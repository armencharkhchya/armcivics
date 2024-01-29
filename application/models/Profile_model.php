<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Profile_model extends CI_Model {
        
        protected $table = 'students_funds';
    
        public function getProgramById($id){
           $result = $this->db->select('*')->from($this->table)->where('id', $id)->get();
           if ($result->num_rows()>0) {
                return $result->row();
           }else{
                return false;
           } 
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
            }
            $this->db->order_by('date', 'DESC');
            $this->db->limit($limit, ($start - 1) * $limit);
            $query = $this->db->get();
            return $query->result();
        }
        
        public function addOrUpdateItem(){
            $item = $this->input->post('item');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name_am', '', 'required');
            // $this->form_validation->set_rules('name_ru', '', 'required');
            // $this->form_validation->set_rules('name_en', '', 'required');
            if ($this->form_validation->run() !== false) {
                $name_am = $this->input->post('name_am');
                // $name_ru = $this->input->post('name_ru');
                // $name_en = $this->input->post('name_en');
                $longtext_am = $this->input->post('longtext_am');
                // $longtext_ru = $this->input->post('longtext_ru');
                // $longtext_en = $this->input->post('longtext_en');
                $status = $this->input->post('status');  
                $date = $this->input->post('date');   
                $data = array(
                    'name_am' => @$name_am,
                    // 'name_ru' => @$name_ru,
                    // 'name_en' => @$name_en,
                    'content_am' => @$longtext_am,
                    // 'content_ru' => @$longtext_ru,
                    // 'content_en' => @$longtext_en,
                    'status' => @$status,
                    'date' => @$date
                );               
                if ($item) {
                    $this->db->where("id", $item);                   
                    $this->db->update('students_funds', $data);                                      
                }else {
                    $data['school_id'] =  decrypt($this->input->post('school_id'));    
                    $this->db->insert('students_funds', $data);
                                     
                }  
               if($this->db->affected_rows() > 0) {
                    return true;
               }else {
                    return false;
               }                              
            }else{
                return false;
            }
        }
        
    }

  