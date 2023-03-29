<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\RequestResource;
use App\Interfaces\RequestServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    protected $requestService;

    public function __construct(RequestServiceInterface $requestService)
    {
        $this->requestService = $requestService;
    }

    public function index(Request $request)
    {
        $requests = $this->requestService->getAllRequests($this->getLimit($request->limit));
        return RequestResource::collection($requests);
    }

    public function store(RequestRequest $request)
    {
        DB::beginTransaction();
        try {
            $requestModel = $this->requestService->createRequest($request);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->error("Request failed to store {$exception->getMessage()}", 400);
        }
        DB::commit();

        return new RequestResource($requestModel);
    }

    public function show($id)
    {
        $request = $this->requestService->getRequestById($id);
        return new RequestResource($request);
    }

    public function destroy($id)
    {
        try {
            $this->requestService->deleteRequest($id);
        } catch (\Exception $exception) {
            return (new ErrorResource("Request Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return response()->json(['message' => 'Deleted Successfully'], 204);
    }
}
