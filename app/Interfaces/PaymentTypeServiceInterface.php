<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface PaymentTypeServiceInterface
{
    public function getAllPaymentTypes();

    public function createPaymentType(Request $request);

    public function getPaymentTypeById($paymentTypeId);

    public function updatePaymentType(Request $request, $paymentTypeId);

    public function deletePaymentType($paymentTypeId);
}
