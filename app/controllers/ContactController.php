<?php
class ContactController extends \BaseController{
	protected $contactRepo;
	protected $companyRepo;
	public function __construct(EloquentContactRepository $contacts,EloquentCompanyRepository $companies){
		$this->contactRepo=$contacts;
		$this->companyRepo=$companies;
		$this->beforeFilter('auth');
	}
	public function show($id){
		return $this->contactRepo->getByHash($id);
	}
	public function index(){
		return $this->contactRepo->getAll();
	}
	public function destroy($id){
		$contact=$this->contactRepo->getByHash($id);
		$contact->delete();
		return '{"error":false}';
	}
	public function store(){
		if($this->contactRepo->validate(new ContactValidator(Input::all()))){
			$contact=$this->contactRepo->newInstance(Input::all());
			if(Input::get('company_id')&&$company=$this->companyRepo->getByHash(Input::get('company_id'))){
				$contact->setCompany($company);
			}else{
				$contact->company_id=null;
			}
			$this->contactRepo->save($contact);
		}else{
			return Response::json($this->contactRepo->getMessages(),400);
		}
		return $contact;
	}
	public function update($id){
		$contact=$this->contactRepo->getByHash($id);
		if($this->contactRepo->validate(new ContactValidator(Input::all()))){
			if(Input::get('company_id')&&$company=$this->companyRepo->getByHash(Input::get('company_id'))){
				$contact->setCompany($company);
			}else{
				$contact->company_id=null;
			}
			$this->contactRepo->update($contact);
		}else{
			return Response::json($this->contactRepo->getMessages(),400);
		}
		return $contact;
	}
}