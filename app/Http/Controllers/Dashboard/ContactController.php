<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\ContactServiceInterface;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactServiceInterface $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        $contacts = $this->contactService->getAllContacts();
        return view('dashboard.contact.index', ['contacts' => $contacts]);
    }

    public function destroy($id)
    {
        try {
            $this->contactService->deleteContact($id);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('contacts.index');
    }
}
