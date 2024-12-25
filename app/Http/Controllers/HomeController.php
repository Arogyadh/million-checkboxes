<?php

namespace App\Http\Controllers;

use App\Models\Checkboxes;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {

        $state = (new Checkboxes());

        // dd($state);
        return view('home', [
            'count' => $state->count(),
            'state' => $state->all(),
        ]);
    }
}
