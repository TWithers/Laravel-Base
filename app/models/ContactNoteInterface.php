<?php
interface ContactNoteInterface{
	public function setUser(User $user);
	public function getUser();
	public function setContact(Contact $contact);
	public function getContact();
}