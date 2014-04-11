<?php

class ContactNoteController extends \BaseController {
	protected $contactRepo;
	protected $noteRepo;
	public function __construct(EloquentContactNoteRepository $notes,EloquentContactRepository $contacts){
		$this->noteRepo=$notes;
		$this->contactRepo=$contacts;
		$this->beforeFilter('auth');
	}
	public function index(){
		return $this->contactRepo->getAll();
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if($this->noteRepo->validate(new ContactNoteValidator(Input::all()))){
			$note=$this->noteRepo->newInstance(Input::all());
			$note->setContact($this->contactRepo->getByHash(Input::get('id_hash')));
			$this->noteRepo->save($note);
		}else{
			return Response::json($this->noteRepo->getMessages(),400);
		}
		return $note;
	}

}