<?php


namespace Ehel\FileUpload;

/**
 * Class FileUpload
 * @package Ehel\FileUpload
 */
class FileUpload
{
    /**
     * Storage Path.
     *
     * @var string
     */
    protected $path;

    /**
     * FileUpload constructor.
     * @param $path
     */

    public function __construct($path)
    {
        $this->path=$path;
    }

    /**
     * Generate buttons
     * @return string
     */
    //Todo Token verification
    public function buttons($directory){

        $html = <<<EOL
            <div class="form-group">
                <div class="input-wrapper">
                    <input type="hidden" name="file_path">
                    <input type="hidden" name="directory" value="$directory">

                    <span class="btn btn-success fileinput-button" style="cursor: pointer;position: relative;">
                        <input type="file" name="file" id="file" class="inputfile" style="width: 0.1px;height: 0.1px;opacity: 0;overflow: hidden;position: absolute;z-index: -1;" />
                        <label for="file" style="display: initial;cursor: pointer;font-weight: inherit;">Choose a file</label>
                    </span>
                    <button type="button" class="btn btn-danger" data-scope="action" data-action="deleteFile" data-filename="">
                        <i class="fa fa-trash"></i>
                        <span>
                        Delete file </span>
                    </button>
                    <code class="fileupload-response" data-filename=""> 'No file chosen'</code>
                </div>
            </div>
EOL;

        return $html;

    }


    /**
     * Generate script
     * @return string
     */
    public function script(){
        $script = <<<EOL
            function handleFile(deleteFile, event) {
                        fd = new FormData();
                        fd.append("file", $('input[type=file]')[0].files[0]);
                        fd.append("directory", $('input[name=directory]').val());

                        $.ajax({
                            url: "http://localhost:8000/ehelfileupload/upload",
                            type: "POST",
                            data: fd,
                            enctype: 'multipart/form-data',
                            processData: false,
                            contentType: false
                        }).done(function( data ) {
                            swal({
                                title: "Saved!",
                                text: "Model has been saved.",
                                type: "success"
                                   }, function () {
                                       location.reload();
                                   });
                        }).fail(function(data) {
                            showErrors(data);
                        });
}
            $('#file').on("change", function(){ handleFile(); });
EOL;

        return $script;
    }


}