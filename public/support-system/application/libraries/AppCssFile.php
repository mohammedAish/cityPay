<?php
	class AppCssFile {
		public $is_combindable = false;
		public $url;
		public $id;
		public $actual_path ;
		
		public function __toString() {
			return $this->url;
		}
	}