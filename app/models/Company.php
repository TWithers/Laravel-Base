<?php
class Company extends Eloquent implements CompanyInterface{
	protected $table = 'companies';
	protected $fillable = ['name', 'address1', 'address2','city','state','zip','country'];
	protected $hidden=['id','user_id'];
	protected $softDelete=true;
	public function user(){
		return $this->belongsTo('User');
	}
	public function companyNotes(){
		return $this->hasMany('CompanyNote');
	}
	public function getUser(){
		return $this->user();
	}
	public function setUser(User $user){
		$this->user()->associate($user);
	}
	public function scopeGetLimited($query)
    {
        return $query->select(['id_hash', 'name']);
    }
    public function contacts(){
    	return $this->hasMany('Contact');
    }
    public function getContacts(){
    	return $this->contacts();
    }
    public function getCompanyNotes(){
    	return $this->companyNotes();
    }
}