<?php
interface ContactInterface{
	public function setUser(User $user);
	public function getUser();
	public function setCompany(Company $Company);
	public function getCompany();
}