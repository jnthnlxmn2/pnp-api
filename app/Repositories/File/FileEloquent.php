<?php

namespace App\Repositories\File;

use App\File;
use App\Repositories\Common\Eloquent\EloquentRepository;
use App\User;
use Auth;
use Carbon\Carbon;
use Storage;

class FileEloquent extends EloquentRepository implements FileRepository
{
    protected $model;

    public function __construct(File $File, User $User)
    {
        $this->user = $User;
        $this->model = $File;
        $this->options = ['paginate' => 15, 'limit' => 0, 'order' => 'desc'];
    }

    public function getAll($options = [])
    {
        $options = $this->getOptions($options);
        return $this->model->orderBy('created_at', 'DESC')
            ->orderBy('created_at', 'desc')
            ->limit($options['limit'])
            ->paginate($options['paginate']);
    }

    public function getAllByUser($options = [])
    {
        $options = $this->getOptions($options);
        return $this->model->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->limit($options['limit'])
            ->paginate($options['paginate']);
    }

    public function uploadFile($file, $attr = [])
    {
        if ($file->isValid()) {
            $dt = Carbon::now();
            $filename = Storage::disk('public')->putFile($dt->format('Ymd'), $file);
            $mime_types = ['image/png', 'image/jpg', 'image/jpeg'];
            $mime_type_pdf = ['application/pdf'];
            $path = url('/') . '/file/' . $filename;
            $type = 'file';
            if (in_array($file->getMimeType(), $mime_types)) {
                $path = url('/') . '/file/' . $filename;
                $type = 'image';
            }
            if (in_array($file->getMimeType(), $mime_type_pdf)) {
                $path = url('/') . '/file/' . $filename;
                $type = 'pdf';
            }
            $file_info = [
                'original_name' => $file->getClientOriginalName(),
                'extension' => $file->extension(),
                'filename' => $filename,
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getClientSize(),
            ];

            $data = [
                'user_id' => Auth::user()->id,
                'name' => $attr['name'],
                'file_category_id' => $attr['file_category_id'],
                'file_path' => $path,
                'file_metadata' => json_encode($file_info),
                'type' => $type,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ];

            $data_file = $this->addFile($data);

            return $data_file;

        }
    }

    public function addFile($attr = [])
    {
        //    return $attr;
        $this->model->fill($attr);
        $file = $this->model->save();
        return $file;
    }

    public function getFileByCategory($options = [], $category_id)
    {
        $options = $this->getOptions($options);

        if (Auth::user()->user_type_id === 1) {
            if ($category_id) {
                $files = $this->model->where('file_category_id', $category_id)
                    ->orderBy('created_at', 'desc')
                    ->limit($options['limit'])
                    ->paginate($options['paginate']);
                foreach ($files as $file) {
                    $file['file_category_type'] = $this->model->get_category_id($file['file_category_id']);
                    $file['user'] = Auth::user()->where('id', $file['user_id'])->first();
                }

                return $files;

            } else {
                $files = $this->model->orderBy('created_at', 'desc')
                    ->limit($options['limit'])
                    ->paginate($options['paginate']);
                foreach ($files as $file) {
                    $file['file_category_type'] = $this->model->get_category_id($file['file_category_id']);
                    $file['user'] = Auth::user()->where('id', $file['user_id'])->first();
                }

                return $files;
            }
        } else {

            if ($category_id) {
                $files = $this->model->where('user_id', Auth::user()->id)
                    ->where('file_category_id', $category_id)
                    ->orderBy('created_at', 'desc')
                    ->limit($options['limit'])
                    ->paginate($options['paginate']);
                foreach ($files as $file) {
                    $file['file_category_type'] = $this->model->get_category_id($file['file_category_id']);
                    $file['user'] = Auth::user()->where('id', $file['user_id'])->first();
                }

                return $files;

            } else {
                $files = $this->model->where('user_id', Auth::user()->id)
                    ->orderBy('created_at', 'desc')
                    ->limit($options['limit'])
                    ->paginate($options['paginate']);
                foreach ($files as $file) {
                    $file['file_category_type'] = $this->model->get_category_id($file['file_category_id']);
                    $file['user'] = Auth::user()->where('id', $file['user_id'])->first();
                }

                return $files;
            }

        }

    }
    public function uploadEditFile($id, $file, $attr = [])
    {
        if ($id) {
            if ($file) {
                if ($file->isValid()) {
                    $dt = Carbon::now();
                    $filename = Storage::disk('public')->putFile($dt->format('Ymd'), $file);
                    $mime_types = ['image/png', 'image/jpg', 'image/jpeg'];
                    $mime_type_pdf = ['application/pdf'];
                    $path = url('/') . '/file/' . $filename;
                    $type = 'file';
                    if (in_array($file->getMimeType(), $mime_types)) {
                        $path = url('/') . '/file/' . $filename;
                        $type = 'image';
                    }
                    if (in_array($file->getMimeType(), $mime_type_pdf)) {
                        $path = url('/') . '/file/' . $filename;
                        $type = 'pdf';
                    }
                    $file_info = [
                        'original_name' => $file->getClientOriginalName(),
                        'extension' => $file->extension(),
                        'filename' => $filename,
                        'path' => $path,
                        'mime_type' => $file->getMimeType(),
                        'size' => $file->getClientSize(),
                    ];

                    $data = [
                        'name' => $attr['name'],
                        'file_category_id' => $attr['file_category_id'],
                        'file_path' => $path,
                        'file_metadata' => json_encode($file_info),
                        'type' => $type,
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ];

                    $data_file = $this->editFile($id, $data);

                    return $data_file;
                }
            } else {
                $data = ['name' => $attr['name'],
                    'file_category_id' => $attr['file_category_id'],
                ];
                $data_file = $this->editFile($id, $data);

                return $data_file;
            }

        }

    }

    public function editFile($id, $data)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

}
