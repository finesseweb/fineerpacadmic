<?php

namespace App\Models;

use CodeIgniter\Model;

class AcademicYearModel extends Model
{
  protected $table = 'academicyears';
    protected $primaryKey = 'academic_year_id';
    protected $allowedFields = ['academic_year_code', 'start_date', 'end_date', 'status','cast_cat'];

   
 protected $validationRules = [
      'academic_year_code' => 'required|max_length[20]',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required|in_list[active,inactive]',
    ];
public function getActiveAcademicYearsWithCollegesAndUniversities()
{
    return $this->select('academicyears.*, colleges.college_name, universities.university_name')
        ->join('academicyearcollege', 'academicyears.academic_year_id = academicyearcollege.academic_year_id', 'left')
        ->join('colleges', 'academicyearcollege.college_id = colleges.college_id', 'left')
        ->join('universities', 'colleges.university_id = universities.university_id', 'left')
       // ->where('AcademicYears.status', 'active')
        ->where('colleges.status', 'active')
        ->where('universities.status', 'active')
        ->groupBy('academicyears.academic_year_id')
        ->findAll();
}



    public function insertAcademicYear($data)
    {
        $this->insert($data);
        return $this->insertID();
    }

    public function updateAcademicYear($id, $data)
    {
        $this->update($id, $data);
    }

    public function deleteAcademicYear($id)
    {
        $this->delete($id);
    }

    public function insertColleges($academicYearId, $collegeIds)
    {
        $data = [];
        foreach ($collegeIds as $collegeId) {
            $data[] = [
                'academic_year_id' => $academicYearId,
                'college_id' => $collegeId,
            ];
        }
        $this->db->table('academicyearcollege')->insertBatch($data);
    }

    public function deleteCollegesForAcademicYear($academicYearId)
    {
        $this->db->table('academicyearcollege')->where('academic_year_id', $academicYearId)->delete();
    }

    public function getCollegeIdsForAcademicYear($academicYearId)
    {
        return $this->db->table('academicyearcollege')
            ->where('academic_year_id', $academicYearId)
            ->get()->getResultArray();
    }
	
	
	public function GetData()
    {
        return $this->db->table('academicyears')
		                   ->where('status','active')
                          ->get()->getResultArray();
                          

    }
	public function getCastStatus($academicID)
    {
        return $this->db->table('academicyears')
		                   ->where('status','active')
						    ->where('academic_year_id',$academicID)
                             ->get()->getRowArray();
                          

    }
}
  
    
     

