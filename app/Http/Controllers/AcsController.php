<?php

namespace App\Http\Controllers;

use App\Models\HerooftheMonth;
use App\Models\usertype;
use Crypt;
use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\Office;

use Barryvdh\DomPDF\Facade\Pdf;
use Redirect;
use Illuminate\Support\Facades\Auth;

class AcsController extends Controller
{
    public function acsadminhome(Request $request)
    {
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $userIp = $request->ip();
        $carddata = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();

        return view('backend.acsadmin.acshome', compact('navbar', 'user', 'userIp', 'carddata'));
    }

    public function HerooftheMonthApprove()
    {
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Hero of the Month Approve', 'message' => 'Hero of the Month Approve', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $data = HerooftheMonth::with(['heromonthsub' => function ($query) {}])->where('acs_approve_flag', 0)->get();

        return view('backend.acsadmin.HeromonthApprove.heromonthapprove', compact('data', 'breadcrumbarr', 'navbar', 'user'));
    }

    public function storeHeroOfMonthRemark(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'remark' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ]);
            $request->input();

            if ($request->selOpt == 'reject') {
                $acs_approve_flag = 2;
            } elseif ($request->selOpt == 'approve') {

                $acs_approve_flag = 1;
            }

            $uparr = [
                'acs_remak' => $request->remark,
                'acs_approve_flag' => $acs_approve_flag,
            ];

            $res = HerooftheMonth::where('id', $request->hidden_id)->update($uparr);
            $edit_f = 'U';
            if ($res) {
                return redirect('/acs/storeHeroOfMonthRemark')->with(['success' => 'Updated successfully']);
            } else {
                return back()->withErrors('Not Updated ');
            }
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR' . $data->id);
        }
    }

    public function heromonthdetails($id)
    {
        $id = Crypt::decryptString($id);
        $data = usertype::where('delet_flag', 0)->get();
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Usertype', 'message' => 'Usertype', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $data = HerooftheMonth::with(['heromonthsub' => function ($query) {
            $query->where('languageid', 1);
        }])->where('id', $id)->first();

        return view('backend.acsadmin.HeromonthApprove.heromonthapprovedetails', compact('data', 'breadcrumbarr', 'navbar', 'user'));
    }

    public function suggestionreport()
    {
        $role_type = Auth::user()->role_id;
        if($role_type == 9)
        {
            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/editorhome'],
                1 => ['title' => 'Suggestion report', 'message' => 'Suggestion report', 'status' => 1],
            ];
        }elseif($role_type == 7){
            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/acsadminhome'],
                1 => ['title' => 'Suggestion report', 'message' => 'Suggestion report', 'status' => 1],
            ];
        }
       
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
// dd($user);
            $data = Suggestion::with(['user' => function ($q1) {
                $q1->with(['designationdata' => function ($q2) {
                    $q2->with(['des_sub' => function ($q2) {
                        $q2->where('languageid', 1);
                    }]);
                }]);
                $q1->with(['officedata' => function ($q3) {
                    $q3->with(['office_sub' => function ($q4) {
                        $q4->where('languageid', 1);
                    }]);
                }]);
            }])
            ->when(request('type_id'), function ($query) {
                return $query->where('type_id', request('type_id'));
            })
            ->where('status_id', 1)
            ->get();
        $offices = Office::with(['office_sub' => function ($query) {}])->get();
        return view('backend.acsadmin.SuggestionReport.suggestionreport', compact('data', 'breadcrumbarr', 'navbar', 'user','offices'));
    }

    public function suggestiondetails($id)
    {
        $id = Crypt::decryptString($id);
        $data = usertype::where('delet_flag', 0)->get();
        $role_type = Auth::user()->role_id;
        
        if($role_type == 9)
        {
            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/editorhome'],
                1 => ['title' => 'Suggestion report', 'message' => 'Suggestion report', 'status' => 1],
            ];
        }elseif($role_type == 7){
            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/acsadminhome'],
                1 => ['title' => 'Suggestion report', 'message' => 'Suggestion report', 'status' => 1],
            ];
        }
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $data = Suggestion::with(['suggItems' => function ($query) {}])->with(['user' => function($q1){

        }])->where('id', $id)->first();

        return view('backend.acsadmin.SuggestionReport.SuggestionReportdetails', compact('data', 'breadcrumbarr', 'navbar', 'user'));
    }

    public function exportPdf($id)
    {
        $id = Crypt::decryptString($id);
      
        $data = Suggestion::with(['suggItems' => function ($query) {}])->where('id', $id)->first();

        $pdf = PDF::loadView('backend/acsadmin/SuggestionReport/exportpdf', ['data' => $data]);

        return $pdf->download('report.pdf');
    }
    public function suggestionapproverRemark(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'remark' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ]);
            $request->input();
            $role_type = Auth::user()->role_id;
  
            
            // dd($role_type);
            if ($request->selOpt == 'reject') {
                $acs_approve_flag = 2;
            } elseif ($request->selOpt == 'approve') {

                $acs_approve_flag = 1;
            } elseif ($request->selOpt == 'returnback') {

                $acs_approve_flag = 3;
            }
            $role_id = Auth::user()->id;
            $uparr = [
                'approverremark' => $request->remark,
                'approverstatus' => $acs_approve_flag,
                'approverdate'   => now(),
                'approverby' => $role_id,
                
            ];

            $res = Suggestion::where('id', $request->hidden_id)->update($uparr);
            $edit_f = 'U';
           
            if($role_type == 9)
            {
                if ($res) {

                    return redirect('/editor/suggestionreport')->with(['success' => 'Updated successfully']);
                } else {
                    return back()->withErrors('Not Updated ');
                }
            }else{
                if ($res) {

                    return redirect('/acs/suggestionreport')->with(['success' => 'Updated successfully']);
                } else {
                    return back()->withErrors('Not Updated ');
                }
            }
            
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR' . $data->id);
        }
    }
    public function reportpdf()
    {
        // $data = Suggestion::with(['user.officedata.office_sub'])->get(); // Adjust this as per your data fetching logic.

        $data = Suggestion::with(['user' => function($q1){
            $q1->with(['designationdata' => function($q2){
                $q2->with(['des_sub' => function($q2){
                    $q2->where('languageid', 1);
                }]);
            }]);
            $q1->with(['officedata' => function($q3){
                  $q3->with(['office_sub' => function($q4){
                      $q4->where('languageid', 1);
            }]);
        }]);
        }])->where('status_id', 1)->get();

        $pdf = Pdf::loadView('backend.acsadmin.SuggestionReport.reportpdf', compact('data'));
        return $pdf->download('report_datatable.pdf');
    }

    public function officewisesearch(Request $request)
    {
         // Validate inputs
    $validated = $request->validate([
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'office' => 'nullable|integer',
    ]);

    $officeID = $request->office;

    // Base query for suggestions
    $query = Suggestion::query();

    // Add conditions for filters dynamically
    if ($request->filled('office')) {
        $query->whereHas('user2', function ($q1) use ($officeID) {
            $q1->where('office_id', $officeID)
                ->with([
                    'designationdata' => function ($q2) {
                        $q2->with([
                            'des_sub' => function ($q3) {
                                $q3->where('languageid', 1);
                            }
                        ]);
                    },
                    'officedata' => function ($q4) {
                        $q4->with([
                            'office_sub' => function ($q5) {
                                $q5->where('languageid', 1);
                            }
                        ]);
                    }
                ]);
        });
    }

    // Add date range filter if provided
    if ($request->filled('start_date')) {
        $query->where('created_at', '>=', $request->start_date);
    }
    if ($request->filled('end_date')) {
        $query->where('created_at', '<=', $request->end_date);
    }
  

    // Add status filter
    $query->where('status_id', 1);

    // Execute query and get results
    $data = $query->get();

    // Breadcrumb and other necessary data
    $role_type = Auth::user()->role_id;
    if($request->type_id != '')
    {
        $type_id=$request->type_id;
    }else{
        $type_id='';
    } 
   
    if($role_type == 9)
    {
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/editorhome'],
            1 => ['title' => 'Suggestion report', 'message' => 'Suggestion report', 'status' => 1],
        ];
    }elseif($role_type == 7){
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/acsadminhome'],
            1 => ['title' => 'Suggestion report', 'message' => 'Suggestion report', 'status' => 1],
        ];
    }
    $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
    $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
    $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
    $offices = Office::with(['office_sub'])->get();

    return view('backend.acsadmin.SuggestionReport.searchsuggestionreport', compact('data', 'breadcrumbarr', 'navbar', 'user', 'offices','type_id'));

    }
}

