<?php namespace App\Controllers;
 
// use App\Models\Login_model;

class Auth extends BaseController
{
	public function __construct()
    {
    	$this->session = \Config\Services::session();
        // $this->login = new Login_model();
        $this->session->start();
    }


    public function index()
    {
    	$data=[
        		'title'	=> 'Login System'
    	];
         //load the login page
         echo view('auth/auth',$data); 
    }
    
    
}