<?php
//Change the language based on the API request
if(!function_exists('api_request_language')){
    function api_request_language($lan='', $text='')
    {
        $ci = & get_instance();
        $ci->lang->load('information', $lan);
        return $ci->lang->line($text);
    }
}