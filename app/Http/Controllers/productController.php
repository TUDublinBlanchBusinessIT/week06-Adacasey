<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class productController extends Controller
{
    public function additem($productid)
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
            if (isset($cart[$productid])) {
                $cart[$productid]=$cart[$productid]+1; //add one to product in cart
            }
            else {
                $cart[$productid]=1; //new product in cart
            }
        }
        else {
            $cart[$productid]=1; //new cart
        }
        Session::put('cart', $cart);
        return Response::json(['success'=>true,'total'=>array_sum($cart)],200);
    }

    public function displaygrid(Request $request)
    {
        $products=\App\Models\Product::all();
        echo "got products";
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
            print_r($cart);
            $totalQty=0;
            foreach ($cart as $product => $qty) {
                $totalQty = $totalQty + $qty;
            }
            $totalItems=$totalQty;
        }
        else {
            $totalItems=0;
            echo "no cart";
        }
        return view('product.displaygrid')->with('products',$products)->with('totalItems',$totalItems);
    }

    public function emptycart()
    {
        if (Session::has('cart')) {
            Session::forget('cart');
        }
        return Response::json(['success'=>true],200);
    }
}