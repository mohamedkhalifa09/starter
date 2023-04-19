<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Traits\OfferTraits;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    //
 
    use OfferTraits;


    public function create()
    {
     return view("AjaxOffer.create");  
    }
    public function store(Request $re)
    {
        // $file_name = $this -> getImages($re->photo,"images/offers");

      
      



        /// insert data to data base after validate

       Offer::create([
      //  "photo" => $file_name ,
        "name_ar"=> $re->name_ar ,
        "name_en"=> $re->name_en ,
        "price" => $re -> price ,
        "details_ar" => $re -> details_ar,
        "details_en" => $re -> details_en

       ]);
    }
}
