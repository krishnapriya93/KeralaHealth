<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Suggestion;

use Illuminate\Support\Facades\Crypt;

class EditorController extends Controller
{
    public function editorhome(Request $request)
    { 
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $userIp = $request->ip();
        $carddata = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();

        $dataCount = Suggestion::where('status_id',1)->count();

        return view('backend.editor.editorhome', compact('navbar', 'user', 'userIp', 'carddata','dataCount'));
    }

    public function gallerymodule()
    {
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/editorhome'],
            1 => ['title' => 'Gallery module', 'message' => 'Gallery module', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $datas = Suggestion::with(['suggItems' => function ($q1) {
            // Your query logic here, if any
        }])
        ->where('status_id', 1)
        ->orderBy('created_at', 'asc')  // Order Suggestions by 'created_at' in ascending order
        ->get();
        
        
        $pdfItems = []; // Variable to collect PDF items
        $jpgItems = []; // Variable to collect JPG items
        $videoItems = [];
        $DocItems = [];
        
        // Iterate over the datas
        foreach ($datas as $data) {
            if ($data && $data->suggItems->isNotEmpty()) {
                // Map the suggItems and filter by extension
                $data->suggItems->map(function ($item) use (&$pdfItems, &$jpgItems) {
                    $image = $item->image;
        
                    // Extract the extension using pathinfo()
                    $extension = pathinfo($image, PATHINFO_EXTENSION);
        
                    // Collect items based on their extensions
                    if ($extension === 'pdf') {
                        // Collect PDF items
                        $pdfItems[] = [
                            'image' => $image,
                            'extension' => $extension,
                        ];
                    } elseif ($extension === 'jpg' || $extension === 'jpeg') {
                        // Collect JPG/JPEG items
                        $jpgItems[] = [
                            'image' => $image,
                            'extension' => $extension,
                        ];
                    }elseif ($extension === 'mp4') {
                        // Collect JPG/JPEG items
                        $videoItems[] = [
                            'image' => $image,
                            'extension' => $extension,
                        ];
                    }elseif ($extension === 'docx') {
                        // Collect JPG/JPEG items
                        $DocItems[] = [
                            'image' => $image,
                            'extension' => $extension,
                        ];
                    }
                });
            }
        }
        
        return view('backend.editor.Gallerymodule.gallerymodulelist', compact('datas', 'breadcrumbarr', 'navbar', 'user','pdfItems','jpgItems','videoItems','DocItems'));
    }
    public function docdetails($id,$type)
    {
        $id = decrypt($id);

        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/editorhome'],
            1 => ['title' => 'Gallery Module', 'message' => 'Gallery Module', 'status' => 0, 'link' => '/editor/gallerymodule'],
            2 => ['title' => 'Gallery Details', 'message' => 'Gallery Details', 'status' => 2],
        ];

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
    
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $data = Suggestion::with(['suggItems' => function ($query) {}])->with(['user' => function($q1) use($id){
                                    $q1->with(['designationdata' => function($q2){
                                        $q2->with(['des_sub' => function($q3){
                                            $q3->where('languageid', 1);
                                        }]);
                                    }]);
                                    $q1->with(['officedata' => function($q3){
                                        $q3->with(['office_sub' => function($q4){
                                            $q4->where('languageid', 1);
                                  }]);
                                }]);
                                }])->where('id', $id)->first();
    
        return view('backend.editor.Gallerymodule.imagedetails', compact('data', 'breadcrumbarr', 'navbar', 'user','type')); 
    }
    public function itemdetails($id,$type)
    {
        $id = decrypt($id);
    
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/editorhome'],
            1 => ['title' => 'Gallery Module', 'message' => 'Gallery Module', 'status' => 0, 'link' => '/editor/gallerymodule'],
            2 => ['title' => 'Gallery Details', 'message' => 'Gallery Details', 'status' => 2],
        ];

        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
    
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();
        $data = Suggestion::with(['suggItems' => function ($query) {}])->with(['user' => function($q1) use($id){
                                    $q1->with(['designationdata' => function($q2){
                                        $q2->with(['des_sub' => function($q3){
                                            $q3->where('languageid', 1);
                                        }]);
                                    }]);
                                    $q1->with(['officedata' => function($q3){
                                        $q3->with(['office_sub' => function($q4){
                                            $q4->where('languageid', 1);
                                  }]);
                                }]);
                                }])->where('id', $id)->first();
    
        return view('backend.editor.Gallerymodule.imagedetails', compact('data', 'breadcrumbarr', 'navbar', 'user','type'));  
    }
}
