<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Piutang;
use App\Produk;
use App\Transaksi;
use App\DetailTransaksi;
Use Validator;
Use DataTables;

class AutocompleteController extends Controller
{

    public function index()
    {
        return view('autocomplete.index');
    }

    public function transaksi_store(Request $request)
    {
        $redirect_to = $request->redirect_to;
        // dd($redirect_to);
        $transaksi_no = 0;
        $data_no = Transaksi::select("id")->orderBy("id", "desc")->take(1)->get();
        foreach ($data_no as $no) {
            $transaksi_no = $no->id;
        }

        //data untuk table transaksi
        $data_customer = [
            'customer_id' => $request->customer_id,
            'tanggal' => $request->tanggal,
            'grand_total' => $request->grand_total
        ];        

        //data untuk table detail_transaksi
        $transaksi_id = $transaksi_no + 1;
        $produk_id = $request->produk_id;
        $qty = $request->qty;
        $harga = $request->harga;
        for ($i=0; $i < count($produk_id); $i++) { 
            $data = [
                'transaksi_id' => $transaksi_id,
                'produk_id' => $produk_id[$i],
                'qty' => $qty[$i],
                'harga' => $harga[$i]
            ];
            $data_produk[] = $data;
        }
        Transaksi::insert($data_customer);
        DetailTransaksi::insert($data_produk);

        return redirect($redirect_to)->with('status', 'Transaksi tersimpan.');
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

    public function dataTable()
    {
        $model = Transaksi::with('Customer');
        return DataTables::eloquent($model)
            ->addColumn('customers', function (Transaksi $transaksi) {
                return $transaksi->customer->name;
            })
            ->addColumn('action', function($model){
                return view('autocomplete.layout._action', [
                    'model' => $model,
                    'url_show' => route('transaksi.show', $model->id),
                    'url_edit' => route('transaksi.edit', $model->id),
                    'url_delete' => route('transaksi.delete', $model->id)
                ]);
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
