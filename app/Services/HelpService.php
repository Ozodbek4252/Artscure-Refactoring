<?php

namespace App\Services;

use App\Interfaces\HelpRepositoryInterface;
use App\Interfaces\HelpServiceInterface;
use Illuminate\Http\Request;

class HelpService implements HelpServiceInterface
{
    protected $helpRepository;

    public function __construct(HelpRepositoryInterface $helpRepository)
    {
        $this->helpRepository = $helpRepository;
    }

    public function getAllHelps($perPage = 20)
    {
        return $this->helpRepository->getAll($perPage);
    }

    public function createHelp(Request $request)
    {
        $helpData = $request->all();
        return $this->helpRepository->create($helpData);
    }

    public function deleteHelp($helpId)
    {
        return $this->helpRepository->delete($helpId);
    }
}

