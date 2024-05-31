<?php

namespace App\Http\Controllers;

use App\Models\Dataanggaran;
use Illuminate\Http\Request;

class Frontend extends Controller
{
    //
    public function home() {

        $data_anggaran = Dataanggaran::all();
        return view('frontanggaran', compact('data_anggaran'));
    }
}