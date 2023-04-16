<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
// use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Validator;

class GrudController extends Controller
{
    //

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
      public function store(Request $re)
      {
        # code...
        //  return $re ;

        /// validate before insert data 

         $rules = $this->getrules();

         $messages = $this->getmessages();

        $validator = Validator::make($re->all(),$rules,$messages);
        if ($validator ->fails()) {
        //  return $validator->errors();
        return redirect()->back()->withErrors($validator)->withInputs($re->all());
        }

        /// insert data to data base after validate

       Offer::create([
        "name"=> $re->name ,
        "price" => $re -> price ,
        "details" => $re -> details
       ]);
       return redirect()->back()->with(["success" => "Successful Added Your Offer"]);


      }

      protected function getmessages(){
        return  [
          "name.required" => "Offer name is  Required",
          "name.unique" => "offer name must be unique",
          "price.numeric" => " price offer must be Number",
          "details.required" => "Offer details are  Required",
        ] ;
      }
       protected function getrules(){
        return  [
          "name"=> "required|max:100|unique:offers,name",
          "price" => "required|numeric|max:1000",
          "details"=>"required"
        ];
       }
}
