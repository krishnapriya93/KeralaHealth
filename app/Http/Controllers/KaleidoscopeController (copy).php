<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mainmenu;
use DB;
use Session;

class KaleidoscopeController extends Controller
{
    public function kaleidoscope()
    {

        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $districts = DB::table('institutions')
        //    ->join('districts')
            ->select('districtname as id')
            ->distinct()
            ->get();

        $nodes = [];
        foreach ($districts as $district) {
            // Prefix type to id for uniqueness
            $nodeId = 'district_' . $district->id;
            $nodes[] = [
                'id' => $nodeId,
                'label' => $district->id,
                'level' => 0,
                'type' => 'district'
            ];
        }


        return view('frontend.main.kaleidoscope', compact('nodes', 'mainsubmenu'));
    }

public function getKaleidoscopeChildren(Request $request)
{
    $parentId = $request->input('id');  // e.g. district_Kozhikode or category_Health
    $type = $request->input('type');    // 'district' or 'category'
    $parentValue = preg_replace('/^[a-z]+_/', '', $parentId);

    $nodes = [];
    $edges = [];

    if ($type === 'district') {
        // Get distinct categories under this district
        $categories = DB::table('institutions')
            ->where('districtname', $parentValue)
            ->select('category_including_fhc as category')
            ->distinct()
            ->get();

        foreach ($categories as $category) {
            if (empty($category->category)) continue;

            $childNodeId = 'category_' . preg_replace('/\s+/', '_', $category->category);
            $nodes[] = [
                'id' => $childNodeId,
                'label' => $category->category,
                'type' => 'category',
                'level' => 1
            ];
            $edges[] = [
                'from' => $parentId,
                'to' => $childNodeId
            ];
        }

    } elseif ($type === 'category') {
        // Get institutions under this category
        $institutions = DB::table('institutions')
            ->where('category_including_fhc', $parentValue)
            ->select('name_of_the_institution as institution', 'complete_address_with_pin_code as address', 'phone_number as phone') // add fields as needed
            ->distinct()
            ->get();

        foreach ($institutions as $institution) {
            if (empty($institution->institution)) continue;

            $childNodeId = 'institution_' . preg_replace('/\s+/', '_', $institution->institution);
            $nodes[] = [
                'id' => $childNodeId,
                'label' => $institution->institution,
                'type' => 'institution',
                'level' => 2,
                'details' => 'Address: ' . $institution->address . '<br>Phone: ' . $institution->phone
            ];
            $edges[] = [
                'from' => $parentId,
                'to' => $childNodeId
            ];
        }
    } else {
        // For other types or no matching, return empty
        return response()->json(['nodes' => [], 'edges' => []]);
    }

    return response()->json(['nodes' => $nodes, 'edges' => $edges]);
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
    // MainController.php
    public function getInstitutionsByDistrict(Request $request)
    {
        $district = $request->district;
        $institutions = Institution::where('district', $district)->get(['name']);

        return response()->json($institutions);
    }
}
