<?php
interface CompanyNoteInterface{
	public function setUser(User $user);
	public function getUser();
	public function setCompany(Company $company);
	public function getCompany();
}