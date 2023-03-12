<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function store(Request $request){

        // Validation Rules
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer'
        ]);

        if ($validator->fails()){
            return response()->json(
                ["message" => 'Error']
            );
        }else{
            Product::create($request->all());

            $products = Product::all();
            return response()->json(
                [
                    "message" => 'Success',
                    "product" => $products
                ]
            );
        }
    } 

    public function index(Request $request){
        $products = Product::all();
        return response()->json(
            [
                "message" => 'Success',
                "product" => $products
            ]
        );
    } 

    public function update(Request $request){

        // Validation Rules
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer'
        ]);

        if ($validator->fails()){
            return response()->json(
                ["message" => 'Error']
            );
        }else{
            $products = Product::find($request->id);
            if($products){
                $products->update($request->all());
                return response()->json(
                    [
                        "message" => 'Success',
                        "product" => $products
                    ]
                );
            }else{
                return response()->json(
                    [
                        "message" => 'Product not found',
                    ]
                );
            }
        }
    } 

    public function delete(Request $request){
        $data = Product::where('id', $request->id)->first(); 
        if($data) {
            $data->delete();
            return response()->json(
                [
                    "message" => 'Successfully deleted.',
                ]
            );
        }else{
            return response()->json(
                [
                    "message" => 'ID not found.',
                ]
            );
        }
            
   
    } 

}
?>
