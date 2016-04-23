<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Debug Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Yura Loginov
 * @link		https://github.com/yuraloginoff/codeigniter-debug-helper.git
 */
// ------------------------------------------------------------------------
/**
 * Readable console
 *
 * Prints human-readable information about a variable
 *
 * @access	public
 * @param	mixed 
 */
if ( ! function_exists('console'))
{
	function console($var)
	{
		$CI =& get_instance();
        $filename = DIR_ERROR_FILE;
        mo_file::make_dir(dirname($filename));
        $file = fopen($filename,"a+");
        fwrite($file,print_r($var, true)."\r\n");
        fclose($file);
	}
}
// ------------------------------------------------------------------------
/**
 * Readable view
 *
 * Prints human-readable information about a variable
 *
 * @access	public
 * @param	mixed 
 */
if ( ! function_exists('view'))
{
	function view($var)
	{
		$CI =& get_instance();
		echo '<pre>' . print_r($var, TRUE) . '</pre>';
	}
}
// ------------------------------------------------------------------------
/**
 * Readable vardump
 *
 * Readable dump information about a variable
 *
 * @access	public
 * @param	mixed * 
 */
if ( ! function_exists('vardump'))
{
	function vardump($var)
	{
		$CI =& get_instance();
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
}
/* End of file debug_helper.php */
/* Location: ./application/helpers/debug_helper.php */