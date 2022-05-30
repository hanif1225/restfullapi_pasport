<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class Product2Controller extends Controller
{
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
}
