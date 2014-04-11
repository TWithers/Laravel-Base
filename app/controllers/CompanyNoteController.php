<?php

class CompanyNoteController extends \BaseController {
	protected $companyRepo;
	protected $noteRepo;
	public function __construct(EloquentCompanyNoteRepository $notes,EloquentCompanyRepository $companies){
		$this->noteRepo=$notes;
		$this->companyRepo=$companies;
		$this->beforeFilter('auth');
	}
	public function index(){
		return $this->companyRepo->getAll();
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if($this->noteRepo->validate(new CompanyNoteValidator(Input::all()))){
			$note=$this->noteRepo->newInstance(Input::all());
			$note->setCompany($this->companyRepo->getByHash(Input::get('id_hash')));
			$this->noteRepo->save($note);
		}else{
			return Response::json($this->noteRepo->getMessages(),400);
		}
		return $note;
	}

}