<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Admin_model extends CI_Model {
        
        protected $table = 'articles';
        
        public function getItems($limit, $start) {
            if ($start < 2) { $start = 1; }   
            $this->db->select('tbl_users.name as user_name,articles.id,articles.name_am AS name,articles.img,articles.date,articles.publish');
            $this->db->from($this->table);
            $this->db->join('tbl_users', 'tbl_users.userId = articles.installer_id','inner'); 
            if($this->session->userdata('role') != ROLE_ADMIN) {
                $this->db->where("articles.installer_id",$this->session->userdata('userId'));
                $this->db->where("articles.publish",'0');       
            } 
            if($this->input->get('publish') == 'on') {                
                $this->db->where("articles.publish",'0'); 
            }
            if($this->input->get('q')) {
                $key = $this->input->get('q');               
                $this->db->where("
                name_am LIKE '%$key%' OR
                name_en LIKE '%$key%' OR
                text_am LIKE '%$key%' OR
                text_en LIKE '%$key%' OR
                longtext_am LIKE '%$key%' OR
                longtext_en LIKE '%$key%' 
                "); 
            }
            if($this->input->get('date')) {
                $date = $this->input->get('date');               
                $this->db->where("date LIKE '%$date%'"); 
            }
            if($this->input->get('c_id')) {
                $c_id = $this->input->get('c_id');               
                $this->db->where("category_id", $c_id); 
            }
            $this->db->limit($limit, ($start -1)*$limit); 
            $this->db->order_by('date', 'DESC');
            $query = $this->db->get(); 
            return $query->result();
        }

        public function getAllCount() {
            if($this->session->userdata('role') != ROLE_ADMIN) {
                $this->db->where("articles.installer_id",$this->session->userdata('userId'));
                $this->db->where("articles.publish",'0');       
            } 
            if($this->input->get('publish') == 'on') {
                $this->db->where("articles.publish",'0'); 
            } 
            if($this->input->get('q')) {
                $key = $this->input->get('q');               
                $this->db->where("
                name_am LIKE '%$key%' OR
                name_en LIKE '%$key%' OR
                text_am LIKE '%$key%' OR
                text_en LIKE '%$key%' OR
                longtext_am LIKE '%$key%' OR
                longtext_en LIKE '%$key%' 
                "); 
            }
            if($this->input->get('date')) {
                $date = $this->input->get('date');               
                $this->db->where("date LIKE '%$date%'"); 
            }
            if($this->input->get('c_id')) {
                $c_id = $this->input->get('c_id');               
                $this->db->where("category_id", $c_id); 
            }
            $count = $this->db->get($this->table)->num_rows();
            return $count;
        }
        
        public function staticPages(){
            $this->db->select('*');
            $this->db->from('static_pages');
            $query = $this->db->get()->result();
            return $query;
        }

        public function getStaticPage($id){
            $query = $this->db->get_where('static_pages', array('id' => $id))->row();
            if ($query) {
                return $query;
            }
        }

        public function updateStaticPage($img){
            $id     = $this->input->post('id');
            $delete_pic = $this->input->post('delete_pic');
            $data = [
                // 'title'     => str_replace('&nbsp;', ' ', preg_replace('/\s+/', ' ', htmlentities($this->input->post('title'), ENT_QUOTES, 'UTF-8'))),
                'text_am'      => str_replace('&nbsp;', ' ', str_replace('</script>', '&lt;/script&gt;', str_replace('<script>', '&lt;script&gt;', $this->input->post('text_am')))),
                // 'text_ru'      => str_replace('&nbsp;', ' ', str_replace('</script>', '&lt;/script&gt;', str_replace('<script>', '&lt;script&gt;', $this->input->post('text_ru')))),
                'text_en'      => str_replace('&nbsp;', ' ', str_replace('</script>', '&lt;/script&gt;', str_replace('<script>', '&lt;script&gt;', $this->input->post('text_en')))),
                'date'      => date("Y-m-d H:i:s"),
            ];  
            if ($delete_pic == "on") {
                    $img = ' ';                  
                    $image = $this->db->get_where('static_pages', array('id' => $id))->row('img');
                    $path = FCPATH . 'images/static/' . $image;
                    if (file_exists($path)) {
                        UNLINK($path);
                    }
                }         
            if ($img != null) {
                $data['img'] = $img;
            }
            $this->db->where('id', $id);
            $this->db->update('static_pages', $data);
        }
    
      
        
        public function getCountByshownNull() {
            $query = $this->db->get_where($this->table,array('publish' => '0')); 
            $count = $query->num_rows();  
            return $count;
        }  
        
        public function getAllTags(){
            $this->db->select('title');
            $query = $this->db->get('tags');
            return $query->result();
        }

        public function membersTree($parent_id){            
            $row1 = [];
            $this->db->select('categories.id, categories.name_am, categories.parent_id');
            $this->db->from('categories');
            $this->db->where('parent_id', $parent_id);
            $row = $this->db->get()->result();
            foreach ($row as $key => $value) {         
                $row1[$key]['text'] = $value->name_am;
                $row1[$key]['id'] = $value->id;
                $this->membersTree($value->id) ? $row1[$key]['inc'] = array_values($this->membersTree($value->id)) : '';
            }
            return $row1;
        }

        public function getAllCategories(){
            $parent_id = '0';
            $data = [];
            $data = $this->membersTree($parent_id);
            return array_values($data);
        }
    
        public function getCategoryByID($id){
            $this->db->select('*');
            $this->db->from('categories');
            $this->db->where("categories.id", $id);
            $query = $this->db->get()->row();
            return $query;
        }

        public function categoryList() {
            $this->db->select("id, name_am, parent_id");
            $this->db->from("categories");
            $query = $this->db->get()->result();
            $cat = array(
                'items' => array(),
                'parents' => array()
            );
            foreach ($query as $cats) {
                $cat['items'][$cats->id] = $cats;
                $cat['parents'][$cats->parent_id][] = $cats->id;
            }
            if ($cat) {
                $result = $this->buildCategoryMenu(0, $cat);
                return $result;
            } else {
                return FALSE;
            }
        }
        
        function buildCategoryMenu($parent, $menu){       
            $html = "";
            if (isset($menu['parents'][$parent])) {
                $html .= "<tr>";
                foreach ($menu['parents'][$parent] as $k => $itemId) {
                    if (!isset($menu['parents'][$itemId])) {
                        if ($menu['items'][$itemId]->parent_id > 0) {
                            $parentID = $menu['items'][$itemId]->parent_id;
                                $html .= "<td>" . $itemId . "</td>";
                                $html .= "<td>" . $menu['items'][$parentID]->name_am .  ' &rarr; '  . $menu['items'][$itemId]->name_am . "</td>";
                            $html .=    "<td class='text-center'>
                                            <button class='btn btn-sm btn-info mr-2' title='Խմբագրել' data-id=" . $menu['items'][$itemId]->id . " data-toggle='modal' data-target='#editCategory'>
                                                <i class='fa fa-pencil'></i>
                                            </button>
                                            <button class='btn btn-sm btn-danger' title='Հեռացնել' data-id=" . $menu['items'][$itemId]->id . " data-delete='category'>
                                                <i class='fa fa-trash'></i>
                                            </button>
                                        </td>";
                            $html .=    "</tr>";
                        }else{
                            $html .=    "<td>" . $itemId . "</td>";
                            $html .=    "<td>" . $menu['items'][$itemId]->name_am . "</td>";
                            $html .=    "<td class='text-center'>
                                            <button class='btn btn-sm btn-info mr-2' title='Խմբագրել' data-id=" . $menu['items'][$itemId]->id . " data-toggle='modal' data-target='#editCategory'>
                                                <i class='fa fa-pencil'></i>
                                            </button>
                                            <button class='btn btn-sm btn-danger' title='Հեռացնել' data-id=" . $menu['items'][$itemId]->id . " data-delete='category'>
                                                <i class='fa fa-trash'></i>
                                            </button>
                                        </td>";
                            $html .=    "</tr>";
                        }
                    }
                    if (isset($menu['parents'][$itemId])) {
                        if ($menu['items'][$itemId]->parent_id > 0) {
                            $parentID = $menu['items'][$itemId]->parent_id;
                            $html .=    "<td>" . $itemId . "</td>";
                            $html .=    "<td>" . $menu['items'][$parentID]->name_am .  ' &rarr; '  .  $menu['items'][$itemId]->name_am . "</td>";
                            $html .=    "<td class='text-center'>
                                            <button class='btn btn-sm btn-info mr-2' title='Խմբագրել' data-id=" . $menu['items'][$itemId]->id . " data-toggle='modal' data-target='#editCategory'>
                                                <i class='fa fa-pencil'></i>
                                            </button>
                                            <button class='btn btn-sm btn-danger' title='Հեռացնել' data-id=" . $menu['items'][$itemId]->id . " data-delete='category'>
                                                <i class='fa fa-trash'></i>
                                            </button>
                                        </td>";
                            $html .= $this->buildCategoryMenu($itemId, $menu);
                            $html .= "</tr>";
                        }else {
                            $html .=    "<td>" . $itemId . "</td>";
                            $html .=    "<td>"  .  $menu['items'][$itemId]->name_am . "</td>";
                            $html .=    "<td class='text-center'>
                                            <button class='btn btn-sm btn-info mr-2' title='Խմբագրել' data-id=" . $menu['items'][$itemId]->id . " data-toggle='modal' data-target='#editCategory'>
                                                <i class='fa fa-pencil'></i>
                                            </button>
                                            <button class='btn btn-sm btn-danger' title='Հեռացնել' data-id=" . $menu['items'][$itemId]->id . " data-delete='category'>
                                                <i class='fa fa-trash'></i>
                                            </button>
                                        </td>";
                            $html .=    $this->buildCategoryMenu($itemId, $menu);
                            $html .=    "</tr>";
                        }                   
                    }
                }
            }
            return $html;
        }
    
        public function editCategory($data_edit) {
            $array = array(
                'name_am' => $data_edit['name_am'],
                // 'name_ru' => $data_edit['name_ru'],
                'name_en' => $data_edit['name_en'],
                'parent_id' => $data_edit['parent_id'],
                'order_by' => $data_edit['order_by']
            );       
            $this->db->where('id', $data_edit['id']);
            $this->db->set($array);
            $this->db->update('categories');
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function addCategory($data_insert){
            $this->db->set($data_insert);
            $this->db->insert('categories');
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteCategory($id) {
            $sum_parent = $this->db->get_where('categories', array('parent_id' => $id))->num_rows();
            if ($sum_parent > 0) {
                return '-1';
            }
            $sum_articles = $this->db->get_where('articles', array('category_id' => $id))->num_rows();
            if ($sum_articles > 0) {
                return '-2';
            }
            $this->db->where('id', $id);
            $this->db->delete('categories');
            if ($this->db->affected_rows() > 0) {
                return '1';
            } else {
                return '-3';
            }
        }

        public function showItem($id, $publish){
            $data = array('publish' => $publish);
            $this->db->where("id", $id);
            $this->db->update($this->table, $data);
            $query = $this->db->get_where($this->table, array('publish' => '0'));
            $count = $query->num_rows();
            return $count;
        }

        public function getItemById($id){
            $this->db->select('articles.id,articles.name_am,articles.name_en,articles.text_am,articles.text_en,articles.longtext_am,articles.longtext_en,articles.img,articles.general,articles.category_id,articles.date, JSON_ARRAYAGG(JSON_OBJECT("id", documents.id, "path", documents.file, "extension", documents.extension)) as files');
            $this->db->from($this->table);
            $this->db->join('documents', 'documents.post_id=articles.id', 'left');
            $this->db->where("articles.id", $id);
            $query['getItemById'] = $this->db->get()->row();
            $this->db->select('tags.title as tag_name, tags.id as tag_id');
            $this->db->from('article_tags');
            $this->db->join('articles', 'articles.id = article_tags.article_id', 'inner');
            $this->db->join('tags', 'article_tags.tag_id = tags.id', 'inner');
            $this->db->where("articles.id", $id);
            $query['getItemTags'] = $this->db->get()->result();
            return $query;
        }

        public function addOrUpdateItem($img){
            $item = $this->input->post('item');
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name_am', '', 'required');
            // $this->form_validation->set_rules('name_ru', '', 'required');
            $this->form_validation->set_rules('name_en', '', 'required');
            $this->form_validation->set_rules('text_am', '', 'required');
            // $this->form_validation->set_rules('text_ru', '', 'required');
            $this->form_validation->set_rules('text_en', '', 'required');
            if ($this->form_validation->run() !== false) {
               // $name = str_replace('&nbsp;', ' ', preg_replace('/\s+/', ' ', htmlentities($this->input->post('name'), ENT_QUOTES, 'UTF-8')));
                $name_am = $this->input->post('name_am');
                // $name_ru = $this->input->post('name_ru');
                $name_en = $this->input->post('name_en');
                $text_am = str_replace('&nbsp;', ' ', str_replace('</script>', '&lt;/script&gt;', str_replace('<script>', '&lt;script&gt;', $this->input->post('text_am'))));
                // $text_ru = str_replace('&nbsp;', ' ', str_replace('</script>', '&lt;/script&gt;', str_replace('<script>', '&lt;script&gt;', $this->input->post('text_ru'))));
                $text_en = str_replace('&nbsp;', ' ', str_replace('</script>', '&lt;/script&gt;', str_replace('<script>', '&lt;script&gt;', $this->input->post('text_en'))));
                $longtext_am = $this->input->post('longtext_am');
                // $longtext_ru = $this->input->post('longtext_ru');
                $longtext_en = $this->input->post('longtext_en');
                $delete_pic = $this->input->post('delete_pic');
                $general = $this->input->post('general');
                $categ_id = $this->input->post('category');
                $date = $this->input->post('date');
                $tags = htmlentities(trim($this->input->post('tags'), ' '), ENT_QUOTES, 'UTF-8');
                $tagsArr = explode(',', $tags);  
                $role = $this->session->userdata('role');
                $role == ROLE_ADMIN ? $publish = '1' : $publish = '0';
                $general == "on" ? $general = 1 : $general = 0;
                if ($delete_pic == "on") {
                    $img = ' ';                  
                    $image = $this->db->get_where($this->table, array('id' => $item))->row('img');
                    $path = FCPATH . 'images/upload/' . $image;
                    if (file_exists($path)) {
                        UNLINK($path);
                    }
                }
                $data = array(
                    'name_am' => @$name_am,
                    // 'name_ru' => @$name_ru,
                    'name_en' => @$name_en,
                    'text_am' => @$text_am,
                    // 'text_ru' => @$text_ru,
                    'text_en' => @$text_en,
                    'longtext_am' => @$longtext_am,
                    // 'longtext_ru' => @$longtext_ru,
                    'longtext_en' => @$longtext_en,
                    'general' => @$general,
                    'category_id' => @$categ_id,
                    'date' => @$date,
                    'publish' => @$publish,
                    'installer_id' => $this->session->userdata('userId')
                );
                if ($img != null) {
                   $data['img'] = $img;
                }
                if ($item) {
                    $this->db->where("id", $item);                   
                    $this->db->update($this->table, $data);  
                    if (!empty($_FILES['file']['name'][0])) {                                        
                        $count = count($_FILES['file']['name']);
                            $files = $_FILES['file'];
                            for($s = 0; $s < $count; $s++){
                                $_FILES['file']['name']         =   $files['name'][$s];
                                $_FILES['file']['type']         =   $files['type'][$s];
                                $_FILES['file']['tmp_name']     =   $files['tmp_name'][$s]; 
                                $_FILES['file']['error']        =   $files['error'][$s];
                                $_FILES['file']['size']         =   $files['size'][$s];  
                                    $upload_path = FCPATH . 'uploads/documents';
                                    $__file = fn_upload('file', $upload_path);                                                                 
                                    $upload_data = [
                                        'file'      => $__file['file_name'],
                                        'extension' => $__file['file_ext'],
                                        'post_id'   => $item   
                                    ];
                                    $this->db->insert('documents', $upload_data);
                            }                    
                        }                   
                    if($this->db->affected_rows() > 0) {                       
                        $this->db->where('article_id', $item);
                        $this->db->delete('article_tags');
                            foreach ($tagsArr as $key => $value) {
                                if ($value != '') {
                                    $this->db->query("CALL CalculateTags('$value', $item)");
                                }
                            }
                        return true;
                    }else {
                        return false;
                    }                        
                }else {
                    $this->db->insert($this->table, $data);
                    $articleId = $this->db->insert_id();
                    if ($this->db->affected_rows() > 0) {
                        if (!empty($_FILES['file']['name'][0])) {                
                            $count = count($_FILES['file']['name']);
                                $files = $_FILES['file'];
                                for($s = 0; $s < $count; $s++){
                                    $_FILES['file']['name']         =   $files['name'][$s];
                                    $_FILES['file']['type']         =   $files['type'][$s];
                                    $_FILES['file']['tmp_name']     =   $files['tmp_name'][$s]; 
                                    $_FILES['file']['error']        =   $files['error'][$s];
                                    $_FILES['file']['size']         =   $files['size'][$s];  
                                        $upload_path = FCPATH . 'uploads/documents';
                                        $__file = fn_upload('file', $upload_path);                                
                                        $upload_data = [
                                            'file'      => $__file['file_name'],
                                            'extension' => $__file['file_ext'],
                                            'post_id'   => $articleId   
                                        ];
                                        $this->db->insert('documents', $upload_data);
                                }                    
                        }
                        if (!empty($tagsArr[0])) {
                            foreach ($tagsArr as $key => $value) {
                                $this->db->query("CALL CalculateTags('$value', $articleId)");
                            }
                        }
                         return true;
                    }else{
                        return false; 
                    }                   
                }                            
            }else{
                return false;
            }
        }
    
        public function deleteItem($id){
            $img = $this->db->get_where($this->table, array('id' => $id))->row('img');
            $this->db->where('id', $id);
            $this->db->delete($this->table);
            if ($this->db->affected_rows() > 0) {
                if ($img != null) {
                    $path = FCPATH . 'images/upload/' . $img;
                    if (file_exists($path)) {
                        UNLINK($path);
                    }
                }
                return true;
            }else{
                return false;
            }
        }

        public function getSearchLogs($limit, $start){
            if ($start < 2) {
                $start = 1;
            }
            $this->db->select('query as datas, max(count) as count, count(*) as counts');
            $this->db->from('search_logs');
            $this->db->group_by('query');
            $this->db->order_by('count(*)', 'DESC');
            $this->db->limit($limit, ($start - 1) * $limit);
            $query = $this->db->get();
            return $query->result();
        }

        public function getSearchLogsCount(){
            $this->db->select('count(*) as numrows');
            $this->db->from('search_logs');
            $this->db->group_by('query');
            $count = $this->db->count_all_results();
            return $count;
        }

        public function getSubscribeEmails(){
            $this->db->where('published', '1');
            $query = $this->db->get('subscribe');
            return $query->result();
        }
        
        public function cancelSubscribe($key) {
            $this->db->where('key', $key);
            $this->db->where('published', '1');
            $this->db->update('subscribe', ['published' => '0']);
            if($this->db->affected_rows() > 0) {
                return 'true';
            }
        }

        public function getArchive($limit, $start){
            if ($start < 2) {
                $start = 1;
            }
            if ($this->input->get('q')) {
                $key = $this->input->get('q');
                $where = "archive.name_am LIKE '%$key%' OR archive.name_en LIKE '%$key%'";
            } else if ($this->input->get('date')) {
                $date = $this->input->get('date');
                $where =  "archive.date LIKE '%$date%'";
            }
            $this->db->select('*');
            $this->db->from('archive');
            if (@$where) {
                $this->db->where($where);
            }
            $this->db->limit($limit, ($start - 1) * $limit);
            $this->db->order_by('date', 'DESC');
            $query['items'] = $this->db->get()->result();
            return $query;
        }

        public function getCountByArchive(){
            if ($this->input->get('q')) {
                $key = $this->input->get('q');
                $where = "archive.name_am LIKE '%$key%' OR archive.name_en LIKE '%$key%'";
            } else if ($this->input->get('date')) {
                $date = $this->input->get('date');
                $where =  "archive.date LIKE '%$date%'";
            }
            $this->db->from("archive");
            if (@$where) {
                $this->db->where($where);
            }
            return $this->db->count_all_results();
        }
       
        public function getArchiveById($id){
            $query = $this->db->get_where('archive', array('id' => $id));
            return $query->row();
        }
    
        public function setArchive($name_am, $name_ru, $name_en, $img = null, $file_info = null, $date = null , $type = null){
            $data = array(
                    'name_am' => $name_am,
                    // 'name_ru' => $name_ru,
                    'name_en' => $name_en,
                    'img' => $img,
                    'pdf' => $file_info,
                    'date' => $date,
                    'type' => $type
                );
            return $this->db->insert('archive', $data);
        }

        public function updateArchive($item, $name_am, $name_en, $img = null, $file_info = null, $date = null, $type = null){
            if ($img == null && $file_info == null) {
                $data = array(
                    'name_am' => $name_am,
                    // 'name_ru' => $name_ru,
                    'name_en' => $name_en,
                    'date' => $date,
                    'type' => $type
                );
            } elseif ($img == null) {
                $data = array(
                    'name_am' => $name_am,
                    // 'name_ru' => $name_ru,
                    'name_en' => $name_en,
                    'pdf' => $file_info,
                    'date' => $date,
                    'type' => $type
                );
            } elseif ($file_info == null) {
                $data = array(
                    'name_am' => $name_am,
                    // 'name_ru' => $name_ru,
                    'name_en' => $name_en,
                    'img' => $img,
                    'date' => $date,
                    'type' => $type
                );
            } else {
                $data = array(
                    'name_am' => $name_am,
                    // 'name_ru' => $name_ru,
                    'name_en' => $name_en,
                    'img' => $img,
                    'pdf' => $file_info,
                    'date' => $date,
                    'type' => $type
                );
            }
              
            $this->db->where("id", $item);
            $this->db->update('archive', $data);
        }  
    
        public function deleteArchive($id) {
            $pdf = $this->db->get_where('archive', array('id' => $id))->row('pdf');
            $img = $this->db->get_where('archive', array('id' => $id))->row('img');
            $this->db->where('id', $id);
            $this->db->delete('archive');
            if ($this->db->affected_rows() > 0) {
                if ($pdf != null) {
                    $path_pdf = FCPATH . 'documents/pdf/' . $pdf;
                    if (file_exists($path_pdf)) {
                        UNLINK($path_pdf);
                    }
                }
                if ($img != null) {
                    $path_img = FCPATH . 'documents/pdf/' . $img;
                    if (file_exists($path_img)) {
                        UNLINK($path_img);
                    }
                }
                return true;
            } else {
                return false;
            }
        }

        public function get_count_by_videos(){
            if ($this->input->get('q')) {
                $key = $this->input->get('q');
                $where = "videos.title_am LIKE '%$key%' OR videos.title_en LIKE '%$key%'";
            } else if ($this->input->get('date')) {
                $date = $this->input->get('date');
                $where =  "videos.date LIKE '%$date%'";
            }
            $this->db->from("videos");
            if (@$where) {
                $this->db->where($where);
            }
            return $this->db->count_all_results();
        }

        public function get_all_videos($limit, $start){
            if ($start < 2) {
                $start = 1;
            }
            if ($this->input->get('q')) {
                $key = $this->input->get('q');
                $where = "videos.title_am LIKE '%$key%' OR videos.title_en LIKE '%$key%'";
            } else if ($this->input->get('date')) {
                $date = $this->input->get('date');
                $where =  "videos.date LIKE '%$date%'";
            }
            $this->db->select('*');
            $this->db->from('videos');
            if (@$where) {
                $this->db->where($where);
            }
            $this->db->order_by('date', 'DESC');
            $this->db->limit($limit, ($start - 1) * $limit);
            $query = $this->db->get();
            return $query->result();
        }

        public function getVideoById($id){
            $this->db->select('*');
            $this->db->from('videos');
            $this->db->where("videos.id", $id);
            $query = $this->db->get()->row();
            return $query;
        }
    
        public function setVideos($data){
            $this->db->insert('videos', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }else{
                return false;
            }
        }
        
        public function updateVideos($data){ 
            $this->db->where('id', $data['id']);
            $this->db->set($data);
            $this->db->update('videos');
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteVideo($id){
            $this->db->where('id', $id);
            $this->db->delete('videos');
            if ($this->db->affected_rows() > 0) {               
                return true;
            } else {
                return false;
            }
        }

        public function get_count_by_team(){
            return $this->db->from("team")->count_all_results();
        }

        public function get_all_team($limit, $start){
            if ($start < 2) {
                $start = 1;
            }
            $this->db->select('*');
            $this->db->from('team');
            $this->db->limit($limit, ($start - 1) * $limit);
            $query = $this->db->get();
            return $query->result();
        }

        public function get_count_by_testimonials(){
            return $this->db->from("testimonials")->count_all_results();
        }

        public function get_all_testimonials($limit, $start){
            if ($start < 2) {
                $start = 1;
            }
            $this->db->select('*');
            $this->db->from('testimonials');
            $this->db->limit($limit, ($start - 1) * $limit);
            $query = $this->db->get();
            return $query->result();
        }
        
        public function setTestimonials($data){
            $this->db->insert('testimonials', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
        
        public function deleteTestimonials($id){
            $img = $this->db->get_where('testimonials', array('id' => $id))->row('img');           
            $this->db->where('id', $id);
            $this->db->delete('testimonials');
            if ($this->db->affected_rows() > 0) {   
                if ($img != null) {
                    $path_img = FCPATH . 'images/testimonials/' . $img;
                    if (file_exists($path_img)) {
                        UNLINK($path_img);
                    }
                }
                return true;
            } else {
                return false;
            }
        }
        
        public function getTeamById($id){
            $this->db->select('*');
            $this->db->from('team');
            $this->db->where("team.id", $id);
            $query = $this->db->get()->row();
            return $query;
        }
    
        public function setTeam($data){
            $this->db->insert('team', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function updateTeam($data){
            if ($data['img'] == null) {
                unset($data['img']);
            }
            $this->db->where('id', $data['id']);
            $this->db->set($data);
            $this->db->update('team');
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    
        public function deleteTeam($id){
            $img = $this->db->get_where('team', array('id' => $id))->row('img');           
            $this->db->where('id', $id);
            $this->db->delete('team');
            if ($this->db->affected_rows() > 0) {   
                if ($img != null) {
                    $path_img = FCPATH . 'images/team/' . $img;
                    if (file_exists($path_img)) {
                        UNLINK($path_img);
                    }
                }
                return true;
            } else {
                return false;
            }
        }

    public function get_count_by_clients(){
        return $this->db->from("clients")->count_all_results();
    }

    public function get_all_clients($limit, $start){
        if ($start < 2) {
            $start = 1;
        }
        $this->db->select('*');
        $this->db->from('clients');
        $this->db->limit($limit, ($start - 1) * $limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function getClientById($id){
        $this->db->select('*');
        $this->db->from('clients');
        $this->db->where("clients.id", $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function setClient($data){
        $this->db->insert('clients', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateClient($data){
        if ($data['img'] == null) {
            unset($data['img']);
        }
        $this->db->where('id', $data['id']);
        $this->db->set($data);
        $this->db->update('clients');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteClient($id){
        $img = $this->db->get_where('clients', array('id' => $id))->row('img');
        $this->db->where('id', $id);
        $this->db->delete('clients');
        if ($this->db->affected_rows() > 0) {
            if ($img != null) {
                $path_img = FCPATH . 'images/client/' . $img;
                if (file_exists($path_img)) {
                    UNLINK($path_img);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function get_count_by_school_grant_programs(){
        if ($this->input->get('q')) {
            $key=$this->input->get('q');            
            $this->db->where("
                school_grant_programs.name_am LIKE '%$key%' OR              
                school_grant_programs.name_en LIKE '%$key%' OR
                school_grant_programs.purpose_am LIKE '%$key%' OR
                school_grant_programs.purpose_en LIKE '%$key%' OR
                school_grant_programs.interest_groups_am LIKE '%$key%' OR
                school_grant_programs.interest_groups_en LIKE '%$key%' OR
                school_grant_programs.location_am LIKE '%$key%' OR
                school_grant_programs.structure_am LIKE '%$key%' OR              
                school_grant_programs.structure_en LIKE '%$key%' OR
                school_grant_programs.quotes_am LIKE '%$key%' OR                
                school_grant_programs.quotes_en LIKE '%$key%' OR
                school_grant_programs.results_am LIKE '%$key%' OR
                school_grant_programs.results_en LIKE '%$key%'
            ");
        }
        if ($this->input->get('date')) {
            $date=$this->input->get('date');
            $this->db->where("date LIKE '%$date%'");
        }
        $query = $this->db->get('school_grant_programs');
        $count = $query->num_rows();
        return $count;
    }

    public function get_all_school_grant_programs($limit, $start){
        if ($start < 2) {
            $start = 1;
        }
        $this->db->select('*');
        $this->db->from('school_grant_programs');
          if ($this->input->get('q')) {
            $key=$this->input->get('q');            
            $this->db->where("
                school_grant_programs.name_am LIKE '%$key%' OR              
                school_grant_programs.name_en LIKE '%$key%' OR
                school_grant_programs.purpose_am LIKE '%$key%' OR
                school_grant_programs.purpose_en LIKE '%$key%' OR
                school_grant_programs.interest_groups_am LIKE '%$key%' OR
                school_grant_programs.interest_groups_en LIKE '%$key%' OR
                school_grant_programs.location_am LIKE '%$key%' OR
                school_grant_programs.structure_am LIKE '%$key%' OR             
                school_grant_programs.structure_en LIKE '%$key%' OR
                school_grant_programs.quotes_am LIKE '%$key%' OR               
                school_grant_programs.quotes_en LIKE '%$key%' OR
                school_grant_programs.results_am LIKE '%$key%' OR
                school_grant_programs.results_en LIKE '%$key%'
            ");
        }
        if ($this->input->get('date')) {
            $date=$this->input->get('date');
            $this->db->where("date LIKE '%$date%'");
        }
        $this->db->limit($limit, ($start - 1) * $limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function addOrUpdateSchoolGrants(){
        $item = $this->input->post('item');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_am', '', 'required'); 
        // $this->form_validation->set_rules('name_ru', '', 'required');       
        $this->form_validation->set_rules('name_en', '', 'required'); 
        if ($this->form_validation->run() !== false) {
            $name_am = $this->input->post('name_am');
            // $name_ru = $this->input->post('name_ru');
            $name_en = $this->input->post('name_en');
            $purpose_am = $this->input->post('purpose_am'); 
            // $purpose_ru = $this->input->post('purpose_ru');  
            $purpose_en = $this->input->post('purpose_en');  
            $interest_groups_am = $this->input->post('interest_groups_am');
            // $interest_groups_ru = $this->input->post('interest_groups_ru');
            $interest_groups_en = $this->input->post('interest_groups_en');
            $location_am = $this->input->post('location_am');
            // $location_ru = $this->input->post('location_ru');
            $location_en = $this->input->post('location_en');
            $structure_am = $this->input->post('structure_am');
            // $structure_ru = $this->input->post('structure_ru');            
            $structure_en = $this->input->post('structure_en');
            $results_am = $this->input->post('results_am');
            // $results_ru = $this->input->post('results_ru');            
            $results_en = $this->input->post('results_en');
            $quotes_am = $this->input->post('quotes_am');
            // $quotes_ru = $this->input->post('quotes_ru');
            $quotes_en = $this->input->post('quotes_en');
            $time = $this->input->post('time');
            $date = $this->input->post('date');
            $data = array(
                'name_am' => @$name_am,
                // 'name_ru' => @$name_ru,
                'name_en' => @$name_en,
                'purpose_am' => @$purpose_am,
                // 'purpose_ru' => @$purpose_ru,
                'purpose_en' => @$purpose_en,                
                'interest_groups_am' => @$interest_groups_am,
                // 'interest_groups_ru' => @$interest_groups_ru,
                'interest_groups_en' => @$interest_groups_en,
                'location_am' => @$location_am,
                // 'location_ru' => @$location_ru,
                'location_en' => @$location_en,
                'structure_am' => @$structure_am,
                // 'structure_ru' => @$structure_ru,
                'structure_en' => @$structure_en,
                'results_am' => @$results_am,
                // 'results_ru' => @$results_ru,
                'results_en' => @$results_en,
                'quotes_am' => @$quotes_am,
                // 'quotes_ru' => @$quotes_ru,
                'quotes_en' => @$quotes_en,
                'time' => @$time,
                'date' => $date
            );           
            if ($item) {
                $this->db->where("id", $item);
                $this->db->update('school_grant_programs', $data);                
            } else {
                $this->db->set($data);
                $this->db->insert('school_grant_programs');
            }
            if ($this->db->affected_rows() > 0) {
                return true;
            }else{
                return false;
            }   
        } else {
            return false;
        }
    }

    public function getSchoolGrantById($id){
        $this->db->select('*');
        $this->db->from('school_grant_programs');
        $this->db->where("school_grant_programs.id", $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function deleteSchoolGrants($id){
        $this->db->where('id', $id);
        $this->db->delete('school_grant_programs');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_count_by_civilSocietyCrowdfunding(){
        if ($this->input->get('q')) {
            $key=$this->input->get('q');            
            $this->db->where("
                civil_society_crowdfunding.name_am LIKE '%$key%' OR           
                civil_society_crowdfunding.name_en LIKE '%$key%' OR
                civil_society_crowdfunding.purpose_am LIKE '%$key%' OR
                civil_society_crowdfunding.purpose_en LIKE '%$key%' OR
                civil_society_crowdfunding.interest_groups_am LIKE '%$key%' OR
                civil_society_crowdfunding.interest_groups_en LIKE '%$key%' OR
                civil_society_crowdfunding.location_am LIKE '%$key%' OR
                civil_society_crowdfunding.structure_am LIKE '%$key%' OR              
                civil_society_crowdfunding.structure_en LIKE '%$key%' OR
                civil_society_crowdfunding.quotes_am LIKE '%$key%' OR               
                civil_society_crowdfunding.quotes_en LIKE '%$key%' OR
                civil_society_crowdfunding.results_am LIKE '%$key%' OR
                civil_society_crowdfunding.results_en LIKE '%$key%'
            ");
        }
        if ($this->input->get('date')) {
            $date=$this->input->get('date');
            $this->db->where("date LIKE '%$date%'");
        }
        if ($this->input->get('status')) {
            $status=$this->input->get('status');
            $this->db->where('status', $status);
        }
        $query = $this->db->get('civil_society_crowdfunding');
        $count = $query->num_rows();
        return $count;
    }

    public function get_all_civilSocietyCrowdfunding($limit, $start){
        if ($start < 2) {
            $start = 1;
        }        
        $this->db->select('*');
        $this->db->from('civil_society_crowdfunding');        
        if ($this->input->get('q')) {
            $key=$this->input->get('q');            
            $this->db->where("
                civil_society_crowdfunding.name_am LIKE '%$key%' OR             
                civil_society_crowdfunding.name_en LIKE '%$key%' OR
                civil_society_crowdfunding.purpose_am LIKE '%$key%' OR
                civil_society_crowdfunding.purpose_en LIKE '%$key%' OR
                civil_society_crowdfunding.interest_groups_am LIKE '%$key%' OR
                civil_society_crowdfunding.interest_groups_en LIKE '%$key%' OR
                civil_society_crowdfunding.location_am LIKE '%$key%' OR
                civil_society_crowdfunding.location_en LIKE '%$key%' OR
                civil_society_crowdfunding.structure_am LIKE '%$key%' OR              
                civil_society_crowdfunding.structure_en LIKE '%$key%' OR
                civil_society_crowdfunding.quotes_am LIKE '%$key%' OR               
                civil_society_crowdfunding.quotes_en LIKE '%$key%' OR
                civil_society_crowdfunding.results_am LIKE '%$key%' OR
                civil_society_crowdfunding.results_en LIKE '%$key%'
            ");
        }
        if ($this->input->get('date')) {
            $date=$this->input->get('date');          
            $this->db->where("civil_society_crowdfunding.date LIKE '%$date%'");
        }
        if ($this->input->get('status')) {
            $status=$this->input->get('status');
            $this->db->where('status', $status);
        }
        $this->db->limit($limit, ($start - 1) * $limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function addOrUpdateCivilSocietyCrowdfunding(){
        $item = $this->input->post('item');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_am', '', 'required');
        // $this->form_validation->set_rules('name_ru', '', 'required');
        $this->form_validation->set_rules('name_en', '', 'required');
        if ($this->form_validation->run() !== false) {
            $name_am = $this->input->post('name_am');
            // $name_ru = $this->input->post('name_ru');
            $name_en = $this->input->post('name_en');
            $purpose_am = $this->input->post('purpose_am'); 
            // $purpose_ru = $this->input->post('purpose_ru');  
            $purpose_en = $this->input->post('purpose_en');              
            $interest_groups_am = $this->input->post('interest_groups_am');
            // $interest_groups_ru = $this->input->post('interest_groups_ru');
            $interest_groups_en = $this->input->post('interest_groups_en');            
            $location_am = $this->input->post('location_am');
            // $location_ru = $this->input->post('location_ru');
            $location_en = $this->input->post('location_en');            
            $structure_am = $this->input->post('structure_am');
            // $structure_ru = $this->input->post('structure_ru');            
            $structure_en = $this->input->post('structure_en');            
            $results_am = $this->input->post('results_am');
            // $results_ru = $this->input->post('results_ru');            
            $results_en = $this->input->post('results_en');
            $quotes_am = $this->input->post('quotes_am');
            // $quotes_ru = $this->input->post('quotes_ru');
            $quotes_en = $this->input->post('quotes_en');
            $status = $this->input->post('status');
            $time = $this->input->post('time');
            $date = $this->input->post('date');
            $data = array(
                'name_am' => @$name_am,
                // 'name_ru' => @$name_ru,
                'name_en' => @$name_en,
                'purpose_am' => @$purpose_am,
                // 'purpose_ru' => @$purpose_ru,
                'purpose_en' => @$purpose_en,                
                'interest_groups_am' => @$interest_groups_am,
                // 'interest_groups_ru' => @$interest_groups_ru,
                'interest_groups_en' => @$interest_groups_en,
                'location_am' => @$location_am,
                // 'location_ru' => @$location_ru,
                'location_en' => @$location_en,
                'structure_am' => @$structure_am,
                // 'structure_ru' => @$structure_ru,
                'structure_en' => @$structure_en,
                'results_am' => @$results_am,
                // 'results_ru' => @$results_ru,
                'results_en' => @$results_en,
                'quotes_am' => @$quotes_am,
                // 'quotes_ru' => @$quotes_ru,
                'quotes_en' => @$quotes_en,
                'status' => @$status,
                'time' => @$time,
                'date' => $date
            );
            if ($item) {
                $this->db->where("id", $item);
                $this->db->update('civil_society_crowdfunding', $data);
            } else {
                $this->db->set($data);
                $this->db->insert('civil_society_crowdfunding');
            }
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function getCivilSocietyCrowdfundingById($id){
        $this->db->select('*');
        $this->db->from('civil_society_crowdfunding');
        $this->db->where("civil_society_crowdfunding.id", $id);
        $query = $this->db->get()->row();
        return $query;
    }
    
     public function deleteCivilSocietyCrowdfunding($id){
        $this->db->where('id', $id);
        $this->db->delete('civil_society_crowdfunding');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function genCategoriesLength(){
        return $this->db->get_where('categories', ['parent_id'=>'0'])->num_rows();
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// USERS
        
        function userListingCount($searchText = '') {
            $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.createdDtm, Role.role');
            $this->db->from('tbl_users as BaseTbl');
            $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
            if(!empty($searchText)) {
                $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                                OR  BaseTbl.name  LIKE '%".$searchText."%'
                                OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
                $this->db->where($likeCriteria);
            }
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.roleId !=', 1);
            $query = $this->db->get();
            
            return $query->num_rows();
        }
        
        function userListing($searchText = '', $page = null, $segment = null) {
            $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.createdDtm, Role.role');
            $this->db->from('tbl_users as BaseTbl');
            $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
            if(!empty($searchText)) {
                $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                                OR  BaseTbl.name  LIKE '%".$searchText."%'
                                OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
                $this->db->where($likeCriteria);
            }
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.roleId !=', 1);
            $this->db->order_by('BaseTbl.userId', 'DESC');
            $this->db->limit($page, $segment);
            $query = $this->db->get();
            
            $result = $query->result();        
            return $result;
        }
        
        function getUserRoles() {
            $this->db->select('roleId, role');
            $this->db->from('tbl_roles');
           // $this->db->where('roleId !=', 1);
            $query = $this->db->get();
            return $query->result();
        }

        function checkEmailExists($email, $userId = 0) {
            $this->db->select("email");
            $this->db->from("tbl_users");
            $this->db->where("email", $email);   
            $this->db->where("isDeleted", 0);
            if($userId != 0){
                $this->db->where("userId !=", $userId);
            }
            $query = $this->db->get();
            return $query->result();
        }
        
        function addNewUser($userInfo) {
            $this->db->trans_start();
            $this->db->insert('tbl_users', $userInfo);        
            $insert_id = $this->db->insert_id();        
            $this->db->trans_complete();        
            return $insert_id;
        }
        
        function getUserInfo($userId) {
            $this->db->select('userId, name, email, mobile, roleId');
            $this->db->from('tbl_users');
            $this->db->where('isDeleted', 0);
            $this->db->where('roleId !=', 1);
            $this->db->where('userId', $userId);
            $query = $this->db->get();
            return $query->row();
        }
        
        function editUser($userInfo, $userId) {
            $this->db->where('userId', $userId);
            $this->db->update('tbl_users', $userInfo);        
            return TRUE;
        }
        
        function deleteUser($userId, $userInfo) {
            $this->db->where('userId', $userId);
            $this->db->update('tbl_users', $userInfo);        
            return $this->db->affected_rows();
        }

        function matchOldPassword($userId, $oldPassword) {
            $this->db->select('userId, password');
            $this->db->where('userId', $userId);        
            $this->db->where('isDeleted', 0);
            $query = $this->db->get('tbl_users');
            $user = $query->result();
            if(!empty($user)){
                if(verifyHashedPassword($oldPassword, $user[0]->password)){
                    return $user;
                } else {
                    return array();
                }
            } else {
                return array();
            }
        }
        
        function changePassword($userId, $userInfo) {
            $this->db->where('userId', $userId);
            $this->db->where('isDeleted', 0);
            $this->db->update('tbl_users', $userInfo);        
            return $this->db->affected_rows();
        }
        
        function loginHistoryCount($userId, $searchText, $fromDate, $toDate) {
            $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
            if(!empty($searchText)) {
                $likeCriteria = "(BaseTbl.sessionData LIKE '%".$searchText."%')";
                $this->db->where($likeCriteria);
            }
            if(!empty($fromDate)) {
                $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
                $this->db->where($likeCriteria);
            }
            if(!empty($toDate)) {
                $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
                $this->db->where($likeCriteria);
            }
            if($userId >= 1){
                $this->db->where('BaseTbl.userId', $userId);
            }
            $this->db->from('tbl_last_login as BaseTbl');
            $query = $this->db->get();
            return $query->num_rows();
        }
        
        function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment) {
            $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
            $this->db->from('tbl_last_login as BaseTbl');
            if(!empty($searchText)) {
                $likeCriteria = "(BaseTbl.sessionData  LIKE '%".$searchText."%')";
                $this->db->where($likeCriteria);
            }
            if(!empty($fromDate)) {
                $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
                $this->db->where($likeCriteria);
            }
            if(!empty($toDate)) {
                $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
                $this->db->where($likeCriteria);
            }
            if($userId >= 1){
                $this->db->where('BaseTbl.userId', $userId);
            }
            $this->db->order_by('BaseTbl.id', 'DESC');
            $this->db->limit($page, $segment);
            $query = $this->db->get();
            $result = $query->result();        
            return $result;
        }

        function getUserInfoById($userId) {
            $this->db->select('userId, name, email, mobile, roleId');
            $this->db->from('tbl_users');
            $this->db->where('isDeleted', 0);
            $this->db->where('userId', $userId);
            $query = $this->db->get();
            return $query->row();
        }
        
        function getUserInfoWithRole($userId) {
            $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.roleId, Roles.role');
            $this->db->from('tbl_users as BaseTbl');
            $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
            $this->db->where('BaseTbl.userId', $userId);
            $this->db->where('BaseTbl.isDeleted', 0);
            $query = $this->db->get();
            return $query->row();
        }

    }

  