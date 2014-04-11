<?php
class GuiController extends BaseController{
	public function __construct(){
		$this->beforeFilter('auth');
	}
	
	public function getHome(){
		return View::make('gui.dashboard');
	}
	public function getContacts(){
		return View::make('gui.contacts');
	}
	public function getCompanies(){
		return View::make('gui.companies');
	}
	public function getUsers(){
		return View::make('gui.users');
	}
}