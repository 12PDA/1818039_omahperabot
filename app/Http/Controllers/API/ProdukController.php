<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Produk;
use App\Http\Resources\Produksource;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Produk::latest()->get();
        return response()->json([Produksource::collection($data), 'Produk fetched.']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_produk'   => 'required|string|max:255',
            'harga'         => 'required|string|max:255',
            'desc'          => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $produk = Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'desc'        => $request->desc
         ]);
        
        return response()->json(['Produk telah ditambahkan.', new Produksource($produk)]);
    }

    public function show($id)
    {
        $produk = Produk::find($id);
        if (is_null($produk)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new Produksource($produk)]);
    }

    public function update(Request $request, Produk $produk)
    {
        $validator = Validator::make($request->all(),[
            'nama_produk'   => 'required|string|max:255',
            'harga'         => 'required|string|max:255',
            'desc'          => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->desc = $request->desc;
        $produk->save();
        
        return response()->json(['Produk berhasill diubah.', new Produksource($produk)]);
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return response()->json('Produk telah dihapus');
    }

}
