<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class AutocompleteController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('autocomplete.index', compact('customers', $customers));
    }
}
