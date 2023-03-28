<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ContactServiceInterface
{
    public function getAllContacts();

    public function createContact(Request $request);

    public function deleteContact($contactId);
}
