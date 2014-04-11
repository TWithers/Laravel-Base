<?php
class CompanyNote extends Eloquent implements CompanyNoteInterface{
	protected $table = 'company_notes';
	protected $fillable = ['note'];
	protected $hidden=['id','company_id','user_id'];
	public function user(){
		return $this->belongsTo('User');
	}
	public function company(){
		return $this->belongsTo('Company');
	}
	public function getUser(){
		return $this->user();
	}
	public function setUser(User $user){
		$this->user()->associate($user);
	}
	public function getCompany(){
		return $this->company();
	}
	public function setCompany(Company $company){
		$this->company()->associate($company);
	}
}