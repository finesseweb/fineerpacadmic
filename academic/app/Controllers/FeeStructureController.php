<?php

namespace App\Controllers;

use App\Models\CasteCategoryModel;
use App\Models\AcademicYearModel;
use App\Models\CollegeModel;
use App\Models\FeeStructureModel;
use App\Models\FeesCategoryModel;
use App\Models\FeesHeadModel;

use CodeIgniter\Controller;

class FeeStructureController extends Controller
{
    private $castategoryModel;
    private $collegeModel;
    private $academicyearModel;
	private $feestructureModel;
	private $feescategoryModel;
    private $feesheadModel;
    private $session;

    public function __construct()
    {
        $this->session = session();
        $this->castategoryModel = new CasteCategoryModel();
		$this->collegeModel = new CollegeModel();
		$this->academicyearModel = new AcademicYearModel();
		$this->feestructureModel = new FeeStructureModel();
		$this->feescategoryModel = new FeesCategoryModel();
        $this->feesheadModel = new FeesHeadModel();
		
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
        $data['feestructures'] = $this->feestructureModel->findAllActivefeeshead();
		
		//print_r($data); die();
        $this->loadCommonViews('feestructure/index', $data);
    }

    public function create()
    {
        
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->academicyearModel->GetData();
		$data['castcategorys'] = $this->castategoryModel->findAllActiveCategories();
		$data['feescategorys'] = $this->feescategoryModel->findAllActivefeesCategory();
		$data['feeheadmodel'] = $this->feesheadModel;
        $this->loadCommonViews('feestructure/create', $data);
    }

    public function store()
    {
        $feestructureModel = $this->feestructureModel;
        $validationRules = $feestructureModel->getValidationRules();
//print_r($validationRules); die();

        
        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
			
			
            // Save caste data
            $feestructureModel->save([
                'academic_year_id' => $this->request->getPost('academic_year_id'),
				'caste_category_id' => $this->request->getPost('caste_category_id'),
				'college_id' => $this->request->getPost('college_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/feestructure')->with('success', 'Fee Structure added successfully');
        }
          
       
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->academicyearModel->GetData();
		$data['castcategorys'] = $this->castategoryModel->findAllActiveCategories();
		 $this->loadCommonViews('feestructure/create', $data);
    }

    public function edit($id)
    {
        $data['feesstructures'] = $this->feestructureModel->find($id);
      // print_r($data); die();
        if (!$data['feesstructures']) {
            return redirect()->to('/feestructure')->with('error', 'Fees Structure not found');
        }

        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->academicyearModel->GetData();
		$data['castcategorys'] = $this->castategoryModel->findAllActiveCategories();
        $this->loadCommonViews('feestructure/edit', $data);
    }

    public function update($id)
    {
        $feesstructure = $this->feestructureModel->find($id);

        if (!$feesstructure) {
            return redirect()->to('/feestructure')->with('error', 'fees Structure not found');
        }

        $validationRules = $this->feestructureModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Update caste data
            $this->feestructureModel->update($id, [
               'academic_year_id' => $this->request->getPost('academic_year_id'),
				'caste_category_id' => $this->request->getPost('caste_category_id'),
				'college_id' => $this->request->getPost('college_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/feestructure')->with('success', 'Fees Structure updated successfully');
        }

        $data['feesstructures'] = $feesstructure;
      
		  $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->academicyearModel->GetData();
		$data['castcategorys'] = $this->castategoryModel->findAllActiveCategories();
        $this->loadCommonViews('feeshead/edit', $data);
    }

    public function delete($id)
    {
        $course = $this->courseModel->find($id);

        if (!$course) {
            return redirect()->to('/feeshead')->with('error', 'Course not found');
        }

        $this->courseModel->delete($id);
        return redirect()->to('/feeshead')->with('success', 'Course deleted successfully');
    }
}
