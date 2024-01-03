<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Login extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
            $this->load->model('Login_model');
        }
        
        public function index() {
            isLoggedIn();
        }
        
        public function loginMe() {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
            if($this->form_validation->run() == FALSE) {
                 $this->index();
            } else {
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $result = $this->Login_model->loginMe($email, $password);
                if(!empty($result)) {
                    $lastLogin = $this->Login_model->lastLoginInfo($result->userId);
                    $sessionArray = array(
                                        'userId'=>$result->userId,                    
                                        'role'=>$result->roleId,
                                        'roleText'=>$result->role,
                                        'name'=>$result->name,
                                        'lastLogin'=> $lastLogin->createdDtm,
                                        'isLoggedIn' => TRUE
                                        );
                    $this->session->set_userdata($sessionArray);
                    unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);
                    $loginInfo = array("userId"=>$result->userId, "sessionData" => json_encode($sessionArray), "machineIp"=>$_SERVER['REMOTE_ADDR'], "userAgent"=>getBrowserAgent(), "agentString"=>$this->agent->agent_string(), "platform"=>$this->agent->platform());
                    $this->Login_model->lastLogin($loginInfo);
                    redirect('login');
                } else {
                    $this->session->set_flashdata('error', 'Էլ.փոստի կամ գաղտնաբառի անհամապատասխանություն');                    
                    $this->index();
                }
            }
        }
        
        public function forgotPassword() {
            $isLoggedIn = $this->session->userdata('isLoggedIn');
            if(!isset($isLoggedIn) || $isLoggedIn != TRUE) {
                $this->load->view('admin/forgotPassword');
            } else {
                redirect('admin');
            }
        }
        
        public function resetPasswordUser() {
            $status = '';
            $this->load->library('form_validation');
            $this->form_validation->set_rules('login_email','Email','trim|required|valid_email');
            if($this->form_validation->run() == FALSE) {            
                $this->forgotPassword();
            } else  {
                $email = strtolower($this->security->xss_clean($this->input->post('login_email')));
                if($this->Login_model->checkEmailExist($email)) {
                    $encoded_email = urlencode($email);
                    $this->load->helper('string');
                    $data['email'] = $email;
                    $data['activation_id'] = random_string('alnum',15);
                    $data['createdDtm'] = date('Y-m-d H:i:s');
                    $data['agent'] = getBrowserAgent();
                    $data['client_ip'] = $this->input->ip_address();
                    $save = $this->Login_model->resetPasswordUser($data);  
                    if($save) {
                        $data1['reset_link'] = base_url('login/resetPasswordConfirmUser/'). $data['activation_id'] . "/" . $encoded_email;
                        $userInfo = $this->Login_model->getCustomerInfoByEmail($email);
                        if(!empty($userInfo)){
                            $data1["name"] = $userInfo->name;
                            $data1["email"] = $userInfo->email;
                            $data1["message"] = "Reset Your Password";
                        }
                        $sendStatus = resetPasswordEmail($data1);
                        if($sendStatus){
                            $status = "send";
                            setFlashData($status, "Հղումն ուղարկված է: Խնդրում ենք ստուգել նամակները:");
                        } else {
                            $status = "notsend";
                            setFlashData($status, "Էլ.փոստը ձախողվեց, կրկին փորձեք:");
                        }
                    } else {
                        $status = 'unable';
                        setFlashData($status, "Տվյալներն ուղարկելիս սխալ է տեղի ունեցել, կրկին փորձեք:");
                    }
                } else {
                    $status = 'invalid';
                    setFlashData($status, "Այս էլ. Փոստը գրանցված չէ մեզ մոտ:");
                }  
                 redirect('login/forgotPassword');
            }
        }
        
        public function resetPasswordConfirmUser($activation_id, $email) {
            $email = urldecode($email);
            $is_correct = $this->Login_model->checkActivationDetails($email, $activation_id);
            $data['email'] = $email;
            $data['activation_code'] = $activation_id;
            if ($is_correct == 1) {
                $this->load->view('admin/newPassword', $data);
            } else {
                redirect('login');
            }
        }
        
        public function createPasswordUser() {
            $status = '';
            $message = '';
            $email = strtolower($this->input->post("email"));
            $activation_id = $this->input->post("activation_code");
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            if($this->form_validation->run() == FALSE) {
                $this->resetPasswordConfirmUser($activation_id, urlencode($email));
            } else {
                $password = $this->input->post('password');
                $cpassword = $this->input->post('cpassword');
                $is_correct = $this->Login_model->checkActivationDetails($email, $activation_id);
                if($is_correct == 1) {                
                    $this->Login_model->createPasswordUser($email, $password);
                    $status = 'success';
                    $message = 'Գաղտնաբառը հաջողությամբ վերագործարկվեց';
                } else {
                    $status = 'error';
                    $message = 'Գաղտնաբառի վերակայումը ձախողվեց';
                }
                setFlashData($status, $message);
                redirect("login");
            }
        }
    }
?>