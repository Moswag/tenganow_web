<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\MyConstants;
use App\Product;
use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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


    public function editProduct($id){
        if(Product::where('id',$id)->exists()){
            $product=Product::find($id);
            return view('server.company.products.edit_product',compact('product'));
        }
        else{
            return back()->with('error','Product with that id do not exists');
        }

    }


    public function updateProduct(Request $request){
        if($request->file('picture')!=null){
            $image=$request->file('picture');
            $input['imagename']=$image->getClientOriginalName();
            $extension=$image->getClientOriginalExtension();
            $myfile=bcrypt($input['imagename']).'.'.$extension;
            $destination = MyConstants::DIRECTORY_PRODUCT_PICS;
            $image->storeAs($destination, $myfile);

            if($request->description!=null) {
                $updateProduct = Product::where('id', $request->id)->update([
                    'name' => $request->name,
                    'price' => $request->price,
                    'description' => $request->description,
                    'discount' => $request->discount,
                    'code' => $request->code,
                    'picture' => MyConstants::PATH_URL . $destination . '/' . $myfile
                ]);
                if($updateProduct){
                    return redirect()->route('view_products')->with('message','Product successfully updated');
                }
                else{
                    return redirect()->route('view_products')->with('error','Failed to update product');
                }
            }
            else{
                $updateProduct = Product::where('id', $request->id)->update([
                    'name' => $request->name,
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'code' => $request->code,
                    'picture' => MyConstants::PATH_URL . $destination . '/' . $myfile
                ]);
                if($updateProduct){
                    return redirect()->route('view_products')->with('message','Product successfully updated');
                }
                else{
                    return redirect()->route('view_products')->with('error','Failed to update product');
                }
            }


        }
        else{
            if($request->description!=null){
                $updateProduct=Product::where('id',$request->id)->update([
                    'name'=>$request->name,
                    'price'=>$request->price,
                    'description'=>$request->description,
                    'discount'=>$request->discount,
                    'code'=>$request->code,
                ]);
                if($updateProduct){
                    return redirect()->route('view_products')->with('message','Product successfully added');
                }
                else{
                    return redirect()->route('view_products')->with('error','Failed to update product, please contact admin');
                }
            }
            else{
                $updateProduct=Product::where('id',$request->id)->update([
                    'name'=>$request->name,
                    'price'=>$request->price,
                    'discount'=>$request->discount,
                    'code'=>$request->code,
                ]);
                if($updateProduct){
                    return redirect()->route('view_products')->with('message','Product successfully added');
                }
                else{
                    return redirect()->route('view_products')->with('error','Failed to update product, please contact admin');
                }
            }


        }


    }

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
        $product->picture=MyConstants::PATH_URL.$destination.'/'.$myfile;
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


    public function deleteProduct($id){
        if(Product::where('id',$id)->exists()){
            if(Product::find($id)->delete()){
                return redirect()->route('view_products')->with('message','Product successfully deleted');
            }
            else{
                return redirect()->route('view_products')->with('message','Failed to delete product, please contact admin');
            }
        }
        else{
            return redirect()->route('view_products')->with('error','Product with that id do not exists');
        }
    }
}
