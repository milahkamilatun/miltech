<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HaiController extends Controller
{
    public function index(Request $request, $sklh)
    {
        $result = " Hai " .$request->nama." di sekolah ".$sklh." dan id ".$request->id;
        return $result;
    }
}