<?php
class ContactNote extends Eloquent implements ContactNoteInterface{
	protected $table = 'contact_notes';
	protected $fillable = ['note'];
	protected $hidden=['id','contact_id','user_id'];
	public function user(){
		return $this->belongsTo('User');
	}
	public function contact(){
		return $this->belongsTo('Contact');
	}
	public function getUser(){
		return $this->user();
	}
	public function setUser(User $user){
		$this->user()->associate($user);
	}
	public function getContact(){
		return $this->contact();
	}
	public function setContact(Contact $contact){
		$this->contact()->associate($contact);
	}
}