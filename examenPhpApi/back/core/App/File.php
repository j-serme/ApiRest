<?php
namespace App;

class File
{

    private $uploadDirectory;

    private $fileData;

    private $extension;

    private $tempFile;

    private $name;

    private $target;

    private $mimetype;

    private $imagesAcceptees = ["image/png", "image/jpg", "image/jpeg", "image/gif"];



    public function __construct($index)
    {
        $this->uploadDirectory = dirname(__DIR__)."/../images/";

        $this->fileData = $_FILES[$index];

        $this->tempFile = $this->fileData['tmp_name'];

        $this->extension = pathinfo($this->fileData['name'], PATHINFO_EXTENSION);

        $this->name = uniqid().".".$this->extension;

        $this->target = $this->uploadDirectory . $this->name;

        $this->mimetype = $this->fileData['type'];

    }


    public function upload(){

        move_uploaded_file($this->tempFile, $this->target);
    }

    public function getName(){
        return $this->name;
    }

    public function isImage():bool {

       return in_array($this->mimetype,$this->imagesAcceptees);

    }


}
