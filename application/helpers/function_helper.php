<?php
//Dynamically add Javascript files to header page
if(!function_exists('add_js')){
    function add_js($file='')
    {
        $str = '';
        $ci = &get_instance();
        $header_js = $ci->config->item('header_js');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $header_js[] = $item;
            }
            $ci->config->set_item('header_js',$header_js);
        }else{
            $str = $file;
            $header_js[] = $str;
            $ci->config->set_item('header_js',$header_js);
        }
    }
}

//Dynamically add CSS files to header page
if(!function_exists('add_css')){
    function add_css($file='')
    {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $header_css[] = $item;
            }
            $ci->config->set_item('header_css',$header_css);
        }else{
            $str = $file;
            $header_css[] = $str;
            $ci->config->set_item('header_css',$header_css);
        }
    }
}

//Putting our CSS Files
if(!function_exists('put_headers')){
    function put_headers()
    {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');
        if($header_css){
        foreach($header_css AS $item){
            $str .= '<link rel="stylesheet" href="'.base_url().$item.'" type="text/css" />'."\n";
        }
    }

    /*    foreach($header_js AS $item){
            $str .= '<script type="text/javascript" src="'.base_url().$item.'"></script>'."\n";
        }
*/
        return $str;
    }
}

//Putting JS files
if(!function_exists('put_footers')){
    function put_footers()
    {
        $str = '';
        $ci = &get_instance();
        $header_js  = $ci->config->item('header_js');
        if($header_js){
             foreach($header_js AS $item){
            $str .= '<script type="text/javascript" src="'.base_url().$item.'"></script>'."\n";
            }
        }
       

        return $str;
    }
}

function routeHas($string, $position = 1)
{
    $routeString = strtolower(get_instance()->uri->segment($position));
    if (!$string) {
        return empty($routeString);
    }

    return $routeString === strtolower($string);
}


  if (!function_exists('web_notification_count')) {
        function web_notification_count()
        {
            $CI = & get_instance();
            $CI->load->model('dashboard/dashboard_model','dashboard');
            return $CI->dashboard->notification_count();
           
        }
    }