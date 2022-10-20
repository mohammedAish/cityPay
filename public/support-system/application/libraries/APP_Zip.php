<?php
class APP_Zip extends CI_Zip{
	/**
	 * Read a directory and add it to the zip.
	 *
	 * This function recursively reads a folder and everything it contains (including
	 * sub-folders) and creates a zip based on it. Whatever directory structure
	 * is in the original file path will be recreated in the zip file.
	 *
	 * @param	string	$path	path to source directory
	 * @param	bool	$preserve_filepath
	 * @param	string	$root_path
	 * @return	bool
	 */
	public function read_dir($path, $preserve_filepath = TRUE, $root_path = NULL)
	{	
		$path=str_replace(array('\\','//'), DIRECTORY_SEPARATOR, $path);		
		return parent::read_dir($path, $preserve_filepath, $root_path);
	}
}