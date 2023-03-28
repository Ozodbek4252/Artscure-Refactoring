<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\ContactResource;

use App\Http\Requests\ContactRequest;
use App\Interfaces\ContactServiceInterface;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactServiceInterface $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index(Request $request)
    {
        try {
            $contacts = $this->contactService->getAllContacts($request->get('num'));
        } catch (\Exception $exception) {
            return (new ErrorResource("Client Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return response()->json([
            'success' => true,
            'data' => $contacts
        ], 200);
    }

    public function store(ContactRequest $request)
    {
        try {
            $contact = $this->contactService->createContact($request);
        } catch (\Exception $exception) {
            return (new ErrorResource("Client Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return (new ContactResource($contact))->response()->setStatusCode(201);
    }

    public function destroy($id)
    {
        try {
            $this->contactService->deleteContact($id);
        } catch (\Exception $exception) {
            return (new ErrorResource("Client Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return response()->json(['message' => 'Deleted Successfully'], 204);
    }
}
