<?php

namespace App\Models;

use CodeIgniter\Model;

class SemesterModel extends Model
{
    protected $table = 'semesters';
    protected $primaryKey = 'semester_id';

    protected $allowedFields = [
        'semester_name',
		'start_date',
		'end_date',
		'academic_year_id',
		'status',
		'college_id',
       
		
    ];

    protected $validationRules = [
	    'semester_name' => 'required|min_length[3]|max_length[255]',
		'college_id' => 'required|integer',
		'academic_year_id' => 'required|integer',
		'status' => 'required|in_list[active,inactive]',
		
  ];

    protected $validationMessages = [
        'semester_name' => [
            'required' => 'The Semester name field is required.',
            'min_length' => 'The Semester name should be at least {param} characters long.',
            'max_length' => 'The Semester name should not exceed {param} characters.',
        ],
		
        'college_id' => [
            'required' => 'The College name field is required.',
            'integer' => 'The College name field must be an integer.',
        ],		
        'academic_year_id' => [
            'required' => 'The College name field is required.',
            'integer' => 'The College name field must be an integer.',
        ],
		'status' => [
            'required' => 'The status field is required.',
            'in_list' => 'The status field should be either active or inactive.',
        ],
    ];

    protected $skipValidation = false;
    
    
    public function findAllActiveSemester()
    {
        return $this->select('semesters.*,colleges.college_name,academicyears.academic_year_code')
              ->join('colleges', 'semesters.college_id = colleges.college_id')
			  ->join('academicyears', 'semesters.academic_year_id = academicyears.academic_year_id')
            ->where('semesters.status', 'active')
            ->findAll();
    }
	
	public function GetDataByAcademic($academic)
    {
        return $this->db->table('semesters')
		                   ->where('status','active')
						   ->where('academic_year_id',$academic)
                          ->get()->getResultArray();
                          

    }
}
