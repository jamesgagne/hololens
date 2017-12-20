<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * 
 *  This template library can be used to automatically build 
 *    views with a header, navigation and footer 
 * 
 * 
 *    Usage: $this->template->show('view', $args); 
 *    Note: make sure to include in autoload.php 
 * 
 * 
 */
class Template
{
    function show($main_view, $args = NULL)
    {
        $CI =& get_instance();

        $CI->load->view('template/header', $args);

        $CI->load->view("main/" . $main_view, $args);

		$CI->load->view('template/footer', $args);
    }
}
?>