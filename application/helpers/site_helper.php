<?php

if (!function_exists('get_chef_image_id')) {
    function get_chef_image_id($name, $path = '', $desc = '', $thumb = false) {
        $CI = & get_instance();
        $img = do_upload_image($name, $path, $CI);
        if(!$img['status']) {
            return false;
        }
        if($thumb) {
            gen_thumb($img['data']['file_path'], $img['data']['file_name']);
        }

        return $img;
    }
}

if (!function_exists('get_customer_image_id')) {
    function get_customer_image_id($name, $path = '', $desc = '', $thumb = false) {
        $CI = & get_instance();
        $img = do_upload_image($name, $path, $CI);
        if(!$img['status']) {
            return false;
        }
        if($thumb) {
            gen_thumb($img['data']['file_path'], $img['data']['file_name']);
        }

        return $img;
    }
}

if (!function_exists('get_update_image_id')) {
    function get_update_image_id($name, $path = '', $desc = '', $thumb = false,$user_id) {
        $CI = & get_instance();
        $img = do_upload_image($name, $path, $CI);
        if(!$img['status']) {
            return false;

        }
        if($thumb) {
            gen_thumb($img['data']['file_path'], $img['data']['file_name']);
        }
        $CI->load->model('image/image_model','image');
        return $CI->image->update_image($img['data']['file_name'], $img['data']['file_path'], $desc,$user_id);
    }
}


if (!function_exists('do_upload_image')) {
    function do_upload_image($name, $path = '', $CI = false) {
        $config['upload_path'] = 'uploads/' . $path;
        $config['max_size']     = '2048';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $new_name = $name . '_' . substr(md5(microtime(true)), 0, 18);
        $config['file_name'] = $new_name;
        $CI = $CI ? $CI : get_instance();
        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);
        
        if ($CI->upload->do_upload($name)) {
            $tmp = $CI->upload->data();
            $tmp['file_path'] = $config['upload_path'];
            return ['status' => true, 'data' => $tmp];
        } 
        else {
            return ['status' => false, 'message' => $CI->upload->display_errors()];
        }
    }
}

if (!function_exists('unlink_all')) {
    function unlink_all($image_path, $image_name) {
        @unlink(FCPATH.fix_path($image_path).$image_name);
        @unlink(FCPATH.fix_path($image_path).'thumb/'.$image_name);
    }
}

if(!function_exists('fix_path')){
    function fix_path($path){
        return $path = rtrim($path, '/') . '/';
    }
}

if (!function_exists('do_upload_multi_image')) {
    function do_upload_multi_image($name, $path ='') {
        $config['upload_path'] = 'uploads/' . $path;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $multi_img_details = array();
        $files = $_FILES;
        $cpt = count($_FILES[$name]['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES[$name]['name'] = $files[$name]['name'][$i];
            $_FILES[$name]['type'] = $files[$name]['type'][$i];
            $_FILES[$name]['tmp_name'] = $files[$name]['tmp_name'][$i];
            $_FILES[$name]['error'] = $files[$name]['error'][$i];
            $_FILES[$name]['size'] = $files[$name]['size'][$i];
            $new_name = $name . '_' . substr(md5(time()), 0, 10);
            $config['file_name'] = $new_name;
            $CI = get_instance();
            $CI->load->library('upload', $config);
            $CI->upload->initialize($config);
            $CI->upload->do_upload($name);
            $tmp = $CI->upload->data();
            $tmp['file_path'] = base_url($config['upload_path']);
            $multi_img_details[] = $tmp;
        }
        return $multi_img_details;
    }
}


if(!function_exists('resize_image')){
    function resize_image($image_path=null, $image_name=null, $resize = true, $width = false, $height = false){
        ini_set('memory_limit', '-1');
        $image_path = fix_path($image_path);
        $CI = & get_instance();
        // $simple_image = 'si'.substr(md5(microtime(true)), 0,8);
        $CI->load->library('simple_image');
        $CI->simple_image->load($image_path.$image_name);
        if(!$resize) {
            list($width,$height) = getimagesize($image_path.$image_name);
            if($width > 1300) { $width = 1300; }
            if($height > 1280) { $height = 1280; }
        }
        $CI->simple_image->best_fit($width,$height);
        $CI->simple_image->save($image_path.$image_name,80);
        unset($CI->simple_image);
    }
}

if(!function_exists('gen_thumb')) {
    function gen_thumb($image_path=null, $image_name=null, $width = 200, $height = 200, $quality = 80, $new_name = ''){
        ini_set('memory_limit', '-1');
        $image_path = fix_path($image_path);
        $CI = & get_instance();
        $CI->load->library('simple_image');
        $CI->simple_image->load($image_path.$image_name);
        if(!file_exists($image_path.'thumb/')) {
            mkdir($image_path.'thumb/', 0777, true);
        }
        $CI->simple_image->thumbnail($width,$height);
        $save_name = $new_name == "" ? $image_name : $new_name;
        $CI->simple_image->save($image_path.'thumb/'.$save_name, $quality);
        // unset($CI->simple_image);
    }
}

if(!function_exists('gen_random')) {
    function gen_random($char_limit = 15) {
        return BRAND_SHORT.strtoupper(substr(hash('sha256', mt_rand() . microtime()),0, $char_limit - strlen(BRAND_SHORT)));
    }
}


if (!function_exists('gen_unique_key')) {
    function gen_unique_key($db_column_name = false) {
        if($db_column_name) {
            list($db_name, $column) = explode('.', $db_column_name);
            return check_for_db($db_name, $column);
        } else {
            return gen_random();
        }
    }
}

if (!function_exists('set_flash_all')) {
    function set_flash_all($data = []) {
        $CI =& get_instance();
        $CI->session->set_flashdata($data);
    }
}

if (!function_exists('convertToEnglishLang')) {
    function convertToEnglishLang($string) {
        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string =  str_replace($persianDecimal, $newNumbers, $string);
        $string =  str_replace($arabicDecimal, $newNumbers, $string);
        $string =  str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);
    }
}

if (!function_exists('strReplaceAssoc')) {
    function strReplaceAssoc(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);
    }
}

