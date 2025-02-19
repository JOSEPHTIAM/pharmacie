<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenAPIController extends Controller
{

    // La fonction pour stocker le time restant ou encore le temps en cours...
    public function storeTimeClient(Request $request)
    {
        $timeOption = $request->input('time_option');
        $remainingTime = time() + (int)$timeOption;

        session(['remaining_time' => $remainingTime]);

        return redirect()->route('accueilClient');
    }

    public function storeTimeAgent(Request $request)
    {
        $timeOption = $request->input('time_option');
        $remainingTime = time() + (int)$timeOption;

        session(['remaining_time' => $remainingTime]);

        return redirect()->route('accueilAgent');
    }

    public function storeTimeAdministrateur(Request $request)
    {
        $timeOption = $request->input('time_option');
        $remainingTime = time() + (int)$timeOption;

        session(['remaining_time' => $remainingTime]);

        return redirect()->route('accueilAdministrateur');
    }
    
}
