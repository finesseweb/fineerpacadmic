<?php

namespace App\Models;

use CodeIgniter\Model;

class FeesHeadModel extends Model
{
    protected $table = 'feeheads';
    protected $primaryKey = 'fee_head_id';

    protected $allowedFields = [
        'fee_head_name',
		'fee_category_id',
		'status',
		'college_id'
       
		
    ];

    protected $validationRules = [
	    'fee_head_name.*' => 'required|min_length[3]|max_length[255]',
		'fee_category_id' => 'required|integer',
		'college_id' => 'required|integer',
		'status' => 'required|in_list[active,inactive]',
		
  ];

    protected $validationMessages = [
        'fee_head_name' => [
            'required' => 'The Head name field is required.',
            'min_length' => 'The Head name should be at least {param} characters long.',
            'max_length' => 'The Head name should not exceed {param} characters.',
        ],
		
        'fee_category_id' => [
            'required' => 'The Category name field is required.',
            'integer' => 'The Category name field must be an integer.',
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
    
    
    public function findAllActivefeeshead()
    {
        return $this->select('feeheads.*,feecategories.fee_category_name,colleges.college_name')
              ->join('feecategories', 'feeheads.fee_category_id = feecategories.fee_category_id')
			  ->join('colleges', 'feeheads.college_id = colleges.college_id')
            ->where('feeheads.status', 'active')
            ->findAll();
    }
}
