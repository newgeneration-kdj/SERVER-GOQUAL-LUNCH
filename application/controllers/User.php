<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Snoopy.class.php';


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
class User extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }

    function user_get()
    {
        $snoopy = new Snoopy;
        //$snoopy->fetch("http://am0100.com/");
        //preg_match('/<ul id="restaurants">(.*?)<\/ul>/is', $snoopy->results, $text);

        $snoopy->fetch("https://www.yogiyo.co.kr/%EB%8C%80%EA%B5%AC/701021/");
        $regexp='/<ul id="restaurants">(.*?)<\/ul>/is';
        //'/<ul class="list_type_1 search_list">(.*?)<\/ul>/is'
        preg_match($regexp, $snoopy->results, $text);

        //var_dump($snoopy->results);
        var_dump($text);
        echo '</br>';
        echo '</br>';
        echo '</br>';
        echo '</br>';
        echo '</br>';   
        var_dump($snoopy->scheme);        echo '</br>';   
        var_dump($snoopy->host);        echo '</br>';   
        /*
        for($i=0; $i<count($snoopy); $i++) {
            var_dump($snoopy[$i]);
        }
        */


        /*
    	echo "test";
        if (!$this->get('id'))
        {
        	echo "id null";
            $this->response(NULL, 400);
        }

        // $user = $this->some_model->getSomething( $this->get('id') );
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

    function user_post()
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

    function user_delete()
    {
        // $this->some_model->delete_something($this->get();
        $message = [
            'id' => $this->get('id'),
            'message' => 'Deleted the resource'
        ];

        $this->response($message, 204); // 204 being the HTTP response code
    }

    function users_get()
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
