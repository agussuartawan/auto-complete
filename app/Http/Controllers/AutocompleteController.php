<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Piutang;
Use Validator;

class AutocompleteController extends Controller
{
    public function index()
    {
        // $customers = Customer::take(10)->get();
        // $customers = Customer::all();
        return view('autocomplete.index');
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

    public function cari_customer(Request $request)
    {
        $name = '';
        $id = '';
        if($request->ajax()){
            $query = $request->get('query');
            if($query != ''){
                $customer = Customer::where('name', 'like', '%'.$query.'%')->get();
            } else {
                $customer = Customer::take(5)->get();
            }
            $total_row = $customer->count();
            if($total_row > 0){
                foreach ($customer as $c) {
                    // $hasil .= '<option value="'.$c->id.'">'.$c->name.'</option>';
                    $name .= $c->name;
                    $id .= $c->id;
                }
            }

            $data = array(
                'id' => $id,
                'name' => $name
            );
            echo json_encode($data);
        }
        // dd($request->all());
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
            // dd($insert_data);
            Customer::insert($insert_data);
            return response()->json([
                'success' => 'Data has been inserted.'
            ]);

        }
    }
}
