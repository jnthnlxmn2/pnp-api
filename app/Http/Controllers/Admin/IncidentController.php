<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Incident\IncidentRepository;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
class IncidentController extends Controller
{

    public function __construct(IncidentRepository $IncidentRepository){
        $this->IncidentRepository = $IncidentRepository;
    }

    public function index(Request $request)
    {
        $options = $request->only('paginate','limit','order');
        $incident = $this->IncidentRepository->getAll($options);
        return response()->success($incident);
    }



    public function store(Request $request)
    {
        $params = $request->only([
            'name',
            'description'
        ]);
        $incident = $this->IncidentRepository->saveByUser($params);
        return response()->success($incident);
    }



    public function show($id)
    {
        $incident = $this->IncidentRepository->find($id);
        return response()->success($incident);
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
        $filecategory_request = $request->only(['name','description']);
        $incident = $this->IncidentRepository->update($id,$filecategory_request);
        return response()->success($incident);

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
