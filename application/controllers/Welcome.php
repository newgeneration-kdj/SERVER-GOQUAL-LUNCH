<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$site_url = "http://github.com";
		$site_data = $this->get_site_data($site_url, 1, 0);
	}

	public function get_site_data()
	{
		$site_url = "http://github.com";
		$URL = "http://naver.com";
		$max_depth = 1;
		$current_depth = 0;

		$current_depth++;
		$this->load->library('Crawler');
		$site_data = array();

		//if($this->crawler->set_url($site_url) !== false) {
			$site_data['title'] = $this->crawler->get_title();
			$site_data['description'] = $this->crawler->get_description();
			$site_data['keywords'] = $this->crawler->get_keywords();
			$site_data['text'] = $this->crawler->get_text();
			$site_data['links'] = $this->crawler->get_links();
			if($current_depth <= $max_depth){
				foreach($site_data['links'] as $link_key => &$link){
					$link['data'] = $this->get_site_data($link, $max_depth, $current_depth);
				}
			}
			return $site_data;
		//} else {
		//	echo "test";
	//		return false;
//		}
	}
}
