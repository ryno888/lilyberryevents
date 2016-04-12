<?php
/**
 *///--------------------------------------------------------------------------------
class mo_stream {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	// stylesheets that needs to be included using media=screen,print in order
	public static $screen_css_arr = array(
		//"bootstrap",
		"base-pre",
		"jquery-ui-1.9.0",
		"ui.notify",
		"uploadify",
		"uploadifive",
		"superfish",
		"base-post",
	);
	// stylesheets that needs to be included using media=print in order
	public static $print_css_arr = array(
		"print"
	);
	// javascripts that needs to be included in order
	public static $js_arr = array(
		"jquery-1.8.2",
		"jquery-ui-1.9.0",
		"jquery.ui.dialog.patch",
		"jquery.supersubs",
		"jquery.superfish",
		//"bootstrap",
		"jquery.comlist",
		"jquery.comuploader",
		"jquery.uploadifive",
		"jquery.uploadify",
		"jquery.notify",
		"core",
		"com_panel",
		"com_tab",
		"com_form",
		"amcharts",
	);
	// supported file extensions and their content types
	protected static $content_arr = array(
		"jpg" => "image/jpeg",
		"gif" => "image/gif",
		"png" => "image/png",
		"ico" => "image/x-icon",
		"css" => "text/css",
		"js" => "text/javascript",
	);
	// registered groups
	protected static $group_arr = array(
		"jquery",
		"amcharts",
		"uploadify",
		"uploadifive",
		"superfish",
		//"bootstrap",
	);
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
  	/**
     * Streams a file from the core folders. The functions first looks at the project
     * folders before checing the core folder.
     *
     * @param string $name - name of the file to stream
     * @param bool $themed - for use with images, tells the function to look at the theme folders instead
     */
	public static function stream($name, $themed = false, $group = false) {
		// group
		$path = false;

		// init file path
		$pathinfo = pathinfo($name);
		switch ($pathinfo['extension']) {
			case 'jpg' 	:
			case 'png' 	:
			case 'ico' 	:
		}

		// stream file
		self::stream_fromfile($path);
	}
	//--------------------------------------------------------------------------------
  	/**
     * Streams a given file. Will generate a eror 404 and nova error when the file is
     * not found. Also checks browser cached version for changes.
     *
     * @param string $path - full path of the file to stream
     */
	public static function stream_fromfile($path) {
		// file not found
		$fail = false;
		if (!$path || !file_exists($path)) $fail = true;
		$pathinfo = pathinfo($path);

		// supported file type
		if (!$fail) {
			if (!isset(self::$content_arr[$pathinfo["extension"]])) $fail = true;
		}

		// fail with not found
		if ($fail) {
			api_error::create("File not found: $path");
			header("HTTP/1.1 404 Not Found");
			return;
		}

		// close session to allow more requests while content is processed
		api_session::close();

		// init
		$mtime = filemtime($path);
		$id = md5_file($path);

		// headers
		header("Etag: \"$id\"");
		header('Last-Modified: '.gmdate('D, d M Y H:i:s', $mtime).'GMT');

		// content type
	  	ini_set("default_mimetype", self::$content_arr[$pathinfo["extension"]]);
  		ini_set("default_charset", "");
	  	header("Content-type: ".self::$content_arr[$pathinfo["extension"]]);

		// check id
		if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && preg_match("/$id/i", $_SERVER['HTTP_IF_NONE_MATCH'])) {
	    	header("HTTP/1.1 304 Not Modified");
	    	return;
	  	}

	  	// check last modified
	  	if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && (strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $mtime)) {
	    	header("HTTP/1.1 304 Not Modified");
	    	return;
	  	}

	  	// stream file
	  	$filedata = file_get_contents($path);
	  	//header("Content-length: ".strlen($filedata)); // zlib compression on should not try to set content length
	  	header("Content-Disposition: attachment; filename=$pathinfo[basename]");
	  	echo $filedata;
	}
	//--------------------------------------------------------------------------------
	// protected functions
	//--------------------------------------------------------------------------------
  	/**
     * Packs all stylesheets into one file if any changes was made since the last pack
     *
     * @param string $media - stylesheet media type [screen, print]
     */
	protected static function packcss($media = "screen") {
		// init
		$file = "autopack.$media.css";
		$path = DIR_CSS."/$file";
		$packnew = false;
		$css_arr = &self::${"{$media}_css_arr"};

		// check for existing packed css file and determine if there has been changes since last pack
		if (file_exists($path)) {
			$mtime_pack = filemtime($path);
			foreach ($css_arr as $css_item) {
				if (filemtime(DIR_CSS."/$css_item.css") > $mtime_pack) {
					$packnew = true;
					break;
				}
			}
		}
		else $packnew = true;

		// pack css files
		if ($packnew) {
			@unlink($path);
			foreach ($css_arr as $css_item) {
				file_put_contents($path, api_str::compress_css(file_get_contents(DIR_CSS."/$css_item.css")), FILE_APPEND);
			}

			// update force refresh version number
			$version_file = DIR_CSS."/autopack.css.txt";
			if (!file_exists($version_file)) file_put_contents($version_file, 1);
			else {
				$version = file_get_contents($version_file);
				file_put_contents($version_file, $version + 1);
			}
		}

		// return file name
		return $file;
	}
	//--------------------------------------------------------------------------------
  	/**
     * Packs all javascripts into one file if any changes was made since the last pack
     *
     * NO PARAMETERS
     */
	protected static function packjs() {
		// init
		$file_min = "autopack-min.js";
		$path_min = DIR_SCRIPTS."/$file_min";
		$packnew = false;

		// check for existing packed js file and determine if there has been changes since last pack
		if (file_exists($path_min)) {
			$mtime_pack = filemtime($path_min);
			foreach (self::$js_arr as $js_item) {
				if (filemtime(DIR_SCRIPTS."/$js_item.js") > $mtime_pack) {
					$packnew = true;
					break;
				}
			}
		}
		else $packnew = true;

		// pack js files
		if ($packnew) {
			@unlink($path_min);
			$minify_exclude_arr = array("jquery-1.8.2", "jquery-ui-1.9.0");
			foreach (self::$js_arr as $js_item) {
				$content = file_get_contents(DIR_SCRIPTS."/$js_item.js");
				if (!in_array($js_item, $minify_exclude_arr)) $content = JSMin::minify($content);
				file_put_contents($path_min, "{$content}\n", FILE_APPEND);
			}

			// update force refresh version number
			$version_file = DIR_SCRIPTS."/autopack.js.txt";
			if (!file_exists($version_file)) file_put_contents($version_file, 1);
			else {
				$version = file_get_contents($version_file);
				file_put_contents($version_file, $version + 1);
			}
		}
	}
	//--------------------------------------------------------------------------------
	public static function get_fromurl($url, $data_arr = array()) {
		// get context
		$context = null;
		if ($data_arr) {
			$context = stream_context_create(array(
				"http" => array(
					"method" => "POST",
					"ignore_errors" => true,
					"content" => http_build_query($data_arr),
					"header" => "Content-Type: application/x-www-form-urlencoded\r\n",
				),
			));
		}

		// get result from url
		return file_get_contents($url, null, $context);
	}
	//--------------------------------------------------------------------------------
}