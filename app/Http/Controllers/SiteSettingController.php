<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SiteSetting;

class siteSettingController extends Controller
{
   public function index()
   {
      $siteSetting = SiteSetting::all();
      return view('backend.siteSetting.index', compact('siteSetting'));
   }

   public function store(Request $request)
   {
      foreach (array_except($request->toArray(), ['_token', 'submit']) as $key => $req) {
         $siteSettingUpdate = SiteSetting::where('nameSetting', $key)->first();

         $siteSettingUpdate->fill(['value' => $req])->save();
      }
      return redirect()->back()->with(['message' => 'the data upated successfully']);
   }
}
