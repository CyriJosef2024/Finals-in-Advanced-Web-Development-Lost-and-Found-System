<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table            = 'items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'type', 'title', 'description', 'category', 'location',
        'date_occurred', 'contact_name', 'contact_email', 'contact_phone',
        'photo', 'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation rules
    protected $validationRules = [
        'type'           => 'required|in_list[lost,found]',
        'title'          => 'required|min_length[3]|max_length[200]',
        'description'    => 'permit_empty|max_length[5000]',
        'category'       => 'permit_empty|max_length[100]',
        'location'       => 'required|max_length[255]',
        'date_occurred'  => 'permit_empty|valid_date[Y-m-d]',
        'contact_name'   => 'required|max_length[100]',
        'contact_email'  => 'required|valid_email|max_length[255]',
        'contact_phone'  => 'permit_empty|max_length[50]',
        'photo'          => 'permit_empty|max_length[255]',
        'status'         => 'permit_empty|in_list[open,claimed,resolved]',
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;
}
