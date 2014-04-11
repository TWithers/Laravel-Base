<?php
interface ContactRepository{
	public function getById($id);
	public function getByEmail($email);
	public function getAll($order);
	public function save(Contact $contact);
	public function update(Contact $contact);
	public function delete(Contact $contact);
	public function newInstance(Array $contact);
}