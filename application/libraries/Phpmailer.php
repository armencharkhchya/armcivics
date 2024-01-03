<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Phpmailer {

    protected $CI;
    
    public function __construct() {
        $this->CI = &get_instance();
    }

    public function send_email($to, $subject, $message, $file = NULL) {
        $config = Array(
            'protocol'      => PROTOCOL,
            'smtp_host'     => SMTP_HOST,
            'smtp_port'     => SMTP_PORT, 
            'smtp_user'     => SMTP_USER,
            'smtp_pass'     => SMTP_PASS,
            'smtp_crypto'   => SMTP_CRYPTO,
            'smtp_timeout'  => SMTP_TIMEOUT,
            'mailtype'      => MAIL_TYPE,
            'charset'       => CHARSET,
            'newline'       => "\r\n",
            'crlf'          => "\r\n"
        );
        $this->CI->load->library('email', $config);
        $this->CI->email->from(SMTP_USER, 'krtutyun.am');
        $this->CI->email->to($to);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);
        if ($file) {
            $this->CI->email->attach($file);
        }
         if (!$this->CI->email->send()) {
             return false;
         }
        return true;
    }
}