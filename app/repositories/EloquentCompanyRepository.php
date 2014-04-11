<?php
use \Input;
class EloquentCompanyRepository extends EloquentRepository implements CompanyRepository{
	public function __construct(Company $companies){
		$this->repo=$companies;
	}
	public function newInstance(Array $data){
		$company=$this->repo->newInstance($data);
		$company->setUser(Auth::user());
		$company->id_hash=$this->generateHash('id_hash');
		return $company->load('user','companyNotes','companyNotes.user','contacts');
	}
	public function getByHash($hash){
		$company=parent::getByHash($hash);
		return $company->load('user','companyNotes','companyNotes.user','contacts');
	}
	public function getByEmail($email){
		return $this->repo->whereEmail($email)->first();
	}
	public function save(Company $company){
		$company->save();
	}
	public function update(Company $company){
		foreach($this->validator->rules as $key=>$val){
			$company->$key=\Input::get($key);
		}
		$company->save();
	}
	public function delete(Company $company){
		$company->delete();
	}
	public function getAll($where=null){
		return $this->repo->with('user','companyNotes','companyNotes.user','contacts')->get();
	}
	public function getLimited(){
		return $this->repo->getLimited()->get();
	}
}