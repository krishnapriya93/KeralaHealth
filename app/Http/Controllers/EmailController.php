<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Mail\BulkEmail;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;


use Barryvdh\DomPDF\Facade\Pdf;

class EmailController extends Controller
{
    public function bulkemail(Request $request)
    {
        $breadcrumb = [
            0 => ['title' => 'Home', 'message' => 'Home', 'status' => 0, 'link' => '/masteradminhome'],
            1 => ['title' => 'Bulk email', 'message' => 'Bulk email', 'status' => 1],
        ];
        $breadcrumbarr = app('App\Http\Controllers\Commonfunctions')->bread_crump_maker($breadcrumb);
        $navbar = app('App\Http\Controllers\Commonfunctions')->componentpermissionsetng();
        $user = app('App\Http\Controllers\Commonfunctions')->userinfo();

        $excludedUserIds = [1, 2, 3, 4, 5, 6]; // Replace with the user IDs you want to exclude

        $data = User::with(['role_users' => function ($query) {
            // Optionally add conditions for the related role_users here
        }])
            ->where('delet_flag', 0)
            ->whereNotIn('id', $excludedUserIds)
            ->get();

        return view('backend.masteradmin.email.bulk', compact('data', 'breadcrumbarr', 'navbar', 'user'));
    }
    public function sendbulkmail(Request $request)
    {
        //    dd($request->all());
        $selectedUsers = $request->input('selected_users');

        if ($selectedUsers === 'all') {
            // Fetch all users (e.g., apply your filters here)
            $excludedIds = [1, 2, 3,4,5,6,22]; // IDs to exclude
            // $includedIds = [23, 14, 29,31,23,14]; // IDs to exclude
            $users = User::whereNotIn('id', $excludedIds)->get();
            // $users = User::whereIn('id', $includedIds)->get();
            // $users = User::where('id',7)->get();
            // $users = User::get();
        } else {
            // Fetch only selected users
            $userIds = explode(',', $selectedUsers);
            $users = User::whereIn('id', $userIds)->get();
        }
// dd($users);
$flag= 0;
        foreach ($users as $user) {
// dd($user);
            $customSubject = "Your Account Credentials and Timeline for Content Submission";
            $customBody = "Here are your login details:";
            $username = $user->email;
            $userfullname = $user->name;
            // $email = $user->email;
            $password = 'health@123'; // Replace with dynamic password generation if needed
            // dd($username);
            // Mail::to($username)->send(new BulkEmail($customSubject, $customBody,$username,$password));
            try {
                // dd(true);
            Mail::to($username)->send(new BulkEmail($customSubject, $customBody, $username, $password,$userfullname));
               
            // If email sent successfully, update the flag and sent_at fields
            $user->update([
                'mail_sent_flag' => 1,
                'sent_at' => now() // Use Carbon's now() method to record the current timestamp
            ]);
            $flag=$flag++;

            // return redirect('/masteradmin/bulkemail')->with(['success' => 'Updated successfully']);
            } catch (\Exception $e) {
                // dd(false);
                // return redirect('/masteradmin/bulkemail')->with(['error' => 'error']);
                \Log::error('Email sending failed: ' . $e->getMessage());
            }

        }
        if($flag>0)
        {
            return redirect('/masteradmin/bulkemail')->with(['success' => 'Updated successfully']);
        }else{
            return redirect('/masteradmin/bulkemail')->with(['error' => 'error']);
        }
    }

    public function reportmailsent()
    {
        $data = User::with(['designationdata' => function($q1){
            $q1->with(['des_sub' => function($q2){
                    $q2->where('languageid', 1);
            }]);

        }])->with(['officedata' => function($q3){
            $q3->with(['office_sub' => function($q4){
                $q4->where('languageid', 1);
            }]);
        }])->where('mail_sent_flag',1)->get();

        $currentDateTime = Carbon::now('Asia/Kolkata')->toDateTimeString();

        $pdf = PDF::loadView('backend/masteradmin/email/report', ['data' => $data,'currentDateTime' => $currentDateTime]);

        return $pdf->download('user_details_keralahealth_all.pdf');
    }
}
