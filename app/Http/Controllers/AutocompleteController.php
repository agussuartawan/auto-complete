<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Piutang;

class AutocompleteController extends Controller
{
    public function index()
    {
        // $customers = Customer::take(10)->get();
        $customers = Customer::all();
        return view('autocomplete.index', compact('customers'));
    }

    public function store(Request $request)
    {
        Piutang::create($request->all());
        // dd($request->all());
        return redirect('/index')->with('success', 'Data berhasil disimpan');
    }

    public function create()
    {
        return view('autocomplete.create');
    }
}
