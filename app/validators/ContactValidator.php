<?php
class ContactValidator extends IlluminateValidator implements ValidatorInterface{
	public $rules=[
		'first_name'=>'required|max:30',
		'last_name'=>'required|max:30',
		'email'=>'required|max:100|email',
		'phone'=>'max:30',
	];	
}