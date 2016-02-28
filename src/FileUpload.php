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
    public function buttons(){

        return 'foo';

    }


    /**
     * Generate script
     * @return string
     */
    public function script(){
        return 'baz';
    }


}