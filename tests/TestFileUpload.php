<?php


class FileUploadTest extends TestCase
{
    public function testRoutes()
    {
        $path = config('fileupload.route_prefix').'/'.config('fileupload.route_name');
        $response = $this->call('POST', '/'.$path);
        $response_delete = $this->call('DELETE', '/'.$path);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(200, $response_delete->getStatusCode());

    }
}