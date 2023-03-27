<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CurrencyServiceInterface
{
    public function getAllCurrencies();

    public function createCurrency(Request $request);

    public function getCurrencyById($currencyId);

    public function updateCurrency(Request $request, $currencyId);

    public function deleteCurrency($currencyId);
}
