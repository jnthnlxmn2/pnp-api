<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FileCategory\FileCategoryRepository;
use App\Http\Requests\FileCategory\FileCategoryRequest;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
class FileCategoryController extends Controller
{

    public function __construct(FileCategoryRepository $filecategoryRepository){
        $this->filecategoryRepository = $filecategoryRepository;
    }

    public function index(Request $request)
    {
        $options = $request->only('paginate','limit','order');
        $FileCategory = $this->filecategoryRepository->getAll($options);
        return response()->success($FileCategory);
    }



    public function store(FileCategoryRequest $request)
    {
        $params = $request->only([
            'name',
            'description'
        ]);
        $FileCategory = $this->filecategoryRepository->saveByUser($params);
        return response()->success($FileCategory);
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
    public function update(FileCategoryRequest $request, $id)
    {
        $filecategory_request = $request->only(['name','description']);
        $announcement = $this->filecategoryRepository->update($id,$filecategory_request);
        return response()->success($announcement);

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
