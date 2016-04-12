<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class mo_file{
    //--------------------------------------------------------------------------
    public static function base64_to_jpeg($image_data, $output_file ) {
        $base64_string = self::decompress_image($image_data);
        $ifp = fopen( $output_file, "wb" ); 
        fwrite( $ifp, base64_decode( $base64_string) ); 
        fclose( $ifp ); 
        return( $output_file ); 
    }
    //--------------------------------------------------------------------------
    public static function compress_image($uploaded_file, $type){
        $data = base64_encode($uploaded_file);
        $encoded_data = 'data: '.$type.';base64,'.$data;
        return base64_encode(gzcompress($encoded_data, 9));
    }
    //--------------------------------------------------------------------------
    public static function decompress_image($image_data){
        $encoded_data = base64_decode($image_data);
        return gzuncompress($encoded_data);
    }
    //--------------------------------------------------------------------------
    public static function insert_uploaded_file_in_db($file_arr = [], $alb_id = null){
        $options_arr = array_merge([
            "file_name" => time(),
            "type" => "image/jpeg",
            "tmp_name" => false,
        ],$file_arr);
        
        if($options_arr['tmp_name']){
            $dest_dir = DIR_IMAGES.'/albums/temp/';
            mo_file::make_dir($dest_dir);
            $path = mo_file::resize_image(
                $options_arr['tmp_name'], 
                $options_arr['file_name'], 
                $options_arr['type'],
                ["dest_dir" => $dest_dir]
            );
            
            $temp_file = file_get_contents($path);
            $base64_file = mo_file::compress_image($temp_file, $options_arr['type']);

            $image = db::get_default("image");
            $image->img_data = $base64_file;
            $image->img_ref_album = $alb_id;
            $image->img_name = $options_arr['file_name'];
            $image->img_date_created = date::get_date();
            $image->img_type = $options_arr['type'];
            return db::insert($image);
        }
        
    }
    //--------------------------------------------------------------------------
    public static function get_uploaded_files(){
        $return = [];
        if(!empty($_FILES)){
            foreach ($_FILES['input4']['tmp_name'] as $key => $value) {
                $return[] = [
                    "file_name" => $_FILES['input4']['name'][$key],
                    "type" => $_FILES['input4']['type'][$key],
                    "tmp_name" => $value,
                ];
            }
        }
        return $return;
    }
    //--------------------------------------------------------------------------
    public static function resize_image($tmp_name, $name, $type, $options = []){
        $options_arr = array_merge([
            "width" => false,
            "height" => false,
            "dest_dir" => false,
        ],$options);
        
        
        /* Get original image x y*/
        list($w, $h) = getimagesize($tmp_name);
        
        if(!$options_arr['width']){
            $size_arr = mo_file::reduce_size($w, $h);
            $options_arr['width'] = $size_arr['width'];
            $options_arr['height'] = $size_arr['height'];
        }
        
        /* calculate new image size with ratio */
        $ratio = max($options_arr['width']/$w, $options_arr['height']/$h);
        $h = ceil($options_arr['height'] / $ratio);
        $x = ($w - $options_arr['width'] / $ratio) / 2;
        $w = ceil($options_arr['width'] / $ratio);
        /* new file name */
        $path = $options_arr['dest_dir'] ? $options_arr['dest_dir'].'/'.$options_arr['width'].'x'.$options_arr['height'].'_'.$name : DIR_IMAGES.'/albums/'.time().'/'.$options_arr['width'].'x'.$options_arr['height'].'_'.$name;
        /* read binary data from image file */
        $imgString = file_get_contents($tmp_name);
        /* create image from string */
        $image = imagecreatefromstring($imgString);
        $tmp = imagecreatetruecolor($options_arr['width'], $options_arr['height']);
        imagecopyresampled($tmp, $image,
            0, 0,
            $x, 0,
            $options_arr['width'], $options_arr['height'],
            $w, $h);
        /* Save image */
        switch ($type) {
            case 'image/jpeg':
              imagejpeg($tmp, $path, 100);
              break;
            case 'image/png':
              imagepng($tmp, $path, 0);
              break;
            case 'image/gif':
              imagegif($tmp, $path);
              break;
            default:
              exit;
              break;
        }
        return $path;
        /* cleanup memory */
        imagedestroy($image);
        imagedestroy($tmp);
    }
    //--------------------------------------------------------------------------
    /**
     * creates a new directory if it doesnt exist
     * @param type $url
     * @return type - the url of the new directory
     */
    public static function make_dir($url) {
        $url = str_replace("//", "/", $url);
        $return = false;
        if (!is_dir($url)) {
            mkdir($url, 0777, true);  
            $return = $url;
        }else if(is_dir($url)) {
            $return = $url;
        }
        return $return;
    }
	//--------------------------------------------------------------------------------
    /**
     * Replaces an old file with a new file
     * @param type $dir_url - the saving directory
     * @param type $temp_url - the temp directory where file was uploaded to
     * @param type $old_filename - the old filename
     * @param type $new_filename - the newly uploaded filename
     * @param type $new_width
     * @param type $new_height
     * @return type - returns the new files url upon success, else returns false
     */
    public static function replace_file($dir_url, $temp_url, $new_filename, $old_filename = false, $new_width = "100", $new_height = "100") {
            $dir_is_empty = $old_filename ? self::delete_file($dir_url, $old_filename) : true;
            if($dir_is_empty){
                api_image::tofixed($temp_url.$new_filename, $dir_url.$new_filename, $new_width, $new_height, 100);
            }
            return file_exists($dir_url.$new_filename) ? $dir_url.$new_filename : false;
    }
	//--------------------------------------------------------------------------------
    /**
     * Deletes the file in the url stated
     * @param type $dir_url
     * @param type $filename
     * @return boolean
     */
    public static function delete_file($dir_url, $filename = false) {
            if($filename && file_exists($dir_url.$filename)){
                unlink($dir_url.$filename);
                return !file_exists($dir_url.$filename) ? true : false;
            }else if(!$filename && file_exists($dir_url)){
                unlink($dir_url);
                return !file_exists($dir_url) ? true : false;
            }else{
                return true;
            }
            
    }
    //--------------------------------------------------------------------------------
    /**
     * reduces the image size (without strecthing) in proportion to the prefered height and width given
     * @param type $file_url - absolute path of the image
     * @param type $prefered_height
     * @param type $prefered_width
     * @return type
     */
    public static function reduce_image_size($file_url, $prefered_width = "1024") {
        
        //get current file size
        if(!file_exists($file_url)) return false;
        
        $size = getimagesize($file_url);
        $current_width = $size[0];
        $current_height = $size[1];
        
        if($current_width < $prefered_width){
            return array("width" => $current_height, "height" => $current_width);
        }
        
        // calculate reduce size percentage
        $percentage_reduction = ($prefered_width / $current_width) * 100;
        $reduced_height = floor(($current_height / 100) * $percentage_reduction);
        $reduced_width = floor(($current_width / 100) * $percentage_reduction);
        return array("width" => $reduced_width, "height" => $reduced_height);
	}
    //--------------------------------------------------------------------------------
    /**
     * reduces the image size (without strecthing) in proportion to the prefered height and width given
     * @param type $prefered_width
     * @return type
     */
    public static function reduce_size($current_width, $current_height, $prefered_width = "1024") {
        
        if($current_width < $prefered_width){
            return array("width" => $current_height, "height" => $current_width);
        }
        
        // calculate reduce size percentage
        $percentage_reduction = ($prefered_width / $current_width) * 100;
        $reduced_height = floor(($current_height / 100) * $percentage_reduction);
        $reduced_width = floor(($current_width / 100) * $percentage_reduction);
        return array("width" => $reduced_width, "height" => $reduced_height);
	}
    //--------------------------------------------------------------------------------
    public static function add_stream_headers($filename, $download = true) {
    	// clear output buffer
		if (ob_get_level()) ob_end_clean();

		// add stream headers
		header('Pragma: public');
		header('Cache-Control: public');
		header('Content-Description: File Transfer');
		header('Content-Transfer-Encoding: binary');
		header('Content-Type: application/octet-stream');
		header("HTTP/1.1 200 OK");
		if ($download) header('Content-Disposition: attachment; filename="'.$filename.'"');
    }
    //--------------------------------------------------------------------------------
	public static function stream($data, $filename, $download = true) {
		self::add_stream_headers($filename, $download);
		//header('Content-Length: '.strlen($data));
		echo $data;
	}
    //--------------------------------------------------------------------------------
	public static function stream_file($filepath, $filename = false, $download = true) {
		if (file_exists($filepath)) {
			$data = file_get_contents($filepath);
			self::stream($data, ($filename ? $filename : basename($filepath)), $download);
		}
	}
    //--------------------------------------------------------------------------------
	public static function format_file_name($filename, $path = "") {
        
        if(!$filename){
            return false;
        }else{
            if(file_exists($path.$filename)){
                $new_filename = self::get_file_extension($filename);
                rename($path.$filename, $path.$new_filename);
            }
        }
	}
    //--------------------------------------------------------------------------------
	public static function get_file_extension($filename, $return_extension = false) {
        if(!$filename){
            return false;
        }else{
            $pos = explode(".", str_replace("./", "/", $filename));
            $filename = $pos[0];
            $ext = $pos[1];
            if($ext === "JPEG"){
                return $filename.".jpg";
            }else if($ext === "JPG"){
                return $filename.".jpg";
            }else{
                return $filename;
            }
        }
	}
	//--------------------------------------------------------------------------------
}

