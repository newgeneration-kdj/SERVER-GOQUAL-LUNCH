<?php
class Menu_model extends CI_Model {
   
    function __construct()
    {    	
        parent::__construct();

        $TABLE_NAME = "lunch";
        $ID = "_id";
        $LABEL = "label";
        $UPDATED = "updated";
        $CREATED = "created";
        $EATED = "eate";
        $HIT = "hit";
        $ISDEPRECATED = "isdeprecated";
    }

    /* read */
    function gets(){
    	return $this->db->query("SELECT * FROM lunch ORDER BY _id DESC")->result();
    }
    function getbyid($menu_id){
    	return $this->db->get_where('lunch', array('_id'=>$menu_id))->row();
    }

    /* created */
    function create($data) {
        $post_data = array(
            'label'     =>  $data['label'],
            'number'    =>  $data['num'],
            'created'    =>  date("Y-m-d"),
            'updated'    =>  date("Y-m-d"),
            'eat'    =>  'null',
            'hit'   =>  0
        );
        $this->db->insert('lunch', $post_data);
        return $this->db->insert_id();
        //$queryStr = "INSERT INTO `lunch` (`label`, `number`, `created`, `updated`, `eat`, `hit`) 
        //             VALUES ('". $data['label'] ."', '". $data['num'] ."', '". date("Y-m-d")."', '". date("Y-m-d") ."', 'null', '0');";

        //return $this->db->query($queryStr);
    }
    function countAll() {
        return $this->db->count_all_result($TABLE_NAME);
    }
}