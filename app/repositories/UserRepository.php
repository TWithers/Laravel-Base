<?php
interface UserRepository{
	public function getById($id);
	public function getByEmail($email);
	public function getAll($order);
	public function save(User $user);
	public function update(User $user);
	public function delete(User $user);
	public function newInstance(Array $user);
}