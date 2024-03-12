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
    
    
    public function findAllActivefeesdetails()
    {
        return $this->select('feestructuredetails.*')
             ->join('feestructures', 'feestructuredetails.fee_structure_id = feestructures.fee_structure_id')
			 ->join('feeheads', 'feestructuredetails.fee_head_id = feeheads.fee_head_id')
			// ->join('colleges', 'feestructures.college_id = colleges.college_id')
            ->where('feestructuredetails.status', 'active')
            ->findAll();
    }
	
	
	public function getamountbyhead($StrucID,$catID,$headID,$cmnterms)
    {
		//echo $StrucID; die();
		
        return $this->db->table('feestructuredetails')
		->join('feestructures', 'feestructuredetails.fee_structure_id = feestructures.fee_structure_id')
		->join('academicyears', 'feestructures.academic_year_id = academicyears.academic_year_id')
		->join('semesters', 'academicyears.academic_year_id = semesters.academic_year_id')
		                ->where('feestructuredetails.status','active')
						->where('feestructuredetails.fee_structure_id',$StrucID)
						->where('feestructuredetails.fee_category_id',$catID)
						->where('fee_head_id',$headID)
						->where('feestructuredetails.term_id',$cmnterms)
                        ->get()->getRowArray();
       // echo $select   ; die();               
 
    }
	public function getamountbyheadID($StrucID,$catID,$headID)
    {
		//echo $cmnterms; die();
		
        return $this->db->table('feestructuredetails')
		->join('feestructures', 'feestructuredetails.fee_structure_id = feestructures.fee_structure_id')
		->join('academicyears', 'feestructures.academic_year_id = academicyears.academic_year_id')
		->join('semesters', 'academicyears.academic_year_id = semesters.academic_year_id')
		                ->where('feestructuredetails.status','active')
						->where('feestructuredetails.fee_structure_id',$StrucID)
						->where('feestructuredetails.fee_category_id',$catID)
						->where('fee_head_id',$headID)
						//->where('feestructuredetails.term_id',$cmnterms)
                        ->get()->getRowArray();
       // echo $select   ; die();               
 
    }
	
	public function getamountbycatID($StrucID,$catID,$cmnterms)
    {
		//echo $cmnterms; die();
		
        return $this->db->table('feestructuredetails')
		->join('feestructures', 'feestructuredetails.fee_structure_id = feestructures.fee_structure_id')
		->join('academicyears', 'feestructures.academic_year_id = academicyears.academic_year_id')
		->join('semesters', 'academicyears.academic_year_id = semesters.academic_year_id')
		                ->where('feestructuredetails.status','active')
						->where('feestructuredetails.fee_structure_id',$StrucID)
						->where('feestructuredetails.fee_category_id',$catID)
						//->where('fee_head_id',$headID)
						->where('feestructuredetails.term_id',$cmnterms)
                        ->get()->getRowArray();
       // echo $select   ; die();               
 
    }
	
	public function getamountbycat($StrucID,$catID,$cmnterms)
    {
		//echo $cmnterms; die();
		
        return $this->select('SUM(feestructuredetails.amount) as totcat')
		
		                ->where('feestructuredetails.status','active')
						->where('feestructuredetails.fee_structure_id',$StrucID)
						->where('feestructuredetails.fee_category_id',$catID)
						//->where('fee_head_id',$headID)
						->where('feestructuredetails.term_id',$cmnterms)
                        ->get()->getRowArray();
       // echo $select   ; die();               
 
    }
	
	
	 public function DeleteRecord($structure)
    {
        return  $this->db->table('feestructuredetails')
                         ->where('fee_structure_id', $structure)
                         ->delete();
    }
}
