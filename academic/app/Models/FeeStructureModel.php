<?php

namespace App\Models;

use CodeIgniter\Model;

class FeeStructureModel extends Model
{
    protected $table = 'feestructures';
    protected $primaryKey = 'fee_structure_id';

    protected $allowedFields = [
        'academic_year_id',
		'caste_category_id',
		'status',
		'college_id',
		'total_grand_value1',
		'course_id'
       
		
    ];

    protected $validationRules = [
	    'academic_year_id' => 'required|integer',
		
		'college_id' => 'required|integer',
		'status' => 'required|in_list[active,inactive]',
		
  ];

    protected $validationMessages = [
        'academic_year_id' => [
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
    
    
    public function findAllActivefeesstructure()
    {
        return $this->select('feestructures.*,academicyears.academic_year_code,colleges.college_name,courses.course_name')
             ->join('academicyears', 'feestructures.academic_year_id = academicyears.academic_year_id')
			 ->join('courses', 'feestructures.course_id = courses.course_id')
			 ->join('colleges', 'feestructures.college_id = colleges.college_id')
             ->where('feestructures.status', 'active')
			 ->limit('10')
			//->groupBy('academic_year_id')
            ->findAll();
    }
	
	
	public function getAcademicId($structure_id)  //company_id is main Company Id

    {       
        return  $this->db->table('feestructures')
                         ->where('fee_structure_id', $structure_id)
                        ->get()->getRowArray();

    }
	
	public function getStructureRecords($college,$acad)  //company_id is main Company Id

    {       
        return $this->select('feestructures.*,academicyears.academic_year_code,colleges.college_name,courses.course_name')
             ->join('academicyears', 'feestructures.academic_year_id = academicyears.academic_year_id')
			 ->join('courses', 'feestructures.course_id = courses.course_id')
			 ->join('colleges', 'feestructures.college_id = colleges.college_id')
             ->where('feestructures.status', 'active')
			 ->where('feestructures.college_id', $college)
			 ->where('feestructures.academic_year_id', $acad)
			 ->limit('10')
			//->groupBy('academic_year_id')
            ->findAll();
    }
}
