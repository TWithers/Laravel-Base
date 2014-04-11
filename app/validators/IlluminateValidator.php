<?php
use \Validator;
class IlluminateValidator implements ValidatorInterface{
	public $rules;
	public $data;
	public $messages;
	protected $validator;
	public function __construct($data=null){
		if($data!==null){
			$this->data=$data;
		}
	}
	public function isValid(){
		//$validatorFactory=new Illuminate\Validation\Factory;
		$validator=Validator::make($this->data,$this->rules);
		if($validator->fails()){
			$this->validator=$validator;
			return false;
		}else{
			return true;
		}
	}
	public function getMessages(){
		return $this->validator->messages();
	}
}