<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'type',
        'title',
        'description',
        'category',
        'location',
        'contact_name',
        'contact_email',
        'contact_phone',
        'photo',
        'status',
        'edit_token'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'type' => 'required|in_list[lost,found]',
        'title' => 'required|min_length[3]|max_length[200]',
        'description' => 'permit_empty|max_length[5000]',
        'location' => 'required|max_length[255]',
        'contact_name' => 'required|max_length[100]',
        'contact_email' => 'required|valid_email|max_length[255]',
        'contact_phone' => 'permit_empty|max_length[50]',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
    /**
     * Retrieves paginated and filtered items.
     * M3 Requirement: Search Persistence & Pagination
     */
    public function getPaginatedItems($keyword = null, $type = null, $perPage = 6)
    {
        // If the user typed something in the search bar
        if (!empty($keyword)) {
            $this->groupStart()
                ->like('title', $keyword)
                ->orLike('description', $keyword)
                ->orLike('location', $keyword)
                ->groupEnd();
        }

        // If the user filtered by 'lost' or 'found'
        if (!empty($type) && in_array($type, ['lost', 'found'])) {
            $this->where('type', $type);
        }

        // Always show the newest items first
        $this->orderBy('created_at', 'DESC');

        // Return both the data array and the pagination object
        return [
            'items' => $this->paginate($perPage),
            'pager' => $this->pager
        ];
    }
}
