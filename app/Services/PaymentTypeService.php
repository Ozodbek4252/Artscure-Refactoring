<?php

namespace App\Services;

use App\Interfaces\PaymentTypeRepositoryInterface;
use App\Interfaces\PaymentTypeServiceInterface;
use Illuminate\Http\Request;

class PaymentTypeService implements PaymentTypeServiceInterface
{
    protected $paymentTypeRepository;

    public function __construct(PaymentTypeRepositoryInterface $paymentTypeRepository)
    {
        $this->paymentTypeRepository = $paymentTypeRepository;
    }

    public function getAllPaymentTypes($perPage = 20)
    {
        return $this->paymentTypeRepository->getAll($perPage);
    }

    public function createPaymentType(Request $request)
    {
        $paymentTypeData = $request->all();
        return $this->paymentTypeRepository->create($paymentTypeData);
    }

    public function getPaymentTypeById($id)
    {
        return $this->paymentTypeRepository->find($id);
    }

    public function updatePaymentType(Request $request, $paymentTypeId)
    {
        $paymentTypeData = $request->all();
        return $this->paymentTypeRepository->update($paymentTypeId, $paymentTypeData);
    }

    public function deletePaymentType($paymentTypeId)
    {
        return $this->paymentTypeRepository->delete($paymentTypeId);
    }
}
