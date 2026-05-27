<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;

class ItemController extends BaseController
{
    public function index()
    {
        // We will build this with Jasmin for pagination later
        return view('items/index');
    }

    public function create()
    {
        helper('form');
        // Serves the submission form
        return view('items/create');
    }

    public function store()
    {
        helper('form');
        
        // This is where we will process the POST request, validate data, 
        // upload the image, and insert it into the database.
        // For now, let's just dump the POST data to verify CSRF is passing.
        
        dd($this->request->getPost()); 
    }
}