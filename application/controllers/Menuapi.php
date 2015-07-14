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
            $this->response(NULL, 400);
        }

        $this->load->model('menu_model');
        $menu = $this->menu_model->get($this->get('id'));

        if ($menu) {
            $this->response($menu, 200);
        } else {
            $this->response(['error' => 'User could not be found'], 400);
        }
        
        // $user = $this->some_model->getSomething( $this->get('id') );
/*
        $users = [
            1 => ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
            2 => ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
            3 => ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
        ];

        $user = @$users[$this->get('id')];

        if ($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(['error' => 'User could not be found'], 404);
        }
*/
    }

    function menu_post()
    {
        // $this->some_model->update_user($this->get('id'));
        $message = [
            'id' => $this->get('id'),
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'message' => 'Added a resource'
        ];

        $this->response($message, 201); // 201 being the HTTP response code
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
        $users = [
            ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
            ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
            3 => ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
        ];

        if ($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(['error' => 'Couldn\'t find any users!'], 404);
        }
    }

    public function send_post()
    {
        var_dump($this->request->body);
    }

    public function send_put()
    {
        var_dump($this->put('foo'));
    }
}