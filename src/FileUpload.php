<?php


namespace Ehel\FileUpload;

/**
 * Class FileUpload
 * @package Ehel\FileUpload
 */
class FileUpload
{
    //Todo Scripts
    /**
     * Generate buttons
     * @param $directory
     * @param $class
     * @return string
     */
    public function buttons($directory, $class){

        $html = <<<EOL
            <div class="form-group $class">
                <div class="input-wrapper">
                    <input type="hidden" name="file_path">
                    <input type="hidden" name="directory" value="$directory">
                    <span class="btn btn-success fileinput-button" style="cursor: pointer;position: relative;">
                        <input type="file" name="file" id="file" class="inputfile" style="width: 0.1px;height: 0.1px;opacity: 0;overflow: hidden;position: absolute;z-index: -1;" />
                        <label for="file" style="display: initial;cursor: pointer;font-weight: inherit;">Choose a file</label>
                    </span>
                    <span type="button" class="btn btn-danger delete-file" data-scope="action" data-action="deleteFile" data-filename="">
                        <i class="fa fa-trash"></i>
                        <span>
                        Delete file </span>
                    </span>
                    <code class="fileupload-response" data-filename=""> 'No file chosen'</code>
                </div>
            </div>
EOL;

        return $html;
    }


    /**
     * Generate script
     * @param $uploadSuccess
     * @param $uploadFail
     * @param $deleteSuccess
     * @return string
     */
    public function script($uploadSuccess = '', $uploadFail = '', $deleteSuccess= ''){
        $route = config('fileupload.route_prefix')."/".config('fileupload.route_name');
        $ajaxUploadFail = config('fileupload.ajaxUploadFail');
        $ajaxDeleteFail = config('fileupload.ajaxDeleteFail');
        $_token = csrf_token();
        $url = url()->full()."/".$route;
        $script = <<<EOL
            function handleFile(uploadFile, event) {
                if(uploadFile){
                        fd = new FormData();
                        fd.append("file", $('input[type=file]')[0].files[0]);
                        fd.append("directory", $('input[name=directory]').val());
                        fd.append("file_path", $('input[name=file_path]').val());
                        fd.append("_token",'$_token');

                        $.ajax({
                            url: "$url",
                            type: "POST",
                            data: fd,
                            enctype: 'multipart/form-data',
                            processData: false,
                            contentType: false
                        }).done(function( data ) {

                            if(!data.error){
                                $('.fileupload-response').text(data.message);
                                $('input[name=file_path]').val(data.message);
                                $(".inputfile").prop('disabled', true);
                                $('.fileinput-button').addClass('disabled');
                                $uploadSuccess
                            } else {
                                $('.fileupload-response').text(data.errors);
                                $uploadFail
                            }


                        }).fail(function(data) {
                            $ajaxUploadFail
                        });
                        }else {
                            $.ajax({
                            url: "$url"+"?file_path="+$('input[name=file_path]').val(),
                            type: "DELETE",
                            data: {"_token" : '$_token'}
                        }).done(function( data ) {
                            $('.fileupload-response').text("'No file chosen'");
                            $(".inputfile").prop('disabled', false);
                            $('.fileinput-button').removeClass('disabled');
                            $deleteSuccess
                        }).fail(function(data) {
                            $ajaxDeleteFail
                        });
                        }
}
            $('#file').on("change", function(){ handleFile(true); });
            $('.delete-file').on("click", function(){ handleFile(false); });
EOL;

        return $script;
    }


}