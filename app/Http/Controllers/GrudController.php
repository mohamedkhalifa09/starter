<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use Illuminate\Http\Request;
use App\Models\Offer;
// use Illuminate\Support\Facades;z

use App\Http\Requests\OfferRequest;
use App\Models\Video;
use App\Traits\OfferTraits;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class GrudController extends Controller
{
    //
  use OfferTraits;
    public function getFillable() // select or show 
    {
        # code...
      return   Offer::select("id","name")->get();
    }
    //  public function store() // insert or add data to dataBase 
    //  {

    //    Offer::create([
    //     "name" => "offer3",
    //     "price" => "500",
    //     "photo" => "offer3.png",
    //     "details" => "Offer 3 details"
    //    ]);
    //  }

     ///////// insert data to data base by form 
     public function create()
     {
        return view("offers.create");
     }
      public function store(OfferRequest $re)
      {
        // save image in folder 

      

        $file_name = $this -> getImages($re->photo,"images/offers");

      
      



        /// insert data to data base after validate

       Offer::create([
        "photo" => $file_name ,
        "name_ar"=> $re->name_ar ,
        "name_en"=> $re->name_en ,
        "price" => $re -> price ,
        "details_ar" => $re -> details_ar,
        "details_en" => $re -> details_en

       ]);
       return redirect()->back()->with(["success" => __("messages.Successful Added Your Offer")]);


      }

      public function getAllOffers()
      {
        

     $offers = Offer::select("id",
     "name_".LaravelLocalization::getCurrentLocale()." as name",
     "price",
     "details_".LaravelLocalization::getCurrentLocale()." as details")->get();
     return view('offers.all',compact(["offers"]));

      }
      ////// edit offer by Id 
      public function editOffer($offer_id)
      {
        // Offer::findOrFail($offer_id);// to seach in database
    $offer =  Offer::find($offer_id);
    if (!$offer) {
      return redirect()->back();
    }
    $offers = Offer::select("id","name_ar","name_en","photo","details_ar","details_en","price")->find($offer_id);
    return view("offers.edit",compact("offers"));
        // return $offer_id ;
      }
      public function updateOffer(OfferRequest $re,$offer_id)
      {
        $offer = Offer::select("id","name_ar","name_en","price","photo","details_en","details_ar")->find($offer_id);
        if (!$offer) {
          return redirect()->back();
        }

        // update offer
       $offer->update($re->all());
       return redirect()->back()->with(["success" => __("messages.Successful Update Your Offer")]);

      }

      public function getVideo()
      {

        $video = Video::first();
        event(new VideoViewer($video));
        return view("video")->with("video",$video);
      }


      
}
