<?php
class EloquentContactNoteRepository extends EloquentRepository implements ContactNoteRepository{
	public function __construct(ContactNote $notes){
		$this->repo=$notes;
	}
	public function newInstance(Array $data){
		$note=$this->repo->newInstance($data);
		$note->setUser(Auth::user());
		return $note;
	}
	public function save(ContactNote $note){
		$note->save();
	}
}