<?php
class Contact extends Eloquent implements ContactInterface{
	protected $table = 'contacts';
	protected $fillable = ['first_name', 'last_name', 'email','phone'];
	protected $hidden=['id','company_id','user_id'];
	protected $softDelete=true;
	public function user(){
		return $this->belongsTo('User');
	}
	public function contactNotes(){
		return $this->hasMany('ContactNote');
	}
	public function getUser(){
		return $this->user();
	}
	public function setUser(User $user){
		$this->user()->associate($user);
	}
	public function company(){
		return $this->belongsTo('Company');
	}
	public function getCompany(){
		return $this->company();
	}
	public function setCompany(Company $company){
		$this->company()->associate($company);
	}

}