<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;

class FileUploadTest extends TestCase
{
 use WithoutMiddleware;

    public function testRoutes()
    {
        $path = config('fileupload.route_prefix').'/'.config('fileupload.route_name');
        $response = $this->call('POST', '/'.$path);
        $response_delete = $this->call('DELETE', '/'.$path);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(200, $response_delete->getStatusCode());

    }

    public function testFileUpload()
    {
        $path = config('fileupload.route_prefix').'/'.config('fileupload.route_name');
        $file_path =__DIR__.'\laravel.png';
        $uploadedFile = new Symfony\Component\HttpFoundation\File\UploadedFile($file_path, 'laravel.png','image/png', 446, null, null, TRUE );
        $response_upload = $this->call('POST', $path, ['directory' => 'test'],[], ['file' => $uploadedFile]);
        $this->assertEquals(200, $response_upload->getStatusCode());
    }
}