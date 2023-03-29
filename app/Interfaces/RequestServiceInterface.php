<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface RequestServiceInterface
{
    public function getAllRequests();

    public function createRequest(Request $request);

    public function getRequestById($requestId);

    public function deleteRequest($requestId);
}
