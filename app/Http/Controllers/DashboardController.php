<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sitecontrollabel;
use App\Models\Mainmenu;

use Session;

class DashboardController extends Controller
{
   


   public function dashboard(Request $request)
   {
      if (! Session::has('bilingual')) {
         Session::put('bilingual', 1);
     }
     $sessionbil = Session::get('bilingual');
     $mainsubmenu = $this->mainmenu($sessionbil);

     $sitecontrolls = Sitecontrollabel::with(['sitelcontrollabel_sub' => function ($query) use ($sessionbil) {
         $query->where('languageid', $sessionbil);
     }])->where('id', 48)->where('status_id', 1)->first();




    // return view('frontend.main.Dashboard.dashboardnew', compact('mainsubmenu','sitecontrolls','sessionbil'));
     return view('frontend.main.Dashboard.layouts.basedashboard');
    

   }
   private function mainmenu($sessionbil)
   {
       $mainsubmenu = Mainmenu::with(['sub_menu' => function ($query) use ($sessionbil) {
           $query->with(['submenusub' => function ($query1) use ($sessionbil) {
               $query1->where('languageid', $sessionbil);
           }]);

           $query->with(['subsubmenu' => function ($query3) use ($sessionbil) {
               $query3->with(['subsubmenusub' => function ($query4) use ($sessionbil) {
                   $query4->where('languageid', $sessionbil);
               }]);
               $query3->orderBy('orderno', 'asc');
           }]);
           $query->where('status_id', 1);
           $query->orderBy('orderno', 'asc');
       }])

           ->with(['mainmenu_sub' => function ($query2) use ($sessionbil) {
               $query2->where('languageid', $sessionbil);
           }])
           ->where('status_id', 1)
           ->orderBy('orderno', 'asc')
           ->get();

       return $mainsubmenu;
   }

public function dashboarddetails()
{
   $curl = curl_init();


curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://projectaudit.cditproject.org/api/healthdashboard',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(),
));

$response = curl_exec($curl);

curl_close($curl);
//dd(true);
// Decode the JSON string
    $decodedResponse = json_decode($response, true);
return response()->json(['result' => $decodedResponse]);
}




public function birthratedetails()
{
   $curl = curl_init();


curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://projectaudit.cditproject.org/api/birthrate',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(),
));

$response = curl_exec($curl);

curl_close($curl);
//dd(true);
// Decode the JSON string
    $decodedResponse = json_decode($response, true);
    //dd($decodedResponse);
return response()->json(['result' => $decodedResponse]);
}
/*==============================================================================================*/
public function maternalmortalitydetails()
{
   $curl = curl_init();


curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://projectaudit.cditproject.org/api/maternalmortality',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(),
));

$response = curl_exec($curl);

curl_close($curl);
//dd(true);
// Decode the JSON string
    $decodedResponse = json_decode($response, true);
    //dd($decodedResponse);
return response()->json(['result' => $decodedResponse]);
}
/*==============================================================================================*/
public function bedstrength_one_details()
{
   $curl = curl_init();


curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://projectaudit.cditproject.org/api/bedstrength_one',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(),
));

$response = curl_exec($curl);

curl_close($curl);
//dd(true);
// Decode the JSON string
    $decodedResponse = json_decode($response, true);
    //dd($decodedResponse);
return response()->json(['result' => $decodedResponse]);
}
/*==============================================================================================*/
public function bedstrength_two_details()
{
   $curl = curl_init();


curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://projectaudit.cditproject.org/api/bedstrength_two',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(),
));

$response = curl_exec($curl);

curl_close($curl);
//dd(true);
// Decode the JSON string
    $decodedResponse = json_decode($response, true);
    //dd($decodedResponse);
return response()->json(['result' => $decodedResponse]);
}

/*==============================================================================================*/
public function healthindicator_details()
{
   $curl = curl_init();


curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://projectaudit.cditproject.org/api/healthindicators',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(),
));

$response = curl_exec($curl);

curl_close($curl);
//dd(true);
// Decode the JSON string
    $decodedResponse = json_decode($response, true);
    //dd($decodedResponse);
return response()->json(['result' => $decodedResponse]);
}
/*==============================================================================================*/
public function familyhealth_centersdetails()
{
   // dd(true);
   $curl = curl_init();


curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://projectaudit.cditproject.org/api/familyhealth_centers',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(),
));

$response = curl_exec($curl);

curl_close($curl);
//dd(true);
// Decode the JSON string
    $decodedResponse = json_decode($response, true);
    //dd($decodedResponse);
return response()->json(['result' => $decodedResponse]);
}

/*=======================================================================*/

public function demographics()
{
   $curl = curl_init();


curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://projectaudit.cditproject.org/api/demographics_details',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(),
));

$response = curl_exec($curl);

curl_close($curl);
//dd(true);
// Decode the JSON string
    $decodedResponse = json_decode($response, true);
    //dd($decodedResponse);
return response()->json(['result' => $decodedResponse]);
}
//-------------------------------------------------------------------------
}
