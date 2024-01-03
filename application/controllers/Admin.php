<?php if (!defined('BASEPATH')) {  exit('No direct script access allowed');}

require APPPATH.'/libraries/BaseController.php';

    class Admin extends BaseController {
    
        public function __construct() {
            parent::__construct();
            $this->load->model('Admin_model');
            $this->isLoggedIn(); 
            $this->global['getCountByShownNull'] = $this->Admin_model->getCountByShownNull(); 
            $this->global['not_items'] = 'Ձեր հարցմանը համապատասխան գրառումներ չկան';
            $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
            $this->lang->load('translate','am');
            $this->global['dateNow'] = date('Y-m-d H:i:s');
            date_default_timezone_set('Asia/Yerevan');
        }
        
        public function index() {                       
            $this->global['pageTitle'] = 'Վահանակ';
            $count = $this->Admin_model->getAllCount();         
            $config = _pagination(base_url('admin'),$count);       
            $this->pagination->initialize($config);
            $page = intval($this->input->get('page'));
            if ($page > ceil($count / $config['per_page'])) {
                return $this->pageNotFound();
                
                
                
            }
            $this->global['links'] = $this->pagination->create_links();
            $this->global['items'] = $this->Admin_model->getItems($config['per_page'], $page);  
            $this->global['allCount'] = $count; 
            $this->loadViews('admin/dashboard', $this->global, null, null);
        }

        public function staticPages(){
            $array['items']  = $this->Admin_model->staticPages();
            $this->global['pageTitle'] = 'Ստատիկ էջեր';
            $this->loadViews('admin/staticPages', $this->global, $array, null);
        }

        public function staticPageEdit($id = NULL){       
            if ($this->input->post('btn')) {
                $img = null;
                if ($_FILES['image_name']['name'] !== '') {
                    $upload_path = FCPATH . 'images/static';
                    resizeImage($upload_path);
                    $img = $this->upload->data('file_name');
                }
                $this->Admin_model->updateStaticPage($img);
                redirect('admin/staticPages');
                exit;
            } else {
                $staticPage = $this->Admin_model->getStaticPage($id);
                if ($staticPage) {
                    $this->global['pageTitle'] = 'Խմբագրել';
                    $array["item"] = $staticPage;
                    $this->loadViews('admin/staticPageEdit', $this->global, $array, null);
                } else {
                    $this->pageNotFound();
                }
            }
        }
        
        public function categories(){
            $this->global['pageTitle'] = 'Բաժիններ';
            $array['categories'] = $this->Admin_model->categoryList();
            $array['gen_categories_length'] = $this->Admin_model->genCategoriesLength();
            $this->loadViews('admin/categories', $this->global, $array, null);
        }

        public function getCategoryByID(){            
            if (!$this->input->is_ajax_request()) {
                exit('No direct script access allowed');
            }
            $id = $this->input->post('id');
            $data  =  $this->Admin_model->getCategoryByID($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        
        public function getAllCategories(){
            if (!$this->input->is_ajax_request()) {
                exit('No direct script access allowed');
            }
            $data =  $this->Admin_model->getAllCategories();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }

        public function editCategory(){       
            if (!$this->input->is_ajax_request()) {
                exit('No direct script access allowed');
            }
            $data_edit = [];
            $data_edit['id'] = $this->input->post('id');
            $data_edit['name_am'] = trim($this->input->post('name_am'));
            // $data_edit['name_ru'] = trim($this->input->post('name_ru'));
            $data_edit['name_en'] = trim($this->input->post('name_en'));
            $data_edit['parent_id'] = $this->input->post('parent_id');
            $data_edit['order_by'] = $this->input->post('order_by');
            $query = $this->Admin_model->getCategoryByID($data_edit['id']);   
            if ($data_edit['parent_id'] && $query->parent_id == '0') {
                echo json_encode(array('status' => -1, 'msg' => 'Ձեր ընտրած կատեգորիան հիմնական կատեգորիա է, որին չեք կարող ծնող կատեգորիա ավելացնել:'), JSON_UNESCAPED_UNICODE);
                exit;
            }
            if ($data_edit['id'] == $data_edit['parent_id']) {
                echo json_encode(array('status'=> -1, 'msg' => 'Ձեր ընտրած ծնող կատեգորիան ներկայիս կատեգորիան է:'), JSON_UNESCAPED_UNICODE);
                exit;
            }       
            $data =  $this->Admin_model->editCategory($data_edit);
            if ($data) {
                echo json_encode(array('status' => 1, 'msg' => 'Փոփոխությունը հաջողությամբ կատարվեց:'), JSON_UNESCAPED_UNICODE);
            }else {
                echo json_encode(array('status' => -1, 'msg' => 'Փոփոխությունը տեղի չունեցավ:'), JSON_UNESCAPED_UNICODE);
            }
           
        }

        public function addCategory(){
            if (!$this->input->is_ajax_request()) {
                exit('No direct script access allowed');
            }
            $data_insert = [];
            $data_insert['name_am'] = trim($this->input->post('name_am'));
            // $data_insert['name_ru'] = trim($this->input->post('name_ru'));
            $data_insert['name_en'] = trim($this->input->post('name_en'));
            $data_insert['parent_id'] = $this->input->post('parent_id');  
            $data =  $this->Admin_model->addCategory($data_insert);
            if ($data) {
                echo json_encode(array('status' => 1, 'msg' => 'Գործողությունը հաջողությամբ կատարվեց:'), JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(array('status' => -1, 'msg' => 'Գործողությունը տեղի չունեցավ:'), JSON_UNESCAPED_UNICODE);
            }
        }

        public function deleteCategory(){
            if (!$this->input->is_ajax_request()) {
                exit('No direct script access allowed');
            }
            $id = $this->input->post('id');
            $data =  $this->Admin_model->deleteCategory($id);
            if ($data && $data == -1) {
                echo json_encode(array('status' => -1, 'msg' => 'Տվյալ կատեգորիային կան կցված կատեգորիա (ներ):'), JSON_UNESCAPED_UNICODE);
                exit;
            } 
            if($data && $data == -2) {
                echo json_encode(array('status' => -2, 'msg' => 'Տվյալ կատեգորիային կան կցված ապրանքներ:'), JSON_UNESCAPED_UNICODE);
                exit;
            }
            if ($data && $data == -3) {
                echo json_encode(array('status' => -3, 'msg' => 'Գործողությունը տեղի չունեցավ:'), JSON_UNESCAPED_UNICODE);
                exit;
            }
            if ($data && $data == 1) {
                echo json_encode(array('status' => 1, 'msg' => 'Գործողությունը հաջողությամբ կատարվեց:'), JSON_UNESCAPED_UNICODE);
            }
        }

        public function showItem(){
            if ($this->input->is_ajax_request()) {
                if ($this->isAdmin() == true) {
                    $this->loadThis();
                } else {
                    $id = $this->input->post('id');
                    $publish = $this->input->post('publish');
                    $publish == 1 ? $s = '0' : $s = '1';
                    $c = $this->Admin_model->showItem($id, $s);
                    $arr = array('publish' => $s, 'count' => $c);
                    $this->cache->clean();
                    echo json_encode($arr);
                }
            } else {
                $this->pageNotFound();
            }
        }

        public function getItemById() {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $fetch_data = $this->Admin_model->getItemById($id);
                echo json_encode($fetch_data);
            } else {
                $this->pageNotFound();
            }
        }

        public function addOrUpdateItem(){
            $img = null;
            if ($_FILES['image_name']['name'] !== '') {
                $upload_path = FCPATH . 'images/upload';
                resizeImage($upload_path);
                $img = $this->upload->data('file_name');
            }
            $query = $this->Admin_model->addOrUpdateItem($img);
            if ($query) {                
                $this->cache->clean();
                redirect('admin');  
            }else{
                 $this->errorpage();
            }            
        }
    
        public function deleteItem(){
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $result = $this->Admin_model->deleteItem($id);
                if ($result) {
                    $this->cache->clean();
                    echo 'YES';
                }else{
                    echo 'NO';
                }
               
            } else {
                $this->pageNotFound();
            }
        }
        
        public function deleteFile($id){
            $file = $this->db->get_where('documents', ['id'=>$id])->row();
            $path = FCPATH . 'uploads/documents/' . $file->file;
            if (!empty($file->file) && file_exists($path)) {
                UNLINK($path);
                $this->db->where('id', $id)->delete('documents');
                echo json_encode([
                    'status'=>1,
                    'message'=>'Գործողությունը բարեհաջող ավարտվել է'
                ]);
                exit;
            } 
            echo json_encode([
                'status'=>-2,
                'message'=>'Ինչոր բան այն չէ'
            ]);
            exit;
        } 
    
        public function getAllTags(){
            if ($this->input->is_ajax_request()) {
                $fetch_data = $this->Admin_model->getAllTags();
                echo json_encode($fetch_data);
                exit;
            }else {
                $this->pageNotFound();
            }           
        }
        
        public function getSearchLogs() {    
            $this->load->library('pagination');        
            $this->global['pageTitle'] = 'Որոնված բառեր';
            $count = $this->Admin_model->getSearchLogsCount();
            $config = _pagination(base_url(). 'admin/getSearchLogs/',$count, 20);        
            $this->pagination->initialize($config);
            $page = intval($this->input->get('page'));
            if ($page > ceil($count / $config['per_page'])) {
                return $this->pageNotFound();
            }
            $this->global['links'] = $this->pagination->create_links();
            $this->global['datas'] = $this->Admin_model->getSearchLogs($config['per_page'], $page);
            $this->global['not_items'] = 'Ձեր հարցմանը համապատասխան գրառումներ չկան';
            $this->loadViews('admin/searchLogs', $this->global, null, null);
        }
        
        public function sendEmailUsers() {
            if ($this->isAdmin() == true) {
                $this->loadThis();
            } else {
                $base_url = base_url();
                $id = $this->input->post('id');
                $m = $this->Admin_model->getItemById($id)['getItemById'];
                $result = $this->Admin_model->getSubscribeEmails();
                $config['protocol'] = PROTOCOL;
                $config['smtp_host'] = SMTP_HOST;
                $config['smtp_port'] = SMTP_PORT;
                $config['smtp_user'] = SMTP_USER;
                $config['smtp_pass'] = SMTP_PASS;
                $config['smtp_crypto'] = SMTP_CRYPTO;
                $config['smtp_timeout'] = SMTP_TIMEOUT;
                $config['mailtype'] = MAIL_TYPE;
                $config['charset'] = CHARSET;
                $config['newline'] = "\r\n";
                $config['crlf'] = "\r\n";
                $this->load->library('email', $config);         
                $subject = 'Կրթություն շաբաթաթերթ';
                if (count($result) != 0) {
                    foreach ($result as $item) {
                        $this->email->clear(TRUE);
                        $this->email->from("krtutyun.am", FROM_NAME);
                        $this->email->to($item->email);
                        $this->email->subject($subject); 
                        $message = "<h2>".$m->name."</h2>
                                    <p>Մանրամասն <a href=".$base_url."am/article/".$m->id.">այստեղ</a></p><br>
                                    <p style='font-size: 12px'>Բաժանորդագրությունը չեղարկելու համար անցեք հետևյալ <a href='".base_url('admin/cancelSubscribe/'.$item->key). "'>հղումով</a></p>
                                    <br>--------------------------------------------<br>
                                    Հեռախոս (+374 10) 123456, Էլ. փոստ - example@civics.am";    
                        $this->email->message($message, 'UTF-8');
                        if ($this->email->send()) {
                            $arr = array('msg' => 'Հղումներն հաջողությամբ ուղարկվեցին', 'success' => true);
                        } else {
                            $arr = array('msg' => 'Չստացվեց, փորձեք կրկին', 'success' => false);
                        }
                    }
                } else {
                    $arr = array('msg' => 'Գրանցված օգտատերեր չկան', 'error' => true);
                }
                echo json_encode($arr);
            }
        }
        
        public function cancelSubscribe($key = null) {
            if ($key) {
                $this->Admin_model->cancelSubscribe($key);
                $this->load->view('front/unsubscribe');
            } else {
                return $this->pageNotFound();
            }
        }

        public function archive(){           
            $count =  $this->Admin_model->getCountByArchive();
            $config = _pagination(base_url('admin/archive/'), $count);
            $this->pagination->initialize($config);
            $page = intval($this->input->get('page'));
            if ($page > ceil($count / $config['per_page'])) {
                return $this->pageNotFound();
            }
            $this->global['links'] = $this->pagination->create_links();
            $data = $this->Admin_model->getArchive($config['per_page'], $page);
            if (empty($data)) {
                return $this->pageNotFound();
            }
            $this->global['items'] =  $data['items'];
            $this->global['pageTitle'] = 'Արխիվ';
            $this->global['allCount'] = $count;
            $this->loadViews('admin/archive', $this->global, null, null);
        }
    
        public function getArchiveById(){
            if ($this->isAdmin() == true) {
                $this->loadThis();
            } else {
                $id = $this->input->post('id');
                $fetch_data = $this->Admin_model->getArchiveById($id);
                echo json_encode($fetch_data);
            }
        }

        public function addOrUpdateArchive(){       
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name_am', 'name_am', 'required');
            // $this->form_validation->set_rules('name_ru', 'name_ru', 'required');
            $this->form_validation->set_rules('name_en', 'name_en', 'required');             
            if ($this->form_validation->run() !== false) {
                $name_am = $this->input->post('name_am');
                // $name_ru = $this->input->post('name_ru');
                $name_en = $this->input->post('name_en');
                $date = $this->input->post('date');
                $type = $this->input->post('type');
                $item = $this->input->post('item');
                $img = null;
                if ($_FILES['image_name']['name'] !== '') {
                    $upload_path = FCPATH . 'documents/img';
                    resizeImage($upload_path);
                    $img = $this->upload->data('file_name');
                }              
                $this->load->library('upload');
                $config['upload_path']      = FCPATH . 'documents/pdf';
                $config['allowed_types']    = 'pdf|csv';
                $config['max_size']         = 0;
                $config['encrypt_name']     = TRUE;
                $config['overwrite']        = FALSE;
                $this->upload->initialize($config);
                $file_info = null;
                if ($this->upload->do_upload('file')) {
                    $file_info = $this->upload->data('file_name');
                }
                if ($item == null) {                
                    $this->form_validation->set_rules('file', 'file', 'required');          
                    $this->Admin_model->setArchive($name_am, $name_en, $img, $file_info, $date, $type);
                } else {
                    $this->Admin_model->updateArchive($item, $name_am, $name_en, $img, $file_info, $date, $type);
                }                
            }
            redirect('admin/archive');
        }

        public function deleteArchive(){
            if ($this->isAdmin() == true) {
                $this->loadThis();
            } else {
                $id = $this->input->post('id');
                $result = $this->Admin_model->deleteArchive($id);
                if ($result) {
                    echo 'YES';
                }else{
                    echo 'NO';
                }
            }
        }
        
        public function videos(){
            $this->global['pageTitle'] = 'Տեսանյութեր';
            $count = $this->Admin_model->get_count_by_videos();
            $config = _pagination(base_url('admin/videos'), $count);
            $this->pagination->initialize($config);
            $page = intval($this->input->get('page'));
            if ($page > ceil($count / $config['per_page'])) {
                return $this->pageNotFound();
            }
            $this->global['links'] = $this->pagination->create_links();
            $this->global['items'] = $this->Admin_model->get_all_videos($config['per_page'], $page);
            $this->global['allCount'] = $count;
            $this->loadViews('admin/videos', $this->global, null, null);
        }

        public function getVideoById(){
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $fetch_data = $this->Admin_model->getVideoById($id);
                echo json_encode($fetch_data);
            } else {
                $this->pageNotFound();
            }
        }
        
        public function addOrUpdateVideos(){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_am', 'title_am', 'trim|strip_tags|required');
            // $this->form_validation->set_rules('title_ru', 'title_ru', 'trim|strip_tags|required');
            $this->form_validation->set_rules('title_en', 'title_en', 'trim|strip_tags|required');
            $this->form_validation->set_rules('url', 'url', 'trim|strip_tags|required');
            $this->form_validation->set_rules('type', 'type', 'trim|strip_tags|required|is_natural_no_zero');
            $this->form_validation->set_rules('date', 'Ամսաթիվ', 'trim|strip_tags|required');
            $data_errors = array();
            $validation_status = $this->form_validation->run();
            foreach ($this->input->post() as $field => $value) {
                $data_errors[$field] = form_error($field);
            }
            if ($validation_status) {
                $data['title_am'] = $this->input->post('title_am');
                // $data['title_ru'] = $this->input->post('title_ru');
                $data['title_en'] = $this->input->post('title_en');
                $data['url'] = $this->input->post('url');
                $data['type'] = $this->input->post('type');
                $data['date'] = $this->input->post('date');
                if ($this->input->post('item') == null) {
                    $result = $this->Admin_model->setVideos($data);                  
                } else {
                    $data['id'] = $this->input->post('item');
                    $result = $this->Admin_model->updateVideos($data);
                }
                if (!$result) {
                    $this->errorpage();
                } else {
                    $this->cache->clean();
                    redirect('admin/videos');
                }
            }else{
                $this->errorpage();
            }
        }

        public function deleteVideo(){
            if ($this->isAdmin() == true) {
                $this->loadThis();
            } else {
                $id = $this->input->post('id');
                $result = $this->Admin_model->deleteVideo($id);
                if ($result) {
                    echo 'YES';
                } else {
                    echo 'NO';
                }
            }
        }

        public function team(){
            $this->global['pageTitle'] = 'Մեր թիմը';
            $count = $this->Admin_model->get_count_by_team();
            $config = _pagination(base_url('admin/team'), $count);
            $this->pagination->initialize($config);
            $page = intval($this->input->get('page'));
            if ($page > ceil($count / $config['per_page'])) {
                return $this->pageNotFound();
            }
            $this->global['links'] = $this->pagination->create_links();
            $this->global['items'] = $this->Admin_model->get_all_team($config['per_page'], $page);
            $this->global['allCount'] = $count;
            $this->loadViews('admin/team', $this->global, null);
        }

        public function getTeamById(){
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $fetch_data = $this->Admin_model->getTeamById($id);
                echo json_encode($fetch_data);
            } else {
                $this->pageNotFound();
            }
        }

        public function deleteTeam(){
            if ($this->isAdmin() == true) {
                $this->loadThis();
            } else {
                if ($this->input->is_ajax_request()) {
                    $id = $this->input->post('id');
                    $result = $this->Admin_model->deleteTeam($id);
                    if ($result) {
                        echo 'YES';
                    } else {
                        echo 'NO';
                    }
                }
            }
        }
    
        public function addOrUpdateTeam(){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name_am', 'name_am', 'trim|strip_tags|required');
            // $this->form_validation->set_rules('name_ru', 'name_ru', 'trim|strip_tags|required');
            $this->form_validation->set_rules('name_en', 'name_en', 'trim|strip_tags|required');
            $data_errors = array();
            $validation_status = $this->form_validation->run();
            foreach ($this->input->post() as $field => $value) {
                $data_errors[$field] = form_error($field);
            }
            if ($validation_status) {
                $data['name_am'] = $this->input->post('name_am');
                // $data['name_ru'] = $this->input->post('name_ru');
                $data['name_en'] = $this->input->post('name_en');
                $data['position_am'] = $this->input->post('position_am');
                // $data['position_ru'] = $this->input->post('position_ru');
                $data['position_en'] = $this->input->post('position_en');
                $data['link_fb'] = $this->input->post('link_fb');
                $data['link_fb'] = $this->input->post('link_fb');
                $data['link_tv'] = $this->input->post('link_tv');
                $data['link_inst'] = $this->input->post('link_inst');
                $data['link_in'] = $this->input->post('link_in');
                $data['img'] = null;
                if ($_FILES['image_name']['name'] !== '') {
                    $upload_path = FCPATH . 'images/team';
                    resizeImage($upload_path);
                    $data['img'] = $this->upload->data('file_name');
                }
                if ($this->input->post('item') == null) {
                    $result = $this->Admin_model->setTeam($data);
                } else {
                    $data['id'] = $this->input->post('item');
                    $result = $this->Admin_model->updateTeam($data);
                }
                if (!$result) {
                    $this->errorpage();
                } else {
                    $this->cache->clean();
                    redirect('admin/team');
                }
            } else {
                $this->errorpage();
            }
        }

        public function clients(){
            $this->global['pageTitle'] = 'Մեր գործընկերները';
            $count = $this->Admin_model->get_count_by_clients();
            $config = _pagination(base_url('admin/clients'), $count);
            $this->pagination->initialize($config);
            $page = intval($this->input->get('page'));
            if ($page > ceil($count / $config['per_page'])) {
                return $this->pageNotFound();
            }
            $this->global['links'] = $this->pagination->create_links();
            $this->global['items'] = $this->Admin_model->get_all_clients($config['per_page'], $page);
            $this->global['allCount'] = $count;
            $this->loadViews('admin/clients', $this->global, null);
        }

        public function getClientById(){
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $fetch_data = $this->Admin_model->getClientById($id);
                echo json_encode($fetch_data);
            } else {
                $this->pageNotFound();
            }
        }

        public function deleteClient(){
            if ($this->isAdmin() == true) {
                $this->loadThis();
            } else {
                if ($this->input->is_ajax_request()) {
                    $id = $this->input->post('id');
                    $result = $this->Admin_model->deleteClient($id);
                    if ($result) {
                        echo 'YES';
                    } else {
                        echo 'NO';
                    }
                }
            }
        }

        public function addOrUpdateClient(){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name_am', 'name_am', 'trim|strip_tags|required');
            // $this->form_validation->set_rules('name_ru', 'name_ru', 'trim|strip_tags|required');
            $this->form_validation->set_rules('name_en', 'name_en', 'trim|strip_tags|required');
            $data_errors = array();
            $validation_status = $this->form_validation->run();
            foreach ($this->input->post() as $field => $value) {
                $data_errors[$field] = form_error($field);
            }
            if ($validation_status) {
                $data['name_am'] = $this->input->post('name_am');
                // $data['name_ru'] = $this->input->post('name_ru');
                $data['name_en'] = $this->input->post('name_en');
                $data['link'] = $this->input->post('link');
                $data['img'] = null;
                if ($_FILES['image_name']['name'] !== '') {
                    $upload_path = FCPATH . 'images/client';
                    resizeImage($upload_path);
                    $data['img'] = $this->upload->data('file_name');
                }
                if ($this->input->post('item') == null) {
                    $result = $this->Admin_model->setClient($data);
                } else {
                    $data['id'] = $this->input->post('item');
                    $result = $this->Admin_model->updateClient($data);
                }
                if (!$result) {
                    $this->errorpage();
                } else {
                    $this->cache->clean();
                    redirect('admin/clients');
                }
            } else {
                $this->errorpage();
            }
        }
        
        public function schoolGrantPrograms(){
            $this->global['pageTitle'] = 'Դպրոցական դրամաշնորհային ծրագրեր';
            $count = $this->Admin_model->get_count_by_school_grant_programs();
            $config = _pagination(base_url('admin/schoolGrantPrograms'), $count);
            $this->pagination->initialize($config);
            $page = intval($this->input->get('page'));
            if ($page > ceil($count / $config['per_page'])) {
                return $this->pageNotFound();
            }
            $this->global['links'] = $this->pagination->create_links();
            $this->global['items'] = $this->Admin_model->get_all_school_grant_programs($config['per_page'], $page);
            $this->global['allCount'] = $count;
            $this->loadViews('admin/schoolGrantPrograms', $this->global, null);
        }

        public function addOrUpdateSchoolGrants(){           
            $result = $this->Admin_model->addOrUpdateSchoolGrants();
            if ($result) {
                redirect('admin/schoolGrantPrograms');
            }else{
                $this->errorpage();
            }
            
        }

        public function getSchoolGrantById(){
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $fetch_data = $this->Admin_model->getSchoolGrantById($id);
                echo json_encode($fetch_data);
            } else {
                $this->pageNotFound();
            }
        }

        public function deleteSchoolGrants(){
            if ($this->isAdmin() == true) {
                $this->loadThis();
            } else {
                if ($this->input->is_ajax_request()) {
                    $id = $this->input->post('id');
                    $result = $this->Admin_model->deleteSchoolGrants($id);
                    if ($result) {
                        echo 'YES';
                    } else {
                        echo 'NO';
                    }
                }
            }
        }
        
        public function civilSocietyCrowdfunding(){
            $this->global['pageTitle'] = 'Քաղաքացիական հասարակության դրամաշնորհային ծրագրեր ';
            $count = $this->Admin_model->get_count_by_civilSocietyCrowdfunding();
            $config = _pagination(base_url('admin/civilSocietyCrowdfunding'), $count);
            $this->pagination->initialize($config);
            $page = intval($this->input->get('page'));
            if ($page > ceil($count / $config['per_page'])) {
                return $this->pageNotFound();
            }
            $this->global['links'] = $this->pagination->create_links();
            $this->global['items'] = $this->Admin_model->get_all_civilSocietyCrowdfunding($config['per_page'], $page);           
            $this->global['allCount'] = $count;
            $this->loadViews('admin/civilSocietyCrowdfunding', $this->global, null);
        }

        public function addOrUpdateCivilSocietyCrowdfunding(){
            $result = $this->Admin_model->addOrUpdateCivilSocietyCrowdfunding();
            if ($result) {
                redirect('admin/civilSocietyCrowdfunding');
            } else {
                $this->errorpage();
            }
        }
    
        public function getCivilSocietyCrowdfundingById(){
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $fetch_data = $this->Admin_model->getCivilSocietyCrowdfundingById($id);
                echo json_encode($fetch_data);
            } else {
                $this->pageNotFound();
            }
        }
        
        public function deleteCivilSocietyCrowdfunding(){
            if ($this->isAdmin() == true) {
                $this->loadThis();
            } else {
                if ($this->input->is_ajax_request()) {
                    $id = $this->input->post('id');
                    $result = $this->Admin_model->deleteCivilSocietyCrowdfunding($id);
                    if ($result) {
                        echo 'YES';
                    } else {
                        echo 'NO';
                    }
                }
            }
        }
        
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// USERS

        public function userListing() {
            if ($this->isAdmin() == true) {
                $this->loadThis();
            } else {
                $searchText = $this->security->xss_clean($this->input->post('searchText'));
                $data['searchText'] = $searchText;
                $this->load->library('pagination');
                $count = $this->Admin_model->userListingCount($searchText);
                $returns = $this->paginationCompress('admin/userListing/', $count, 10);
                $data['userRecords'] = $this->Admin_model->userListing($searchText, $returns['page'], $returns['segment']);
                $this->global['pageTitle'] = 'Օգտագործողներ';
                $this->loadViews('admin/users', $this->global, $data, null);
            }
        }
        
        public function addNew() {
            if ($this->isAdmin() == true) {
                $this->loadThis();
            } else {
                $data['roles'] = $this->Admin_model->getUserRoles();
                $this->global['pageTitle'] = 'Ավելացնել նոր օգտվող';
                $this->loadViews('admin/addNew', $this->global, $data, null);
            }
        }
        
        public function checkEmailExists() {
            $userId = $this->input->post('userId');
            $email = $this->input->post('email');
            if (empty($userId)) {
                $result = $this->Admin_model->checkEmailExists($email);
            } else {
                $result = $this->Admin_model->checkEmailExists($email, $userId);
            }
            if (empty($result)) {
                echo 'true';
            } else {
                echo 'false';
            }
        }
        
        public function addNewUser() {
            if ($this->isAdmin() == true) {
                $this->loadThis();
            } else {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
                $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
                $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');
                $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
                $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[8]');
                if ($this->form_validation->run() == false) {
                    $this->addNew();
                } else {
                    $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                    $email = strtolower($this->security->xss_clean($this->input->post('email')));
                    $password = $this->input->post('password');
                    $roleId = $this->input->post('role');
                    $mobile = $this->security->xss_clean($this->input->post('mobile'));
                    $userInfo = array('email' => $email, 'password' => getHashedPassword($password), 'roleId' => $roleId, 'name' => $name,'mobile' => $mobile, 'createdBy' => $this->vendorId, 'createdDtm' => date('Y-m-d H:i:s'), );
                    $result = $this->Admin_model->addNewUser($userInfo);
                    if ($result > 0) {
                        $this->session->set_flashdata('success', 'Նոր օգտվողը հաջողությամբ ստեղծվեց');
                    } else {
                        $this->session->set_flashdata('error', 'Օգտագործողի ստեղծումը ձախողվեց');
                    }
                    redirect('admin/addNew');
                }
            }
        }
      
        public function editOld($userId = null) {
            if ($this->isAdmin() == true || $userId == 1) {
                $this->loadThis();
            } else {
                if ($userId == null) {
                    redirect('admin/userListing');
                }
                $data['roles'] = $this->Admin_model->getUserRoles();
                $data['userInfo'] = $this->Admin_model->getUserInfo($userId);
                $this->global['pageTitle'] = 'Խմբագրել օգտագործողը';
                $this->loadViews('admin/editOld', $this->global, $data, null);
            }
        }

        public function editUser() {
            if ($this->isAdmin() == true) {
                $this->loadThis();
            } else {
                $this->load->library('form_validation');
                $userId = $this->input->post('userId');
                $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
                $this->form_validation->set_rules('password', 'Password', 'matches[cpassword]|max_length[20]');
                $this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]|max_length[20]');
                $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
                $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[8]');
                if ($this->form_validation->run() == false) {
                    $this->editOld($userId);
                } else {
                    $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                    $email = strtolower($this->security->xss_clean($this->input->post('email')));
                    $password = $this->input->post('password');
                    $roleId = $this->input->post('role');
                    $mobile = $this->security->xss_clean($this->input->post('mobile'));
                    $userInfo = array();
                    if (empty($password)) {
                        $userInfo = array('email' => $email, 'roleId' => $roleId, 'name' => $name,'mobile' => $mobile, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'), );
                    } else {
                        $userInfo = array('email' => $email, 'password' => getHashedPassword($password), 'roleId' => $roleId,'name' => ucwords($name), 'mobile' => $mobile, 'updatedBy' => $this->vendorId,'updatedDtm' => date('Y-m-d H:i:s'), );
                    }
                    $result = $this->Admin_model->editUser($userInfo, $userId);
                    if ($result == true) {
                        $this->session->set_flashdata('success', 'Օգտագործողը հաջողությամբ թարմացվեց');
                    } else {
                        $this->session->set_flashdata('error', 'Օգտագործողի թարմացումը ձախողվեց');
                    }
                    redirect('admin/userListing');
                }
            }
        }
        
        public function deleteUser() {
            if ($this->input->is_ajax_request()) {
                if ($this->isAdmin() == true) {
                    echo json_encode(array('status' => 'access'));
                } else {
                    $userId = $this->input->post('userId');
                    $userInfo = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));
                    $result = $this->Admin_model->deleteUser($userId, $userInfo);
                    if ($result > 0) {
                        echo json_encode(array('status' => true));
                    } else {
                        echo json_encode(array('status' => false));
                    }
                }
            }else {
                $this->pageNotFound();
            }  
        }
        
        public function pageNotFound() {
            http_response_code(404);
            header("HTTP/1.1 404 Not Found");
            $this->global['pageTitle'] = '404 - Էջը չի գտնվել';
            $this->loadViews('admin/error_page', $this->global, null, null);
        }

        public function errorpage(){
            $this->global['pageTitle'] = 'Խափանում';
            $this->loadViews('admin/error_page', $this->global, null, null);
        }
    
        public function loginHistory($userId = null) {
            if ($this->isAdmin() == true) {
                $this->loadThis();
            } else {
                $userId = ($userId == null ? 0 : $userId);
                $searchText = $this->input->post('searchText');
                $fromDate = $this->input->post('fromDate');
                $toDate = $this->input->post('toDate');
                $data['userInfo'] = $this->Admin_model->getUserInfoById($userId);
                $data['searchText'] = $searchText;
                $data['fromDate'] = $fromDate;
                $data['toDate'] = $toDate;
                $this->load->library('pagination');
                $count = $this->Admin_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);
                $returns = $this->paginationCompress('admin/loginHistory/'.$userId.'/', $count, 10, 3);
                $data['userRecords'] = $this->Admin_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns['page'], $returns['segment']);
                $this->global['pageTitle'] = 'Օգտագործողի մուտքի պատմություն';
                $this->loadViews('admin/loginHistory', $this->global, $data, null);
            }
        }
        
        public function profile($active = 'details') {
            $data['userInfo'] = $this->Admin_model->getUserInfoWithRole($this->vendorId);
            $data['active'] = $active;
            $this->global['pageTitle'] = $active == 'details' ? 'Իմ էջը' : 'Փոխել գաղտնաբառը';
            $this->loadViews('admin/profile', $this->global, $data, null);
        }
        
        public function profileUpdate($active = 'details') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[9]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]|callback_emailExists');
            if ($this->form_validation->run() == false) {
                $this->profile($active);
            } else {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $userInfo = array('name' => $name, 'email' => $email, 'mobile' => $mobile, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));
                $result = $this->Admin_model->editUser($userInfo, $this->vendorId);
                if ($result == true) {
                    $this->session->set_userdata('name', $name);
                    $this->session->set_flashdata('success', 'Էջը հաջողությամբ թարմացվեց');
                } else {
                    $this->session->set_flashdata('error', 'Էջի թարմացումը ձախողվեց');
                }
                redirect('admin/profile/'.$active);
            }
        }
        
        public function changePassword($active = 'changepass') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('oldPassword', 'Old password', 'required|max_length[20]');
            $this->form_validation->set_rules('newPassword', 'New password', 'required|max_length[20]');
            $this->form_validation->set_rules('cNewPassword', 'Confirm new password', 'required|matches[newPassword]|max_length[20]');
            if ($this->form_validation->run() == false) {
                $this->profile($active);
            } else {
                $oldPassword = $this->input->post('oldPassword');
                $newPassword = $this->input->post('newPassword');
                $resultPas = $this->Admin_model->matchOldPassword($this->vendorId, $oldPassword);
                if (empty($resultPas)) {
                    $this->session->set_flashdata('nomatch', 'Ձեր հին գաղտնաբառը ճիշտ չէ');
                } else {
                    $usersData = array('password' => getHashedPassword($newPassword), 'updatedBy' => $this->vendorId,'updatedDtm' => date('Y-m-d H:i:s'),);
                    $result = $this->Admin_model->changePassword($this->vendorId, $usersData);
                    if ($result > 0) {
                        $this->session->set_flashdata('success', 'Գաղտնաբառը հաջողությամբ թարմացվեց');
                    } else {
                        $this->session->set_flashdata('error', 'Գաղտնաբառի թարմացումը ձախողվեց');
                    }
                }
                redirect('admin/profile/'.$active);
            }
        }
        
        public function emailExists($email) {
            $userId = $this->vendorId;
            $return = false;
            if (empty($userId)) {
                $result = $this->Admin_model->checkEmailExists($email);
            } else {
                $result = $this->Admin_model->checkEmailExists($email, $userId);
            }
            if (empty($result)) {
                $return = true;
            } else {
                $this->form_validation->set_message('emailExists', 'The {field} already taken');
                $return = false;
            }
            return $return;
        }
    }
