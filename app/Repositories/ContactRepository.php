<?php

namespace App\Repositories;

use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    public function getAll($perPage = 20)
    {
        return Contact::orderBy('updated_at', 'desc')->paginate($perPage);
    }

    public function create(array $data): Contact
    {
        $contact = new Contact();
        $contact->name = $data['name'];
        $contact->phone = $data['phone'];
        $contact->email = $data['email'];
        $contact->save();

        return $contact;
    }

    public function delete(int $id): bool
    {
        return Contact::find($id)->delete();
    }
}
