<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\UploadFileRequest;
use App\Repositories\File\FileRepository;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function uploadFile(UploadFileRequest $request)
    {
        $file = $request->file('file');
        $params = $request->only(['file_category_id']);
        $upload = $this->fileRepository->uploadFile($file, $params);
        return response()->success($upload);

    }

    public function index(Request $request)
    {
        $options = $request->only('paginate', 'limit', 'order');
        $files = $this->fileRepository->getAllByUser($options);
        return response()->success($files);
    }

    public function getFileByCategory(Request $request, $category_id ){
        $options = $request->only('paginate', 'limit', 'order');
        $files = $this->fileRepository->getFileByCategory($options, $category_id);
        return response()->success($files);
    }

   
}
