<?php

use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements Illuminate\Auth\UserInterface, UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password','id');
	protected $fillable = ['username', 'password', 'email'];

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}
	public function scopeActivity($query){
		return $query
			->join('contacts','users.id','=','contacts.user_id')
			->join('contact_notes','users.id','=','contact_notes.user_id')
			->join('companies','users.id','=','companies.user_id')
			->join('company_notes','users.id','=','company_notes.user_id')
			->orderBy('created_at','desc');
	}
	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	public function contacts(){
		return $this->hasMany('Contact');
	}
	public function contactNotes(){
		return $this->hasMany('ContactNote');
	}
	public function companies(){
		return $this->hasMany('Company');
	}
	public function companyNotes(){
		return $this->hasMany('CompanyNote');
	}
	public function getContacts(){
		return $this->contacts();
	}
	public function getContactNotes(){
		return $this->contactNotes();
	}
	public function getCompanies(){
		return $this->companies();
	}
	public function getCompanyNotes(){
		return $this->companyNotes();
	}

}