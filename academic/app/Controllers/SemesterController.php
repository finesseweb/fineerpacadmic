<?php

namespace App\Controllers;

use App\Models\SemesterModel;
use App\Models\CollegeModel;
use App\Models\AcademicYearModel;
use CodeIgniter\Controller;

class SemesterController extends Controller
{
    private $feecategoryModel;
    private $collegeModel;
    private $session;

    public function __construct()
    {
        $this->session = session();
        $this->semesterModel = new SemesterModel();
		$this->academicyearModel = new AcademicYearModel();
		$this->collegeModel = new CollegeModel();
        
		
    }

    // Common method to load header, sidebar, and footer views
    private function loadCommonViews($viewName, $data = [])
    {
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view($viewName, $data);
        echo view('templates/footer', $data);
    }

    public function index()
    {
        $data['semesters'] = $this->semesterModel->findAllActiveSemester();
		//print_r($data); die();
        $this->loadCommonViews('Semester/index', $data);
    }

    public function create()
    {
        
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academicyears'] = $this->academicyearModel->GetData();
        $this->loadCommonViews('Semester/create', $data);
    }

    public function store()
    {
        $semesterModel = $this->semesterModel;
        $validationRules = $semesterModel->getValidationRules();
//print_r($validationRules); die();

        
        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
			
			
            // Save caste data
            $semesterModel->save([
                'semester_name' => $this->request->getPost('semester_name'),
				'academic_year_id' => $this->request->getPost('academic_year_id'),
				'start_date' => $this->request->getPost('start_date'),
				'end_date' => $this->request->getPost('end_date'),
				'college_id' => $this->request->getPost('college_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/semester')->with('success', 'Category added successfully');
        }
          
       
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academicyears'] = $this->academicyearModel->GetData();
		 $this->loadCommonViews('Semester/create', $data);
    }

    public function edit($id)
    {
        $data['semester'] = $this->semesterModel->find($id);
      // print_r($data); die();
        if (!$data['semester']) {
            return redirect()->to('/semester')->with('error', 'Fees Category not found');
        }

        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->academicyearModel->GetData();
		//$data['degrees'] = $this->degreeModel->GetData();
		//$data['department'] = $this->departmentModel->findAllActiveDepartments();
        $this->loadCommonViews('Semester/edit', $data);
    }

    public function update($id)
    {
        $semester = $this->semesterModel->find($id);

        if (!$semester) {
            return redirect()->to('/semester')->with('error', 'fees category not found');
        }

        $validationRules = $this->semesterModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Update caste data
            $this->semesterModel->update($id, [
               'semester_name' => $this->request->getPost('semester_name'),
				'academic_year_id' => $this->request->getPost('academic_year_id'),
				'start_date' => $this->request->getPost('start_date'),
				'end_date' => $this->request->getPost('end_date'),
				'college_id' => $this->request->getPost('college_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/semester')->with('success', 'Semester updated successfully');
        }

        $data['semester'] = $semester;
        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->AcademicYearModel->GetData();
		//$data['degrees'] = $this->degreeModel->GetData();
		//$data['department'] = $this->departmentModel->findAllActiveDepartments();
        $this->loadCommonViews('Semester/edit', $data);
    }

    public function delete($id)
    {
        $course = $this->courseModel->find($id);

        if (!$course) {
            return redirect()->to('/semester')->with('error', 'Course not found');
        }

        $this->courseModel->delete($id);
        return redirect()->to('/semester')->with('success', 'Course deleted successfully');
    }
}
