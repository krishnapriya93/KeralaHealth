<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementType;
use App\Models\AnnouncementTypeSub;
use App\Models\Articletype;
use App\Models\Articletypesub;
use App\Models\Componentpermission;
use App\Models\Department;
use App\Models\DepartmentCat;
use App\Models\DepartmentCatSub;
use App\Models\DepartmentField;
use App\Models\DepartmentFieldsSub;
use App\Models\DepartmentSub;
use App\Models\Designation;
use App\Models\Designationsub;
use App\Models\Footermenu;
use App\Models\GalleryCategory;
use App\Models\GalleryCategorySub;
use App\Models\Gallerytype;
use App\Models\Keywordtag;
use App\Models\Keywordtagsub;
use App\Models\Language;
use App\Models\Linktype;
use App\Models\Linktypesub;
use App\Models\Logotype;
use App\Models\Menulinktype;
use App\Models\Milestone;
use App\Models\Office;
use App\Models\OfficeSub;
use App\Models\Publicrelationtype;
use App\Models\PublicrelationtypSub;
use App\Models\usertype;
use App\Models\wellnessTipType;
use App\Models\wellnessTipTypeSub;
use App\Models\DepartmentSubmenu;
use App\Models\DepartmentSubmenuSub;
use Crypt;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Redirect;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        // dd(phpinfo());
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $userIp = $request->ip();
        $carddata = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();

        return view('backend.masteradmin.masterhome', compact('navbar', 'user', 'userIp', 'carddata'));
    }

    /*Article type*/
    public function articletype()
    {
        $data = Articletype::with(['article_sub' => function ($query) {
            $query->where('delet_flag', 0);
        }])->where('delet_flag', 0)->get();

        $role_id = Auth::user()->id;

        if ($role_id == 1) {
            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
                1 => ['title' => 'Article type', 'message' => 'Article type', 'status' => 1],
            ];
        } else {
            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masterhome'],
                1 => ['title' => 'Article type', 'message' => 'Article type', 'status' => 1],
            ];
        }

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $usertype = usertype::get();

        return view('backend.masteradmin.Articletype.articletypelist', compact('data', 'breadcrumbarr', 'usertype', 'navbar', 'user'));
    }

    /*Article type create*/
    public function createarticletype()
    {

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $role_id = Auth::user()->id;

        if ($role_id == 1) {
            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
                1 => ['title' => 'Articletype', 'message' => 'Articletype', 'status' => 0, 'link' => '/admin/articletype'],
                2 => ['title' => 'Create article type', 'message' => 'Create article type', 'status' => 1],
            ];
        } else {
            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masterhome'],
                1 => ['title' => 'Articletype', 'message' => 'Articletype', 'status' => 0, 'link' => '/masteradmin/articletype'],
                2 => ['title' => 'Create article type', 'message' => 'Create article type', 'status' => 1],
            ];
        }

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        $Navid = Componentpermission::where('url', '/'.$route)->select('id')->first();

        return view('backend.masteradmin.Articletype.createarticletype', compact('breadcrumbarr', 'language', 'navbar', 'user', 'Navid'));
    }

    /*Store Article type*/

    public function storearticletype(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {
            $role_id = Auth::user()->id;

            $leng = count($request->sel_lang);
            // dd($leng);
            if ($request->sbu_user == null) {
                $sbu_user = 0;
            } else {
                $sbu_user = $request->sbu_user;
            }
            $storeinfo = new Articletype([
                'userid' => Auth::user()->id,
                'delet_flag' => 0,
                'status_id' => 1,
            ]);
            // dd($storeinfo);
            $res = $storeinfo->save();
            $Articletypeid = DB::getPdo()->lastInsertId();

            for ($i = 0; $i < $leng; $i++) {

                if ($Articletypeid) {

                    $store_sub_info = new Articletypesub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'articletypeid' => $Articletypeid,
                        'userid' => $role_id,
                        'delet_flag' => 0,
                        'status_id' => 1,
                    ]);
                    $storedetails_sub = $store_sub_info->save();
                }
                // dd($path);
            } //forloopend

            return redirect()->route('masteradmin.articletype')->with('success', 'created successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    /*edit Article type*/
    public function editarticletype($id)
    {

        $id = Crypt::decryptString($id);
        $edit_f = 'E';
        $keydata = Articletype::with(['article_sub' => function ($query) {
            $query->where('delet_flag', 0);
        }])->where('delet_flag', 0)->where('id', $id)->first();
        $error = '';
        $data = Articletype::with(['article_sub' => function ($query) {
            $query->where('delet_flag', 0);
        }])->where('delet_flag', 0)->get();

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Articletype', 'message' => 'Articletype', 'status' => 0, 'link' => '/admin/articletype'],
            2 => ['title' => 'Create article type', 'message' => 'Create article type', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Articletype.createarticletype', compact('data', 'edit_f', 'error', 'keydata', 'breadcrumbarr', 'navbar', 'language', 'user'));
    }

    /*Articletype  update*/
    public function updatearticletype(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {
            //    if($request->sbu_user==null)
            //    {
            //        $sbu_user= 0;
            //    }else{
            //        $sbu_user= $request->sbu_user;
            //    }
            //    $storeinfo=Articletype::where('id',$request->hidden_id) ->update([
            //        'viewer_id'=>$request->sbu_id,
            //    ]);

            for ($i = 0; $i < count($request->title); $i++) {
                $res = Articletypesub::where('articletypeid', $request->hidden_id)->where('languageid', $request->sel_lang[$i])
                    ->update([
                        'title' => $request->title[$i],
                    ]);
                // dd($request->sel_lang[$i]);

            } //forloopend

            if ($res) {
                DB::commit();

                return Redirect('masteradmin/articletype')->with('success', 'Updated successfully');
            } else {
                DB::rollback();

                return back()->withErrors('Not Updated ');
            }
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    /* Article delete*/
    public function deletearticletype($id)
    {
        $id = Crypt::decryptString($id);
        // dd($id);
        DB::beginTransaction();

        $res_sub = Articletypesub::where('articletypeid', $id)->delete();

        if ($res_sub) {
            $res = Articletype::findOrFail($id)->delete();
        }
        $edit_f = '';
        if ($res_sub) {
            DB::commit();

            return Redirect('masteradmin/articletype')->with('success', 'Deleted successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /*Articletype Status*/
    public function statusarticletype($id)
    {
        $id = Crypt::decryptString($id);
        $status = Articletype::where('id', $id)->value('status_id');

        DB::beginTransaction();
        if ($status == 1) {
            $uparr = [
                'status_id' => 0,
            ];
        } else {
            $uparr = [
                'status_id' => 1,
            ];
        }

        $res = Articletype::where('id', $id)->update($uparr);

        $edit_f = '';
        if ($res) {
            DB::commit();

            return Redirect('masteradmin.articletype')->with('success', 'Status updated successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }
   
    /*Sbu milestonelis */
    public function milestonelist()
    {
        $role_id = Auth::user()->id;
        $data = Milestone::with(['milestonesub' => function ($query) {
            // $query->where('delet_flag',0);
        }])->where('user_id', $role_id)->get();

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $role_type = Auth::user()->role_id;
        if ($role_type == 3) { //planning office
            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masterhome'],
                1 => ['title' => 'Milestone', 'message' => 'Milestone', 'status' => 1],
            ];
        }

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Milestone.milestonelist', compact('data', 'breadcrumbarr', 'language', 'navbar', 'user'));
    }

    /*Milestone create*/
    public function createmilestone()
    {

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();
        $role_id = Auth::user()->role_id;

        if ($role_id == 3) { //planning office
            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masterhome'],
                1 => ['title' => 'Milestone', 'message' => 'Milestone', 'status' => 0, 'link' => '/planning/milestonelist'],
                2 => ['title' => 'Create Milestone', 'message' => 'Create Milestone', 'status' => 1],
            ];
        }

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        $Navid = Componentpermission::where('url', '/'.$route)->select('id')->first();

        $years = range(Carbon::now()->year, 1920);

        //  dd($Navid->id);
        return view('backend.masteradmin.Milestone.createmilestone', compact('breadcrumbarr', 'language', 'navbar', 'user', 'Navid', 'years'));
    }

    /*store Milestone*/
    public function storemilestone(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate(
                [
                    'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
                    'con_title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg_ckedit(),
                ],
                [
                    'title.required' => 'Title is required',
                    'title.min' => 'Title  minimum lenght is 2',
                    'title.max' => 'Title  maximum lenght is 50',
                    'title.regex' => 'Invalid characters not allowed for Title',
                ]
            );
            $request->input();
            $role_id = Auth::user()->id;
            DB::beginTransaction();
            $leng = count($request->sel_lang);
            // dd($leng);
            $link = $request->link;
            if ($link == '') {
                $link = '';
            } else {
                $link = $link;
            }
            $iconclass = $request->iconclass;
            if ($iconclass == '') {
                $iconclass = '';
            } else {
                $iconclass = $iconclass;
            }
            $storeinfo = new Milestone([
                'user_id' => $role_id,
                'status_id' => 1,
                'date' => $request->date,
                'link' => $request->link,
                'year' => $request->year,
                'icon_class' => $request->iconclass,
                'sbutype_id' => Auth::user()->sbutype,
            ]);

            $res = $storeinfo->save();
            $milestoneid = DB::getPdo()->lastInsertId();
            // dd($milestoneid);
            for ($i = 0; $i < $leng; $i++) {

                // dd($request->sel_lang[$i]);
                if ($milestoneid) {
                    if (isset($request->poster)) {
                        foreach ($request->file('poster') as $key => $file) {
                            $date = date('dmYH:i:s');
                            if ($request->file('poster')) {
                                $imageName = 'Milestone'.$request->sel_lang[$i].$date.'.'.$file->extension();
                                $filename[] = $imageName;
                                $path = $request->file('poster')[$i]->storeAs('/uploads/Milestone/', $imageName, 'myfile');
                            } else {
                            }
                            // else{
                            //   $imageName='';
                            //

                        } //foreach
                    } else {
                        $imageName = '';
                    }

                    $store_sub_info = new Milestonesub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'milestoneid' => $milestoneid,
                        'description' => $request->description[$i],
                        'content' => $request->con_title[$i],
                        'poster' => $imageName,
                    ]);

                    $storedetails_sub = $store_sub_info->save();
                }
                // dd($path);
            } //forloopend

            if ($storedetails_sub) {
                $role_type = Auth::user()->role_id;

                if ($role_type == 5) { //SBU admin
                    DB::commit();

                    return redirect()->route('milestonelist')->with('success', 'created successfully');
                } elseif ($role_type == 3) { //Site admin

                    DB::commit();

                    return redirect()->route('planning.milestonelist')->with('success', 'created successfully');
                }
            } else {
                DB::rollback();

                return back()->withErrors('Not created ');
            }
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    /*edit milestone*/
    public function editmilestone($id)
    {
        $id = Crypt::decryptString($id); //History::with(['historysub
        $edit_f = 'E';
        $keydata = Milestone::with(['milestonesub' => function ($query) {
            // $query->where('delet_flag',0);
        }])->where('id', $id)->first();
        $error = '';
        $data = Milestone::with(['milestonesub' => function ($query) {
            // $query->where('delet_flag',0);
        }])->get();

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();
        $years = range(Carbon::now()->year, 1920);

        $role_id = Auth::user()->role_id;

        if ($role_id == 3) { //planning office
            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masterhome'],
                1 => ['title' => 'Milestone', 'message' => 'Milestone', 'status' => 0, 'link' => '/planning/milestonelist'],
                2 => ['title' => 'Edit Milestone', 'message' => 'Edit Milestone', 'status' => 1],
            ];
        }

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        $Navid = Componentpermission::where('url', '/'.$route)->select('id')->first();

        // dd($keydata);
        return view('backend.masteradmin.Milestone.createmilestone', compact('data', 'edit_f', 'error', 'keydata', 'breadcrumbarr', 'navbar', 'user', 'language', 'Navid', 'years'));
    }

    /*milestone delete*/
    public function deletemilestone($id)
    {
        $id = Crypt::decryptString($id);

        DB::beginTransaction();
        $imageName = Milestonesub::where('milestoneid', $id)->select('poster')->get();

        foreach ($imageName as $img) {
            Storage::disk('myfile')->delete('/uploads/Milestone/'.$img->file);
        }
        $res_sub = Milestonesub::where('milestoneid', $id)->delete();

        if ($res_sub) {
            $res = Milestone::findOrFail($id)->delete();
        }
        $edit_f = '';
        if ($res_sub) {

            $role_type = Auth::user()->role_id;
            if ($role_type == 5) { //SBU admin
                DB::commit();

                return redirect()->route('milestonelist')->with('success', 'Deleted successfully');
            } elseif ($role_type == 3) { //planning admin
                DB::commit();

                return redirect()->route('planning.milestonelist')->with('success', 'Deleted successfully');
            }
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /**update Milestone */
    public function updatemilestone(Request $request)
    {
        // dd($request->all());
        $id = $request->hidden_id;
        $validator = Validator::make(
            $request->all(),
            [
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
                'con_title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg_ckedit(),
                // 'description.*'   => app('App\Http\Controllers\Commonfunctions')->getEntitlereg_ckedit(),
                //'poster.*'      => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
                'alt_title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),

            ],
            [
                'title.required' => 'Title is required',
                'title.regex' => 'The title format is invalid',
                'title.min' => 'Title  minimum length is 3',
                'title.max' => 'Title  maximum length is 150',

                'sub_title.required' => 'Sub Title is required',
                'sub_title.regex' => 'The Sub Title format is invalid',
                'sub_title.min' => 'Sub Title  minimum length is 3',
                'sub_title.max' => 'Sub Title  maximum length is 150',
            ]
        );
        //

        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }

        try {
            // dd($request->subtitle);

            // dd($request->poster);
            $i = 0;
            $filename = [];
            if (isset($request->poster)) {
                foreach ($request->poster as $filep) {
                    // echo $i.':::'.count($request->poster);
                    if ($i <= count($request->poster)) {
                        // dd('d');
                        // echo $i;
                        if (isset($request->file('poster')[$i])) {
                            $date = date('dmYH:i:s');
                            $imageName = 'Milestone'.$i.$date.'.'.$filep->extension();
                            $filename[] = $imageName;
                            $path = $request->file('poster')[$i]->storeAs('/uploads/Milestone/', $imageName, 'myfile');
                        } else {
                            $j = $i + 1;
                            $date = date('dmYH:i:s');
                            $imageName = 'Milestone'.$i.$date.'.'.$filep->extension();
                            $filename[] = $imageName;
                            $path = $request->file('poster')[$j]->storeAs('/uploads/Milestone/', $imageName, 'myfile');
                        }

                        $i++;
                    }
                    // dd($filename);
                }
            }

            $leng = count($request->sel_lang);
            // dd($request->all());
            $main_update = Milestone::where('id', $request->hidden_id)
                ->update([
                    'date' => $request->date,
                    'link' => $request->link,
                    'icon_class' => $request->iconclass,
                    'year' => $request->year,
                ]);
            if ($main_update) {
                for ($i = 0; $i < $leng; $i++) {
                    // dd(count($lang));
                    $chekrows = Milestonesub::where('milestoneid', '=', $request->hidden_id)->exists() ? 1 : 0;
                    // dd($chekrows);
                    if ($chekrows == 1) {
                        // if(!isset($artsubval->languageid)){
                        // echo $i.' :: lang '.$lng->id.' :::: '.$filename[$i];
                        if (! empty($filename[$i])) {
                            $dataarr1 = [
                                'languageid' => $request->sel_lang[$i],
                                'title' => $request->title[$i],
                                'milestoneid' => $request->hidden_id,
                                'description' => $request->description[$i],
                                'content' => $request->con_title[$i],
                                'poster' => $imageName,
                            ];
                        } else {
                            $dataarr1 = [
                                'languageid' => $request->sel_lang[$i],
                                'title' => $request->title[$i],
                                'description' => $request->description[$i],
                                'content' => $request->con_title[$i],
                                'milestoneid' => $request->hidden_id,
                            ];
                        }

                        $res1 = Milestonesub::where('milestoneid', '=', $request->hidden_id)->where('languageid', '=', $request->sel_lang[$i])->update($dataarr1);
                    } else {
                        return back()->withInput()->with('error', 'Already existing');
                    }
                }
            }

            // dd(true)
            $role_type = Auth::user()->role_id;
            if ($role_type == 5) { //SBU admin
                return redirect()->route('milestonelist')->with('success', 'Updated successfully');
            } elseif ($role_type == 3) { //Site admin
                return redirect()->route('planning.milestonelist')->with('success', 'Updated successfully');
            }

            // }
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e);
        }
    }

    /*Milestone Status*/
    public function statusmilestone($id)
    {
        $id = Crypt::decryptString($id);
        $status = Milestone::where('id', $id)->value('status_id');

        DB::beginTransaction();
        if ($status == 1) {
            $uparr = [
                'status_id' => 0,
            ];
        } else {
            $uparr = [
                'status_id' => 1,
            ];
        }
        $res = Milestone::where('id', $id)->update($uparr);

        $edit_f = '';
        if ($res) {
            DB::commit();
            $role_type = Auth::user()->role_id;
            if ($role_type == 5) { //SBU admin
                return redirect()->route('milestonelist')->with('success', 'Status change successfully');
            } elseif ($role_type == 3) { //Site admin
                return redirect()->route('planning.milestonelist')->with('success', 'Status change successfully');
            }
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /*Footermenu*/
    public function footermenu()
    {
        $data = Footermenu::with(['footermenu_sub' => function ($query) {
            $query->where('delet_flag', 0)->where('languageid', 1);
        }])->where('delet_flag', 0)->get();

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Footer menu', 'message' => 'Footer menu', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Footermenu.footermenulist', compact('data', 'breadcrumbarr', 'language', 'navbar', 'user'));
    }

    /*Footer menu create*/
    public function createfootermenu()
    {

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Footer menu list', 'message' => 'Footer menu list', 'status' => 1, 'link' => '/footermenu'],
            2 => ['title' => 'Footer menu create', 'message' => 'Footer menu create', 'status' => 2],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        $Navid = Componentpermission::where('url', '/'.$route)->select('id')->first();

        return view('backend.masteradmin.Footermenu.createfootermenu', compact('breadcrumbarr', 'language', 'navbar', 'user', 'Navid'));
    }

    /*Store logo*/

    public function storefootermenu(Request $request)
    {
        // dd($request->poster);
        try {
            $request->validate(
                [
                    'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                    'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
                    'alt_title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
                    'iconclass.*' => app('App\Http\Controllers\Commonfunctions')->getIconClass(),
                ],
                [
                    'title.required' => 'Title is required',
                    'title.min' => 'Title  minimum lenght is 2',
                    'title.max' => 'Title  maximum lenght is 50',
                    'title.regex' => 'Invalid characters not allowed for Title',

                    'alt_title.required' => 'Alternate text is required',
                    'alt_title.min' => 'Alternate text  minimum lenght is 2',
                    'alt_title.max' => 'Alternate text  maximum lenght is 100',
                    'alt_title.regex' => 'Invalid characters not allowed for Alternate text',

                ]
            );
            $request->input();
            $role_id = Auth::user()->id;

            $leng = count($request->sel_lang);
            // dd($leng);
            //
            $storeinfo = new Footermenu([
                'userid' => Auth::user()->id,
                'delet_flag' => 0,
                'iconclass' => $request->iconclass,
                'status_id' => 1,
            ]);

            $res = $storeinfo->save();
            $footermenuid = DB::getPdo()->lastInsertId();

            // for($i=0;$i<$leng;$i++){

            if ($footermenuid) {
                $j = 0;
                $filename = [];
                foreach ($request->poster as $filep) {

                    // print_r($request->file('poster')[$i]);
                    //    dd($filep->poster[$i]->extension());
                    // dd(count($request->poster));
                    // $imageName = 'logo' . $date . '.' .$filep->poster->extension();
                    if ($j < count($request->poster)) {
                        $date = date('dmYH:i:s');
                        $imageName = 'Footermenu'.$j.$date.'.'.$filep->extension();
                        $filename[] = $imageName;
                        $path = $request->file('poster')[$j]->storeAs('/uploads/Footermenu/', $imageName, 'myfile');

                        $j++;
                    }
                }
                // dd($i);
                //  $date = date('dmYH:i:s');
                //    foreach($request->file('poster') as $key => $file)
                //     {
                //          $imageName = $i . $date . '.' . $file->extension();

                //          $path=$file->storeAs('/uploads/Footermenu', $imageName,'myfile');

                //     }
                for ($i = 0; $i < $leng; $i++) {
                    $store_sub_info = new Footermenusub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'alternatetext' => $request->alt_title[$i],
                        'poster' => $filename[$i],
                        'footermenuid' => $footermenuid,
                        'userid' => $role_id,
                        'content' => $request->content[$i],
                        'delet_flag' => 0,
                        'status_id' => 1,
                    ]);

                    // dd($store_sub_info);
                    $storedetails_sub = $store_sub_info->save();
                }
                // dd($path);
            } //forloopend

            return redirect()->route('footermenu')->with('success', 'created successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    /*edit Footermenu*/
    public function editfootermenu($id)
    {
        $id = Crypt::decryptString($id);
        $edit_f = 'E';
        $keydata = Footermenu::with(['footermenu_sub' => function ($query) {
            $query->where('delet_flag', 0);
        }])->where('delet_flag', 0)->where('id', $id)->first();
        $error = '';
        $data = Footermenu::with(['footermenu_sub' => function ($query) {
            $query->where('delet_flag', 0);
        }])->where('delet_flag', 0)->get();

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Footermenu', 'message' => 'Footermenu', 'status' => 1, 'link' => '/footermenu'],
            2 => ['title' => 'Edit Footermenu', 'message' => 'Edit Footermenu', 'status' => 2],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        $Navid = Componentpermission::where('url', '/'.$route)->select('id')->first();

        // dd($keydata);
        return view('backend.masteradmin.Footermenu.createfootermenu', compact('data', 'edit_f', 'error', 'keydata', 'breadcrumbarr', 'navbar', 'user', 'language', 'Navid'));
    }

    /**update Footermenu */
    public function updatefootermenu(Request $request)
    {
        // dd($request->all());
        $id = $request->hidden_id;
        $validator = Validator::make(
            $request->all(),
            [
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
                'alt_title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.regex' => 'The title format is invalid',
                'title.min' => 'Title  minimum length is 3',
                'title.max' => 'Title  maximum length is 150',

                'alt_title.required' => 'Sub Title is required',
                'alt_title.regex' => 'The Alternative Title format is invalid',
                'alt_title.min' => 'Alternative Title  minimum length is 3',
                'alt_title.max' => 'Alternative Title  maximum length is 150',
            ]
        );

        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        // dd($request->all());
        try {

            $i = 0;
            $filename = [];
            if (isset($request->poster)) {
                foreach ($request->poster as $filep) {
                    // echo $i.':::'.count($request->poster);
                    if ($i <= count($request->poster)) {
                        // dd('d');
                        // echo $i;
                        if (isset($request->file('poster')[$i])) {
                            $date = date('dmYH:i:s');
                            $imageName = 'Footermenu'.$i.$date.'.'.$filep->extension();
                            $filename[] = $imageName;
                            $path = $request->file('poster')[$i]->storeAs('/uploads/Footermenu/', $imageName, 'myfile');
                        } else {
                            $j = $i + 1;
                            $date = date('dmYH:i:s');
                            $imageName = 'Footermenu'.$i.$date.'.'.$filep->extension();
                            $filename[] = $imageName;
                            $path = $request->file('poster')[$j]->storeAs('/uploads/Footermenu/', $imageName, 'myfile');
                        }
                        $i++;
                    }
                    // dd($filename);
                }
            }
            // dd($request->hidden_id);
            $leng = count($request->sel_lang);

            $main_update = Footermenu::where('id', $request->hidden_id)
                ->update([
                    'iconclass' => $request->iconclass,
                ]);
            if ($main_update) {
                for ($i = 0; $i < $leng; $i++) {
                    // dd(count($lang));
                    $chekrows = Footermenusub::where('title', $request->title[$i])->where('footermenuid', '!=', $request->hidden_id)->exists() ? 1 : 0;

                    if ($chekrows == 0) {
                        // if(!isset($artsubval->languageid)){
                        // echo $i.' :: lang '.$lng->id.' :::: '.$filename[$i];
                        if (! empty($filename[$i])) {
                            $dataarr1 = [
                                'languageid' => $request->sel_lang[$i],
                                'title' => $request->title[$i],
                                'alternatetext' => $request->alt_title[$i],
                                'poster' => $filename[$i],
                                'footermenuid' => $request->hidden_id,
                                'content' => $request->content[$i],
                            ];
                        } else {
                            $dataarr1 = [
                                'languageid' => $request->sel_lang[$i],
                                'title' => $request->title[$i],
                                'alternatetext' => $request->alt_title[$i],
                                'footermenuid' => $request->hidden_id,
                                'content' => $request->content[$i],
                            ];
                        }

                        $res1 = Footermenusub::where('footermenuid', '=', $request->hidden_id)->where('languageid', '=', $request->sel_lang[$i])->update($dataarr1);
                    } else {
                        return back()->withInput()->with('error', 'Already existing');
                    }
                }
            }

            return redirect()->route('footermenu')->with('success', 'Updated successfully');

            // }
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e);
        }
    }

    /*Footermenu delete*/
    public function deletefootermenu($id)
    {
        $id = Crypt::decryptString($id);

        DB::beginTransaction();
        $res_sub = Footermenusub::where('footermenuid', $id)->delete();

        if ($res_sub) {
            $res = Footermenu::findOrFail($id)->delete();
        }
        $edit_f = '';
        if ($res_sub) {
            DB::commit();

            return Redirect('footermenu')->with('success', 'Deleted successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /*Gallerytype*/
    public function gallerytype()
    {
        $data = Gallerytype::where('delet_flag', 0)->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Gallery type', 'message' => 'Gallery type', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $usertype = usertype::get();

        return view('backend.masteradmin.Gallerytype.gallerytype', compact('data', 'breadcrumbarr', 'usertype', 'navbar', 'user'));
    }

    /*Store gallery type*/
    public function storegallerytype(Request $request)
    {

        try {
            $request->validate([
                'gallery_type' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ]);
            $request->input();
            $role_id = Auth::user()->id;

            $storeinfo = new Gallerytype([
                'name' => $request->gallery_type,
                'delet_flag' => 0,
                'status_id' => 1,
                'userid' => $role_id,
            ]);

            $storedetails = $storeinfo->save();

            return redirect()->route('masteradmin.gallerytype')->with('success', 'created successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    /*Gallery type delete*/
    public function deletegaltype($id)
    {
        $id = Crypt::decryptString($id);

        DB::beginTransaction();
        // $uparr=array(
        //     'delet_flag'=>1,
        //      );
        $res = Gallerytype::findOrFail($id)->delete();
        // $res=usertype::where('id',$id)->update($uparr);
        $edit_f = '';
        if ($res) {
            DB::commit();

            return Redirect('masteradmin/gallerytype')->with('success', 'Deleted successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /*gallery type edit*/
    public function editgaltype($id)
    {
        $id = Crypt::decryptString($id);
        $edit_f = 'E';
        $keydata = Gallerytype::where('id', $id)->first();
        $error = '';
        $data = Gallerytype::where('delet_flag', 0)->get();
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Gallerytype', 'message' => 'Gallerytype', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Gallerytype.gallerytype', compact('data', 'edit_f', 'error', 'keydata', 'breadcrumbarr', 'navbar', 'user'));
    }

    /*gallery type  update*/
    public function updategallerytype(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'gallery_type' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ]);
            $request->input();

            $uparr = [
                'name' => $request->gallery_type,
            ];
            // dd($uparr);
            $res = Gallerytype::where('id', $request->hidden_id)->update($uparr);
            //  dd($res);
            $edit_f = 'U';
            if ($res) {
                return Redirect('masteradmin/gallerytype')->with('success', 'Updated successfully', ['edit_f' => $edit_f]);
            } else {
                return back()->withErrors('Not Updated ');
            }
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    /*Gallery cat*/
    public function gallerycategory()
    {
        $datas = GalleryCategory::with(['gallerycatsub' => function ($query) {}])->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Gallery cateogry', 'message' => 'Gallery category', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $usertype = usertype::get();

        return view('backend.masteradmin.Gallerycategory.gallerycatlist', compact('datas', 'breadcrumbarr', 'usertype', 'navbar', 'user'));
    }

    public function creategallerycategory()
    {
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Gallery cateogry', 'message' => 'Gallery category', 'status' => 1],
        ];

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $usertype = usertype::get();

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        return view('backend.masteradmin.Gallerycategory.creategallerycat', compact('breadcrumbarr', 'navbar', 'user', 'usertype', 'language'));
    }

    public function storegallerycategory(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {

            $request->input();
            $role_id = Auth::user()->id;
            DB::beginTransaction();
            $leng = count($request->sel_lang);
            // dd($leng);

            $storeinfo = new GalleryCategory([
                'user_id' => Auth::user()->id,
                'status_id' => 1,
            ]);

            $res = $storeinfo->save();

            $gallerycategoryId = DB::getPdo()->lastInsertId();

            for ($i = 0; $i < $leng; $i++) {

                if ($gallerycategoryId) {

                    $store_sub_info = new GalleryCategorySub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'gallerycategoryId' => $gallerycategoryId,
                    ]);
                    $storedetails_sub = $store_sub_info->save();
                }
                // dd($path);
            } //forloopend
            DB::commit();

            return redirect()->route('masteradmin.gallerycategory')->with('success', 'Created successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();
            DB::rollback();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    public function editgalcategory($id)
    {

        $id = Crypt::decryptString($id);

        $edit_f = 'E';

        $keydata = GalleryCategory::with(['gallerycatsub' => function ($query) {
            $query->with('lang_sel');
        }])->where('id', $id)->first();
        $error = '';

        $language = Language::orderBy('name')->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masterhome'],
            1 => ['title' => 'Gallery category', 'message' => 'Gallery category', 'status' => 0, 'link' => '/masteradmin/gallerycategory'],
            2 => ['title' => 'Edit Gallery category', 'message' => 'Edit Gallery category', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $depfield = DepartmentField::with(['depfd_sub' => function ($query) {
            $query->where('languageid', 1);
        }])->where('status_id', 1)->get();

        return view('backend.masteradmin.Gallerycategory.creategallerycat', compact('breadcrumbarr', 'navbar', 'user', 'language', 'edit_f', 'keydata', 'depfield'));
    }

    public function updategallerycategory(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {

            $request->input();
            $role_id = Auth::user()->id;

            $leng = count($request->sel_lang);
            // dd($leng);

            $storeinfo = [
                'user_id' => Auth::user()->id,
            ];

            $res = GalleryCategory::where('id', $request->hidden_id)->update($storeinfo);
            $departmentcatid = $request->hidden_id;

            for ($i = 0; $i < $leng; $i++) {

                if ($departmentcatid) {

                    $store_sub_info = [
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'gallerycategoryId' => $departmentcatid,
                    ];
                    $storedetails_sub = GalleryCategorySub::where('gallerycategoryId', $request->hidden_id)->where('languageid', $request->sel_lang[$i])->update($store_sub_info);
                }
                // dd($path);
            } //forloopend

            return redirect()->route('masteradmin.gallerycategory')->with('success', 'Updated successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    /*Logo type*/
    public function logotype()
    {
        $data = Logotype::where('delet_flag', 0)->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Logo type', 'message' => 'Logo type', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);

        $usertype = usertype::get();

        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Logo.logotype', compact('data', 'breadcrumbarr', 'usertype', 'navbar', 'user'));
    }

    /*store logo type*/
    public function storelogotype(Request $request)
    {
        $role_id = Auth::user()->id;
        try {
            $request->validate([
                'logotype' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ]);
            $request->input();

            $storeinfo = new Logotype([
                'name' => $request->logotype,
                'delet_flag' => 0,
                'status_id' => 1,
                'userid' => $role_id,
            ]);

            $storedetails = $storeinfo->save();

            return redirect()->route('logotype')->with('success', 'created successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    /*edit Logotype*/
    public function editlogotype($id)
    {
        $id = Crypt::decryptString($id);
        $edit_f = 'E';
        $keydata = Logotype::where('id', $id)->first();
        $error = '';
        $data = Logotype::where('delet_flag', 0)->get();
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Logotype', 'message' => 'Logotype', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Logo.logotype', compact('data', 'edit_f', 'error', 'keydata', 'breadcrumbarr', 'navbar', 'user'));
    }

    /*Logotype update*/
    public function updatelogotype(Request $request)
    {
        try {
            $request->validate([
                'logotype' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ]);
            $request->input();

            $uparr = [
                'name' => $request->logotype,
            ];

            $res = Logotype::where('id', $request->hidden_id)->update($uparr);
            $edit_f = '';
            if ($res) {

                return redirect()->route('logotype')->with('success', 'Updated successfully', ['edit_f' => $edit_f]);
            } else {
                return back()->withErrors('Not Updated ');
            }
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    /*Logotype delete*/
    public function deletelogotype($id)
    {
        $id = Crypt::decryptString($id);

        DB::beginTransaction();
        // $uparr=array(
        //     'delet_flag'=>1,
        //      );
        // $res=Logotype::where('id',$id)->update($uparr);
        $res = Logotype::findOrFail($id)->delete();
        $edit_f = '';
        if ($res) {
            DB::commit();

            return redirect()->route('logotype')->with('success', 'Deleted successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /*Link list*/
    public function Menulinktype()
    {
        $data = Menulinktype::where('delet_flag', 0)->get();
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Menulinktypes', 'message' => 'Menulinktypes', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);

        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Menulinktype.menulinktype', compact('data', 'breadcrumbarr', 'navbar', 'user'));
    }

    /*store menulink type*/
    public function storemenulinktype(Request $request)
    {
        try {

            $validator = Validator::make(
                $request->all(),
                [
                    'Menulinktype' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
                ],
                [
                    'title.required' => 'Title is required',
                    'title.min' => 'Title  minimum lenght is 2',
                    'title.max' => 'Title  maximum lenght is 50',
                    'title.regex' => 'Invalid characters not allowed for Title',
                ]
            );
            if ($validator->fails()) {
                // dd($validator->errors());
                return back()->withInput()->withErrors($validator->errors());
            }

            $storeinfo = new Menulinktype([
                'name' => $request->Menulinktype,
                'delet_flag' => 0,
                'status_id' => 1,
            ]);

            $storedetails = $storeinfo->save();

            return redirect()->route('masteradmin.menulinktype')->with('success', 'created successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    /*edit Menulinktype*/
    public function editMenulinktype($id)
    {
        $id = Crypt::decryptString($id);
        $edit_f = 'E';
        $keydata = Menulinktype::where('id', $id)->first();
        $error = '';
        $data = Menulinktype::where('delet_flag', 0)->get();
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Menulinktype', 'message' => 'Menulinktype', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Menulinktype.menulinktype', compact('data', 'edit_f', 'error', 'keydata', 'breadcrumbarr', 'navbar', 'user'));
    }

    /*component update*/
    public function updateMenulinktype(Request $request)
    {
        try {
            $request->validate([
                'Menulinktype' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ]);
            $request->input();

            $uparr = [
                'name' => $request->Menulinktype,
            ];

            $res = Menulinktype::where('id', $request->hidden_id)->update($uparr);
            $edit_f = '';
            if ($res) {
                return Redirect('masteradmin.menulinktype')->with('success', 'Updated successfully', ['edit_f' => $edit_f]);
            } else {
                return back()->withErrors('Not Updated ');
            }
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    /*Menue link type delete*/
    public function deleteMenulinktype($id)
    {
        $id = Crypt::decryptString($id);

        DB::beginTransaction();
        // $uparr=array(
        //     'delet_flag'=>1,
        //      );
        // $res=Menulinktype::where('id',$id)->update($uparr);
        $res = Menulinktype::findOrFail($id)->delete();
        $edit_f = '';
        if ($res) {
            DB::commit();

            return Redirect('masteradmin.menulinktype')->with('success', 'Deleted successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /*Menutype Status*/
    public function statusmenutype($id)
    {
        $id = Crypt::decryptString($id);

        DB::beginTransaction();
        $uparr = [
            'status_id' => 0,
        ];
        $res = Menulinktype::where('id', $id)->update($uparr);

        $edit_f = '';
        if ($res) {
            DB::commit();

            return Redirect('masteradmin.menulinktype')->with('success', 'Status updated successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /*link type*/
    public function linktype()
    {
        $data = Linktype::with(['linktype_sub' => function ($query) {}])->where('delet_flag', 0)->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Link type', 'message' => 'Link type', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $usertype = usertype::get();

        return view('backend.masteradmin.Linktype.linktypelist', compact('data', 'breadcrumbarr', 'usertype', 'navbar', 'user'));
    }

    /*Link type create*/
    public function createlinktype()
    {

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Linktype', 'message' => 'Linktype', 'status' => 0, 'link' => '/linktype'],
            2 => ['title' => 'Create link type', 'message' => 'Create link type', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        $Navid = Componentpermission::where('url', '/'.$route)->select('id')->first();

        return view('backend.masteradmin.Linktype.createlinktype', compact('breadcrumbarr', 'language', 'navbar', 'user', 'Navid'));
    }

    /*Store Linktype*/

    public function storelinktype(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ], [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]);
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {

            $request->input();
            $role_id = Auth::user()->id;

            $leng = count($request->sel_lang);
            // dd($leng);

            $storeinfo = new Linktype([
                'userid' => Auth::user()->id,
                'delet_flag' => 0,
                'status_id' => 1,
            ]);

            $res = $storeinfo->save();
            $linkid = DB::getPdo()->lastInsertId();

            for ($i = 0; $i < $leng; $i++) {

                if ($linkid) {

                    $store_sub_info = new Linktypesub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'linktypeid' => $linkid,
                    ]);
                    $storedetails_sub = $store_sub_info->save();
                }
                // dd($path);
            }//forloopend

            return redirect()->route('linktype')->with('success', 'created successfully');

        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }

    }

    /*edit Linktype*/
    public function editlinktype($id)
    {

        $id = Crypt::decryptString($id);
        $edit_f = 'E';
        $keydata = Linktype::with(['linktype_sub' => function ($query) {
            $query->where('delet_flag', 0);
        }])->where('delet_flag', 0)->where('id', $id)->first();
        $error = '';
        $data = Linktype::with(['linktype_sub' => function ($query) {
            $query->where('delet_flag', 0);
        }])->where('delet_flag', 0)->get();

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Linktype', 'message' => 'Linktype', 'status' => 0, 'link' => '/linktype'],
            2 => ['title' => 'Edit link type', 'message' => 'Edit link type', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Linktype.createlinktype', compact('data', 'edit_f', 'error', 'keydata', 'breadcrumbarr', 'navbar', 'user', 'language'));
    }

    /*linktype  update*/
    public function updatelinktype(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ], [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]);
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {

            for ($i = 0; $i < count($request->title); $i++) {
                $res = Linktypesub::where('linktypeid', $request->hidden_id)->where('languageid', $request->sel_lang[$i])
                    ->update([
                        'title' => $request->title[$i],
                    ]);
                // dd($request->sel_lang[$i]);

            } //forloopend

            if ($res) {
                DB::commit();

                return Redirect('linktype')->with('success', 'Updated successfully');
            } else {
                DB::rollback();

                return back()->withErrors('Not Updated ');
            }

        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }

    }

    /* linktype delete*/
    public function deletelinktype($id)
    {
        $id = Crypt::decryptString($id);
        // dd($id);
        DB::beginTransaction();

        $res_sub = Linktypesub::where('linktypeid', $id)->delete();

        if ($res_sub) {
            $res = Linktype::findOrFail($id)->delete();

        }
        $edit_f = '';
        if ($res_sub) {
            DB::commit();

            return Redirect('linktype')->with('success', 'Deleted successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /*Linktype Status*/
    public function statuslinktype($id)
    {
        $id = Crypt::decryptString($id);
        $status = Linktype::where('id', $id)->value('status_id');
        //   dd($status);

        DB::beginTransaction();
        if ($status == 1) {
            $uparr = [
                'status_id' => 0,
            ];
        } else {
            $uparr = [
                'status_id' => 1,
            ];
        }

        $res = Linktype::where('id', $id)->update($uparr);

        $edit_f = '';
        if ($res) {
            DB::commit();

            return Redirect('linktype')->with('success', 'Status updated successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /*publicrelationtype*/
    public function publicrelationtype()
    {
        $data = Publicrelationtype::with(['ptypesub' => function ($query) {
            $query->where('languageid', 1);
        }])->where('delet_flag', 0)->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Public relation', 'message' => 'Public relation', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        return view('backend.masteradmin.Publicrelationtype.Publicrelationtype', compact('data', 'breadcrumbarr', 'navbar', 'language', 'user'));
    }

    /*Store widget positions*/
    public function storepublicrelationtype(Request $request)
    {

        $role_id = Auth::user()->id;
        try {
            $validator = Validator::make(
                $request->all(),
                [

                    'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),

                ],
                [
                    'title.required' => 'Title is required',
                    'title.regex' => 'The title format is invalid',
                    'title.min' => 'Title  minimum length is 3',
                    'title.max' => 'Title  maximum length is 150',

                ]
            );
            //

            if ($validator->fails()) {
                // dd($validator->errors());
                return back()->withInput()->withErrors($validator->errors());
            }
            $storeinfo = new Publicrelationtype([
                'userid' => Auth::user()->id,
                'delet_flag' => 0,
                'status_id' => 1,
            ]);
            // dd($storeinfo);
            $res = $storeinfo->save();
            $typeid = DB::getPdo()->lastInsertId();
            $leng = count($request->sel_lang);

            for ($i = 0; $i < $leng; $i++) {

                if ($typeid) {

                    $store_sub_info = new PublicrelationtypSub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'publicrelationtypeid' => $typeid,
                    ]);
                    $storedetails_sub = $store_sub_info->save();
                }
                // dd($path);
            } //forloopend

            return redirect()->route('admin.publicrelationtype')->with('success', 'created successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    /*edit widget positions*/
    public function editwidget($id)
    {
        $id = Crypt::decryptString($id);
        $edit_f = 'E';
        $keydata = Publicrelationtype::where('id', $id)->first();
        $error = '';
        $data = Publicrelationtype::where('delet_flag', 0)->get();
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Widgetposition', 'message' => 'Widgetposition', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.admin.Widgetpostion.widgetposition', compact('data', 'edit_f', 'error', 'keydata', 'breadcrumbarr', 'navbar', 'user'));
    }

    /*widget positions update*/

    public function updatepublicrelationtype(Request $request)
    {
        try {
            $request->validate([
                'widget' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ]);
            $request->input();

            $uparr = [
                'name' => $request->widget,
            ];

            $res = Publicrelationtype::where('id', $request->hidden_id)->update($uparr);
            $edit_f = '';
            if ($res) {
                return Redirect('admin.publicrelationtype')->with('success', 'Updated successfully', ['edit_f' => $edit_f]);
            } else {
                return back()->withErrors('Not Updated ');
            }
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    /*widget positions delete*/

    public function deletewidget($id)
    {
        $id = Crypt::decryptString($id);

        DB::beginTransaction();
        // $uparr=array(
        //     'delet_flag'=>1,
        //      );
        // $res=Widgetposition::where('id',$id)->update($uparr);
        $res = Publicrelationtype::findOrFail($id)->delete();
        $edit_f = '';
        if ($res) {
            DB::commit();

            return Redirect('widgetpositions')->with('success', 'Deleted successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /*Widget postion Status*/
    public function statuswidgetpost($id)
    {
        $id = Crypt::decryptString($id);

        DB::beginTransaction();
        $uparr = [
            'status_id' => 0,
        ];
        $res = Publicrelationtype::where('id', $id)->update($uparr);

        $edit_f = '';
        if ($res_sub) {
            DB::commit();

            return Redirect('widgetpositions')->with('success', 'Status updated successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /*widget link*/

    /*Department cat type*/
    public function departmentcat()
    {
        $datas = DepartmentCat::with(['depcat_sub' => function ($query) {}])->with(['depcat_field' => function ($q) {
            $q->with(['depfd_sub' => function ($q1) {
                $q1->where('languageid', 1);
            }]);
        }])->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Department category', 'message' => 'Department category', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.DepartmentCat.DepartmentCatlist', compact('datas', 'breadcrumbarr', 'navbar', 'user'));
    }

    public function createdepartmentcat()
    {
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Create Department category', 'message' => 'Create Department category', 'status' => 1],
        ];

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $usertype = usertype::get();
        //   $depfield = DepartmentField::with('depfd_sub')->where('status_id', 1)->get();

        $depfield = DepartmentField::with(['depfd_sub' => function ($query) {
            $query->where('languageid', 1);
        }])->where('status_id', 1)->get();

        $department = Department::with(['dep_sub' => function ($q1) {
            $q1->where('languageid', 1);
        }])->get();

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        return view('backend.masteradmin.DepartmentCat.createDepartmentCat', compact('breadcrumbarr', 'navbar', 'user', 'usertype', 'language', 'depfield', 'department'));
    }

    public function storedepartmentcat(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {

            $request->input();
            $role_id = Auth::user()->id;
            DB::beginTransaction();
            $leng = count($request->sel_lang);
            // dd($leng);

            $storeinfo = new DepartmentCat([
                'userid' => Auth::user()->id,
                'status_id' => 1,
                'departmentfieldid' => $request->depfield,
                'department' => $request->department,
            ]);

            $res = $storeinfo->save();

            $departmentcatid = DB::getPdo()->lastInsertId();

            for ($i = 0; $i < $leng; $i++) {

                if ($departmentcatid) {

                    $store_sub_info = new DepartmentCatSub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'departmentcatid' => $departmentcatid,
                    ]);
                    $storedetails_sub = $store_sub_info->save();
                }
                // dd($path);
            } //forloopend
            DB::commit();

            return redirect()->route('masteradmin.departmentcat')->with('success', 'Created successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();
            DB::rollback();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    public function editdepartmentcat($id)
    {

        $id = Crypt::decryptString($id);

        $edit_f = 'E';

        $keydata = DepartmentCat::with(['depcat_sub' => function ($query) {
            $query->with('lang_sel');
        }])->where('id', $id)->first();
        $error = '';

        $language = Language::orderBy('name')->get();
        $department = Department::with(['dep_sub' => function ($q1) {
            $q1->where('languageid', 1);
        }])->get();
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masterhome'],
            1 => ['title' => 'Department category', 'message' => 'Department category', 'status' => 0, 'link' => '/masteradmin/createdepartmentcat'],
            2 => ['title' => 'Edit Department category', 'message' => 'Edit Department category', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $depfield = DepartmentField::with(['depfd_sub' => function ($query) {
            $query->where('languageid', 1);
        }])->where('status_id', 1)->get();

        return view('backend.masteradmin.DepartmentCat.createDepartmentCat', compact('breadcrumbarr', 'navbar', 'user', 'language', 'edit_f', 'keydata', 'depfield', 'department'));
    }

    public function updatdepartmentcat(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {

            $request->input();
            $role_id = Auth::user()->id;

            $leng = count($request->sel_lang);
            // dd($leng);

            $storeinfo = [
                'userid' => Auth::user()->id,
                'departmentfieldid' => $request->depfield,
                'department' => $request->department,
            ];

            $res = DepartmentCat::where('id', $request->hidden_id)->update($storeinfo);
            $departmentcatid = $request->hidden_id;

            for ($i = 0; $i < $leng; $i++) {

                if ($departmentcatid) {

                    $store_sub_info = [
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'departmentcatid' => $departmentcatid,
                    ];
                    $storedetails_sub = DepartmentCatSub::where('departmentcatid', $request->hidden_id)->where('languageid', $request->sel_lang[$i])->update($store_sub_info);
                }
                // dd($path);
            } //forloopend

            return redirect()->route('masteradmin.departmentcat')->with('success', 'Updated successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    public function deletedepartmentcat($id)
    {
        $id = Crypt::decryptString($id);
        // dd($id);
        DB::beginTransaction();

        $res_sub = DepartmentCatSub::where('departmentcatid', $id)->delete();

        // if($res_sub)
        // {
        $res = DepartmentCat::findOrFail($id)->delete();

        // }
        $edit_f = '';
        if ($res_sub) {
            DB::commit();

            return Redirect('/masteradmin/departmentcategory')->with('success', 'Deleted successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /*Department*/
    public function department()
    {
        $datas = Department::with(['dep_sub' => function ($q1) {
            // $q1->where('languageid', 1);
        }])->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Department', 'message' => 'Department', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Department.Departmentlist', compact('datas', 'breadcrumbarr', 'navbar', 'user'));
    }

    /*Department field*/
    public function createdepartment()
    {
        $datas = Department::where('delet_flag', 0)->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Department', 'message' => 'Department', 'status' => 1],
        ];
        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Department.createDepartment', compact('datas', 'breadcrumbarr', 'navbar', 'user', 'language'));
    }

    public function storedepartment(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {

            $request->input();
            $role_id = Auth::user()->id;
            DB::beginTransaction();
            $leng = count($request->sel_lang);
            // dd($leng);

            $storeinfo = new Department([
                'user_id' => Auth::user()->id,
                'status_id' => 1,
            ]);

            $res = $storeinfo->save();
            $departmentid = DB::getPdo()->lastInsertId();

            for ($i = 0; $i < $leng; $i++) {

                if ($departmentid) {

                    $store_sub_info = new DepartmentSub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'departmentid' => $departmentid,
                    ]);
                    $storedetails_sub = $store_sub_info->save();
                }
                // dd($path);
            } //forloopend
            DB::commit();

            return redirect()->route('masteradmin.department')->with('success', 'Created successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();
            DB::rollback();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    public function editdepartment($id)
    {

        $id = Crypt::decryptString($id);

        $edit_f = 'E';

        $keydata = Department::with(['dep_sub' => function ($query) {}])->where('id', $id)->first();

        $error = '';

        $language = Language::orderBy('name')->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Department ', 'message' => 'Department ', 'status' => 0, 'link' => 'masteradmin/createdepartment'],
            2 => ['title' => 'Edit department ', 'message' => 'Edit department ', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Department.createDepartment', compact('breadcrumbarr', 'navbar', 'user', 'language', 'edit_f', 'keydata'));
    }

    public function updatdepartment(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {

            $request->input();
            $role_id = Auth::user()->id;

            $leng = count($request->sel_lang);
            // dd($leng);

            $storeinfo = [
                'user_id' => Auth::user()->id,
            ];

            $res = Department::where('id', $request->hidden_id)->update($storeinfo);
            $departmentid = $request->hidden_id;

            for ($i = 0; $i < $leng; $i++) {

                if ($departmentid) {

                    $store_sub_info = [
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'departmentid' => $departmentid,
                    ];
                    $storedetails_sub = DepartmentSub::where('departmentid', $request->hidden_id)->where('languageid', $request->sel_lang[$i])->update($store_sub_info);
                }
                // dd($path);
            } //forloopend

            return redirect()->route('masteradmin.department')->with('success', 'Updated successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    /*Department field*/
    public function departmentfields()
    {
        $datas = DepartmentField::with(['depfd_sub' => function ($q1) {
            $q1->where('languageid', 1);
        }])->with(['department' => function ($q2) {
            $q2->with(['dep_sub' => function ($q3) {
                $q3->where('languageid', 1);
            }]);

        }])->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Department Field', 'message' => 'Department Field', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.DepartmentField.DepartmentFieldlist', compact('datas', 'breadcrumbarr', 'navbar', 'user'));
    }

    public function createdepartmentfields()
    {
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Department Field', 'message' => 'Department Field', 'status' => 1],
        ];

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $usertype = usertype::get();
        $department = Department::with(['dep_sub' => function ($q1) {
            $q1->where('languageid', 1);
        }])->get();
        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        return view('backend.masteradmin.DepartmentField.createDepartmentField', compact('breadcrumbarr', 'navbar', 'user', 'usertype', 'language', 'department'));
    }

    public function storedepartmentfields(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {

            $request->input();
            $role_id = Auth::user()->id;
            DB::beginTransaction();
            $leng = count($request->sel_lang);
            // dd($leng);

            $storeinfo = new DepartmentField([
                'user_id' => Auth::user()->id,
                'status_id' => 1,
                'departmentId' => $request->department,
            ]);

            $res = $storeinfo->save();
            $depfieldidid = DB::getPdo()->lastInsertId();

            for ($i = 0; $i < $leng; $i++) {

                if ($depfieldidid) {

                    $store_sub_info = new DepartmentFieldsSub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'departmentfieldid' => $depfieldidid,
                    ]);
                    $storedetails_sub = $store_sub_info->save();
                }
                // dd($path);
            } //forloopend
            DB::commit();

            return redirect()->route('masteradmin.departmentfields')->with('success', 'Created successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();
            DB::rollback();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    public function editdepartmentfields($id)
    {

        $id = Crypt::decryptString($id);

        $edit_f = 'E';

        $keydata = DepartmentField::with(['depfd_sub' => function ($query) {}])->where('id', $id)->first();

        $error = '';

        $department = Department::with(['dep_sub' => function ($q1) {
            $q1->where('languageid', 1);
        }])->get();

        $language = Language::orderBy('name')->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Department field', 'message' => 'Department field', 'status' => 0, 'link' => 'masteradmin/createdepartmentfields'],
            2 => ['title' => 'Edit department field', 'message' => 'Edit department field', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.DepartmentField.createDepartmentField', compact('breadcrumbarr', 'navbar', 'user', 'language', 'edit_f', 'keydata', 'department'));
    }

    public function updatdepartmentfields(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {

            $request->input();
            $role_id = Auth::user()->id;

            $leng = count($request->sel_lang);
            // dd($leng);

            $storeinfo = [
                'user_id' => Auth::user()->id,
                'departmentId' => $request->department,
            ];

            $res = DepartmentField::where('id', $request->hidden_id)->update($storeinfo);
            $depfid = $request->hidden_id;

            for ($i = 0; $i < $leng; $i++) {

                if ($depfid) {

                    $store_sub_info = [
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'departmentfieldid' => $depfid,
                    ];
                    $storedetails_sub = DepartmentFieldsSub::where('departmentfieldid', $request->hidden_id)->where('languageid', $request->sel_lang[$i])->update($store_sub_info);
                }
                // dd($path);
            } //forloopend

            return redirect()->route('masteradmin.departmentfields')->with('success', 'Updated successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    public function deletedepartmentfields($id)
    {
        $id = Crypt::decryptString($id);
        // dd($id);
        DB::beginTransaction();

        $res_sub = DepartmentFieldsSub::where('departmentfieldid', $id)->delete();

        // if($res_sub)
        // {
        $res = DepartmentField::findOrFail($id)->delete();

        // }
        $edit_f = '';
        if ($res_sub) {
            DB::commit();

            return Redirect('/masteradmin/departmentfields')->with('success', 'Deleted successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /*offices*/
    public function offices()
    {
        // $datas = Office::with(['office_sub' => function ($query) {}])->get();
        $datas = Office::with(['office_sub' => function ($query) {
     
        }])->orderBy('orderno')->get();
        
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Office', 'message' => 'Office', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Office.Officelist', compact('datas', 'breadcrumbarr', 'navbar', 'user'));
    }

    public function createoffice()
    {
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Office', 'message' => 'Office', 'status' => 1],
        ];

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $usertype = usertype::get();

        $departcats = DepartmentCat::with(['depcat_sub' => function ($q2) {
            $q2->where('languageid', 1);
        }])
            ->with(['depcat_field' => function ($q) {
                $q->with(['depfd_sub' => function ($q1) {
                    $q1->where('languageid', 1);
                }]);
            }])->get();

        $depfield = DepartmentField::with(['depfd_sub' => function ($query) {
            $query->where('languageid', 1);
        }])->where('status_id', 1)->get();

        $department = Department::with(['dep_sub' => function ($q1) {
            $q1->where('languageid', 1);
        }])->get();

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $depsubmenus = DepartmentSubmenu::with(['dep_submenu' => function ($query) {
            $query->where('languageid', 1);
        }])->get();

        return view('backend.masteradmin.Office.createoffice', compact('depsubmenus','breadcrumbarr', 'navbar', 'user', 'usertype', 'language', 'departcats', 'depfield', 'department'));
    }
    public function Orderchangeofficelist_form(Request $request)
    {
        try {
            $id = Crypt::decryptString($request->id); /*dd($request->val);*/
           
            $res = Office::where('id', '=', $id)->update(['orderno' => $request->val]);
            //
        } catch (\Exception $exception) {
            /*\LogActivity::addToLog($exception->getMessage());
    $data = \LogActivity::logLatestItem();
    $error = array('er' => 'Please contact admin; the error code is ERROR' . $data->id);
    return view('Siteadmin.dashboard', compact('error'));*/
        } catch (\Throwable $exception) {
            /*\LogActivity::addToLog($exception->getMessage());
    $data = \LogActivity::logLatestItem();
    $error = array('er' => 'Please contact admin; the error code is ERROR' . $data->id);
    return view('Siteadmin.dashboard', compact('error'));*/
        } catch (\Illuminate\Database\QueryException $exception) {
            /*\LogActivity::addToLog($exception->getMessage());
    $data = \LogActivity::logLatestItem();
    return back()->withInput()->withErrors('Please contact admin; the error code is ERROR' . $data->id);*/
        }
        if ($res) {
            $success = 'Status Updated!';
            return response()->json(['html' => $success]);
        } else {
            $error = 'Not updated status';
            return response()->json(['html' => $error]);
        }
    }

    public function depacategorysel(Request $request)
    {
        $departmentFieldId = $request->departmentFieldId;

        $departcats = DepartmentCat::with(['depcat_sub' => function ($q2) {
            $q2->where('languageid', 1);
        }])->with(['depcat_field' => function ($q) {
            $q->with(['depfd_sub' => function ($q1) {
                $q1->where('languageid', 1);
            }]);

        }])->where('departmentfieldid', $departmentFieldId)->get();

        return response()->json(['departcats' => $departcats]);

    }

    public function editoffice($id)
    {

        $id = Crypt::decryptString($id);

        $edit_f = 'E';

        $keydata = Office::with(['office_sub' => function ($query) {
            $query->with('lang');
        }])->where('id', $id)->first();

        $selectedDepSubs = explode(',', $keydata->submenus);
        // dd($selectedDepSubs);
        $error = '';

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Office', 'message' => 'Office', 'status' => 1],
        ];

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $usertype = usertype::get();

        $departcats = DepartmentCat::with(['depcat_sub' => function ($q2) {
            $q2->where('languageid', 1);
        }])
            ->with(['depcat_field' => function ($q) {
                $q->with(['depfd_sub' => function ($q1) {
                    $q1->where('languageid', 1);
                }]);
            }])->get();

        $depfield = DepartmentField::with(['depfd_sub' => function ($query) {
            $query->where('languageid', 1);
        }])->where('status_id', 1)->get();

        $department = Department::with(['dep_sub' => function ($q1) {
            $q1->where('languageid', 1);
        }])->get();

        $depsubmenus = DepartmentSubmenu::with(['dep_submenu' => function ($query) {
            $query->where('languageid', 1);
        }])->get();
  
        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        return view('backend.masteradmin.Office.createoffice', compact('breadcrumbarr','depsubmenus','selectedDepSubs', 'navbar', 'user', 'usertype', 'language', 'departcats', 'depfield', 'department', 'keydata', 'edit_f'));
    }

    public function storeoffice(Request $request)
    {
        // dd($request->all());
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
                    'department' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                    'depfield' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                    'depcat' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                    // 'imageUpload' => 'some',
                ], [
                    'title.required' => 'Title is required',
                    'title.min' => 'Title  minimum lenght is 2',
                    'title.max' => 'Title  maximum lenght is 50',
                    'title.regex' => 'Invalid characters not allowed for Title',

                ]);
            if ($validator->fails()) {
                // dd($validator->errors());
                return back()->withInput()->withErrors($validator->errors());
            }
            DB::beginTransaction();

            $role = Auth::user()->role_id;
            $leng = count($request->sel_lang);

            $date = date('dmYH:i:s');
            $office_view_flag = $request->has('office_view_flag') ? 1 : 0;

            $dep_sub_ids = implode(',', $request->dep_sub_ids);

            $latestOrderNumber = Office::max('orderno');
            $nextOrderNumber = $latestOrderNumber ? $latestOrderNumber + 1 : 1;

            if ($request->imageUpload) {
                $date = date('dmYH:i:s');
                $imageName = 'office'.$date.'.'.$request->imageUpload->extension();
                $filename = $imageName;
                $path = $request->file('imageUpload')->storeAs('/assets/backend/uploads/Officelogo/', $imageName, 'myfile');
                $storeinfo = new Office([
                    'user_id' => Auth::user()->id,
                    'status_id' => 1,
                    'department' => $request->department,
                    'depafields' => $request->depfield,
                    'depcat' => $request->depcat,
                    'office_view_flag' => $office_view_flag,
                    'logo' => $imageName,
                    'submenus' => $dep_sub_ids,
                    'orderno'  => $nextOrderNumber
                ]);

            } else {
                $storeinfo = new Office([
                    'user_id' => Auth::user()->id,
                    'status_id' => 1,
                    'department' => $request->department,
                    'depafields' => $request->depfield,
                    'depcat' => $request->depcat,
                    'office_view_flag' => $office_view_flag,
                    'submenus' => $dep_sub_ids,
                    'orderno'  => $nextOrderNumber
                ]);

            }

            $res = $storeinfo->save();
            $officeid = DB::getPdo()->lastInsertId();

            if ($officeid) {

                for ($i = 0; $i < $leng; $i++) {
                    $store_sub_info = new OfficeSub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'officeid' => $officeid,
                    ]);
                    $storedetails_sub = $store_sub_info->save();
                }//forloop
                // dd($path);
            }//ifend
            // dd($storeinfo->id);
            // return redirect()->route('gallery')->with('success','created successfully');
            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masterhome'],
                1 => ['title' => 'List offices', 'message' => 'List offices', 'status' => 0, 'link' => '/masteradmin/offices'],
                2 => ['title' => 'Create offices Item', 'message' => 'Create offices', 'status' => 2],
            ];
            $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
            $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
            $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

            DB::commit();

            return redirect()->route('masteradmin.offices')->with('success', 'Created successfully');
        } catch (ModelNotFoundException $exception) {
            DB::rollback();

            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    public function updateoffice(Request $request)
    {
        // dd($request->all());
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
                    'department' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                    'depfield' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                    'depcat' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                    // 'imageUpload'        => 'required',
                ], [
                    'title.required' => 'Title is required',
                    'title.min' => 'Title  minimum lenght is 2',
                    'title.max' => 'Title  maximum lenght is 50',
                    'title.regex' => 'Invalid characters not allowed for Title',

                ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            DB::beginTransaction();
            $office_view_flag = $request->has('office_view_flag') ? 1 : 0;
            // dd($office_view_flag);
            $role = Auth::user()->role_id;
            $leng = count($request->sel_lang);

            $date = date('dmYH:i:s');

            $dep_sub_ids = implode(',', $request->dep_sub_ids);

            if ($request->imageUpload) {
                $date = date('dmYH:i:s');
                $imageName = 'office'.$date.'.'.$request->imageUpload->extension();
                $filename = $imageName;
                $path = $request->file('imageUpload')->storeAs('/assets/backend/uploads/Officelogo/', $imageName, 'myfile');

                $storeinfo = [
                    'user_id' => Auth::user()->id,
                    'status_id' => 1,
                    'department' => $request->department,
                    'depafields' => $request->depfield,
                    'depcat' => $request->depcat,
                    'logo' => $imageName,
                    'office_view_flag' => $office_view_flag,
                    'submenus' => $dep_sub_ids,
                ];

            } else {
                $storeinfo = [
                    'user_id' => Auth::user()->id,
                    'status_id' => 1,
                    'department' => $request->department,
                    'depafields' => $request->depfield,
                    'depcat' => $request->depcat,
                    'office_view_flag' => $office_view_flag,
                    'submenus' => $dep_sub_ids,
                ];

            }

            $res = Office::where('id', $request->hidden_id)->update($storeinfo);

            $officeid = $request->hidden_id;

            if ($officeid) {

                for ($i = 0; $i < $leng; $i++) {
                    $store_sub_info = [
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'officeid' => $officeid,
                    ];
                    $storedetails_sub = OfficeSub::where('officeid', $request->hidden_id)->where('languageid', $request->sel_lang[$i])->update($store_sub_info);

                }//forloop
                // dd($path);
            }//ifend
            // dd($storeinfo->id);
            // return redirect()->route('gallery')->with('success','created successfully');
            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masterhome'],
                1 => ['title' => 'List offices', 'message' => 'List offices', 'status' => 0, 'link' => '/masteradmin/offices'],
                2 => ['title' => 'Edit offices Item', 'message' => 'Edit offices', 'status' => 2],
            ];
            $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
            $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
            $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

            DB::commit();

            return redirect()->route('masteradmin.offices')->with('success', 'Created successfully');
        } catch (ModelNotFoundException $exception) {
            DB::rollback();

            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }
    public function deleteoffice($id)
    {
        $id = Crypt::decryptString($id);
        // dd($id);
        DB::beginTransaction();

        $res_sub = OfficeSub::where('officeid', $id)->delete();

        if ($res_sub) {
            $res = Office::findOrFail($id)->delete();
        }
        $edit_f = '';
        if ($res_sub) {
            DB::commit();
            return redirect()->route('masteradmin.offices')->with('success', 'Deleted successfully');
            
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }
    /*Article type*/
    public function announcementtype()
    {
        $data = AnnouncementType::with(['announcetypesub' => function ($query) {}])->get();

        $role_id = Auth::user()->id;

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Announcement type', 'message' => 'Announcement type', 'status' => 1],
        ];

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $usertype = usertype::get();

        return view('backend.masteradmin.AnnouncementType.announcementtypelist', compact('data', 'breadcrumbarr', 'usertype', 'navbar', 'user'));
    }

    public function createannouncementtype()
    {

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $role_id = Auth::user()->id;

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Alert type', 'message' => 'Alert type', 'status' => 0, 'link' => '/masteradmin/announcementtype'],
            2 => ['title' => 'Create Alert type', 'message' => 'Create Alert type', 'status' => 1],
        ];

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        $Navid = Componentpermission::where('url', '/'.$route)->select('id')->first();

        return view('backend.masteradmin.AnnouncementType.createannouncementtype', compact('breadcrumbarr', 'language', 'navbar', 'user', 'Navid'));
    }

    public function storeannouncementtype(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {
            $role_id = Auth::user()->id;

            $leng = count($request->sel_lang);

            $storeinfo = new AnnouncementType([
                'userid' => Auth::user()->id,
                'status_id' => 1,
            ]);
            // dd($storeinfo);
            $res = $storeinfo->save();
            $announctypeid = DB::getPdo()->lastInsertId();

            for ($i = 0; $i < $leng; $i++) {

                if ($announctypeid) {

                    $store_sub_info = new AnnouncementTypeSub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'announcementtypeid' => $announctypeid,
                    ]);
                    $storedetails_sub = $store_sub_info->save();
                }
                // dd($path);
            } //forloopend

            return redirect()->route('masteradmin.announcementtype')->with('success', 'created successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    public function editannouncementtype($id)
    {

        $id = Crypt::decryptString($id);
        $edit_f = 'E';

        $keydata = AnnouncementType::with(['announcetypesub' => function ($query) {}])->where('id', $id)->first();

        $error = '';

        $data = AnnouncementType::with(['announcetypesub' => function ($query) {}])->get();

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Alert type', 'message' => 'Alert type', 'status' => 0, 'link' => '/masteradmin/announcementtype'],
            2 => ['title' => 'Create Alert type', 'message' => 'Create Alert type', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.AnnouncementType.createannouncementtype', compact('data', 'edit_f', 'error', 'keydata', 'breadcrumbarr', 'navbar', 'language', 'user'));
    }

    public function updateannouncementtype(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {

            for ($i = 0; $i < count($request->title); $i++) {
                $res = AnnouncementTypeSub::where('announcementtypeid', $request->hidden_id)->where('languageid', $request->sel_lang[$i])
                    ->update([
                        'title' => $request->title[$i],
                    ]);
                // dd($request->sel_lang[$i]);

            } //forloopend

            if ($res) {
                DB::commit();

                return Redirect('masteradmin/announcementtype')->with('success', 'Updated successfully');
            } else {
                DB::rollback();

                return back()->withErrors('Not Updated ');
            }
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    public function deleteannouncementtype($id)
    {
        $id = Crypt::decryptString($id);
        // dd($id);
        DB::beginTransaction();

        $res_sub = AnnouncementTypeSub::where('announcementtypeid', $id)->delete();

        if ($res_sub) {
            $res = AnnouncementType::findOrFail($id)->delete();
        }
        $edit_f = '';
        if ($res_sub) {
            DB::commit();

            return Redirect('masteradmin/announcementtype')->with('success', 'Deleted successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    public function statusannouncementtype($id)
    {
        $id = Crypt::decryptString($id);
        $status = AnnouncementType::where('id', $id)->value('status_id');

        DB::beginTransaction();
        if ($status == 1) {
            $uparr = [
                'status_id' => 0,
            ];
        } else {
            $uparr = [
                'status_id' => 1,
            ];
        }

        $res = AnnouncementType::where('id', $id)->update($uparr);

        $edit_f = '';
        if ($res) {
            DB::commit();

            return Redirect('masteradmin/announcementtype')->with('success', 'Status updated successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /*WellnessTip Type*/
    public function WellnessTipType()
    {
        $datas = wellnessTipType::with(['wellnessTipTypesub' => function ($query) {}])->get();

        $role_id = Auth::user()->id;

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masterhome'],
            1 => ['title' => 'Wellness TipType list', 'message' => 'Wellness Tip Type list', 'status' => 1],
        ];

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $usertype = usertype::get();

        return view('backend.masteradmin.WellnessTipType.WellnessTipTypelist', compact('datas', 'breadcrumbarr', 'usertype', 'navbar', 'user'));
    }

    public function createWellnessTipType()
    {

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Wellness TipType', 'message' => 'Wellness TipType', 'status' => 0, 'link' => '/admin/WellnessTipType'],
            2 => ['title' => 'Create Wellness TipType', 'message' => 'Create Wellness TipType', 'status' => 1],
        ];

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        $Navid = Componentpermission::where('url', '/'.$route)->select('id')->first();

        return view('backend.masteradmin.WellnessTipType.createWellnessTipType', compact('breadcrumbarr', 'language', 'navbar', 'user', 'Navid'));
    }

    public function storeWellnessTipType(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {
            $role_id = Auth::user()->id;
            DB::beginTransaction();
            $leng = count($request->sel_lang);
            $date = date('dmYH:i:s');

            if (isset($request->iconUpload)) {

                $image = $request->file('iconUpload');

                $iconUpload = time().'WellnessIcon'.$image->getClientOriginalName();

                $imagePath1 = $image->storeAs('/assets/backend/uploads/WellnessIcon', $iconUpload, 'myfile');

            }
            if (isset($request->imageUpload)) {
                $image = $request->file('imageUpload');

                $imageUpload = time().'WellnessBgImg'.$image->getClientOriginalName();

                $imagePath2 = $image->storeAs('/assets/backend/uploads/WellnessBgImage', $imageUpload, 'myfile');

            }

            $storeinfo = new wellnessTipType([
                'user_id' => Auth::user()->id,
                'iconimg' => $iconUpload ?? null,
                'backgroundimg' => $imageUpload ?? null,
                'status_id' => 1,
            ]);
            // dd($storeinfo);
            $res = $storeinfo->save();
            $wellnesstiptypeid = DB::getPdo()->lastInsertId();

            for ($i = 0; $i < $leng; $i++) {

                if ($wellnesstiptypeid) {

                    $store_sub_info = new wellnessTipTypeSub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'wellnessTipTypesid' => $wellnesstiptypeid,
                    ]);
                    $storedetails_sub = $store_sub_info->save();
                }
                // dd($path);
            } //forloopend
            DB::commit();

            return redirect()->route('masteradmin.WellnessTipType')->with('success', 'created successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            DB::rollback();
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    public function editWellnessTipType($id)
    {

        $id = Crypt::decryptString($id);
        $edit_f = 'E';
        $keydata = wellnessTipType::with(['wellnessTipTypesub' => function ($query) {
            $query->with('lang_sel');
        }])->where('id', $id)->first();

        $error = '';

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Wellness TipType', 'message' => 'Wellness TipType', 'status' => 0, 'link' => '/admin/WellnessTipType'],
            2 => ['title' => 'Edit Wellness TipType', 'message' => 'Edit Wellness TipType', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.WellnessTipType.createWellnessTipType', compact('edit_f', 'error', 'keydata', 'breadcrumbarr', 'navbar', 'language', 'user'));
    }

    public function updateWellnessTipType(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {
            DB::beginTransaction();
            if (isset($request->iconUpload) || isset($request->imageUpload)) {
                if (isset($request->iconUpload)) {

                    $image = $request->file('iconUpload');

                    $iconUpload = time().'WellnessIcon'.$image->getClientOriginalName();

                    $imagePath1 = $image->storeAs('/assets/backend/uploads/WellnessIcon', $iconUpload, 'myfile');

                }
                if (isset($request->imageUpload)) {
                    $image = $request->file('imageUpload');

                    $imageUpload = time().'WellnessBgImg'.$image->getClientOriginalName();

                    $imagePath2 = $image->storeAs('/assets/backend/uploads/WellnessBgImage', $imageUpload, 'myfile');

                }

                $storeinfo = wellnessTipType::where('id', $request->hidden_id)
                    ->update([
                        'iconimg' => $iconUpload ?? null,
                        'backgroundimg' => $imageUpload ?? null,
                    ]);
            }

            for ($i = 0; $i < count($request->sel_lang); $i++) {
                $res = wellnessTipTypeSub::where('id', $request->hidden_id)->where('languageid', $request->sel_lang[$i])
                    ->update([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'wellnessTipTypesid' => $request->hidden_id,
                    ]);
            }

            if ($res) {
                DB::commit();

                return Redirect('masteradmin/WellnessTipType')->with('success', 'Updated successfully');
            } else {
                DB::rollback();

                return back()->withErrors('Not Updated ');
            }
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    public function deleteWellnessTipType($id)
    {
        $id = Crypt::decryptString($id);
        // dd($id);
        DB::beginTransaction();

        $res_sub = wellnessTipTypeSub::where('wellnessTipTypesid', $id)->delete();

        if ($res_sub) {
            $res = wellnessTipType::findOrFail($id)->delete();
        }
        $edit_f = '';
        if ($res_sub) {
            DB::commit();

            return Redirect('masteradmin/WellnessTipType')->with('success', 'Deleted successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    public function designation()
    {

        $data = Designation::with(['des_sub' => function ($query) {
            $query->where('delet_flag', 0);
           
        }])
        ->orderBy(function($query){
            $query->select('title') // Replace 'some_field' with the actual field you want to order by
                  ->from('designationsubs')
                  ->whereColumn('designationsubs.designationid', 'designations.id')
                  ->orderBy('title', 'asc') // Order by the same field
                  ->limit(1); // Limit to 1 to get the correct ordering
        })
        ->where('delet_flag', 0)->get();
        // dd($data);

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Designation', 'message' => 'Designation', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Designation.designation', compact('data', 'breadcrumbarr', 'navbar', 'language', 'user'));
    }

    /*Store Designation*/
    public function storedesignation(Request $request)
    {

        try {

            $validator = Validator::make(
                $request->all(),
                [
                    'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
                ], [
                    'title.required' => 'Title is required',
                    'title.min' => 'Title  minimum lenght is 2',
                    'title.max' => 'Title  maximum lenght is 50',
                    'title.regex' => 'Invalid characters not allowed for Title',

                ]);
            if ($validator->fails()) {
                // dd($validator->errors());
                return back()->withInput()->withErrors($validator->errors());
            }

            DB::beginTransaction();

            $leng = count($request->sel_lang);

            $storeinfo = new Designation([
                'delet_flag' => 0,
                'status_id' => 1,
                'userid' => Auth::user()->id,
            ]);
            $res = $storeinfo->save();
            $des_id = DB::getPdo()->lastInsertId();
            if ($res) {
                for ($i = 0; $i < $leng; $i++) {
                    $storeinfo_sub = new Designationsub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'designationid' => $des_id,
                        'delet_flag' => 0,
                        'status_id' => 1,
                        'userid' => Auth::user()->id,
                    ]);
                    $storedetails_sub = $storeinfo_sub->save();
                }

                if ($storedetails_sub) {
                    DB::commit();

                    return Redirect('/masteradmin/Designation')->with('success', 'created successfully');
                } else {
                    DB::rollback();

                    return back()->withErrors('Not  ');
                }
            }

        } catch (ModelNotFoundException $exception) {
            DB::rollback();
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }

    }

    /*edit Designation*/
    public function editdesignation($id)
    {

        $id = Crypt::decryptString($id);
        $edit_f = 'E';
        $keydata = Designation::with(['des_sub' => function ($query) {
            $query->where('delet_flag', 0);
        }])->where('delet_flag', 0)->where('id', $id)->first();
        $error = '';
        $data = Designation::with(['des_sub' => function ($query) {
            $query->where('delet_flag', 0);
        }])->where('delet_flag', 0)->get();

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Designation', 'message' => 'Designation', 'status' => 0, 'link' => '/masteradmin/designation'],
            2 => ['title' => 'Edit Designation', 'message' => 'Edit Designation', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Designation.designation', compact('data', 'edit_f', 'error', 'keydata', 'breadcrumbarr', 'navbar', 'language', 'user'));
    }

    /*Designation  update*/
    public function updatedesignation(Request $request)
    {
        //  dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ], [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]);
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {

            for ($i = 0; $i < count($request->title); $i++) {
                $res = Designationsub::where('designationid', $request->hidden_id)->where('languageid', $request->sel_lang[$i])
                    ->update([
                        'title' => $request->title[$i],
                    ]);
                // dd($request->sel_lang[$i]);

            } //forloopend

            if ($res) {
                DB::commit();

                return Redirect('/masteradmin/Designation')->with('success', 'Updated successfully');
            } else {
                DB::rollback();

                return back()->withErrors('Not Updated ');
            }

        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }

    }

    /*Designation Status*/
    public function statusdesignation($id)
    {
        $id = Crypt::decryptString($id);
        $status = Designation::where('id', $id)->value('status_id');

        DB::beginTransaction();
        if ($status == 1) {
            $uparr = [
                'status_id' => 0,
            ];
        } else {
            $uparr = [
                'status_id' => 1,
            ];
        }

        $res = Designation::where('id', $id)->update($uparr);

        $edit_f = '';
        if ($res) {
            DB::commit();

            return Redirect('/masteradmin/Designation')->with('success', 'Status updated successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    /* Designation delete*/
    public function deletedesignation($id)
    {
        $id = Crypt::decryptString($id);
        // dd($id);
        DB::beginTransaction();

        $res_sub = Designationsub::where('designationid', $id)->delete();

        if ($res_sub) {
            $res = Designation::findOrFail($id)->delete();
        }
        $edit_f = '';
        if ($res_sub) {
            DB::commit();

            return Redirect('/masteradmin/Designation')->with('success', 'Deleted successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }

    public function keywordtag()
    {
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Keyword tag', 'message' => 'Keyword tag', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $datas = Keywordtag::with(['keytag_sub' => function ($q1) {
            // $q1->where('languageid', 1);
        }])->get();

        return view('backend.masteradmin.Keytags.Keywordtaglist', compact('datas', 'breadcrumbarr', 'navbar', 'user'));
    }

    public function createkeywordtag()
    {
        $datas = Department::where('delet_flag', 0)->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Keyword tag', 'message' => 'Keyword tag', 'status' => 1],
        ];
        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Keytags.createKeywordtag', compact('datas', 'breadcrumbarr', 'navbar', 'user', 'language'));
    }

    public function storekeywordtag(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {

            $request->input();
            $role_id = Auth::user()->id;
            DB::beginTransaction();
            $leng = count($request->sel_lang);
            // dd($leng);

            $storeinfo = new Keywordtag([
                'userid' => Auth::user()->id,
                'delet_flag' => 0,
                'status_id' => 1,
            ]);

            $res = $storeinfo->save();
            $keywordtagid = DB::getPdo()->lastInsertId();

            for ($i = 0; $i < $leng; $i++) {

                if ($keywordtagid) {

                    $store_sub_info = new Keywordtagsub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'keywordtagid' => $keywordtagid,
                    ]);
                    $storedetails_sub = $store_sub_info->save();
                }
                // dd($path);
            } //forloopend
            DB::commit();

            return redirect()->route('masteradmin.keywordtag')->with('success', 'Created successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();
            DB::rollback();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    public function editkeywordtag($id)
    {

        $id = Crypt::decryptString($id);

        $edit_f = 'E';

        $keydata = Keywordtag::with(['keytag_sub' => function ($query) {}])->where('id', $id)->first();

        $error = '';

        $language = Language::orderBy('name')->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Keyword tags ', 'message' => 'Keyword tags ', 'status' => 0, 'link' => 'masteradmin/createkeywordtag'],
            2 => ['title' => 'Edit Keyword tags ', 'message' => 'Edit Keyword tags ', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Keytags.createKeywordtag', compact('breadcrumbarr', 'navbar', 'user', 'language', 'edit_f', 'keydata'));
    }

    public function updatekeywordtag(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make(
            $request->all(),
            [
                'sel_lang.*' => app('App\Http\Controllers\Commonfunctions')->getsel2valreq(),
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ],
            [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]
        );
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {

            $request->input();
            $role_id = Auth::user()->id;

            $leng = count($request->sel_lang);
            // dd($leng);

            $storeinfo = [
                'userid' => Auth::user()->id,
            ];

            $res = Keywordtag::where('id', $request->hidden_id)->update($storeinfo);
            $Keywordtagid = $request->hidden_id;

            for ($i = 0; $i < $leng; $i++) {

                if ($Keywordtagid) {

                    $store_sub_info = [
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'keywordtagid' => $Keywordtagid,
                    ];
                    $storedetails_sub = Keywordtagsub::where('keywordtagid', $request->hidden_id)->where('languageid', $request->sel_lang[$i])->update($store_sub_info);
                }
                // dd($path);
            } //forloopend

            return redirect()->route('masteradmin.keywordtag')->with('success', 'Updated successfully');
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    public function deletekeywordtag($id)
    {
        $id = Crypt::decryptString($id);
        // dd($id);
        DB::beginTransaction();

        $res_sub = Keywordtagsub::where('keywordtagid', $id)->delete();

        if ($res_sub) {
            $res = Keywordtag::findOrFail($id)->delete();
        }
        $edit_f = '';
        if ($res_sub) {
            DB::commit();

            return Redirect('masteradmin/keywordtag')->with('success', 'Deleted successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }
    public function departmentsubmenu()
    {
        $data = DepartmentSubmenu::with(['dep_submenu' => function ($query) {
           
        }])->get();
        // dd($data);

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Designation', 'message' => 'Designation', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Depsubmenu.depsubmenu', compact('data', 'breadcrumbarr', 'navbar', 'language', 'user'));

    }

    public function storedepartmentsubmenu(Request $request)
    {

        try {

            $validator = Validator::make(
                $request->all(),
                [
                    'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
                ], [
                    'title.required' => 'Title is required',
                    'title.min' => 'Title  minimum lenght is 2',
                    'title.max' => 'Title  maximum lenght is 50',
                    'title.regex' => 'Invalid characters not allowed for Title',

                ]);
            if ($validator->fails()) {
                // dd($validator->errors());
                return back()->withInput()->withErrors($validator->errors());
            }

            DB::beginTransaction();

            $leng = count($request->sel_lang);

            $storeinfo = new DepartmentSubmenu([
                'status' => 1,
                'userid' => Auth::user()->id,
                'single_article'=>$request->single_article
            ]);
            $res = $storeinfo->save();
            $des_id = DB::getPdo()->lastInsertId();
            if ($res) {
                for ($i = 0; $i < $leng; $i++) {
                    $storeinfo_sub = new DepartmentSubmenuSub([
                        'languageid' => $request->sel_lang[$i],
                        'title' => $request->title[$i],
                        'depsubmenuid' => $des_id,
                    ]);
                    $storedetails_sub = $storeinfo_sub->save();
                }

                if ($storedetails_sub) {
                    DB::commit();

                    return Redirect('/master/departmentsubmenu')->with('success', 'created successfully');
                } else {
                    DB::rollback();

                    return back()->withErrors('Not  ');
                }
            }

        } catch (ModelNotFoundException $exception) {
            DB::rollback();
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }
    /*edit Department*/
    public function editdepartmentsubmenu($id)
    {

        $id = Crypt::decryptString($id);
        $edit_f = 'E';
        $keydata = DepartmentSubmenu::with(['dep_submenu' => function ($query) {

        }])->where('id', $id)->first();
        $error = '';
        $data = DepartmentSubmenu::with(['dep_submenu' => function ($query) {

        }])->get();

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Designation', 'message' => 'Designation', 'status' => 0, 'link' => '/masteradmin/designation'],
            2 => ['title' => 'Edit Designation', 'message' => 'Edit Designation', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.masteradmin.Depsubmenu.depsubmenu', compact('data', 'edit_f', 'error', 'keydata', 'breadcrumbarr', 'navbar', 'language', 'user'));
    }
    /*Dep sub menu  update*/
    public function updatedepartmentsubmenu(Request $request)
    {
        //  dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'title.*' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ], [
                'title.required' => 'Title is required',
                'title.min' => 'Title  minimum lenght is 2',
                'title.max' => 'Title  maximum lenght is 50',
                'title.regex' => 'Invalid characters not allowed for Title',

            ]);
        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        try {
            $res = DepartmentSubmenu::where('id', $request->hidden_id)
            ->update([
                'single_article'=>$request->single_article
            ]);

            for ($i = 0; $i < count($request->title); $i++) {
                $res = DepartmentSubmenuSub::where('depsubmenuid', $request->hidden_id)->where('languageid', $request->sel_lang[$i])
                    ->update([
                        'title' => $request->title[$i],
                    ]);
                // dd($request->sel_lang[$i]);

            } //forloopend

            if ($res) {
                DB::commit();

                return Redirect('/master/departmentsubmenu')->with('success', 'Updated successfully');
            } else {
                DB::rollback();

                return back()->withErrors('Not Updated ');
            }

        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }
    public function statusdepartmenusubmenu($id)
    {
        $id = Crypt::decryptString($id);
        $status = DepartmentSubmenu::where('id', $id)->value('status');

        DB::beginTransaction();
        if ($status == 1) {
            $uparr = [
                'status' => 0,
            ];
        } else {
            $uparr = [
                'status' => 1,
            ];
        }

        $res = DepartmentSubmenu::where('id', $id)->update($uparr);

        $edit_f = '';
        if ($res) {
            DB::commit();

            return Redirect('/master/departmentsubmenu')->with('success', 'Status updated successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }
}
