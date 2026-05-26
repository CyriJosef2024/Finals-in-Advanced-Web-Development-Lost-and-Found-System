<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ItemModel;

class ItemController extends BaseController
{
    protected ItemModel $itemModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
    }

    // READ: List all items with search and pagination
    public function index()
    {
        $keyword = trim((string) $this->request->getGet('search'));
        $keyword = $keyword === '' ? null : $keyword;

        $type = (string) $this->request->getGet('type'); // 'lost' or 'found' filter
        $type = in_array($type, ['lost', 'found'], true) ? $type : null;

        $query = $this->itemModel->orderBy('created_at', 'DESC');

        if ($keyword) {
            $query->groupStart()
                ->like('title', $keyword)
                ->orLike('description', $keyword)
                ->orLike('location', $keyword)
                ->groupEnd();
        }

        if ($type) {
            $query->where('type', $type);
        }

        $data['items']   = $query->paginate(10); // 10 items per page
        $data['pager']   = $this->itemModel->pager;
        $data['keyword'] = $keyword;
        $data['type']    = $type;

        return view('items/index', $data);
    }

    // CREATE: Show form to add new item
    public function create()
    {
        return view('items/create');
    }

    // STORE: Process the submitted form (POST)
    public function store()
    {
        // Validation (uses ItemModel rules)
        if (! $this->validate($this->itemModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $photoName = null;
        $photoFile = $this->request->getFile('photo_file');

        // Optional image upload with strict type/size checks.
        if ($photoFile !== null && $photoFile->getError() !== UPLOAD_ERR_NO_FILE) {
            if (! $photoFile->isValid()) {
                return redirect()->back()->withInput()->with('error', 'Uploaded image is invalid.');
            }

            $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
            $mimeType     = (string) $photoFile->getMimeType();
            $maxSizeBytes = 2 * 1024 * 1024; // 2 MB

            if (! in_array($mimeType, $allowedMimes, true)) {
                return redirect()->back()->withInput()->with('error', 'Photo must be a JPG, PNG, WEBP, or GIF image.');
            }

            if ($photoFile->getSize() > $maxSizeBytes) {
                return redirect()->back()->withInput()->with('error', 'Photo must be 2 MB or less.');
            }

            $uploadPath = WRITEPATH . 'uploads';

            if (! is_dir($uploadPath) && ! mkdir($uploadPath, 0755, true) && ! is_dir($uploadPath)) {
                return redirect()->back()->withInput()->with('error', 'Failed to prepare upload directory.');
            }

            $photoName = $photoFile->getRandomName();
            $photoFile->move($uploadPath, $photoName);
        }

        $toNullableString = static fn($value): ?string => (($value = trim((string) $value)) === '' ? null : $value);

        $data = [
            'type'           => (string) $this->request->getPost('type'),
            'title'          => (string) $this->request->getPost('title'),
            'description'    => $toNullableString($this->request->getPost('description')),
            'category'       => $toNullableString($this->request->getPost('category')),
            'location'       => (string) $this->request->getPost('location'),
            'date_occurred'  => $toNullableString($this->request->getPost('date_occurred')),
            'contact_name'   => (string) $this->request->getPost('contact_name'),
            'contact_email'  => (string) $this->request->getPost('contact_email'),
            'contact_phone'  => $toNullableString($this->request->getPost('contact_phone')),
            'status'         => 'open',
            'photo'          => $photoName,
        ];

        if ($this->itemModel->insert($data)) {
            return redirect()->to('/items')->with('message', 'Item posted successfully!');
        }

        if ($photoName !== null) {
            $filePath = WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR . $photoName;
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }

        return redirect()->back()->withInput()->with('error', 'Failed to post item.');
    }
}

