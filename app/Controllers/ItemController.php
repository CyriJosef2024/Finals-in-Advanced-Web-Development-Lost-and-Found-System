<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;

class ItemController extends BaseController
{
    public function index()
    {
        // Load helpers required for this view
        helper(['text', 'form']);

        $itemModel = new ItemModel();

        // 1. Grab search parameters from the URL (Search Persistence)
        $keyword = $this->request->getGet('keyword');
        $type = $this->request->getGet('type');

        // M3 Requirement: Smart Caching
        // Only cache the main page for 60 seconds if no search filters are applied
        if (empty($keyword) && empty($type)) {
            $this->cachePage(60);
        }

        // 2. Fetch data using our new Model method (6 items per page)
        $result = $itemModel->getPaginatedItems($keyword, $type, 6);

        // 3. Pass everything to the view
        $data = [
            'items'   => $result['items'],
            'pager'   => $result['pager'],
            'keyword' => $keyword,
            'type'    => $type
        ];

        return view('items/index', $data);
    }

    public function create()
    {
        return view('items/create');
    }

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

    // Displays the management screen (Requires correct ID and Token)
    public function manage($id, $token)
    {
        $itemModel = new ItemModel();
        $item = $itemModel->find($id);

        // Security check: Does the item exist and does the token match?
        if (!$item || $item['edit_token'] !== $token) {
            return redirect()->to('/items')->with('errors', ['Invalid or expired management link.']);
        }

        return view('items/manage', ['item' => $item]);
    }

    // Processes the status update
    public function update($id)
    {
        $itemModel = new ItemModel();
        
        // 1. Verify the token was passed via POST for security
        $token = $this->request->getPost('edit_token');
        $item = $itemModel->find($id);

        if (!$item || $item['edit_token'] !== $token) {
            return redirect()->to('/items')->with('errors', ['Unauthorized update attempt.']);
        }

        // 2. Update the status
        $newStatus = $this->request->getPost('status');
        if (in_array($newStatus, ['open', 'claimed', 'resolved'])) {
            $itemModel->update($id, ['status' => $newStatus]);
            session()->setFlashdata('success', 'Item status updated successfully.');
        }

        return redirect()->to("/items/manage/{$id}/{$token}");
    }
}
