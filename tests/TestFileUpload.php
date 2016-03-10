<?php
//use Illuminate\Foundation\Testing\TestCase;
use TestCase;
class FileUploadTest extends TestCase
{
    public function testRoutes()
    {
        $path = config('fileupload.route_prefix').config('fileupload.route_name');
        $this->json('POST', '/'.$path, ['name' => 'Test'])
            ->seeJson([
                'created' => true,
            ]);
    }
}