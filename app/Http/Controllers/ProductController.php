<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;



class ProductController extends Controller
{


    public function index()
    {
        $user = auth()->user();
        $data = Product::orderBy('created_at', 'DESC')->paginate(10)->withQueryString();
        if($user)
        {
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan'
            ], 400);
        }
    }

    public function show($uuid)
    {
        $user = auth()->user();
        $data = Product::where('uuid', $uuid)->get();
        if($user)
        {
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan'
            ], 400);
        }
    }

    public function store(Request $request)
    {
        $role = auth()->user()->role;

        $this->validate($request, [
            'uuid'      => 'required',
            'name'      => 'required',
            'type'      => 'required',
            'prince'    => 'required',
            'quantity'  => 'required'
        ]);
            
        if($role == 'admin')
        {
            $product = new Product();

            $product->uuid     = $request->uuid;
            $product->name     = $request->name;
            $product->type     = $request->type;
            $product->prince   = $request->prince;
            $product->quantity = $request->quantity;
            $product->save();
     
            if ($product)
                return response()->json([
                    'success' => true,
                    'data' => $product->toArray()
                ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Post not added'
                ], 500);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'unauthorization'
            ], 500);
        }

    }

    public function update(Request $request, $uuid)
    {

        $role = auth()->user()->role;
        if($role == 'admin')
        {
            $data = array(
                'name'    => $request->name,
                'type'    => $request->type,
                'prince'  => $request->prince,
                'quantity'=> $request->quantity,
            );
            $update = Product::find($uuid)->update($data);

            if ($update)
                return response()->json([
                    'success' => true
                ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Post can not be updated'
                ], 500);
            
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'unauthorization'
            ], 500);
        }
    }

}
