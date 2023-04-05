<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentTypeResource;
use App\Interfaces\PaymentTypeServiceInterface;
use App\Models\PaymentType;

class PaymentTypeController extends Controller
{
    protected $paymentTypeService;

    public function __construct(PaymentTypeServiceInterface $paymentTypeService)
    {
        $this->paymentTypeService = $paymentTypeService;
    }

    public function index()
    {
        $payment_types = $this->paymentTypeService->getAllPaymentTypes(20);
        return PaymentTypeResource::collection($payment_types);
    }

    public function show($id)
    {
        $payment_type = PaymentType::find($id);
        return new PaymentTypeResource($payment_type);
    }
}
