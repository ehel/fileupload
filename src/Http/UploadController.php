<?php

namespace Ehel\FileUpload\Http;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;


class UploadController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!is_null($request->file_path) && config('fileupload.rewrite_file')){
            $this->deleteFile($request);
        }
        $directory = $request->input('directory');
        if ($request->file('file')) {
            $file = $this->getFile('file', $directory, $request);
            if ($file && $file != 'error') {
                return response()->json($file);
            }
        }
    }

    /**
     * Get file
     * @param $input
     * @param $source
     * @param $request
     * @return array|bool|string
     */
    private function getFile($input, $source, $request)
    {
        $file = $request->file($input);
        if ($file) {
            return $this->processFile($file, $source);
        } else {
            return false;
        }
    }
    /**
     * Validate and save file
     * @param $file
     * @param $extraDirectory
     * @return array|string
     */
    private function processFile($file, $extraDirectory)
    {
        $extension = $file->getClientOriginalExtension();
        $size = $file->getClientSize();
        $mimes = config('fileupload.mimes');
        $maxSize = config('fileupload.max_size');
        $validation = new \StdClass;
        $validation->error = false;
        $validation->errors = array();

        if (!in_array($extension, $mimes)) {
            $validation->error = true;
            array_push($validation->errors, 'Restricted file extension');
        }

        if ($size > $maxSize) {
            $validation->error = true;
            array_push($validation->errors, 'File size is more than 5 mb.');

        }

        if ($validation->error) {
            return $validation->errors;
        } else {
            if ($file->isValid()) {
                $destinationPath = config('fileupload.path') . $extraDirectory;
                $fileName = $extraDirectory . '_' . rand(11111, 99999) . '.' . $extension;
                $file->move($destinationPath, $fileName);

                return $destinationPath . '/' . $fileName;
            } else {
                return 'error';
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->deleteFile($request);
    }

    /**
     * Delete file
     * @param Request $request
     */
    protected function deleteFile(Request $request)
    {
        $filename = $request->input('file_path');
        $fullpath = public_path() . '/' . $filename;
        File::delete($fullpath);
    }
}
