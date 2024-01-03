<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	protected $global = array ();
	
	public function __construct() {
		parent::__construct();	
		date_default_timezone_set('Asia/Yerevan');		
		$this->global['lang'] = $this->uri->segment(1);
		if(!$this->global['lang'] || ($this->global['lang'] !== 'am' && $this->global['lang'] !== 'en' && $this->global['lang'] !== 'ru')) { redirect(base_url('am')); }  
		$this->lang->load('translate',$this->global['lang']);
		$this->load->model('Profile_model');
		$this->load->model('Articles_model');
		$this->global['not_items'] = $this->lang->line('not_items_query');
		$this->breadcrumbs->push($this->lang->line('home'), '/'. $this->global['lang']);		
	}
    
    public function index(){
		$this->breadcrumbs->push($this->lang->line('profile'), 'page');		
		$this->global['breadcrumbs'] = $this->breadcrumbs->show();
		$this->global['title'] = $this->lang->line('profile');
		$count = $this->Articles_model->get_count_by_students_funds();
		$config = _pagination(base_url() . $this->global['lang'] . '/profile', $count);
		$this->pagination->initialize($config);
		$page = intval($this->input->get('page'));
		if ($page > ceil($count / $config['per_page'])) {
			return $this->my404();
		}
		$this->global['links'] = $this->pagination->create_links();
		$this->global['items'] = $this->Articles_model->get_all_students_funds($config['per_page'], $page);
        load_page('front/profile', $this->global['lang'], $this->global);      
    }
	
	public function getProgramById(){
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }		
		$data = $this->Profile_model->getProgramById($this->input->post('id'));
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
	
	 public function addOrUpdateItem(){  
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }	          
        $query = $this->Profile_model->addOrUpdateItem();
        if ($query) {
            echo json_encode([
				'status'=>1,
				'message'=> $this->lang->line('successful'),
            ]);
		}else{
			echo json_encode([
				'status'=>-1,
				'message'=>$this->lang->line('some_wrong'),
			]);
		}            
	}
}