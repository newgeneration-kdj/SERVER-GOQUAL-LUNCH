<?php
class Menu_model extends CI_Model {
    public $TABLE_NAME = "lunch";
    public $ID = "_id";
    public $LABEL = "label";
    public $UPDATED = "updated";
    public $CREATED = "created";
    public $EATED = "eate";
    public $HIT = "hit";
    public $ISDEPRECATED = "isdeprecated";

    function __construct()
    {    	
        parent::__construct();
    }

    /* read */
    function gets(){
    	return $this->db->query("SELECT * FROM ". $TABLE_NAME)->result();
    }
    function getbyid($menu_id){
    	return $this->db->get_where($TABLE_NAME, array($ID=>$menu_id))->row();
    }

    /* created */
    function create($data) {
        $queryStr = "INSERT INTO `lunch` (`label`, `number`, `create`, `updated`, `eat`, `hit`) 
        VALUES ('". $data['label'] ."', '". $data['num'] ."', '". date("Y-m-d")."', '". date("Y-m-d") ."', 'null', '0');";

        var_dump($queryStr);

        return $this->db->query($queryStr);
    }
    function countAll() {
        return $this->db->count_all_result($TABLE_NAME);
    }
}