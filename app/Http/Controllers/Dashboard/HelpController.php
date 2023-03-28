<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\HelpServiceInterface;

class HelpController extends Controller
{
    protected $helpService;

    public function __construct(HelpServiceInterface $helpService)
    {
        $this->helpService = $helpService;
    }

    public function index()
    {
        $helps = $this->helpService->getAllHelps();
        return view('dashboard.help.index', ['helps'=>$helps]);
    }

    public function destroy($id)
    {
        try {
            $this->helpService->deleteHelp($id);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('helps.index');
    }

}

