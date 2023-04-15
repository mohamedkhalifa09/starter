<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;

class GrudController extends Controller
{
    //

    public function getFillable() // select or show 
    {
        # code...
      return   Offer::select("id","name")->get();
    }
     public function store() // insert or add data to dataBase 
     {

       Offer::create([
        "name" => "offer3",
        "price" => "500",
        "photo" => "offer3.png",
        "details" => "Offer 3 details"
       ]);
     }

     ///////// insert data to data base by form 
     public function create()
     {
        # code...
     }
}
