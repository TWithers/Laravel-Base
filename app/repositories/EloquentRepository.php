<?php
class EloquentRepository{
	protected $repo;
	protected $validator;
	public function newInstance(Array $data){
		$orm=$this->repo->newInstance($data);
		return $orm;
	}
	public function getById($id){
		return $this->repo->find($id);
	}
	public function getByHash($hash){
		return $this->repo->where('id_hash','=',$hash)->firstOrFail();
	}
	public function getAll($where=null){
		if($where==null){
			return $this->repo->all();
		}else{
			return $this->repo->whereRaw($where)->get();
		}
	}
	public function generateHash($field,$length=5){
		$loops=0;
		$found=false;
		while(!$found){
			$loops++;
			$hash=self::randomHash($length);
			$count=$this->repo->where($field,'=',$hash)->count();
			if($count==0){
				$found=true;
			}else{
				if($loops%1000==0){
					$length++;
				}
			}
		}
		return $hash;
	}
	public static function randomHash($str_length){
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);
		$repl = unpack('C2', $bytes);
		$first  = $chars[$repl[1]%62];
		$second = $chars[$repl[2]%62];
		return strtr(substr(base64_encode($bytes), 0, $str_length), '+/', "$first$second");
	}
	public function validate(ValidatorInterface $validator){
		$this->validator=$validator;
		if($validator->isValid()){
			return true;
		}else{
			return false;
		}
	}
	public function getMessages(){
		return $this->validator->getMessages();
	}
	
}