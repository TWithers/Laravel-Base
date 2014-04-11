<?php
class UserValidator extends IlluminateValidator implements ValidatorInterface{
	public $rules=[
		'username'=>'required|between:4,20|alpha_dash|unique:users',
		'password'=>'sometimes|required|between:8,30|confirmed',
		'email'=>'required|max:100|email|unique:users',
	];	
}