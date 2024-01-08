<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Articles_model extends CI_Model {
        
        protected $table = 'articles';
        
        protected $catIds = array();

        public function membersCateg($parent_key){
            $row1 = [];
            $row = $this->db->select('cat.id')
            ->from('categories as cat')
            ->where('cat.parent_id', $parent_key)->get()->result_array();
            foreach ($row as $key => $value) {
                $value['children'] = $this->membersCateg($value['id']);
                $row1[] = $value;
            }
            return $row1;
        }

        public function members_tree($parent_id){
            $lang = $this->uri->segment(1);
            $row1 = [];
            $this->db->select("categories.id, categories.name_{$lang} as cat_name, categories.parent_id");
            $this->db->from('categories');
            $this->db->where('parent_id', $parent_id);
            $this->db->order_by('order_by ASC, id DESC');
            $row = $this->db->get()->result();
            foreach ($row as $key => $value) {
                $row1[$key]['text'] = $value->cat_name;
                $row1[$key]['id'] = $value->id;
                $this->members_tree($value->id) ? $row1[$key]['inc'] = array_values($this->members_tree($value->id)) : '';
            }
            return $row1;
        }
        
        public function membersTree($parent_id){
            $lang = $this->uri->segment(1);
            $row1 = new stdClass();
            $this->db->select("categories.id, categories.name_{$lang} as cat_name, categories.parent_id");
            $this->db->from('categories');
            $this->db->where('parent_id', $parent_id);
            $this->db->order_by('order_by ASC, id DESC');
            $row = $this->db->get()->result();
            foreach ($row as $key => $value) {
                $row1->$key =  new stdClass();
                $row1->$key->text = $value->cat_name;
			    $row1->$key->id = $value->id;
                count((array)$this->membersTree($value->id)) ? $row1->$key->children = $this->membersTree($value->id) : '';
            }
            return $row1;
        }

        public function get_categories(){
            $parent_id = '0';
            $data = $this->membersTree($parent_id);
            return $data;
        }
        
        public function get_all_categories(){
            $parent_id = '0';
            $data = $this->members_tree($parent_id);
            return $data;
        }

        public function general_data(){
            $data['about'] = $this->get_static_page('about');
            $data['videos'] = $this->get_videos();
            // $data['team'] = $this->get_our_team();
            $data['slider'] = $this->db->get_where($this->table, ['general' => 1, 'publish' => '1'], 4, 0 )->result();
            $data['eventful'] = $this->get_eventful();
            $data['announcement'] = $this->get_announcement();
            $data['clients'] = $this->get_our_clients();
            $data['video'] = $this->get_all_multimedia(1, 0);
            return $data;
        }
        
        public function getCatIds($data){
            for ($i = 0; $i < count($data); $i++) {
                array_push($this->catIds, $data[$i]['id']);
                if (!empty($data[$i]['children'])) {
                    $this->getCatIds($data[$i]['children']);
                }
            }
        }

        public function get_eventful(){        
           $query = $this->db->select("*")
           ->from($this->table)
           ->where('general',1)
           ->where('publish','1')
           ->where_not_in('category_id',array(46))
           ->limit(2, 0)
           ->get();
           if ($query->num_rows() > 0) {                
                return $query->result();
           }else{
                return false;
           }           
        }
        
        public function get_announcement(){
            $lang = $this->uri->segment(1);
            $query = $this->db->select("name_{$lang} AS name, text_{$lang} AS text, date")
            ->from($this->table)
            ->where('category_id', 67)
            ->where("articles.date <=", date("Y-m-d H:i:s"))
            ->where_not_in("articles.publish", '0')
            ->order_by('date', 'DESC')
            ->limit(1,0)
            ->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            }else{
                return false;
            }
        }
        
        public function get_articles_by_category($categ_id = null, $limit = null, $start = null){
            $lang = $this->uri->segment(1);
            if ($start < 2) {
                $start = 1;
            }
            $data = $this->membersCateg($categ_id);
            $this->getCatIds($data);
            array_push($this->catIds, $categ_id);
            $this->db->select('categories.id as c_id, categories.name_' . $lang . ' as c_name, articles.id,articles.name_'.$lang.' as name,articles.text_'.$lang.' as text,articles.img,articles.date');
            $this->db->from($this->table);
            $this->db->join('categories', 'categories.id = articles.category_id', 'left');
            $this->db->where("articles.date <=", date("Y-m-d H:i:s"));
            $this->db->where_in("articles.category_id", array_unique($this->catIds));
            $this->db->where_not_in("articles.publish", '0');
            $this->db->order_by('date', 'DESC');
            $this->db->limit($limit, ($start - 1) * $limit);
            $query = $this->db->get()->result();
            foreach ($query as $key => $q) {
                $q->categ_id = $categ_id;
                $q->categ_name = $this->db->get_where('categories', array('categories.id' => $categ_id))->row('name_' . $lang);
                $q->parent_1_id = $this->db->get_where('categories', array('categories.id' => $categ_id))->row('parent_id');
                if ($q->parent_1_id > 0) {
                    $q->parent_1_name = $this->db->get_where('categories', array('categories.id' => $q->parent_1_id))->row('name_' . $lang);
                    $q->parent_2_id = $this->db->get_where('categories', array('categories.id' => $q->parent_1_id))->row('parent_id');
                    if ($q->parent_2_id > 0) {
                        $q->parent_2_name = $this->db->get_where('categories', array('categories.id' => $q->parent_2_id))->row('name_' . $lang);
                        $q->parent_3_id = $this->db->get_where('categories', array('categories.id' => $q->parent_2_id))->row('parent_id');
                        if ($q->parent_3_id > 0) {
                            $q->parent_3_name = $this->db->get_where('categories', array('categories.id' => $q->parent_3_id))->row('name_' . $lang);
                        }else{
                            unset($q->parent_3_id); 
                        }
                    } else {
                        unset($q->parent_2_id);
                    }
                } else {
                    unset($q->parent_1_id);
                }
            }
            return $query;
        }

        public function get_news(){
            $lang = $this->uri->segment(1);
            $this->db->select('categories.id as c_id, categories.name_' . $lang . ' as c_name, articles.id,articles.name_'.$lang.' as name,articles.date');
            $this->db->from($this->table);
            $this->db->join('categories', 'categories.id = articles.category_id', 'left');
            $this->db->where("articles.date <=", date("Y-m-d H:i:s"));
            $this->db->where_not_in("articles.publish", '0');
            $this->db->order_by('date', 'DESC');
            $query = $this->db->get()->result();
            return $query;
        }
        
        public function get_count_by_category($id){
            $id = intval($id);
            $lang = $this->uri->segment(1);
            $data = $this->membersCateg($id);
            $this->getCatIds($data);
            array_push($this->catIds, $id);
            $this->db->from($this->table);
            $this->db->where("articles.date <=", date("Y-m-d H:i:s"));
            $this->db->where_in("articles.category_id", array_unique($this->catIds));
            $this->db->where('articles.publish', '1');
            $count =  $this->db->count_all_results();
            return $count;
        }

        public function get_count_by_search($key){
            $tags = $this->db->get_where("tags", "tags.title LIKE '%$key%'")->row();
            if ($tags) {
                $this->db->join("article_tags", "articles.id = article_tags.article_id", "inner");
                $this->db->join("tags", "article_tags.tag_id = tags.id", "inner");
                $this->db->group_by('articles.id');
                $count = $this->db->get_where($this->table, "(
                    articles.name_am LIKE '%$key%' OR 
                    articles.name_en LIKE '%$key%' OR 
                    articles.text_am LIKE '%$key%' OR                   
                    articles.text_en LIKE '%$key%' OR                     
                    articles.longtext_am LIKE '%$key%' OR 
                    articles.longtext_en LIKE '%$key%' OR  
                    tags.id =' $tags->id') 
                    AND articles.publish = '1'")->num_rows();
            } else {
                $count = $this->db->get_where($this->table, "(
                    articles.name_am LIKE '%$key%' OR 
                    articles.name_en LIKE '%$key%' OR 
                    articles.text_am LIKE '%$key%' OR                   
                    articles.text_en LIKE '%$key%' OR                     
                    articles.longtext_am LIKE '%$key%' OR 
                    articles.longtext_en LIKE '%$key%' 
                    ) 
                    AND articles.publish = '1'")->num_rows();
            }
            return $count;
        }

        public function get_articles_by_search($limit, $start, $key){
            $lang = $this->uri->segment(1);
            if ($start < 2) {
                $start = 1;
            }
            $tags = $this->db->get_where("tags", "tags.title LIKE '%$key%'")->row();
            $this->db->select('categories.id AS c_id,categories.name_'.$lang. ' AS c_name,articles.id,articles.name_'.$lang.' AS name,articles.img,articles.date');
            $this->db->join("categories", "categories.id = articles.category_id", "LEFT");
            $this->db->from($this->table);
            if ($tags) {
                $this->db->join("article_tags", "articles.id = article_tags.article_id", "inner");
                $this->db->join("tags", "article_tags.tag_id = tags.id", "inner");
                $this->db->where("(
                    articles.name_am LIKE '%$key%' OR 
                    articles.name_en LIKE '%$key%' OR 
                    articles.text_am LIKE '%$key%' OR                    
                    articles.text_en LIKE '%$key%' OR                     
                    articles.longtext_am LIKE '%$key%' OR 
                    articles.longtext_en LIKE '%$key%' OR                     
                    tags.id =' $tags->id') 
                    AND articles.publish = '1'");
            } else {
                $this->db->where("(
                    articles.name_am LIKE '%$key%' OR 
                    articles.name_en LIKE '%$key%' OR 
                    articles.text_am LIKE '%$key%' OR                   
                    articles.text_en LIKE '%$key%' OR                     
                    articles.longtext_am LIKE '%$key%' OR 
                    articles.longtext_en LIKE '%$key%' 
                    ) 
                    AND articles.publish = '1'");
            }
            $this->db->group_by('articles.id');
            $this->db->order_by('date', 'DESC');
            $this->db->limit($limit, ($start - 1) * $limit);
            $query = $this->db->get()->result();
            return $query;
        }

        public function search_log($key, $count){
            if (!$count) $count = '0';
            $insert = [
                'query'             => $key,
                'count'             => $count
            ];
            if (!$this->agent->robot() || !$_SERVER['HTTP_USER_AGENT']) {
                $this->db->insert('search_logs', $insert);
            }
        }

        public function get_count_by_tags($id){
            $id = intval($id);
            $count = $this->db->get_where('article_tags', "tag_id  = {$id}")->num_rows();
            return $count;
        }

        public function get_articles_by_tags($limit, $start, $id){
            $lang = $this->uri->segment(1);
            $id = intval($id);
            if ($start < 2) {
                $start = 1;
            }
            $query = $this->db->select("articles.id,
                                            articles.name_{$lang} AS name,
                                            articles.date,
                                            articles.img,
                                            tags.title as tag_name,
                                            categories.id AS c_id,
                                            categories.name_{$lang} AS c_name")
            ->from("articles")
            ->join("article_tags", "articles.id = article_tags.article_id", "inner")
            ->join("tags", "article_tags.tag_id = tags.id", "inner")
            ->join("categories", "categories.id = articles.category_id", "LEFT")
            ->where("tags.id", $id)
            ->where("articles.publish", '1')
            ->limit($limit, ($start - 1) * $limit)
            ->order_by('date', 'DESC')
            ->get()->result();
            return $query;
        }

        public function get_article_by_id($id){
            $lang = $this->uri->segment(1);
            $id = intval($id);
            $this->db->select("articles.id,articles.name_{$lang} AS name,articles.text_{$lang} AS text,articles.longtext_{$lang} AS longtext,articles.img,articles.date,articles.votes,articles.category_id,articles.publish, JSON_ARRAYAGG(JSON_OBJECT('id', documents.id, 'path', documents.file, 'extension', documents.extension)) as files");
            $this->db->from($this->table);
             $this->db->join('documents', 'documents.post_id=articles.id', 'left');
            $this->db->where("articles.id", $id);
            $query = $this->db->get()->row();
            if ($query) {
                $this->db->where('article_id', $id);
                $article_tags = $this->db->get('article_tags')->result();
                if (!empty($article_tags)) {
                    foreach ($article_tags as $row) {
                        $query->tag_name[$row->tag_id] = $this->db->get_where('tags', ['id' => $row->tag_id])->row('title');
                    }
                }
                $query->category_name =  $this->db->get_where('categories', array('categories.id' => $query->category_id))->row('name_'.$lang);
                $query->parent_1_id = $this->db->get_where('categories', array('categories.id' => $query->category_id))->row('parent_id');
                if ($query->parent_1_id > 0) {
                    $query->parent_1_name = $this->db->get_where('categories', array('categories.id' => $query->parent_1_id))->row('name_' . $lang);
                    $query->parent_2_id = $this->db->get_where('categories', array('categories.id' => $query->parent_1_id))->row('parent_id');
                    if ($query->parent_2_id > 0) {
                        $query->parent_2_name = $this->db->get_where('categories', array('categories.id' => $query->parent_2_id))->row('name_' . $lang);
                        $query->parent_3_id = $this->db->get_where('categories', array('categories.id' => $query->parent_2_id))->row('parent_id');
                        if ($query->parent_3_id > 0) {
                            $query->parent_3_name = $this->db->get_where('categories', array('categories.id' => $query->parent_3_id))->row('name_' . $lang);
                        }else{
                            unset($query->parent_3_id);
                        }
                    } else {
                        unset($query->parent_2_id);
                    }
                } else {
                    unset($query->parent_1_id);
                }
                return $query;
            } else {
                return false;
            }
        }

        public function get_items_by_topic($limit, $start, $cat_id, $id){
            $lang = $this->uri->segment(1);
            if ($start < 2) {
                $start = 1;
            }
            $this->db->select("articles.id,articles.name_{$lang} AS name,articles.img,articles.date");
            $this->db->from($this->table);
            $this->db->join('categories', 'categories.id = articles.category_id', 'left');
            $this->db->where("articles.id != {$id}");
            $this->db->where("articles.category_id = {$cat_id}");
            $this->db->or_where("categories.parent_id = {$cat_id}");
            $this->db->where("articles.publish", '1');
            $this->db->order_by('date', 'DESC');
            $this->db->limit($limit, ($start - 1) * $limit);
            $query = $this->db->get();
            return $query->result();
        }

        public function update_count($id, $client_ip){
            $query = $this->db->get_where($this->table, array('id' => $id))->row();
            $data = array('votes' => $query->votes + 1);
            $this->db->where("id", $id);
            $this->db->update($this->table, $data);
        }

        public function is_email_available($key, $email, $date){
            $this->db->select('published');
            $this->db->where('email', strip_tags($email));
            $query = $this->db->get("subscribe")->row_array();
            if ($query) {
                if ($query['published'] == '0') {
                    $this->db->update('subscribe', array('published' => '1'));
                    return 1;
                } else {
                    return 2;
                }
            } else {
                $data = array(
                    'date' => $date,
                    'email' => $email,
                    'key'   => $key,
                    'published' => '1',
                );
                $this->db->insert('subscribe', $data);
                return 3;
            }
        }
        
        public function get_static_page($link) {
            $this->db->select('*');
            $this->db->from('static_pages');
            $array = array('link' => $link);
            $this->db->where($array);
            $query = $this->db->get()->row();
            return $query;
        }     

        public function get_our_team(){
            $query = $this->db->get('team')->result();
            return $query;
        }

        public function get_our_clients(){
            $query = $this->db->get('clients')->result();
            return $query;
        }
    
        public function get_count_by_literature(){
            if ($this->input->get('q')) {
                $key = $this->input->get('q');
                $this->db->where("
                    name_am LIKE '%$key%' OR
                    name_en LIKE '%$key%'                
                ");
            }
            if ($this->input->get('type')) {
                $type = $this->input->get('type');
                $this->db->where("type", $type);
            }
            return $this->db->from("archive")->count_all_results();
        }

        public function get_all_literature($limit, $start){
            if ($start < 2) {
                $start = 1;
            }
            $this->db->select('*');
            $this->db->from('archive');
            if ($this->input->get('q')) {
                $key = $this->input->get('q');
                $this->db->where("
                    name_am LIKE '%$key%' OR
                    name_en LIKE '%$key%'                
                ");
            }
            if ($this->input->get('type')) {
                $type = $this->input->get('type');
                $this->db->where("type", $type);
            }
            $this->db->order_by('date', 'DESC');
            $this->db->limit($limit, ($start - 1) * $limit);
            $query = $this->db->get();
            return $query->result();
        }

        public function get_count_by_multimedia(){
            if ($this->input->get('q')) {
                $key = $this->input->get('q');
                $this->db->where("
                    title_am LIKE '%$key%' OR
                    title_en LIKE '%$key%' 
                ");
            }
            if ($this->input->get('type')) {
                $type = $this->input->get('type');
                $this->db->where("type",$type);
            }
            return $this->db->from("videos")->count_all_results();
        }

        public function get_all_multimedia($limit, $start){
            if ($start < 2) {
                $start = 1;
            }
            $this->db->select('*');
            $this->db->from('videos');
            if ($this->input->get('q')) {
                $key = $this->input->get('q');
                $this->db->where("
                    title_am LIKE '%$key%' OR
                    title_en LIKE '%$key%' 
                ");
            }
            if ($this->input->get('type')) {
                $type = $this->input->get('type');
                $this->db->where("type",$type);
            }
            $this->db->order_by('date', 'DESC');
            $this->db->limit($limit, ($start - 1) * $limit);
            $query = $this->db->get();
            return $query->result();
        }

        public function get_videos(){
            $this->db->select('*');
            $this->db->from('videos');
            $this->db->where('videos.type', 1);
            $this->db->order_by('date', 'DESC');
            $this->db->limit(3, 0);
            $query['programs'] = $this->db->get()->result();
            $this->db->select('*');
            $this->db->from('videos');
            $this->db->where('videos.type', 2);
            $this->db->order_by('date', 'DESC');
            $this->db->limit(3, 0);
            $query['videos'] = $this->db->get()->result();
            $query = array_merge($query['programs'], $query['videos']);
            return $query;
        }

        public function get_count_by_students_funds(){
            $lang = $this->uri->segment(1);
            if($this->input->get('i')){
                $this->db->where('students_funds.school_id', decrypt($this->input->get('i')));
            }
            return $this->db->from("students_funds")->count_all_results();
        }

        public function get_all_students_funds($limit, $start){
            $lang = $this->uri->segment(1);
            if ($start < 2) {
                $start = 1;
            }
            $this->db->select("students_funds.id,students_funds.name_{$lang} AS name,students_funds.status,students_funds.date");
            $this->db->from('students_funds');
            if($this->input->get('i')){
                $this->db->where('students_funds.school_id', decrypt($this->input->get('i')));
            }else{
               $this->db->where('students_funds.status', '1'); 
            }
            $this->db->order_by('date', 'DESC');
            $this->db->limit($limit, ($start - 1) * $limit);
            $query = $this->db->get();
            return $query->result();
        }

        public function get_students_fund_by_id($id){
            $lang = $this->uri->segment(1);
            $id = intval($id);
            $this->db->select("students_funds.id,students_funds.name_{$lang} AS name,students_funds.content_{$lang} AS content, students_funds.date,students_funds.school_id");
            $this->db->from('students_funds');
            $this->db->where("students_funds.id", $id);
            $this->db->where('students_funds.status', '1');
            $query = $this->db->get()->row();
            if ($query) {
                return $query;
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
            $lang = $this->uri->segment(1);
            if ($start < 2) {
                $start = 1;
            }
            $this->db->select('school_grant_programs.id,school_grant_programs.name_'.$lang.' AS name,school_grant_programs.date');
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

        public function get_school_grant_program_by_id($id){
            $lang = $this->uri->segment(1);
            $id = intval($id);
            $this->db->select("
            name_{$lang} AS name, 
            purpose_{$lang} AS purpose,
            interest_groups_{$lang} AS interest_groups,
            location_{$lang} AS location,
            structure_{$lang} AS structure,
            quotes_{$lang} AS quotes,
            results_{$lang} AS results,
            time,
            date
            ");
            $this->db->from('school_grant_programs');
            $this->db->where("school_grant_programs.id", $id);
            $query = $this->db->get()->row();
            if ($query) {           
                return $query;
            } else {
                return false;
            }
        }

        public function get_count_by_civil_society_crowdfunding(){
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

        public function get_all_civil_society_crowdfunding($limit, $start){
            $lang = $this->uri->segment(1);
            if ($start < 2) {
                $start = 1;
            }
            $this->db->select("civil_society_crowdfunding.id,civil_society_crowdfunding.name_{$lang} AS name,civil_society_crowdfunding.purpose_{$lang} AS purpose,civil_society_crowdfunding.status,civil_society_crowdfunding.date");
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

        public function get_civil_society_crowdfund_by_id($id){
            $lang = $this->uri->segment(1);
            $id = intval($id);
            $this->db->select("
                name_{$lang} AS name, 
                purpose_{$lang} AS purpose,
                interest_groups_{$lang} AS interest_groups,
                location_{$lang} AS location,
                structure_{$lang} AS structure,
                quotes_{$lang} AS quotes,
                results_{$lang} AS results,
                time,
                date,
                status
            ");
            $this->db->from('civil_society_crowdfunding');
            $this->db->where("civil_society_crowdfunding.id", $id);
            $query = $this->db->get()->row();
            if ($query) {
                return $query;
            } else {
                return false;
            }
        }
    
    }

  