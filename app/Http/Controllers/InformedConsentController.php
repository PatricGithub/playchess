<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformedConsentController extends Controller
{
    public function show()
    {
        return view('informed-consent');
    }
}
