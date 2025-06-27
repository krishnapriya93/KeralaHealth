<?php

  

namespace App\Imports;

  

use App\Models\User;
use App\Models\Designation;
use App\Models\Office;

use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

  

class UsersImport implements ToModel, WithHeadingRow

{

    /**

    * @param array $row

    *

    * @return \Illuminate\Database\Eloquent\Model|null

    */

    public function model(array $row)

    {
        $designation = @$row['designation'];
        $department = @$row['department'];
    // dd($row);
        return new User([
            'name'     => @$row['full_name'],
            'email'    => @$row['email'], 
            'password' => '$2y$12$/Nl4gJ5/tjkgGuLws3Mhde6VIc6h2Bu2pZKK9mJmiE4RA6fUiigFO',
            'role_id'  => 8,
            'fullname' => @$row['full_name'],
            'mobile'   => @$row['mobile_number'], 
            'designation' => $this->getdesignation($designation),
            'office_id' => $this->getoffice($department),
            'status_id'=> 1

        ]);

    }

    private function getdesignation($designation)
    {
        
        $designation1 = Designation::with(['des_sub' => function ($query) use($designation) {
            $query->where('title', 'LIKE', '%' . $designation . '%');
           
        }])->first();

        return $designation1 ? $designation1->id : null;
    }

    private function getoffice($department)
    {
        $office1 = Office::with(['office_sub' => function ($query) use($department) {
            $query->where('title', 'LIKE', '%' . $department . '%');
        }])->first();

        // Return the ID if found; otherwise, return a default value (e.g., null)
        return $office1 ? $office1->id : null;
    }


}