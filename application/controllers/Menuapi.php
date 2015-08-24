<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Menuapi extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->database();
        $this->load->model('menu_model');
        //$this->load->model('menu_model');

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        $this->methods['menu_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['menu_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['menu_delete']['limit'] = 50; //50 requests per hour per user/key
    }

    function menu_get()
    {     
        if (!$this->get('id'))
        {
            $this->menus_get();
          //$this->response(NULL, 400);
        }

        $menu = $this->menu_model->getbyid($this->get('id'));

        if ($menu) {
            $this->response($menu, 200);
        } else {
            $this->response(['error' => 'User could not be found'], 400);
        }
    }

    public function menu_post()
    {
        $data = array(
            'label'=> $this->post('label'),
            'num'=> $this->post('num')
        );   

        $rtv = $this->menu_model->create($data);

        if ($rtv) {
            $this->response("{'_id':'". $rtv ."'}", 201); // 201 being the HTTP response code
        } else {
            $this->response(['error' => 'ERROR'], 400);
        }
    }

    function menu_delete()
    {
        // $this->some_model->delete_something($this->get();
        $message = [
            'id' => $this->get('id'),
            'message' => 'Deleted the resource'
        ];

        $this->response($message, 204); // 204 being the HTTP response code
    }

    function menus_get()
    {
        // $users = $this->some_model->get_something($this->get('limit'));
        $menues = $this->menu_model->gets();

        if ($menues) {
            $this->response($menues, 200);
        } else {
            $this->response(['error' => 'could not find any users'], 400);
        }
    }
   
    public function send_put()
    {
        echo "test1";        
        var_dump($this->put('foo'));
    }
}
