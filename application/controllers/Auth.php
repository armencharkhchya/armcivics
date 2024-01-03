<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->global['lang'] = $this->uri->segment(1);
        if ($this->global['lang'] !== 'am' && $this->global['lang'] !== 'en' && $this->global['lang'] !== 'ru') {
            redirect(base_url('am/auth'));
        }  
        $this->lang->load('translate', $this->global['lang']);
        if (!$this->session->customer_id && !$this->session->item) {
            // redirect($this->global['lang'].'/profile/?i=' . uid('123456'));
        }else{
            redirect($this->global['lang'].'/profile/?i=' . uid('1'));
        }
        // 
    }
    
    public function index(){
        $this->load->vars(['title' => $this->lang->line('login_system'), 'lang' => $this->global['lang']]);
        $this->load->view('auth/login');
    }

    public function generate_password(){
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ1234567890';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < 6; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }
    
    public function set_pass($pass) {
        pre($pass);
        pre(password_hash($pass,PASSWORD_DEFAULT));
        pre(sha1(md5(trim(@$pass))));
    }
    
    
}
