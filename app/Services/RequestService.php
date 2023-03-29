<?php

namespace App\Services;

use App\Interfaces\RequestRepositoryInterface;
use App\Interfaces\RequestServiceInterface;
use Illuminate\Http\Request;
use App\Traits\UtilityTrait;
use Illuminate\Support\Str;
use App\Models\Image as ImageModel;

class RequestService implements RequestServiceInterface
{
    use UtilityTrait;

    protected $requestRepository;

    public function __construct(RequestRepositoryInterface $requestRepository)
    {
        $this->requestRepository = $requestRepository;
    }

    public function getAllRequests($perPage = 20)
    {
        return $this->requestRepository->getAll($perPage);
    }

    public function createRequest(Request $request)
    {
        $requestData = $request->all();
        $requestModel = $this->requestRepository->create($requestData);

        // File upload
        $file = $request->portfolio;
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

        if (!file_exists('images/requests')) {
            mkdir('images/requests', 0700, true);
        }
        $file->move(public_path('images/requests'), $filename);

        $image = new ImageModel();
        $image->image = 'images/requests/' . $filename;
        $image->imageable_id = $requestModel->id;
        $image->imageable_type = 'App\Models\\Request';
        $image->save();

        $requestModel->portfolio = $filename;
        $requestModel->save();

        return $requestModel;
    }

    public function getRequestById($id)
    {
        return $this->requestRepository->find($id);
    }

    public function deleteRequest($requestId)
    {
        return $this->requestRepository->delete($requestId);
    }
}
