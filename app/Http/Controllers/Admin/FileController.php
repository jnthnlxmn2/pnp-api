<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Repositories\File\FileRepository;
use Image;
use Carbon\Carbon;
use Route;

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
        if ($exists) {
            $path = $storage->path($file);
            $mime_type = $storage->mimeType($file);
            $meta_data = $storage->getMetaData($file);
            if (in_array($mime_type, $mime_types)) {
                $get_file = $storage->get($file);
                $response = response()->make($get_file, 200)->header("Content-Type", $mime_type);
                return $response;
            }
            $data = [
                'meta_data' => $meta_data,
                'download' => url('/') . '/file/' . $file . '/download?storage=files',
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

}
