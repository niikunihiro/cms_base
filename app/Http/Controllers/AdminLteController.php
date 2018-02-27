<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('adminlte.form');
    }
}
