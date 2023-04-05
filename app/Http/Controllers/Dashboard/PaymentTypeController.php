<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentTypeRequest;
use App\Interfaces\PaymentTypeServiceInterface;

class PaymentTypeController extends Controller
{
    protected $paymentTypeService;

    public function __construct(PaymentTypeServiceInterface $paymentTypeService)
    {
        $this->paymentTypeService = $paymentTypeService;
    }

    public function index()
    {
        $payment_types = $this->paymentTypeService->getAllPaymentTypes(10);
        return view('dashboard.payment_type.index', compact('payment_types'));
    }

    public function create()
    {
        return view('dashboard.payment_type.create');
    }

    public function store(PaymentTypeRequest $request)
    {
        try {
            $this->paymentTypeService->createPaymentType($request);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('paymentTypes.index');
    }

    public function edit($id)
    {
        try {
            $payment_type = $this->paymentTypeService->getPaymentTypeById($id);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return view('dashboard.payment_type.edit', compact('payment_type'));
    }

    public function update(PaymentTypeRequest $request, $id)
    {
        try {
            $this->paymentTypeService->updatePaymentType($request, $id);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('paymentTypes.index');
    }

    public function destroy($id)
    {
        try {
            $this->paymentTypeService->deletePaymentType($id);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('paymentTypes.index');
    }
}
