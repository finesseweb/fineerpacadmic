<?php

namespace App\Models;

use CodeIgniter\Model;

class FeeStructureDetailsModel extends Model
{
    protected $table = 'feestructuredetails';
    protected $primaryKey = 'fee_structure_detail_id';

    protected $allowedFields = [
        'fee_structure_id',
		'fee_head_id',
		'amount',
		'status',
		'college_id',
		'caste_category_id'
       
		
    ];

    protected $validationRules = [
	    'fee_structure_id' => 'required|integer',
		'college_id' => 'required|integer',
		'status' => 'required|in_list[active,inactive]',
		
  ];

    protected $validationMessages = [
        'fee_structure_id' => [
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
        return $this->select('feestructures.*,academicyears.academic_year_code,colleges.college_name')
             ->join('academicyears', 'feestructures.academic_year_id = academicyears.academic_year_id')
			// ->join('castecategory', 'feestructures.caste_category_id = castecategory.caste_category_id')
			 ->join('colleges', 'feestructures.college_id = colleges.college_id')
            ->where('feestructures.status', 'active')
            ->findAll();
    }
}
