<?php
class APPCssCombinder {
    private $css_files=array();
    private $from="";
    private $to="";
    private $maxfileSize=5; //kb
    function __construct(){
        
    }
    /**
     * @param int $size in kb
     */
    public function setMaxFileSize($size){
        $this->maxfileSize=$size;
    }
    public function AddFile($path){
        $this->css_files[]=$path;
    }
    function get_data_url($full_path){       
        $type = pathinfo($full_path, PATHINFO_EXTENSION);
        if(file_exists($full_path)) {
            $data = file_get_contents($full_path);
            return 'data:image/' . $type . ';base64,' . base64_encode($data);
        }else{
            return '';
        }
    }
    function compress (&$code) {
        $code = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code);
        $code = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $code);
        $code = str_replace('{ ', '{', $code);
        $code = str_replace(' }', '}', $code);
        $code = str_replace('; ', ';', $code);        
    }
    public function Save($filepath,$basepath=""){
        $dir=dirname($filepath);
        if(!is_writable($dir)){
            return false;
        }
        $fh = fopen($filepath, 'w');
        if($fh){
            $fileSaveRelativePath=$filepath;
            if(!empty($basepath)){
                $fileSaveRelativePath=str_replace($basepath, "", $fileSaveRelativePath);
            }
            foreach ($this->css_files as $cssfile){
                $cssfileRelative=str_replace($basepath, "", $cssfile);
                $converter = new AppPathConverter($cssfileRelative, $fileSaveRelativePath);
                $fileContent=file_get_contents($cssfile);
                //echo $cssfileRelative."->".$fileSaveRelativePath."<br/>";
                preg_match_all('/url.*?\((.*?)\)/i', $fileContent,$match);
                preg_match_all('/@import.*?["\'](.*?)["\']/', $fileContent,$match2);
                $needtoReplace=array_merge($match[1],$match2[1]);  
                $needtoReplace=array_map(function ($value){return trim($value,'" \'');},$needtoReplace);
                $needtoReplace=array_unique($needtoReplace);
                ;
                $toReplace=array();
                foreach ($needtoReplace as $key=>$f){                   
                    if(strtolower(substr($f, 0,5))=="data:"){
                       unset($needtoReplace[$key]);
                        continue;
                    }
                   
                    $imgfile=$basepath.dirname($cssfileRelative)."/{$f}";
                    if(file_exists($imgfile)){
                        $filesize=filesize($imgfile);
                        if($filesize && ($filesize/1024)<=$this->maxfileSize){                        
                            $toReplace[]=$this->get_data_url($basepath.dirname($cssfileRelative)."/{$f}");
                            continue;
                        }
                    }
                    $newpath=$converter->convert($f);
                    $toReplace[]=$converter->convert($f);
                    //echo $f."=>".$newpath."<br/>";
                }
                $needtoReplace=array_values($needtoReplace);
                //GPrint($needtoReplace);
                //GPrint($toReplace);
                $fileContent=str_replace($needtoReplace, $toReplace, $fileContent);
                $this->compress($fileContent);
                fwrite($fh, $fileContent);                
            }
            fclose($fh);
            //die;
            return true;
        }
        return false;        
    }    
    
}

class AppPathConverter
{
    /**
     * @var string
     */
    protected $from;

    /**
     * @var string
     */
    protected $to;

    /**
     * @param string $from The original base path (directory, not file!)
     * @param string $to   The new base path (directory, not file!)
     */
    public function __construct($from, $to)
    {
        $shared = $this->shared($from, $to);
        if ($shared === '') {
            // when both paths have nothing in common, one of them is probably
            // absolute while the other is relative
            $cwd = getcwd();
            $from = strpos($from, $cwd) === 0 ? $from : $cwd.'/'.$from;
            $to = strpos($to, $cwd) === 0 ? $to : $cwd.'/'.$to;

            // or traveling the tree via `..`
            // attempt to resolve path, or assume it's fine if it doesn't exist
            $from = realpath($from) ?: $from;
            $to = realpath($to) ?: $to;
        }

        $from = $this->dirname($from);
        $to = $this->dirname($to);

        $from = $this->normalize($from);
        $to = $this->normalize($to);

        $this->from = $from;
        $this->to = $to;
    }

    /**
     * Normalize path.
     *
     * @param string $path
     *
     * @return string
     */
    protected function normalize($path)
    {
        // deal with different operating systems' directory structure
        $path = rtrim(str_replace(DIRECTORY_SEPARATOR, '/', $path), '/');

        /*
         * Example:
         *     /home/forkcms/frontend/cache/compiled_templates/../../core/layout/css/../images/img.gif
         * to
         *     /home/forkcms/frontend/core/layout/images/img.gif
         */
        do {
            $path = preg_replace('/[^\/]+(?<!\.\.)\/\.\.\//', '', $path, -1, $count);
        } while ($count);

        return $path;
    }

    /**
     * Figure out the shared path of 2 locations.
     *
     * Example:
     *     /home/forkcms/frontend/core/layout/images/img.gif
     * and
     *     /home/forkcms/frontend/cache/minified_css
     * share
     *     /home/forkcms/frontend
     *
     * @param string $path1
     * @param string $path2
     *
     * @return string
     */
    protected function shared($path1, $path2)
    {
        // $path could theoretically be empty (e.g. no path is given), in which
        // case it shouldn't expand to array(''), which would compare to one's
        // root /
        $path1 = $path1 ? explode('/', $path1) : array();
        $path2 = $path2 ? explode('/', $path2) : array();

        $shared = array();

        // compare paths & strip identical ancestors
        foreach ($path1 as $i => $chunk) {
            if (isset($path2[$i]) && $path1[$i] == $path2[$i]) {
                $shared[] = $chunk;
            } else {
                break;
            }
        }

        return implode('/', $shared);
    }

    /**
     * Convert paths relative from 1 file to another.
     *
     * E.g.
     *     ../images/img.gif relative to /home/forkcms/frontend/core/layout/css
     * should become:
     *     ../../core/layout/images/img.gif relative to
     *     /home/forkcms/frontend/cache/minified_css
     *
     * @param string $path The relative path that needs to be converted
     *
     * @return string The new relative path
     */
    public function convert($path)
    {
        // quit early if conversion makes no sense
        if ($this->from === $this->to) {
            return $path;
        }

        //$path = $this->normalize($path);
        // if we're not dealing with a relative path, just return absolute
        if (strpos($path, '/') === 0) {
            return $path;
        }

        // normalize paths
        //$path = $this->normalize($this->from.'/'.$path);
        $path = $this->from.'/'.$path;

        // strip shared ancestor paths
        $shared = $this->shared($path, $this->to);
        $path = mb_substr($path, mb_strlen($shared));
        $to = mb_substr($this->to, mb_strlen($shared));

        // add .. for every directory that needs to be traversed to new path
        $to = str_repeat('../', mb_substr_count($to, '/'));
        return $this->normalize($to.ltrim($path, '/'));
    }

    /**
     * Attempt to get the directory name from a path.
     *
     * @param string $path
     *
     * @return string
     */
    protected function dirname($path)
    {
        if (is_file($path)) {
            return dirname($path);
        }

        if (is_dir($path)) {
            return rtrim($path, '/');
        }

        // no known file/dir, start making assumptions

        // ends in / = dir
        if (mb_substr($path, -1) === '/') {
            return rtrim($path, '/');
        }

        // has a dot in the name, likely a file
        if (preg_match('/.*\..*$/', basename($path)) !== 0) {
            return dirname($path);
        }

        // you're on your own here!
        return $path;
    }
}
