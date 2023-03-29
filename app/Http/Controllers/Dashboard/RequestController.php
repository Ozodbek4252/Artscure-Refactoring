<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\RequestServiceInterface;

class RequestController extends Controller
{
    protected $requestService;

    public function __construct(RequestServiceInterface $requestService)
    {
        $this->requestService = $requestService;
    }

    public function index()
    {
        $requests = $this->requestService->getAllRequests();
        return view('dashboard.request.index', ['requests' => $requests]);
    }

    public function destroy($id)
    {
        try {
            $this->requestService->deleteRequest($id);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('requests.index');
    }
}
