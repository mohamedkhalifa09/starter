<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTraits;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\LaravelLocalization as LaravelLocalizationLaravelLocalization;
use SebastianBergmann\CodeCoverage\Driver\Selector;

class OfferController extends Controller
{
    //
 
    use OfferTraits;


    public function create()
    {
     return view("AjaxOffer.create");  
    }
    public function store(OfferRequest $re)
    {
        $file_name = $this -> getImages($re->photo,"images/offers");

      
      



        /// insert data to data base after validate

      $offer =  Offer::create([
       "photo" => $file_name ,
        "name_ar"=> $re->name_ar ,
        "name_en"=> $re->name_en ,
        "price" => $re -> price ,
        "details_ar" => $re -> details_ar,
        "details_en" => $re -> details_en

       ]);
        if($offer)
       return response()->json([
        "status" => true ,
        "msg" => __("messages.Successful Added Your Offer")
       ]);
       else 
       return response()->json([
        "status" => false ,
        "msg" => __("messages.Failed Added Your Offer please Try Again")
       ]);
    }


    public function all()
    {
        $offers = Offer::select(
            "id",
            "price",
            "photo",
            "name_".LaravelLocalization::getCurrentLocale()." as name",
            "details_".LaravelLocalization::getCurrentLocale()." as details",
        )->limit(10)->get();
        return view("AjaxOffer.all",compact("offers"));
    }
    public function delete(Request $re)
    {
        # code...
    //    return $re ;

    $offer = Offer::find($re->id);
    if(!$offer)
    return redirect()->back();

    $offer->delete();

    return response()->json([
        "status" => true,
        "msg" => __("messages.Successful Deleted Offer"),
        "id" => $re->id
    ]);
    }


}
