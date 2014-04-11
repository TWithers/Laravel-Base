<?php
interface CompanyRepository{
	public function getById($id);
	public function getByHash($hash);
	public function getAll($order);
	public function save(Company $company);
	public function update(Company $company);
	public function delete(Company $company);
	public function newInstance(Array $company);
}