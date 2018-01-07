<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// application/helpers/asset_helper.php 
if (!function_exists('assetUrl'))
{
    function assetUrl()
    {
        // the helper function doesn't have access to $this, so we need to get a reference to the 
        // CodeIgniter instance.  We'll store that reference as $CI and use it instead of $this 
        $CI =& get_instance();

        // return the asset_url 
        //I've added the config item assetsPath 
        // in a custom config file which is autoloaded 
        return base_url() . $CI->config->item('assetsPath');
    }
}

if (!function_exists('hardImgUrl')){
     
     function hardImgUrl()
     {
        $CI =& get_instance();
        //return  "/home/student/000328298/public_html/private/hololens/application/assets/img/";
        return $CI->config->item('imgPath'); 
     }
}

if (!function_exists('profilePicturePath'))
{
    function profilePicturePath()
    {
        $CI =& get_instance();

        return $CI->config->item('profilePicturePath');
    }
}