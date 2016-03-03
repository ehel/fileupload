<?php

namespace Ehel\FileUpload\Http;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;


class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
       // $source = Input::get('modelSource');
        $directory = $request->input('directory');


                if ($request->file('file')) {
                    $file = $this->getFile('file', $directory,$request);
                    if ($file && $file != 'error') {
                        return response()->json($file);
                    }
                }


    }

    private function getFile($input, $source,$request)
    {

        $file = $request->file($input);
        if ($file) {
            return $this->processFile($file, $source);
        } else {
            return false;
        }
    }

    private function processFile($file, $extraDirectory)
    {
        $extension = $file->getClientOriginalExtension();
        $size = $file->getClientSize();
        $mimes = array(
            'pdf',
            'doc',
            'docx',
            'odf',
            'png',
            'jpg',
            'jpeg'
        );
        $maxSize = 5242880; // 5 mb
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
            return response()->json($validation->errors);
        } else {
            if ($file->isValid()) {
                $destinationPath = config('fileupload.path') . $extraDirectory;
                $fileName = $extraDirectory . '_' . rand(11111,99999) . '.' . $extension;
                $file->move($destinationPath, $fileName);

                return $destinationPath . '/' .$fileName;
            } else {
                return 'error';
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $filename = $request->input('file_path');
        $fullpath = public_path() . '/' . $filename;
        File::delete($fullpath);
    }
}
