<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface TypeServiceInterface
{
    public function getAllTypes();

    public function createType(Request $request);

    public function getTypeBySlug($slug);

    public function updateType(Request $request, $typeId);

    public function deleteType($typeId);
}
