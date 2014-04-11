<?php
class CompanyNoteValidator extends IlluminateValidator implements ValidatorInterface{
	public $rules=[
		'note'=>'required',
	];	
}