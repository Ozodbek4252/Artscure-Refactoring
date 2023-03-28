<?php

namespace App\Services;

use App\Interfaces\ContactRepositoryInterface;
use App\Interfaces\ContactServiceInterface;
use Illuminate\Http\Request;

class ContactService implements ContactServiceInterface
{
    protected $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getAllContacts($perPage = 20)
    {
        return $this->contactRepository->getAll($perPage);
    }

    public function createContact(Request $request)
    {
        $contactData = $request->all();
        return $this->contactRepository->create($contactData);
    }

    public function deleteContact($contactId)
    {
        return $this->contactRepository->delete($contactId);
    }
}
