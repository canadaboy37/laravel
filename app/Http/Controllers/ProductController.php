<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index()
    {
        return View('welcome');
    }

    public function add(Request $request)
    {
        try{
            $pname = $request->input('pname');
            $price = $request->input('price');
            $qty  = $request->input('qty');
            $date = date('Y-m-d h:i:s A');
            $data = [
                "product_name" => $pname,
                "price" => $price,
                "qty" => $qty,
                "date" => $date,
                "total" => $qty * $price,
            ];
            Storage::append('products.json', json_encode($data));
            return response()->json($data);
        }catch(Exception $e)
        {
            return "error";
        }
    }

    public function products(){
        if (Storage::get('products.json')){
            $file = Storage::get('products.json');
        } else {
            $file = 'none';
        }
        return (new Response($file, 200))->header('Content-Type', 'application/json');
    }
}