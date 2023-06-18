<?php

class UserQRService
{
    private $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    public function generateQRForUser()
    {
        $dir = 'public/qr/';

        if (!file_exists($dir)) {
            mkdir($dir);
        }
        $userName = $_GET['name'];
        $filename = $dir . $userName . '.png';

        if (!file_exists($filename)) {
            $size = 9;
            $level = 'M';
            $frameSize = 1;
            $content = "localhost/user&name=" . $userName;
            QRcode::png($content, $filename, $level, $size, $frameSize);
        }
    }
}