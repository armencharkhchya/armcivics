<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

    function pre($data) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    
    if(!function_exists('getHashedPassword')) {
        function getHashedPassword($plainPassword) {
            return password_hash($plainPassword, PASSWORD_DEFAULT);
        }
    }
    
    if(!function_exists('verifyHashedPassword')) {
        function verifyHashedPassword($plainPassword, $hashedPassword) {
            return password_verify($plainPassword, $hashedPassword) ? true : false;
        }
    }
    
    if(!function_exists('getBrowserAgent'))  {
        function getBrowserAgent() {
            $CI = &get_instance();
            $CI->load->library('user_agent');

            $agent = '';

            if ($CI->agent->is_browser())
            {
                $agent = $CI->agent->browser().' '.$CI->agent->version();
            }
            else if ($CI->agent->is_robot())
            {
                $agent = $CI->agent->robot();
            }
            else if ($CI->agent->is_mobile())
            {
                $agent = $CI->agent->mobile();
            }
            else
            {
                $agent = 'Unidentified User Agent';
            }
            return $agent;
        }
    }

    if(!function_exists('setProtocol')) {
        function setProtocol() {
            $CI = &get_instance();
            $CI->load->library('email');
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'smtp.office365.com';
            $config['smtp_port'] = '587';
            $config['smtp_user'] = 'noreply@ktak.am';
            $config['smtp_pass'] = 'Quva9810';
            $config['smtp_crypto'] = 'tls';
            $config['smtp_timeout'] = '15';
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['crlf'] = "\r\n";
            $CI->email->initialize($config);
            return $CI;
        }
    }

    if(!function_exists('resetPasswordEmail')) {
        function resetPasswordEmail($detail) {
            $data["data"] = $detail;
            $CI = setProtocol(); 
            $CI->email->from('noreply@ktak.am', 'ktak.am');
            $CI->email->subject("Reset Password");
            $CI->email->message($CI->load->view('admin/email/resetPassword', $data, TRUE));
            $CI->email->to($detail["email"]);
            $status = $CI->email->send();
            return $status;
        }
    }
    
    if(!function_exists('setFlashData')) {
        function setFlashData($status, $flashMsg) {
            $CI = get_instance();
            $CI->session->set_flashdata($status, $flashMsg);
        }
    }
    
    function ip_address() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $ip = explode(',', $ip)[0];
        return $ip;
    }

    function load_page($page, $lang = 'am', $field_array = NULL, $field_value = NULL) {
        $self = &get_instance();
        load_vars($field_array, $field_value);
        $self->load->vars([
            'lang'       => $lang
        ]);
        $self->load->view('front/includes/header');
        $self->load->view($page);
        $self->load->view('front/includes/footer');
    }

    function load_vars($field_array, $field_value = NULL) {
        $self = &get_instance();
        if (is_array($field_array)) {
            $self->load->vars($field_array);
        } else {
            $self->load->vars(array($field_array => $field_value));
        }
    }

    function lang($lang = NULL) {
        if($lang === 'ru'){
            return 2;
        }
        if($lang === 'en'){
            return 3;
        }
        if($lang === 'am') {
            return 1;
        }
        return 1;
    }
    
    function language($link = NULL, $lang = 'am', $change_lang = NULL) {
        $data = [
            'am' => 'am',
            'ru' => 'ru',
            'en' => 'en',
        ];
        $link = str_replace('/' . $lang, '/' . $data[$change_lang], $link );
        return $link . ($_SERVER['QUERY_STRING'] ? ('?' . $_SERVER['QUERY_STRING']) : '');
    }
    
    function my_date($date, $lang = NULL, $all = NULL) {
        $self = &get_instance();
        if(date("Y-m-d") == date('Y-m-d', strtotime($date)) && $all !== true) {
            return $self->lang->line('today') . ' ' . date('H:i', strtotime($date));
        }
        $month = [
            'am' => [
                1 => 'Հունվար',
                2 => 'Փետրվար',
                3 => 'Մարտ',
                4 => 'Ապրիլ',
                5 => 'Մայիս',
                6 => 'Հունիս',
                7 => 'Հուլիս',
                8 => 'Օգոստոս',
                9 => 'Սեպտեմբեր',
                10 => 'Հոկտեմբեր',
                11 => 'Նոյեմբեր',
                12 => 'Դեկտեմբեր',
            ],
            'ru' => [
                1 => 'Январь',
                2 => 'Февраль',
                3 => 'Март',
                4 => 'Апрель',
                5 => 'Май',
                6 => 'Июнь',
                7 => 'Июль',
                8 => 'Август',
                9 => 'Сентябрь',
                10 => 'Октябрь',
                11 => 'Ноябрь',
                12 => 'Декабрь',
            ],

            'en' => [
                1 => 'January',
                2 => 'February',
                3 => 'March',
                4 => 'April',
                5 => 'May',
                6 => 'June',
                7 => 'July',
                8 => 'August',
                9 => 'September',
                10 => 'October',
                11 => 'November',
                12 => 'December',
            ],
        ];
        $m = $month[$lang][intval(date('m', strtotime($date)))];
        $new_date = date(' d ', strtotime($date)) . ' ' . $m . ' ' . date('Y', strtotime($date));
        if ($all === true) {
            $new_date = date(' d ' . $m . ' Y H:i', strtotime($date));
        }
        return $new_date;
    }
    
    function to_mysql_date($date) {
        $date 		= date_create_from_format('d.m.Y', "{$date}");
        $new_date 	= @date_format($date, 'Y-m-d');
        return $new_date;
    }
    
    function _pagination($base_url,$count,$per_page = 9) {   
        $config = array();
        $config['base_url'] = $base_url;
        $config['total_rows'] = $count;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;

        $config['num_links'] = 3;
        $config['use_page_numbers'] = true;
        $config['page_query_string'] = true;
        $config['reuse_query_string'] = true;
        $config['query_string_segment'] = 'page';

        // $config['prev_link'] = '«';
        // $config['next_link'] = '»';
        // $config['first_link'] = '««';
        // $config['last_link'] = '»»';
         //config for bootstrap pagination class integration
         $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
         $config['full_tag_close'] = '</ul>';
         $config['first_link'] = false;
         $config['last_link'] = false;
         $config['first_tag_open'] = '<li class="page-item><span class="page-link">';
         $config['first_tag_close'] = '</span></li>';
         $config['prev_link'] = '<span class="page-link">&laquo</span>';
         $config['prev_tag_open'] = '<li class="page-item">';
         $config['prev_tag_close'] = '</li>';
         $config['next_link'] = '<span class="page-link">&raquo</span>';
         $config['next_tag_open'] = '<li class="page-item">';
         $config['next_tag_close'] = '</li>';
         $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
         $config['last_tag_close'] = '</span></li>';
         $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
         $config['cur_tag_close'] = '</a></li>';
         $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
         $config['num_tag_close'] = '</span></li>';
        
        return $config;
    }

    function decrypt($uid){
        return (int)substr($uid, 32, -32);
    }

    function uid($id){
        return (string)md5(rand(-50000, 50000) % rand(-6400000, 6400000)) . $id . md5(rand(-50000, 50000) % rand(-6400000, 6400000));
    }

    function keyGen($length = 32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    function cdn($src = NULL, $w = NULL, $h = NULL) {
        $cdn = base_url().'images/upload/';
        if (!$src || $src == ' ') {
            $src = 'default.png';
        }
        $src = $cdn . $src;
        if (!$w || !$h) {
            return $src;
        }
        $img = base_url('timthumb.php?src=' . $src . '&w=' . $w . '&h=' . $h);
        return $img;
    }

    function cdn_st($src = NULL, $w = NULL, $h = NULL) {
        $cdn = base_url() . 'images/static/';
        if (!$src || $src == ' ') {
            $src = 'default.png';
        }
        $src = $cdn . $src;
        if (!$w || !$h) {
            return $src;
        }
        $img = base_url('timthumb.php?src=' . $src . '&w=' . $w . '&h=' . $h);
        return $img;
    }

    function cdn_tm($src = NULL, $w = NULL, $h = NULL){
        $cdn = base_url() . 'images/team/';
        if (!$src || $src == ' ') {
            $src = 'default.png';
        }
        $src = $cdn . $src;
        if (!$w || !$h) {
            return $src;
        }
        $img = base_url('timthumb.php?src=' . $src . '&w=' . $w . '&h=' . $h);
        return $img;
    }

    function cdn_lt($src = NULL, $w = NULL, $h = NULL){
        $cdn = base_url() . 'documents/img/';
        if (!$src || $src == ' ') {
            $src = 'default.png';
        }
        $src = $cdn . $src;
        if (!$w || !$h) {
            return $src;
        }
        $img = base_url('timthumb.php?src=' . $src . '&w=' . $w . '&h=' . $h);
        return $img;
    }

    function cdn_cl($src = NULL, $w = NULL, $h = NULL){
        $cdn = base_url() . 'images/client/';
        if (!$src || $src == ' ') {
            $src = 'default.png';
        }
        $src = $cdn . $src;
        if (!$w || !$h) {
            return $src;
        }
        $img = base_url('timthumb.php?src=' . $src . '&w=' . $w . '&h=' . $h);
        return $img;
    }

    function isLoggedIn() {
        $self = &get_instance();
        $isLoggedIn = $self->session->userdata('isLoggedIn');
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            $self->load->view('admin/login');
        }
        else { 
            redirect('admin'); 
        }
    }
    
    function resizeImage($upload_path) {
        $self = &get_instance();
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = '*';
        $config['max_size'] = '10000';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = true;
        $image_data = array();
        if ($_FILES) {
            $self->load->library('upload', $config);
            if (!$self->upload->do_upload('image_name')) {
                $data['error'] = $self->upload->display_errors();
                if ($image_data) {
                    $file = $upload_path.$image_data['file_name'];
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
            } else {
                $image_data = $self->upload->data();
                $imgConfig = array();
                $imgConfig['image_library'] = 'GD2';
                $imgConfig['source_image'] = $image_data['full_path'];
                $imgConfig['maintain_ratio'] = true;
                $imgConfig['width'] = 1600;
                $imgConfig['height'] = 520;
                $self->load->library('image_lib', $imgConfig);
                $self->image_lib->initialize($imgConfig);
                $self->image_lib->resize();
                $self->image_lib->clear();
                $data['resize_img'] = $upload_path.$image_data['file_name'];
            }
        }
    }

    function parse_bbcode($str = '', $max_images = 0){
        // Max image size eh? Better shrink that pic!
        if ($max_images > 0) :
            $str_max = "style=\"max-width:" . $max_images . "px; width: [removed]this.width > " . $max_images . " ? " . $max_images . ": true);\"";
        endif;

        $find = array(
            "'\[b\](.*?)\[/b\]'is",
            "'\[i\](.*?)\[/i\]'is",
            "'\[u\](.*?)\[/u\]'is",
            "'\[s\](.*?)\[/s\]'is",
            "'\[img\](.*?)\[/img\]'i",
            "'\[url\](.*?)\[/url\]'i",
            "'\[url=(.*?)\](.*?)\[/url\]'i",
            "'\[link\](.*?)\[/link\]'i",
            "'\[link=(.*?)\](.*?)\[/link\]'i"
        );

        $replace = array(
                '<strong>\\1</strong>',
                '<em>\\1</em>',
                '<u>\\1</u>',
                '<s>\\1</s>',
                '<img src="\\1" alt="" />',
                '<a href="\\1">\\1</a>',
                '<a href="\\1">\\2</a>',
                '<a href="\\1">\\1</a>',
                '<a href="\\1">\\2</a>'
            );

        return preg_replace($find, $replace, $str);
    }
    
    function fn_upload($file_name, $path, $types = '*') {	
		$self = &get_instance();
		$config = array();
		$config['upload_path'] = $path;
		$config['allowed_types'] = $types;
		$config['max_size']    = '0';
		$config['encrypt_name'] = true;
		$self->load->library('upload');		
		$self->upload->initialize($config);		
		if(!is_dir($path)){
			@mkdir($path, 0777, true);
		}		
		if ( ! $self->upload->do_upload($file_name)) {
			throw new Exception($self->upload->display_errors());
		} else {
			$__file =  $self->upload->data();		
			return $__file;
		}
	}
        
?>