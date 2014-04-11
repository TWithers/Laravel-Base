<?php
use \Input;
class EloquentContactRepository extends EloquentRepository implements ContactRepository{
	public function __construct(Contact $contacts){
		$this->repo=$contacts;
	}
	public function newInstance(Array $data){
		$contact=$this->repo->newInstance($data);
		$contact->setUser(Auth::user());
		$contact->id_hash=$this->generateHash('id_hash');
		return $contact->load('user','contactNotes','contactNotes.user','company');
	}
	public function getByHash($hash){
		$contact=parent::getByHash($hash);
		return $contact->load('user','contactNotes','contactNotes.user','company');
	}
	public function getByEmail($email){
		return $this->repo->whereEmail($email)->first();
	}
	public function save(Contact $contact){
		$contact->save();
	}
	public function update(Contact $contact){
		foreach($this->validator->rules as $key=>$val){
			$contact->$key=\Input::get($key);
		}
		$contact->save();
	}
	public function delete(Contact $contact){
		$contact->delete();
	}
	public function getAll($where=null){
		return $this->repo->with(['user','contactNotes','contactNotes.user','company'])->get();
	}
}