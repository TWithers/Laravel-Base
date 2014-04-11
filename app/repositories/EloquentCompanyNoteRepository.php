<?php
class EloquentCompanyNoteRepository extends EloquentRepository implements CompanyNoteRepository{
	public function __construct(CompanyNote $notes){
		$this->repo=$notes;
	}
	public function newInstance(Array $data){
		$note=$this->repo->newInstance($data);
		$note->setUser(Auth::user());
		return $note;
	}
	public function save(CompanyNote $note){
		$note->save();
	}
}