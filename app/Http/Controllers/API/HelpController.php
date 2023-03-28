<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\HelpRequest;

use App\Http\Resources\HelpResource;
use App\Http\Resources\ErrorResource;
use App\Interfaces\HelpServiceInterface;

class HelpController extends Controller
{
    protected $helpService;

    public function __construct(HelpServiceInterface $helpService)
    {
        $this->helpService = $helpService;
    }

    public function index(Request $request)
    {
        try {
            $helps = $this->helpService->getAllHelps($request->get('limit'));
        } catch (\Exception $exception) {
            return (new ErrorResource("Help Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return response()->json([
            'success' => true,
            'data' => $helps
        ], 200);
    }

    public function store(HelpRequest $request)
    {
        try {
            $help = $this->helpService->createHelp($request);
        } catch (\Exception $exception) {
            return (new ErrorResource("Help Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return (new HelpResource($help))->response()->setStatusCode(201);
    }

    public function destroy($id)
    {
        try {
            $this->helpService->deleteHelp($id);
        } catch (\Exception $exception) {
            return (new ErrorResource("Help Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return response()->json(['message' => 'Deleted Successfully'], 204);
    }
}
