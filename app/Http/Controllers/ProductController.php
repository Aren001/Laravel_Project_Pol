<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        // return Product::all(); //stacav datan
        
            $data= Product::all();
    
           return view('product',['products'=>$data]);  
             
    }
    // Details
    public function detail($id){

        $data =Product::find($id);
        return view('detail',['product'=>$data]);
    }
    //SEARCH
    function search(Request $req){

        // return $req->input('query'); //query-n searchi inputi name-na

        $data= Product::where('name', 'like', '%'.$req->input('query').'%')  //nayuma barov hamapatsxan beruma
        ->get();
        return view('search',['products'=>$data]);
        
    }


     //AdminPanel
     public function show(Request $req){
        if($req->session()->has('user')){
            $data = Product::all();
            return view('adminPanel',['products'=>$data]);    
        }
        return redirect('/login');


        // $data = Product::all();
        // if($req->session()->has('user'))
        // {
        //     return view('adminPanel',['products'=>$data]);
        // } else{
        //     return redirect('/login');
        // }
    }
    //ADD
    public function addData(Request $req){
        
        $product = new Product;
        $product->name = $req->name;
        $product->price = $req->price;
        $product->category = $req->category;
        $product->description = $req->description;
        $product->gallery = $req->gallery;
        $product->save();
        return redirect('adminPanel');
    }

    //Delete
    public function delete($id){
        $data = Product::find($id);
        $data->delete();
        return redirect('adminPanel');
    }
    //Edit
    public function edit($id){

        $data = Product::find($id);
        return view('editPanel',['data'=>$data]);

    }
    //UPDATE
    public function update(Request $req){
        
        $data = Product::find($req->id);
        $data->name = $req->name;
        $data->price=$req->price;
        $data->category=$req->category;
        $data->description=$req->description;
        $data->gallery=$req->gallery;
        $data->save();
        return redirect('/adminPanel');
    }
}
