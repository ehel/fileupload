<?php

namespace Ehel\FileUpload;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input, File;

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
        $source = Input::get('modelSource');


                if (Input::file('file_1')) {
                    $file = $this->getFile('file_1', $source);
                    if ($file && $file != 'error') {
                        return response()->json($file);
                    }
                }


    }

    private function getFile($input, $source)
    {
        $file = Input::file($input);
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
                $destinationPath = 'uploads/' . $extraDirectory;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filename = Input::get('filePath');
        $fullpath = public_path() . '/' . $filename;
        File::delete($fullpath);
    }
}
