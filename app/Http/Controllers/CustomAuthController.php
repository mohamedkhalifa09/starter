<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    //
    public function index()
    {
       return view("customAuth.index");
    }
    public function site()
    {
        return view("customAuth.site");
    }
    public function admin()
    {
        return view("customAuth.admin");
        
    }
    public function adminLogin()
    {
        return view("customAuth.AdminLogin");
    }

    public function checkAdminLogin(Request $req)
    {
       
   $this->validate($req,[
     "email" =>'required|email',
     "password" => "required|min:8"
   ]);

  if(Auth::guard("admin")->attempt(["email" => $req->email,"password"=>$req->password])){
    return redirect()->intended("/admin");
  }
   
  return back()->withInput($req->only("email"));

    }
}
