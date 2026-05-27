<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;

class ItemController extends BaseController
{
    public function index()
    {
        $itemModel = new ItemModel();
        
        // Fetch all items. (We will let Jasmin upgrade this to getPaginatedItems() later)
        $data['items'] = $itemModel->orderBy('created_at', 'DESC')->findAll();

        return view('items/index', $data);
    }

    // ... (Keep your existing create() and store() methods here) ...
    public function store()
    {
        $itemModel = new ItemModel();

        // 1. Map the incoming form data
        $data = [
            'type'          => $this->request->getPost('type'),
            'title'         => $this->request->getPost('title'),
            'location'      => $this->request->getPost('location'),
            'contact_name'  => $this->request->getPost('contact_name'),
            'contact_email' => $this->request->getPost('contact_email'),
            'status'        => 'open',
            // Generate a secure, random 32-character token for auth-less editing
            'edit_token'    => bin2hex(random_bytes(16)), 
        ];

        // 2. M2 Handoff: Secure File Upload (Kenneth's Domain)
        $img = $this->request->getFile('photo');
        
        if ($img && $img->isValid() && !$img->hasMoved()) {
            // Generate a random filename to prevent malicious file execution masking
            $newName = $img->getRandomName();
            
            // Move it strictly to the WRITEPATH (outside the public web root)
            $img->move(WRITEPATH . 'uploads', $newName);
            
            // Save the hashed filename to the database
            $data['photo'] = $newName; 
        }

        // 3. Save to Database (This automatically triggers your Model's validation rules!)
        if ($itemModel->save($data)) {
            $insertId = $itemModel->getInsertID();
            $manageLink = base_url("items/manage/{$insertId}/{$data['edit_token']}");
            
            // Flash a success message containing their unique edit link
            session()->setFlashdata('success', 'Item reported successfully! Save this link to update your post later: <br> <a href="'.$manageLink.'">'.$manageLink.'</a>');
            
            return redirect()->to('/items');
        } else {
            // If validation fails, send them back with errors and their old input
            return redirect()->back()->withInput()->with('errors', $itemModel->errors());
            
            dd($this->request->getPost());
        }
    }
       
}
