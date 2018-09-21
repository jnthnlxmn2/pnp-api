<?php

namespace App\Http\Controllers\Me;

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


    public function show($id)
    {
        $announcement = $this->filecategoryRepository->find($id);
        return response()->success($announcement);
    }

}
