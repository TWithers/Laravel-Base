<?php
class CompanyController extends \BaseController{
	protected $companyRepo;
	public function __construct(EloquentCompanyRepository $company){
		$this->companyRepo=$company;
		$this->beforeFilter('auth');
	}
	public function show($id){
		return $this->companyRepo->getByHash($id);
	}
	public function index(){
		if(Input::get('limited')){
			return $this->companyRepo->getLimited();
		}
		return $this->companyRepo->getAll();
	}
	public function destroy($id){
		$company=$this->companyRepo->getByHash($id);
		$company->delete();
		return '{"error":false}';
	}
	public function store(){
		if($this->companyRepo->validate(new CompanyValidator(Input::all()))){
			$company=$this->companyRepo->newInstance(Input::all());
			$this->companyRepo->save($company);
		}else{
			return Response::json($this->companyRepo->getMessages(),400);
		}
		return $company;
	}
	public function update($id){
		$company=$this->companyRepo->getByHash($id);
		if($this->companyRepo->validate(new CompanyValidator(Input::all()))){
			$this->companyRepo->update($company);
		}else{
			return Response::json($this->companyRepo->getMessages(),400);
		}
		return $company;
	}


}