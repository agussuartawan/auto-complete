<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Piutang;

class AutocompleteController extends Controller
{
    public function index()
    {
        $customers = Customer::take(10)->get();
        return view('autocomplete.index', compact('customers', $customers));
    }

    public function store(Request $request)
    {
        Piutang::create($request->all());
        // dd($request->all());
        return redirect('/index');
    }

    public function create()
    {
        return view('autocomplete.create');
    }
}
