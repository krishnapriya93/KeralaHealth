<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sitecontrollabel;
use App\Models\Mainmenu;

use Session;

class DashboardAdminController extends Controller
{

   public function dashboarduser(Request $request)
   {
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $userIp = $request->ip();
        $carddata = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();

        $dataCount = Suggestion::where('status_id',1)->count();

        return view('backend.dashboardadmin.dashboarduserhome', compact('navbar', 'user', 'userIp', 'carddata','dataCount'));
   }
   
}
