<?php 

interface UserInterface {
	public function getContacts();
	public function getContactNotes();
	public function getCompanies();
	public function getCompanyNotes();
}