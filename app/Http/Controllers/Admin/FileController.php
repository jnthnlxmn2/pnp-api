<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\File\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function getFile($folder, $filename)
    {
        $storage = Storage::disk('public');
        $file = $folder . '/' . $filename;
        $exists = $storage->exists($file);
        $mime_types = ['image/png', 'image/jpg', 'image/jpeg'];
        $mime_type_pdf = ['application/pdf'];

        if ($exists) {
            $path = $storage->path($file);
            $mime_type = $storage->mimeType($file);
            $meta_data = $storage->getMetaData($file);
            if (in_array($mime_type, $mime_types)) {
                $get_file = $storage->get($file);
                $response = response()->make($get_file, 200)->header("Content-Type", $mime_type);
                return $response;
            }
            if (in_array($mime_type, $mime_type_pdf)) {
                $get_file = $storage->get($file);
                $response = response()->make($get_file, 200)->header("Content-Type", $mime_type);
                return $response;
            }
            $data = [
                'meta_data' => $meta_data,
                'download' => url('/') . '/file/' . $file . '/download?',
            ];

            return response()->success($data);
        }

        return response('File not found', 403);
    }

    public function downloadFile(Request $request, $folder, $filename)
    {
        $storage_name = $request->storage ? $request->storage : 'local';
        $file = $folder . '/' . $filename;
        $storage = Storage::disk('public');
        $exists = $storage->exists($file);
        if ($exists) {
            return response()->download($storage->path($file));
        }
        return response('File not found', 403);
    }

    public function destroy($id)
    {
        $delete = $this->fileRepository->delete($id);
        return response()->success($delete);
    }

    public function editFile($id, Request $request)
    {
        $file = $request->file('file');
        $params = $request->only(['name', 'file_category_id']);
        $upload = $this->fileRepository->uploadEditFile($id, $file, $params);
        return response()->success($upload);
    }

}
