<?php
/**
 * @since: 11/08/2020
 * @author: Sarwar Hasan
 * @version 1.0.0
 */

class AppCleanHtml {
	
	// List of tags to be replaced and their replacement
	public static $replace_tags = [
		'i' => 'em',
		'b' => 'strong'
	];
	
	// List of tags to be stripped. Text and children tags will be preserved.
	public static $remove_tags = [
		'acronym',
		'applet',
		'b',
		'basefont',
		'big',
		'bgsound',
		'blink',
		'center',
		'del',
		'dir',
		'font',
		'frame',
		'frameset',
		'hgroup',
		'i',
		'ins',
		'kbd',
		'marquee',
		'nobr',
		'noframes',
		'plaintext',
		'samp',
		'small',
		'span',
		'strike',
		'tt',
		'u',
		'var'
	];

// List of attributes to remove. Applied to all tags.
	public static $remove_attribs = [
		'class',
		//'style',
		'lang',
		'width',
		'height',
		'align',
		'hspace',
		'vspace',
		'dir',
		'id'
	];

// Your HTML code
	static function pre_filter($html){
		// Remove Invisible Characters Again!
		$html = remove_invisible_characters($html);
		//$html=preg_replace('/<\!--.*?-->/im','',$html);
		
		if( preg_match('/<\!--.*?-->/im',$html) !==false || strpos($html,'<!--')){
			$html=strip_tags($html,'<h1><h2><h3><h4><strong><b><br><pre><span><ul><ol><u><font><li><table><tr><img><div><td><th><tbody><thead><tfoot><hr><p><a>');
		}
		return $html;
	}
	protected function _convert_attribute($match)
	{
		return str_replace(array('>', '<', '\\'), array('&gt;', '&lt;', '\\\\'), $match[0]);
	}
	static function replaceTags( $html, $tags=null ) {
		// Clean the HTML
		if(empty($tags)){
			$tags=self::$replace_tags;
		}
		$html = '<div>' . $html . '</div>'; // Workaround to get the HTML back from DOMDocument without the <html><head> and <body> tags
		$dom  = new DOMDocument;
		self::LoadDom($dom,$html);		;
		$html = substr( $dom->saveHTML( $dom->getElementsByTagName( 'div' )->item( 0 ) ), 5, - 6 );
		// Use simple string replace to replace tags
		foreach ( $tags as $search => $replace ) {
			$html = str_replace( '<' . $search . '>', '<' . $replace . '>', $html );
			$html = str_replace( '<' . $search . ' ', '<' . $replace . ' ', $html );
			$html = str_replace( '</' . $search . '>', '</' . $replace . '>', $html );
		}
		
		return $html;
	}
	
	static function stripTags( $html, $tags=null ) {
		if(empty($tags)){
			$tags=self::$remove_tags;
		}
		// Remove all attributes from tags to be removed
		$html = '<div>' . $html . '</div>';
		$dom  = new DOMDocument;
		self::LoadDom($dom,$html);
		foreach ( $tags as $tag ) {
			$nodes = $dom->getElementsByTagName( $tag );
			foreach ( $nodes as $node ) {
				// Remove attributes
				while ( $node->attributes->length ) {
					$node->removeAttribute( $node->attributes->item( 0 )->name );
				}
			}
		}
		$html = substr( $dom->saveHTML( $dom->getElementsByTagName( 'div' )->item( 0 ) ), 5, - 6 );
		
		// Strip tags using string replace
		foreach ( $tags as $tag ) {
			$html = str_replace( '<' . $tag . '>', '', $html );
			$html = str_replace( '</' . $tag . '>', '', $html );
		}
		
		return $html;
	}
	
	static function stripAttributes( $html, $attribs =null) {
		if(empty($attribs)){
			$attribs=self::$remove_attribs;
		}
		
		// Find all nodes that contain the attribute and remove it
		$html = '<div>' . $html . '</div>';
		$dom  = new DOMDocument;
		self::LoadDom($dom,$html);
		$xPath = new DOMXPath( $dom );
		foreach ( $attribs as $attrib ) {
			$nodes = $xPath->query( '//*[@' . $attrib . ']' );
			foreach ( $nodes as $node ) {
				/*//$node= new DOMElement();
				if($node->nodeName!='div' && $attrib=='style'){
					continue;
				}*/
				$node->removeAttribute( $attrib );
				
			}
			
		}
		$specealAttr=['href'];
		foreach ($specealAttr as $attrib) {
			$anodes = $xPath->query( '//*[@' . $attrib . ']' );
			foreach ( $anodes as $node ) {
				if ( empty( $node ) ) {
					$node = new DOMElement();
				}
				$data = $node->getAttribute( $attrib );
				if ( preg_match( '/javascript|alert|location|script/i', $data ) ) {
					$node->removeAttribute( $attrib );
				}
			}
		}
		
		return substr( $dom->saveHTML( $dom->getElementsByTagName( 'div' )->item( 0 ) ), 5, - 6 );
	}
	static function LoadDom(&$dom,&$html){
	    if(version_compare(LIBXML_DOTTED_VERSION ,'2.7.7','>=')) {
            if (function_exists("mb_convert_encoding")) {
                $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            } else {
                $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            }
        }else{
            $dom->loadHTML('<?xml encoding="UTF-8">' . $html);
        }
	}
	static function CleanHTML( $html ,$repTags=null,$stripTags=null,$stripAttbute=null) {
		$html = self::pre_filter($html);
		$html = self::replaceTags($html,$repTags);
		$html = self::stripTags($html,$stripTags);
		$html = self::stripAttributes($html,$stripAttbute);
		return $html;
	}
	
	static function CleanHTMLForDirectTicketReply($html){
		$remove_attribs = [
			
			//'style',
			'lang',
			'align',
			'hspace',
			'vspace',
			'dir',
			'id',
			'onclick',
			'onchange',
			'onmouseover',
			'onmouseout',
			'onkeydown',
			'onload',
			'onerror'
		];
		$remove_tags = [
			'acronym',
			'applet',
			'b',
			'basefont',
			'big',
			'bgsound',
			'blink',
			'center',
			'del',
			'dir',
			'font',
			'frame',
			'frameset',
			'hgroup',
			'i',
			'ins',
			'kbd',
			'marquee',
			'nobr',
			'noframes',
			'plaintext',
			'samp',
			'small',
			'span',
			'strike',
			'tt',
			'u',
			'var',
			'script',
			'style'
		];
		
		$replace_tags = [
			'i' => 'em',
			'b' => 'strong'
		];
		$html = self::pre_filter($html);
		$html = self::replaceTags($html,$replace_tags);
		$html = self::stripTags($html,$remove_tags);
		$html = self::stripAttributes($html,$remove_attribs);
		//$html=preg_replace('/javascript|alert\(|/')
		return $html;
	}
	
}