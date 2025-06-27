<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use App\Models\Language;
use App\Models\Component;
use App\Models\Componentpermission;
use App\Models\Suggestionitem;
use App\Models\User;
use Crypt;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Redirect;

class OfficerController extends Controller
{
    public function officerhome(Request $request)
    {
        $role_id = Auth::user()->id;
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $userIp = $request->ip();
        $carddata = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $datacount = Suggestion::where('userid',$role_id)->count();
        $keydata = User::with(['designationdata' => function($q1){
                      $q1->with(['des_sub' => function($q2){
                        $q2->where('languageid', 1);
                      }]);
        }])->with(['officedata' => function($q3){
            $q3->with(['office_sub' => function($q4){
                $q4->where('languageid', 1);
              }]);
        }])->where('id', $role_id)->first();

        return view('backend.officer.officerhome', compact('navbar', 'user', 'userIp', 'carddata','datacount','keydata'));
    }

    public function suggestion()
    {
        $role_id = Auth::user()->id;
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/officerhome'],
            1 => ['title' => 'Suggestion', 'message' => 'Suggestion', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $data = Suggestion::where('userid',$role_id)->get();

        return view('backend.officer.suggestion.suggestionlist', compact('data', 'breadcrumbarr', 'navbar', 'user'));
    }

    public function createsuggestion()
    {

        $language = Language::where('delet_flag', 0)->orderBy('name')->get();

        $breadcrumb = array(
            0 => array('title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/officerhome'),
            1 => array('title' => 'Suggestion', 'message' => 'Suggestion', 'status' => 1)
        );
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        // $announcetypes = AnnouncementType::get();

        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        $Navid = Componentpermission::where('url', '/' . $route)->select('id')->first();

        return view('backend.officer.suggestion.createsuggestion', compact('breadcrumbarr', 'language', 'navbar', 'user', 'Navid'));
    }

    public function storesuggestion(Request $request)
    {
        // dd($request->all());
        $role_id = Auth::user()->id;
        try {

            $validator = Validator::make(
                $request->all(),
                [
                    'subject'       => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
                    'description.*' => 'sometimes',
                    'typeId'        => app('App\Http\Controllers\Commonfunctions')->dropnumcheck(),
                    
                ],
                [
                    'subject.required' => 'subject is required',
                    'subject.min' => 'subject  minimum lenght is 2',
                    'subject.max' => 'subject  maximum lenght is 50',
                    'subject.regex' => 'Invalid characters not allowed for subject',

                    'description.required' => 'Alternative text is required',
                    'description.min' => 'Alternative text  minimum lenght is 2',
                    'description.max' => 'Alternative text  maximum lenght is 50',
                    'description.regex' => 'Invalid characters not allowed for alternative text',

                ]
            );


            if ($validator->fails()) {
                // dd($validator->errors());
                // return route()->withInput()->withErrors($validator->errors());
                return redirect()->route('officer.createsuggestion')->withInput()->withErrors($validator->errors());
            }

            DB::beginTransaction();

                $storeinfo = new Suggestion([
                    'userid' => $role_id,
                    'title' => $request->subject,
                    'suggestion' => $request->description,
                    'status_id' => 1,
                    'typeId'=>$request->typeId
                ]);
                // dd($storeinfo);
                $sub =$request->subject;
                $des =$request->description;
                $res = $storeinfo->save();
                $SuggestionId = DB::getPdo()->lastInsertId();
                $breadcrumb = array(
                    0 => array('title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/officerhome'),
                    1 => array('title' => 'Upload Suggestion', 'message' => 'Upload Suggestion', 'status' => 1)
                );
                $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
                $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
                $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        
                $url = url()->previous();
                $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
                $Navid = Componentpermission::where('url', '/' . $route)->select('id')->first();

                $galdet = Suggestion::whereId($storeinfo->id)->first();
               
                $galitem = Suggestionitem::where('suggestionid', $SuggestionId)->get();
                $galitemcnt = count($galitem);
                $usertype_id = Auth::user()->role_id;
                // dd($galitemcnt);
            DB::commit();
            return view('backend.officer.suggestion.uploadsuggest', compact('breadcrumbarr', 'navbar', 'user', 'Navid','SuggestionId', 'galitem', 'galdet', 'galitemcnt', 'usertype_id'));
            // return redirect()->route('officer.suggattachmtupload')->with('success', 'created successfully');
        } catch (ModelNotFoundException $exception) {
            DB::rollback();
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();
            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR' . $data->id);
        }
    }
    public function suggattachmtupload(Request $request, $encid)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
               'file' => 'required|mimes:jpg,jpeg,png,pdf,webp,mp4,doc,docx,xls,xlsx',
            ],
            [

                // 'file.dimensions' => 'Image resolution does not meet the requirement. Size of the image should be 1090 x 400 (w x h). ',
                'file.mimes' => 'Invalid image format',
            ]
        );

        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withInput()->withErrors($validator->errors());
        }
        $id = Crypt::decrypt($encid);
        // dd($id);
        $usertype_id = Auth::user()->role_id;
        $pgmdet = Suggestion::where('id', $id)->first();

        $files = $request->file;
        $imageName = time().rand().'.'.$files->extension();
        $request->file('file')->storeAs('/assets/backend/uploads/Suggestionitem', $imageName, 'myfile');

        $formdata = [
            'suggestionid' => $id,
            'image' => $imageName,
            'alternate_text' => 'Upload',

        ];

        $res = Suggestionitem::create($formdata);
        $resusertype = $usertype_id;
        // dd($res->id."");
  
        if ($res) {
            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/officerhome'],
                1 => ['title' => 'List Suggestion', 'message' => 'List Suggestion', 'status' => 0, 'link' => '/officer/suggestion'],
                2 => ['title' => 'Upload Suggestion Item', 'message' => 'Upload Suggestion Item', 'status' => 2],
            ];

            $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
            $galdet = Suggestionitem::whereId($res->id)->first();
            $galitem = Suggestionitem::where('suggestionid', $id)->where('status_id', 1)->get();
            // dd($galitem);
            $galitemcnt = count($galitem);
            // dd($galitem);
            // dd($galitemcnt);
            $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
            $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

            return view('backend.officer.suggestion.uploadsuggest', compact('breadcrumbarr', 'resusertype', 'galdet', 'galitem', 'galitemcnt', 'navbar', 'user', 'usertype_id'));
        } else {
            return back()->withInput()->withErrors('error', 'Not added');
        }
    }
    public function deletesuggestionupload(Request $request, $id)
    {
        // dd($id);
        // $id = Crypt::decryptString($id);
       
        DB::beginTransaction();
        $imageName = Suggestionitem::where('suggestionid', $id)->select('image')->get();
     
        foreach ($imageName as $img) {
            Storage::disk('myfile')->delete('/assets/backend/uploads/Suggestionitem/'.$img->file);
        }
    
        $res_sub = Suggestionitem::where('id', $id)->delete();
// dd($res_sub);
        if ($res_sub) {
            DB::commit();
            // return back()->with('success', 'Action completed successfully!')->with('reload', true);
            return response()->json(['success' => 'Data deleted successfully.']);
            // return redirect()->route('officer.suggattachmtupload')->with('success', 'Deleted successfully');

        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }

    }

    /*Uppy view images */
    public function viewsuggestionitem(Request $request, $encid)
    {
        // dd(true);
        $id = Crypt::decrypt($encid);
        $resusertype = User::where('id', Auth::user()->id)->first();
        $usertype_id = Auth::user()->role_id;
        $usertype = Auth::user()->role_id;
        //return redirect('festmanager/listFilm')->with('msg','Film updated successfully.');
        $resusertype = User::where('id', Auth::user()->id)->first();
        $usertype_id = Auth::user()->usertype_id;

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/officer/suggestion'],
            1 => ['title' => 'Upload Suggestion Item', 'message' => 'Upload Suggestion Item', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);

        $galdet = Suggestionitem::whereId($id)->first();
        $galitem = Suggestionitem::where('suggestionid', $id)->where('status_id', 1)->get();
        $galitemcnt = count($galitem);
// dd($galitem);
        $usertype_id = $usertype;
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        return view('backend.officer.suggestion.uploadsuggest', compact('user', 'navbar', 'breadcrumbarr', 'resusertype', 'galdet', 'galitem', 'galitemcnt', 'usertype_id'));
    }
    public function editsuggestion(Request $request, $encid)
    {

        $edit_f = 'E';

        try {
            $id = Crypt::decryptString($encid);
            $usertype_id = Auth::user()->role_id;

            $breadcrumb = [
                0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/officerhome'],
                1 => ['title' => 'List Suggestion', 'message' => 'List Suggestion', 'status' => 0, 'link' => '/officer/suggestion'],
                2 => ['title' => 'Upload Suggestion Item', 'message' => 'Upload Suggestion Item', 'status' => 2],
            ];

  
            $keydata = Suggestion::where('id', $id)->first();
        } catch (\Illuminate\Database\QueryException $exception) {
        }

        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);

        return view('backend.officer.suggestion.createsuggestion', compact('breadcrumbarr', 'edit_f', 'keydata', 'navbar', 'user', 'usertype_id', 'usertype_id'));
    }

    public function updatesuggestion(Request $request)
    {

        $usertype = Auth::user()->role_id;

        $validator = Validator::make(
            $request->all(),
            [
                'subject'       => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
                'description.*'   => 'sometimes',
                'typeId'        => app('App\Http\Controllers\Commonfunctions')->dropnumcheck(),
            ],
            [
                'subject.required' => 'subject is required',
                'subject.min' => 'subject  minimum lenght is 2',
                'subject.max' => 'subject  maximum lenght is 50',
                'subject.regex' => 'Invalid characters not allowed for subject',

                'description.required' => 'Alternative text is required',
                'description.min' => 'Alternative text  minimum lenght is 2',
                'description.max' => 'Alternative text  maximum lenght is 50',
                'description.regex' => 'Invalid characters not allowed for alternative text',

            ]
        );

        if ($validator->fails()) {
            // dd($validator->errors());
            // return back()->withInput()->withErrors($validator->errors());
            return redirect()->route('officer.createsuggestion')->withInput()->withErrors($validator->errors());
        }

        DB::beginTransaction();
        try {

            $id = $request->hidden_id;

            $storeinfo = [
                    'title' => $request->subject,
                    'suggestion' => $request->description,
                    'typeId'=>$request->typeId
            ];

            $res_main_table = Suggestion::where('id', $id)->update($storeinfo);
 
            if ($res_main_table) {
                DB::commit();
                $breadcrumb = array(
                    0 => array('title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/officerhome'),
                    1 => array('title' => 'Upload Suggestion', 'message' => 'Upload Suggestion', 'status' => 1)
                );

                $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
                $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
                $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
                $galdet = Suggestion::whereId($id)->first();
                // dd($usertype_id);
                $galitem = Suggestionitem::where('suggestionid', $id)->where('status_id', 1)->get();
                $galitemcnt = count($galitem);
                $gallery_id = $id;
                $usertype_id = $usertype;

                return view('backend.officer.suggestion.uploadsuggest', compact('breadcrumbarr', 'navbar', 'user', 'gallery_id', 'galitem', 'galdet', 'galitemcnt', 'usertype_id'));
            } else {
                DB::rollback();
                $data = \LogActivity::logLatestItem();

                return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
            }
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }
    public function statussuggestion($id)
    {
        $id = Crypt::decryptString($id);
        $status = Suggestion::where('id', $id)->value('status_id');

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

        $res = Suggestion::where('id', $id)->update($uparr);

        $edit_f = '';
        if ($res) {
            DB::commit();

            return Redirect('officer/suggestion')->with('success', 'Status updated successfully', ['edit_f' => $edit_f]);
        } else {
            DB::rollback();

            return back()->withErrors('Not deleted ');
        }
    }
    // public function suggattachmtupload(Request $request)
    // {
    //     // dd($request->all());
    //     // Check if files are present in the request
    //     if ($request->hasFile('files')) {
    //         $files = $request->file('files'); // Retrieve uploaded files
    //         $uploadedFiles = [];

    //         foreach ($files as $file) {
    //             // Validate the file type
    //             $request->validate([
    //                 'files.*' => 'mimes:jpg,png,pdf,mp4,avi,mp3,wav|max:10240', // Max file size: 10MB
    //             ]);

    //             // Store the file
    //             $path = $file->store('/backend/uploads/Suggestionitem', 'public');
    //             // dd($path);
    //             // Save the file data into the database
    //             $suggestionItem = Suggestionitem::create([
    //                 'image' => $file->getClientOriginalName(),
    //                 'file_path' => $path,
    //                 'file_size' => $file->getSize(),
    //                 'alternate_text' => 'attachment',
    //                 'status_id'=>1,
    //             ]);

    //             // Add the file's info to the response
    //             $uploadedFiles[] = [
    //                 'id' => $suggestionItem->id,
    //                 'original_name' => $file->getClientOriginalName(),
    //                 'path' => $path,
    //                 'size' => $file->getSize(),
    //                 'type' => $file->getMimeType(),
    //             ];
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Files uploaded and saved successfully!',
    //             'files' => $uploadedFiles,
    //         ]);
    //     }

    //     return response()->json([
    //         'success' => false,
    //         'message' => 'No files uploaded.',
    //     ], 400);
    // }
    public function suggitemupdate($SuggestionId)
    {

    }
    public function passwordchange(Request $request)
    {
        $role_id = Auth::user()->id;
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/officerhome'],
            1 => ['title' => 'Password change', 'message' => 'Password change', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $data = Suggestion::where('userid',$role_id)->get();

        return view('backend.officer.passwordchange.passwordchange', compact('data', 'breadcrumbarr', 'navbar', 'user'));
    }
    public function passwordupdate(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();

        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'new_password' => ['required'],
                    'password-confirm' => ['required', 'min:8', 'same:new_password'],
    
                ],
                [
                    'password.required' => 'new_password is required',
                    'password-confirm.required'      => 'new_password_confirmation required'
    
                ]
            );
    
            if ($validator->fails()) {
                // dd($validator->errors());
                return redirect()->route('officers.passwordchange')->withInput()->withErrors($validator->errors());
            }
            // dd(true);
            $user = Auth::user();
    
            $pass_update = User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        
            DB::commit();
            return redirect()->route('officers.passwordchange')->with('success', 'Password successfully updated!');

            // all good
        } catch (\Exception $e) {
            dd(true);
            DB::rollback();
            // something went wrong
        }
    }
    public function usermanual(Request $request)
    {
        $role_id = Auth::user()->id;
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/officerhome'],
            1 => ['title' => 'User manual', 'message' => 'User manual', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $data = Suggestion::where('userid',$role_id)->get();

        return view('backend.officer.usermanual.usermanual', compact('data', 'breadcrumbarr', 'navbar', 'user'));
    }
    
}
