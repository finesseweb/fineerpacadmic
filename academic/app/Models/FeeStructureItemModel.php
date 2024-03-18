<?php

namespace App\Models;

use CodeIgniter\Model;

class FeeStructureItemModel extends Model
{
    protected $table = 'feestructure_item_details';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'stucture_id',
		'grand_term1_result',
		'grand_term2_result',
		'grand_term3_result',
		'grand_term4_result',
		'grand_term5_result',
		'grand_term6_result',
		'grand_term7_result',
		'grand_term8_result',
		'total_grand_value'
       
		
    ];

    protected $validationRules = [
	    'stucture_id' => 'required|integer',
		
		
  ];

    protected $validationMessages = [
        'stucture_id' => [
           'required' => 'The Category name field is required.',
           'integer' => 'The Category name field must be an integer.',
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
        return  $this->db->table('feestructure_item_details')
                         ->where('stucture_id', $structure)
                         ->delete();
    }
	
	public function getStructureRecords($structure_id)  //company_id is main Company Id

    {       
	   return  $this->db->table('feestructure_item_details')
                         ->where('stucture_id', $structure_id)
                         ->get()->getRowArray();

    }
    
    
    public function insertVal($feeData){
        $insert_id= $this->db->table('feestructure_item_details')
                 ->insert($feeData);
       return $insert_id;
    }
}
