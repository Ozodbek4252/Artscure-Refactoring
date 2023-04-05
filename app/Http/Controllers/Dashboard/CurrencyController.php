<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use App\Interfaces\CurrencyServiceInterface;
use Illuminate\Http\Request;
use App\Models\Currency;

class CurrencyController extends Controller
{
    protected $currencyService;

    public function __construct(CurrencyServiceInterface $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function index()
    {
        $currencies = $this->currencyService->getAllCurrencies(20);
        return view('dashboard.currency.index', compact('currencies'));
    }

    public function create()
    {
        return view('dashboard.currency.create');
    }

    public function store(CurrencyRequest $request)
    {
        $this->currencyService->createCurrency($request);
        return redirect()->route('currencies.index')->with('success', 'Currency created successfully');
    }

    public function edit(Currency $currency)
    {
        return view('dashboard.currency.edit', compact('currency'));
    }

    public function update(CurrencyRequest $request, $id)
    {
        $this->currencyService->updateCurrency($request, $id);
        return redirect()->route('currencies.index')->with('success', 'Currency updated successfully');
    }

    public function destroy($id)
    {
        $this->currencyService->deleteCurrency($id);
        return redirect()->route('currencies.index')->with('success', 'Currency deleted successfully');
    }
}
