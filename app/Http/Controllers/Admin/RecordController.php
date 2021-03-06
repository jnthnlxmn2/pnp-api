<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Record\RecordRepository;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
class RecordController extends Controller
{

    public function __construct(RecordRepository $recordRepository){
        $this->recordRepository = $recordRepository;
    }

    public function index(Request $request)
    {
        $options = $request->only('paginate','limit','order');
        $record = $this->recordRepository->getAll($options);
        return response()->success($record);
    }



    public function store(Request $request)
    {
        $params = $request->only([
        'bltr_entry_num',
        'incdnt_type_id',
        'date_reported',
        'date_incident',
        'place_of_incident',
        'itm_a_first_name',
        'itm_a_family_name',
        'itm_a_middle_name',
        'itm_a_qualifier',
        'itm_a_nickname',
        'itm_a_citizenship',
        'itm_a_gender',
        'itm_a_civil_status',
        'itm_a_date_of_birth',
        'itm_a_age',
        'itm_a_place_of_birth',
        'itm_a_home_phone',
        'itm_a_mobile_phone',
        'itm_a_address',
        'itm_a_village',
        'itm_a_brngy',
        'itm_a_city',
        'itm_a_province',
        'itm_a_address2',
        'itm_a_village2',
        'itm_a_brngy2',
        'itm_a_city2',
        'itm_a_province2',
        'itm_a_h_educ_attainment',
        'itm_a_occupation',
        'itm_a_id_card_presented',
        'itm_a_email_address',

        'itm_b_family_name',
        'itm_b_middle_name',
        'itm_b_qualifier',
        'itm_b_nickname',
        'itm_b_citizenship',
        'itm_b_gender',
        'itm_b_civil_status',
        'itm_b_date_of_birth',
        'itm_b_age',
        'itm_b_place_of_birth',
        'itm_b_home_phone',
        'itm_b_mobile_phone',
        'itm_b_address',
        'itm_b_village',
        'itm_b_brngy',
        'itm_b_city',
        'itm_b_province',
        'itm_b_address2',
        'itm_b_village2',
        'itm_b_brngy2',
        'itm_b_city2',
        'itm_b_province2',
        'itm_b_h_educ_attainment',
        'itm_b_occupation',
        'itm_b_work_address',
        'itm_b_rel_to_victim',
        'itm_b_email',
        'itm_b_pnp_rank',
        'itm_b_affiliation',
        'itm_b_criminal_record',
        'itm_b_stat_previous_case',
        'itm_b_height',
        'itm_b_weight',
        'itm_b_build',
        'itm_b_color_of_eyes',
        'itm_b_descp_eyes',
        'itm_b_color_of_hair',
        'itm_b_influence',
        'itm_b_guardian_name',
        'itm_b_guardian_address',
        'itm_b_guardian_home_phone',
        'itm_b_guardian_mobile_phone',
        'itm_b_diversion_mech',

        'itm_c_family_name',
        'itm_c_middle_name',
        'itm_c_qualifier',
        'itm_c_nickname',
        'itm_c_citizenship',
        'itm_c_gender',
        'itm_c_civil_status',
        'itm_c_date_of_birth',
        'itm_c_age',
        'itm_c_place_of_birth',
        'itm_c_home_phone',
        'itm_c_mobile_phone',
        'itm_c_address',
        'itm_c_village',
        'itm_c_brngy',
        'itm_c_city',
        'itm_c_province',
        'itm_c_address2',
        'itm_c_village2',
        'itm_c_brngy2',
        'itm_c_city2',
        'itm_c_province2',
        'itm_c_h_educ_attainment',
        'itm_c_occupation',
        'itm_c_email_address',

        'item_d_blotter_entry_number',
        'item_d_incident_type_id',
        'item_d_time',
        'item_d_date',
        'item_d_place_of_incident',
        'itm_d_narrative_report',
        'aut_name_of_reporting_person',
        'aut_name_of_desk_officer',
        'case_name_of_designated_invstgtr_oncase',
        'case_name_of_cheif',
        ]);
        $Record = $this->recordRepository->saveByUser($params);
        return response()->success($Record);
    }



    public function search(Request $request)
    {   
        $params = $request->only([
            'gender',
            'place_of_incident',
            '18below_report',
            '18above_report',
            '18below_victim',
            '18above_victim',
            'from',
            'to'
        ]);
        $Record = $this->recordRepository->search($params);
        return response()->success($Record);
    }


    


    public function show($id)
    {
        $announcement = $this->filecategoryRepository->find($id);
        return response()->success($announcement);
    }




    /**
     * Update the specified resource in storage.
     * TODO: create request for
     *
     * @param  \Illuminate\Http\Requests\AnnouncementRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request = $request->only(['action_brgy',
        'action_prosecutor',
        'action_court',
        'action_investigation']);
        $report = $this->recordRepository->update($id,$request);
        return response()->success($report);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->filecategoryRepository->delete($id);
        return response()->success($delete);
    }

  
}
