<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller {
	
	protected $global = array ();
	
	public function __construct() {
		parent::__construct();	
		date_default_timezone_set('Asia/Yerevan');		
		$this->global['lang'] = $this->uri->segment(1);
		if(!$this->global['lang'] || ($this->global['lang'] !== 'am' && $this->global['lang'] !== 'en' && $this->global['lang'] !== 'ru')) { redirect(base_url('am')); }  
		$this->lang->load('translate',$this->global['lang']);
		$this->load->model('Articles_model');
		$this->global['not_items'] = $this->lang->line('not_items_query');
		$this->global['categories'] = $this->Articles_model->get_categories();	
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$this->breadcrumbs->push($this->lang->line('home'), '/'. $this->global['lang']);		
	}
	
	public function index() {
		$this->load->library('form_validation');
		$this->global['title'] = $this->lang->line('s_name');
		// if (!$this->cache->get('index.'.$this->global['lang'])) {
		// 	$this->global +=$this->Articles_model->general_data();
		// 	$this->cache->save('index.'.$this->global['lang'], $this->global, 300);
		// }else{
		// 	$this->global = $this->cache->get('index.'.$this->global['lang']);
		// }
		
		$this->global += $this->Articles_model->general_data();
		load_page('front/index', $this->global['lang'], $this->global);          
	}
	
	public function get_all_categories(){
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$data =  $this->Articles_model->get_all_categories();
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
	
	public function category() {
		$id = $this->input->get('id');
		if (!$id) {
			return $this->my404();
		}
		$count = $this->Articles_model->get_count_by_category($id);			
		$config = _pagination(base_url().$this->global['lang'].'/category/?id='.$id,$count);  
		$this->pagination->initialize($config);
		$page = intval($this->input->get('page'));
		if ($page > ceil($count / $config['per_page'])) {
			return $this->my404();
		}
		$this->global['links'] = $this->pagination->create_links();
		$this->global['items'] = $this->Articles_model->get_articles_by_category($id, $config['per_page'],$page);
		if (!empty($this->global['items'])) {
			$this->global['title'] = $this->global['items'][0]->categ_name;
			if (!empty($this->global['items'][0]->parent_3_id)) {
				$this->breadcrumbs->push(mb_strtolower($this->global['items'][0]->parent_3_name),  $this->global['lang'] . '/category/?id=' .  $this->global['items'][0]->parent_3_id);
			}
			if (!empty($this->global['items'][0]->parent_2_id)) {
				$this->breadcrumbs->push(mb_strtolower($this->global['items'][0]->parent_2_name),  $this->global['lang'] . '/category/?id=' .  $this->global['items'][0]->parent_2_id);
			}
			if (!empty($this->global['items'][0]->parent_1_id)) {
				$this->breadcrumbs->push(mb_strtolower($this->global['items'][0]->parent_1_name),  $this->global['lang'] . '/category/?id=' .  $this->global['items'][0]->parent_1_id);
			}
			$this->breadcrumbs->push( word_limiter(mb_strtolower($this->global['title']), 2),  '/page');
			$this->global['breadcrumbs'] = $this->breadcrumbs->show();			
		}
		load_page('front/list', $this->global['lang'], $this->global);			         
	}

	public function find(){
		$key = $this->input->get('q');
		$key    = preg_replace('/ {3,}/', ' ', trim($key));
		$key    = trim(mb_substr($key, 0, 100, 'UTF-8'));
		$key    = htmlentities($key, ENT_QUOTES, "UTF-8");
		$this->global['title'] = $key;
		$this->breadcrumbs->push($key, '/page');
		$this->global['breadcrumbs'] = $this->breadcrumbs->show();
		$count = $this->Articles_model->get_count_by_search($key);
		$config = _pagination(base_url() . $this->global['lang'] . '/find', $count);
		$this->pagination->initialize($config);
		$page = intval($this->input->get('page'));
		if ($page > ceil($count / $config['per_page'])) {
			return $this->my404();
		}
		$this->global['links'] = $this->pagination->create_links();
		$this->global['items'] = $this->Articles_model->get_articles_by_search($config['per_page'], $page, $key);
		if (mb_strlen($key) >= 3 && !$this->session->has_userdata('key_' . $key)) {
			$this->session->set_tempdata('key_' . $key, $key, 86400);
			$this->Articles_model->search_log($key, $count);
		}
		load_page('front/list', $this->global['lang'], $this->global);
	}

	public function tags($id){
		$count = $this->Articles_model->get_count_by_tags($id);
		$config = _pagination(base_url() . $this->global['lang'] . '/tags/'.$id, $count);
		$this->pagination->initialize($config);
		$page = intval($this->input->get('page'));
		if ($page > ceil($count / $config['per_page'])) {
			return $this->my404();
		}
		$this->global['links'] = $this->pagination->create_links();
		$this->global['items'] = $this->Articles_model->get_articles_by_tags($config['per_page'], $page, $id);
		if (!empty($this->global['items'])) {
			$this->global['title'] = $this->global['items'][0]->tag_name ;
			$this->breadcrumbs->push( $this->lang->line('tag').' (' . $this->global['items'][0]->tag_name . ')', '/page');
		} else {
			$this->breadcrumbs->push($this->lang->line('tag'), '/page');
		}
		$this->global['breadcrumbs'] = $this->breadcrumbs->show();
		load_page('front/list', $this->global['lang'], $this->global);
	}

	public function article(){
        $id = $this->input->get('i');
		$data = $this->Articles_model->get_article_by_id($id);
		$lang = $this->uri->segment(1);
		if (empty($data) || $data->date >= date('Y-m-d H:i:s') || $data->publish !== '1') {
			return $this->my404();
		} else {
			$this->global['title'] = $data->name;
			$this->global['description'] = $data->text;
			$this->global['article'] = $data;
			$this->global['image'] = base_url('images/upload/') . $data->img;
			$this->global['topic'] = $this->Articles_model->get_items_by_topic(6, 0, $data->category_id, $id);
			$this->global['next_id'] =  $this->db->select_min('id')->from('articles')->where(array("id > " => $id))->get()->row()->id;
			$this->global['prev_id'] =  $this->db->select_max('id')->from('articles')->where(array("id < " => $id))->get()->row()->id;
			if ($this->global['next_id']) {
				$this->global['next'] = $this->Articles_model->get_article_by_id($this->global['next_id']);
			}
			if ($this->global['prev_id']) {
				$this->global['prev'] = $this->Articles_model->get_article_by_id($this->global['prev_id']);
			}
			if (!$this->session->has_userdata('id_' . $id)) {
				$this->session->set_tempdata('id_' . $id, $id, 86400);
				$this->Articles_model->update_count($id, null);
			}
			if (!empty($this->global['article']->parent_3_id)) {
				$this->breadcrumbs->push(mb_strtolower($this->global['article']->parent_3_name),  $this->global['lang'] . '/category/?id=' .  $this->global['article']->parent_3_id);
			}
			if (!empty($this->global['article']->parent_2_id)) {
				$this->breadcrumbs->push(mb_strtolower($this->global['article']->parent_2_name),  $this->global['lang'] . '/category/?id=' .  $this->global['article']->parent_2_id);
			}
			if (!empty($this->global['article']->parent_1_id)) {
				$this->breadcrumbs->push(mb_strtolower($this->global['article']->parent_1_name),  $this->global['lang'] . '/category/?id=' .  $this->global['article']->parent_1_id);
			}
			$this->breadcrumbs->push(mb_strtolower($this->global['article']->category_name),  $this->global['lang'] . '/category/?id=' .  $this->global['article']->category_id);
			$this->breadcrumbs->push(word_limiter(mb_strtolower($this->global['article']->name), 3), '/page');
		}
		$this->global['breadcrumbs'] = $this->breadcrumbs->show();
		load_page('front/detail', $this->global['lang'], $this->global);
	}	

	public function about(){		
		$link = $this->input->get('l');		
		$this->global['about'] = $this->Articles_model->get_static_page($link);
		if ($this->global['about']) {
			$this->breadcrumbs->push($this->global['about']->{'title_'. $this->global['lang']}, '/page');
			$this->global['breadcrumbs'] = $this->breadcrumbs->show();
			$this->global['title'] =$this->global['about']->{'title_'. $this->global['lang']};
			load_page('front/about', $this->global['lang'], $this->global);
		}else{
			$this->my404();
		}
		
	}
	
	public function literature(){
		$this->global['title'] = $this->lang->line('literature');
		$count = $this->Articles_model->get_count_by_literature();
		$config = _pagination(base_url($this->global['lang']. '/literature/'), $count, 20);
		$this->pagination->initialize($config);
		$page = intval($this->input->get('page'));
		if ($page > ceil($count / $config['per_page'])) {
			return $this->my404();
		}
		$this->global['links'] = $this->pagination->create_links();
		$this->global['items']  = $this->Articles_model->get_all_literature($config['per_page'], $page);
		if (empty($this->global['items'])) {
			return $this->my404();
		}
		$this->breadcrumbs->push($this->lang->line('literature'), '/page');
		$this->global['breadcrumbs'] = $this->breadcrumbs->show();
		load_page('front/literature', $this->global['lang'], $this->global);
	}

	public function multimedia(){
		$this->global['title'] = $this->lang->line('multimedia');
		$count = $this->Articles_model->get_count_by_multimedia();
		$config = _pagination(base_url() . $this->global['lang'] . '/multimedia', $count);
		$this->pagination->initialize($config);
		$page = intval($this->input->get('page'));
		$this->global['links'] = $this->pagination->create_links();
		$this->global['result'] = $this->Articles_model->get_all_multimedia($config['per_page'], $page);
		$this->breadcrumbs->push($this->lang->line('multimedia'), '/page');
		$this->global['breadcrumbs'] = $this->breadcrumbs->show();
		load_page('front/multimedia', $this->global['lang'], $this->global);
	}

	public function students_funds(){
		$this->global['title'] = $this->lang->line('students-funds');
		$count = $this->Articles_model->get_count_by_students_funds();
		$config = _pagination(base_url() . $this->global['lang'] . '/students_funds', $count);
		$this->pagination->initialize($config);
		$page = intval($this->input->get('page'));
		if ($page > ceil($count / $config['per_page'])) {
			return $this->my404();
		}
		$this->global['links'] = $this->pagination->create_links();
		$this->global['items'] = $this->Articles_model->get_all_students_funds($config['per_page'], $page);
		$this->breadcrumbs->push($this->lang->line('students-funds'), '/page');
		$this->global['breadcrumbs'] = $this->breadcrumbs->show();
		load_page('front/students_funds', $this->global['lang'], $this->global);
	}

	public function students_fund(){
		$id = $this->input->get('id');
		if (!$id) {
			return $this->my404();
		}
		$data = $this->Articles_model->get_students_fund_by_id($id);
		if (empty($data)) {
			return $this->my404();
		} else {
			$this->global['title'] = $data->name;
			$this->global['article'] = $data;
			$this->breadcrumbs->push($this->lang->line('students-funds'),  $this->global['lang'] . '/students_funds');
			$this->breadcrumbs->push(word_limiter($data->name, 4), '/page');
		}
		$this->global['breadcrumbs'] = $this->breadcrumbs->show();
		load_page('front/students_fund', $this->global['lang'], $this->global);
	}
	
	public function school_grant_programs(){
		$this->global['title'] = $this->lang->line('school-grant-programs');
		$count = $this->Articles_model->get_count_by_school_grant_programs();
		$config = _pagination(base_url() . $this->global['lang'] . '/school_grant_programs', $count);
		$this->pagination->initialize($config);
		$page = intval($this->input->get('page'));
		if ($page > ceil($count / $config['per_page'])) {
			return $this->my404();
		}
		$this->global['links'] = $this->pagination->create_links();
		$this->global['items'] = $this->Articles_model->get_all_school_grant_programs($config['per_page'], $page);
		$this->breadcrumbs->push($this->lang->line('school-grant-programs'), '/page');
		$this->global['breadcrumbs'] = $this->breadcrumbs->show();
		load_page('front/school_grant_programs', $this->global['lang'], $this->global);
	}

	public function school_grant_program(){
		$id = $this->input->get('id');
		if(!$id) return $this->my404();
		$data = $this->Articles_model->get_school_grant_program_by_id($id);
		if (empty($data))return $this->my404();		
		$this->global['title'] = $data->name;
		$this->global['description'] = $data->purpose;
		$this->global['article'] = $data;
		$this->breadcrumbs->push($this->lang->line('school-grant-programs'),  $this->global['lang'] . '/school_grant_programs');
		$this->breadcrumbs->push(word_limiter($data->name, 4), '/page');
		
		$this->global['breadcrumbs'] = $this->breadcrumbs->show();
		load_page('front/school_grant_program', $this->global['lang'], $this->global);
	}
	
	public function civil_society_crowdfunding(){
		$this->global['title'] = $this->lang->line('civil-society-crowdfunding');
		$count = $this->Articles_model->get_count_by_civil_society_crowdfunding();
		$config = _pagination(base_url() . $this->global['lang'] . '/civil_society_crowdfunding', $count);
		$this->pagination->initialize($config);
		$page = intval($this->input->get('page'));
		if ($page > ceil($count / $config['per_page'])) {
			return $this->my404();
		}
		$this->global['links'] = $this->pagination->create_links();
		$this->global['items'] = $this->Articles_model->get_all_civil_society_crowdfunding($config['per_page'], $page);
		$this->breadcrumbs->push($this->lang->line('civil-society-crowdfunding'), '/page');
		$this->global['breadcrumbs'] = $this->breadcrumbs->show();
		load_page('front/civil_society_crowdfunding', $this->global['lang'], $this->global);
	}

	public function civil_society_crowdfund(){
		$id = $this->input->get('id');
		$data = $this->Articles_model->get_civil_society_crowdfund_by_id($id);
		if (empty($data)) {
			return $this->my404();
		} else {
			$this->global['title'] = $data->name;
			$this->global['description'] = $data->purpose;
			$this->global['article'] = $data;
			$this->breadcrumbs->push($this->lang->line('civil-society-crowdfunding'),  $this->global['lang'] . '/civil_society_crowdfunding');
			$this->breadcrumbs->push(word_limiter($data->name, 4), '/page');
		}
		$this->global['breadcrumbs'] = $this->breadcrumbs->show();
		load_page('front/civil_society_crowdfund', $this->global['lang'], $this->global);
	}
	
	public function subscribe(){
		$this->load->helper('string');
		$key = random_string('alnum', 16);
		$date = date('Y-m-d H:i:s');
		$email = $this->input->post('email');
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo json_encode(array('status' => -1, 'errors' => $this->lang->line('Invalid Email')));
			exit;
		} else {
			$register = $this->Articles_model->is_email_available($key, $email, $date);
			if ($register == 2) {
				echo json_encode(array('status' => -1, 'errors' => $this->lang->line('Email Already register')));
				exit;
			} else if ($register == 3) {
				echo json_encode(array('status' => 1, 'message' => $this->lang->line('Email Available')));
				exit;
			} else if ($register == 1) {
				echo json_encode(array('status' => 1, 'message' => $this->lang->line('Email re-registered')));
				exit;
			}
		}
	}

	public function unsubscribe(){
		$this->load->view('front/unsubscribe');
	}
	
	public function send_email() {
		if ($this->input->is_ajax_request() && $this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|min_length[3]|max_length[40]|required');
			$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|valid_email|max_length[50]|required');
			$this->form_validation->set_rules('subject', $this->lang->line('subject'), 'trim|min_length[3]|max_length[40]|required');
			$this->form_validation->set_rules('message', $this->lang->line('message'), 'trim|min_length[5]|max_length[1000]|required');
			$this->form_validation->set_message('min_length', '{field} '. $this->lang->line('form_validation_min_length').' {param} '. $this->lang->line('simbol'));
			$this->form_validation->set_message('max_length', '{field} '. $this->lang->line('form_validation_max_length').' {param} '. $this->lang->line('simbol'));
			$this->form_validation->set_message('required', $this->lang->line('form_validation_required'));
			$this->form_validation->set_message('regex_match', $this->lang->line('form_validation_regex_match'));
			$this->form_validation->set_message('valid_email', $this->lang->line('form_validation_valid_email'));
			$this->form_validation->set_error_delimiters('','');
			if ($this->form_validation->run()) {
				$to       = 'armencharkhchyan@gmail.com';
				$subject  = $this->input->post('subject');
				$message  = "Անուն։ ".$this->input->post('name') . "<br/>";
				$message .= "Էլ. փոստ։ ".$this->input->post('email') . "<br/>";
				$message .= $this->input->post('message') . "<br/>";
				$this->load->library('phpmailer');
				if ($this->phpmailer->send_email($to, $subject, $message, $file = NULL)) {
					$data['status'] = 'success';
					$data['html'] = $this->lang->line('send_mess');
					$data['bg'] ='#5cb85c';
				}
			} else {				
				$data['status'] = 'no-validate';
				$data['ValidationErrors']  = [
					'name'      => form_error('name'),
					'email'     => form_error('email'),
					'subject'     => form_error('subject'),
					'message'      => form_error('message')
				];
				$data['html'] = $this->lang->line('error_message');
				$data['bg'] ='#F73F52';
			}
			echo json_encode($data);
			exit;
		} else {
			$this->my404();
		}
	}

    public function getNews(){
        // echo json_encode(array('status' => 1, 'message' => $this->lang->line('Email re-registered')));
        echo json_encode(array('data' => $this->Articles_model->get_news()));
    }
    
	public function my404(){
		http_response_code(404);
		header("HTTP/1.1 404 Not Found");
		$this->global['title'] = '#404';
		load_page('front/404', $this->global['lang'], $this->global);
	}
	
}
