<?php
class UserController extends \BaseController{
	protected $userRepo;
	public function __construct(EloquentUserRepository $users){
		$this->userRepo=$users;
		$this->beforeFilter('auth');
	}
	public function show($id){
		return $this->userRepo->getByHash($id);
	}
	public function index(){
		return $this->userRepo->getAll();
	}
	public function destroy($id){
		$user=$this->userRepo->getByHash($id);
		$user->delete();
		return '{"error":false}';
	}
	public function store(){
		if($this->userRepo->validate(new UserValidator(Input::all()))){
			$user=$this->userRepo->newInstance(Input::all());
			$this->userRepo->save($user);
		}else{
			return Response::json($this->userRepo->getMessages(),400);
		}
		return $user;
	}
	public function update($id){
		$user=$this->userRepo->getByHash($id);
		$validator=new UserValidator(Input::all());
		$validator->setRule("email","required|max:100|email|unique:users,email,".$user->id);
		$validator->setRule("username","required|between:4,20|alpha_dash|unique:users,username,".$user->id);
		if($this->userRepo->validate($validator)){

			$this->userRepo->update($user);
		}else{
			return Response::json($this->userRepo->getMessages(),400);
		}
		return $user;
	}
}