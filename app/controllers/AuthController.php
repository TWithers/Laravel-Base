<?php
class AuthController extends BaseController{
	public function __construct(){
		$this->beforeFilter('csrf',['only'=>'postLogin']);
	}
	public function getLogin(){
		if(Auth::check()){
			return Redirect::to('/');
		}
		return View::make('auth.login');
	}
	public function postLogin(){
		if(Auth::check()){
			return Redirect::to('/');
		}
		if (Auth::attempt(array('username' => $_POST['username'], 'password' => $_POST['password']),isset($_POST['remember_me'])))
		{
		    return Redirect::intended('/');
		}
	}
	public function getLogout(){
		if(Auth::check()){
			Auth::logout();
		}
		return Redirect::to('auth/login');
	}
}