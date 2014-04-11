<?php
class CompanyValidator extends IlluminateValidator implements ValidatorInterface{
	public $rules=[
		'name'=>'required|max:40',
		'address1'=>'max:255',
		'address2'=>'max:255',
		'city'=>'max:30',
		'state'=>'max:5',
		'zip'=>'max:15',
		'country'=>'max:30',
	];	
}