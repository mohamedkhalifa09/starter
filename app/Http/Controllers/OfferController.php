<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
    public function edit(Request $req)
    {
      $offer = Offer::find($req->offer_id);
        if (!$offer) 
        return response()->json([
            "status" => false ,
            "msg" => __("messages.This offer Not Found"),
        ]);
        $offer = Offer::select("id","photo","name_ar","name_en","details_ar","details_en","price")->find($req->offer_id);
        return  view("AjaxOffer.edit",compact("offer"));


    }

    public function update(Request $req)
    {
    //    return $req ;

      $offer = Offer::find($req->offer_id);
      if(!$offer)
      return response()->json([
   "status" => false ,
   "msg" => __("messages.This offer Not Found"),
      
      ]);

    //   $offer->update($req->all());
    $offer = Offer::find($req->offer_id);
    $offer->name_ar = $req->input("name_ar");
    $offer->name_en = $req->input("name_en");
    $offer->price = $req->input("price");
    $offer->details_en = $req->input("details_en");
    $offer->details_ar = $req->input("details_ar");
    if ($req->hasfile("photo")) {

      $destination =  "images/offers".$offer->photo;
      if(File::exists($destination)){
         File::delete($destination);
      }
      $file = $req->file("photo");
      $file_extension  = $file -> getClientOriginalExtension();
     $file_name = time().".".$file_extension;

    $path = "images/offers";

    $file-> move($path,$file_name);
     $offer->photo =  $file_name ;
    }

     $offer->update();

      // or update(["name_ar"=>$req->name_ar,]);
     return    response()->json([
        "status" => true ,
        "msg" => __("messages.Successful Update Your Offer"),
           
           ]);
        

    }


}
