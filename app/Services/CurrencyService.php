<?php

namespace App\Services;

use App\Interfaces\CurrencyRepositoryInterface;
use App\Interfaces\CurrencyServiceInterface;
use Illuminate\Http\Request;

class CurrencyService implements CurrencyServiceInterface
{
    protected $currencyRepository;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function getAllCurrencies($perPage = 20)
    {
        return $this->currencyRepository->getAll($perPage);
    }

    public function createCurrency(Request $request)
    {
        $currencyData = $request->all();
        return $this->currencyRepository->create($currencyData);
    }

    public function getCurrencyById($id)
    {
        return $this->currencyRepository->find($id);
    }

    public function updateCurrency(Request $request, $currencyId)
    {
        $currencyData = $request->all();
        return $this->currencyRepository->update($currencyId, $currencyData);
    }

    public function deleteCurrency($currencyId)
    {
        return $this->currencyRepository->delete($currencyId);
    }
}
