<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class OrderController extends Controller
{
    public function create(Request $request)
    {

        $price = $request->get("price");
        $streetName = $request->get("streetName");
        $city = $request->get("city");
        $state = $request->get("state"); //Can be empty
        $zipCode = $request->get("zipCode");
        $country = $request->get("country");
        $phone = $request->get("phone"); //Can be empty
        $firstName = $request->get("firstName");
        $lastName = $request->get("lastName");
        $email = $request->get("email");

        $request->validate([
            'firstName' => 'required|min:2',
            'lastName' => 'required|min:2',
            'email' => 'required|email',
            'streetName' => 'required|min:2',
            'city' => 'required|min:2',
            'zipCode' => 'required|min:3',
            'country' => 'required|min:2'
        ]);

        return "hallo";
    }
}
