<?php

namespace App\Models;

use CodeIgniter\Model;

class FeesCategoryModel extends Model
{
    protected $table = 'feecategories';
    protected $primaryKey = 'fee_category_id';

    protected $allowedFields = [
        'fee_category_name',
		'status',
		'college_id'
       
		
    ];

    protected $validationRules = [
	    'fee_category_name' => 'required|min_length[3]|max_length[255]',
		'college_id' => 'required|integer',
		'status' => 'required|in_list[active,inactive]',
		
  ];

    protected $validationMessages = [
        'fee_category_name' => [
            'required' => 'The Category name field is required.',
            'min_length' => 'The Category name should be at least {param} characters long.',
            'max_length' => 'The Category name should not exceed {param} characters.',
        ],
		
        'college_id' => [
            'required' => 'The College name field is required.',
            'integer' => 'The College name field must be an integer.',
        ],		
        'status' => [
            'required' => 'The status field is required.',
            'in_list' => 'The status field should be either active or inactive.',
        ],
    ];

    protected $skipValidation = false;
    
    
    public function findAllActivefeesCategory()
    {
        return $this->select('feecategories.*,colleges.college_name')
              ->join('colleges', 'feecategories.college_id = colleges.college_id')
            ->where('feecategories.status', 'active')
            ->findAll();
    }
}
