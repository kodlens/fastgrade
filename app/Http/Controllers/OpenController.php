<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Office;

class OpenController extends Controller
{
    //

    public function loadOffices(Request $req){
        return Office::orderBy('office', 'asc')
            ->get();
    }
}
