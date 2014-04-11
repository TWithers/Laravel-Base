<?php
use \Input;
use \Hash;
class EloquentUserRepository extends EloquentRepository implements UserRepository{
	public function __construct(User $users){
		$this->repo=$users;
	}
	public function newInstance(Array $data){
		if(isset($data['password_confirmation'])){
			unset($data['password_confirmation']);
		}
		$user=$this->repo->newInstance($data);
		$user->id_hash=$this->generateHash('id_hash');
		return $user;
	}
	public function getByHash($hash){
		$user=parent::getByHash($hash);
		return $user;
	}
	public function getByEmail($email){
		return $this->repo->whereEmail($email)->first();
	}
	public function save(User $user){
		$user->password=Hash::make($user->password);
		$user->save();
	}
	public function update(User $user){
		if(\Input::has('password')){
			$user->password=\Hash::make(\Input::get('password'));
		}
		foreach($this->validator->rules as $key=>$val){
			if($key!='password')
				$user->$key=\Input::get($key);
		}

		$user->save();
	}
	public function delete(User $user){
		$user->delete();
	}
	public function getAll($where=null){
		return $this->repo->get();
	}
}