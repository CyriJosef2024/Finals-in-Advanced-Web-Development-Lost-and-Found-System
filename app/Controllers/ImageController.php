<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class ImageController extends BaseController
{
    public function show($filename)
    {
        // Security (M1 Check): Ensure the filename doesn't contain directory traversal dots (../)
        if (strpos($filename, '..') !== false || strpos($filename, '/') !== false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $path = WRITEPATH . 'uploads/' . $filename;

        // Check if the file actually exists
        if (!file_exists($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get the MIME type so the browser knows it's an image, not a text file
        $mime = mime_content_type($path);
        
        // Output the image securely
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    }
}