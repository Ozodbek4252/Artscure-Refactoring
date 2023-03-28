<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface HelpServiceInterface
{
    public function getAllHelps();

    public function createHelp(Request $request);

    public function deleteHelp($helpId);
}
