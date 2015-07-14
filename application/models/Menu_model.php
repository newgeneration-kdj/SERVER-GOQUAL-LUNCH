<?php
class Menu_model extends CI_Model {
    function __construct()
    {    	
        parent::__construct();
    }
    function gets(){
    	return $this->db->query("SELECT * FROM lunch")->result();
    }
    function get($menu_id){
    	return $this->db->get_where('lunch', array('_id'=>$menu_id))->row();
    }
    function countAll() {
        return $this->db->count_all_result('lunch');
    }
}