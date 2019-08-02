<?php

namespace App\Http\Controllers;

use App\MyConstants;
use App\Product;
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
        //
    }


    public function view_products(){
        $products=Product::where('company_id',auth()->user()->company_or_outlet_id)->get();
        return view('server.company.products.view_products',compact('products'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image=$request->file('picture');
        $input['imagename']=$image->getClientOriginalName();
        $extension=$image->getClientOriginalExtension();
        $myfile=bcrypt($input['imagename']).'.'.$extension;
        $destination = MyConstants::DIRECTORY_PRODUCT_PICS;
        $image->storeAs($destination, $myfile);

        $product=new Product();
        $product->name=$request->name;
        $product->company_id=auth()->user()->company_or_outlet_id;
        $product->price=$request->price;
        $product->description=$request->description;
        $product->discount=$request->discount;
        $product->code=$request->code;
        $product->picture='http://localhost/tenganow/storage/app/'.$destination.'/'.$myfile;
        $product->save();
        return redirect()->route('view_products')->with('message','Product successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
