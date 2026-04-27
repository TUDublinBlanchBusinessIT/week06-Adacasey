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
}