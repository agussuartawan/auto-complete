<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Piutang;
use App\Produk;
Use Validator;

class AutocompleteController extends Controller
{
    public function index()
    {
        return view('autocomplete.index');
    }

    public function store(Request $request)
    {
        Piutang::create($request->all());
        // dd($request->all());
        return redirect('/home')->with('status', 'Data berhasil disimpan');
    }

    public function create()
    {
        return view('autocomplete.create');
    }

    public function cari_customer(Request $request)
    {
        $hasil = Customer::select("id", "name", "addres")->where("name", "LIKE", "%{$request->input('find')}%")->get();
        return response()->json($hasil);
    }

    public function cari_produk(Request $request)
    {
        $data = Produk::select("id", "kode_produk", "nama_produk", "harga")->where("nama_produk", "LIKE", "%{$request->input('query')}%")->get();
        return response()->json($data);
    }

    public function customer_store(Request $request)
    {
        if($request->ajax()){
            $rules = array(
                'name.*' => 'required',
                'addres.*' => 'required',
                'phone.*' => 'required'
            );
            $error = Validator::make($request->all(), $rules);
            if($error->fails()){
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }
            $name = $request->name;
            $addres = $request->addres;
            $phone = $request->phone;
            for ($i=0; $i < count($name); $i++) { 
                $data = array(
                    'name' => $name[$i],
                    'addres' => $addres[$i],
                    'phone' => $phone[$i]
                );
                $insert_data[] = $data;
            }
            Customer::insert($insert_data);
            return response()->json([
                'success' => 'Data has been inserted.'
            ]);

        }
    }

    public function customerStore(Request $request)
    {
        Customer::create($request->all());
        return redirect("/index");
    }
}
