<?php


namespace Ehel\FileUpload;

/**
 * Class FileUpload
 * @package Ehel\FileUpload
 */
class FileUpload
{

    /**
     * Generate buttons
     * @return string
     */
    //Todo Token verification
    //Todo Refactor Directory

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
                    <button type="button" class="btn btn-danger delete-file" data-scope="action" data-action="deleteFile" data-filename="">
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
            function handleFile(uploadFile, event) {
                if(uploadFile){
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
                            $('.fileupload-response').text(data);
                            $('input[name=file_path]').val(data);
                        }).fail(function(data) {
                            showErrors(data);
                        });
                        }else {
                            fd = new FormData();
                            fd.append("file_path", $('input[name=file_path]').val());
                            fd.append("_method", "DELETE");
                            $.ajax({
                            url: "http://localhost:8000/ehelfileupload/upload?file_path="+$('input[name=file_path]').val(),
                            type: "DELETE",
                            enctype: 'multipart/form-data',
                            processData: false,
                            contentType: false
                        }).done(function( data ) {
                            $('.fileupload-response').text("'No file chosen'");
                        }).fail(function(data) {
                            console.log("Can't delete file");
                        });
                        }
}
            $('#file').on("change", function(){ handleFile(true); });
            $('.delete-file').on("click", function(){ handleFile(false); });
EOL;

        return $script;
    }


}