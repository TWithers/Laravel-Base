<?php
class ContactNoteValidator extends IlluminateValidator implements ValidatorInterface{
	public $rules=[
		'note'=>'required',
	];	
}