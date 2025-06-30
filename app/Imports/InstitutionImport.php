<?php

namespace App\Imports;

use App\Models\Institution;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InstitutionImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Institution([
            'name_of_district' => $row['name_of_district'] ?? null,
            'category' => $row['category'] ?? null,
            'category_including_fhc' => $row['category_including_fhc'] ?? null,
            'central_category' => $row['central_category'] ?? null,
            'fhc_phase' => $row['fhc_phase'] ?? null,
            'fhc_type_block_fhc' => $row['fhc_type_block_fhc'] ?? null,
            'name_of_the_institution' => $row['name_of_the_institution'] ?? null,
            'complete_address_with_pin_code' => $row['complete_address_with_pin_code'] ?? null,
            'phone_number' => $row['phone_number'] ?? null,
            'sanctioned_bed' => $row['sanctioned_bed'] ?? null,
            'functional_bed' => $row['functional_bed'] ?? null,
            'ruralurban' => $row['ruralurban'] ?? null,
            'name_of_the_corp_munigrama_panchayath' => $row['name_of_the_corp_munigrama_panchayath'] ?? null,
            'cmp' => $row['cmp'] ?? null,
            'name_of_health_block' => $row['name_of_health_block'] ?? null,
            'name_of_block_panchayath' => $row['name_of_block_panchayath'] ?? null,
            'name_of_taluk' => $row['name_of_taluk'] ?? null,
            'name_of_assembly_constituency' => $row['name_of_assembly_constituency'] ?? null,
            'email_id' => $row['email_id'] ?? null,
            'whether_the_institution_is_handed_over_to_lsgd' => $row['whether_the_institution_is_handed_over_to_lsgd'] ?? null,
            'if_yes_name_of_lsgd' => $row['if_yes_name_of_lsgd'] ?? null,
            'delivery_pont_yesno' => $row['delivery_pont_yesno'] ?? null,
            'tribal_areacoastal_area' => $row['tribal_areacoastal_area'] ?? null,
            'total_population_under_institution_area' => $row['total_population_under_institution_area'] ?? null,
            'lattitude' => $row['lattitude'] ?? null,
            'longitude' => $row['longitude'] ?? null,
            'nin' => $row['nin'] ?? null,
            'type_of_building' => $row['type_of_building'] ?? null,
        ]);
    }
}
