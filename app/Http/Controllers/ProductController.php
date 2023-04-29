<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Product::all();
        //อ่านข้อมูลแบบแบ่งหน้า
        return Product::orderBy('id','desc')->paginate(25);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // เช็คสิทธิ์ (role) ว่าเป็น admin (1)
        $user = auth()->user();
        if ($user->tokenCan("1"))
        {
            $request->validate([
                'name'  => 'required|min:5',
                'slug'  => 'required',
                'price' => 'required',

            ]);

            return Product::create($request->all());
        }
        else
        {
            return [
                'status' => 'Permission denied to create',
            ];

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // เช็คสิทธิ์ (role) ว่าเป็น admin (1)
        $user = auth()->user();
        if ($user->tokenCan("1"))
        {

            $product = Product::find($id);
            $product->update($request->all());

            return $product;

        }
        else
        {
            return [
                'massage' => 'Permission denied to Update',
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // เช็คสิทธิ์ (role) ว่าเป็น admin (1)
        $user = auth()->user();
        if ($user->tokenCan("1"))
        {
            return Product::destroy($id);

        }
        else
        {
            return [
                'massage' => 'Permission denied to delete',
            ];

        }
    }
}
