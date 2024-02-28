<?php

namespace App\Controllers;

use App\Models\CasteCategoryModel;
use App\Models\AcademicYearModel;
use App\Models\CollegeModel;
use App\Models\FeeStructureModel;
use App\Models\FeesCategoryModel;
use App\Models\FeesHeadModel;
use App\Models\FeeStructureDetailsModel;


use CodeIgniter\Controller;

class FeeStructureController extends Controller
{
    private $castategoryModel;
    private $collegeModel;
    private $academicyearModel;
	private $feestructureModel;
	private $feescategoryModel;
    private $feesheadModel;
	private $feestructuredetailsModel;
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
		$this->feestructuredetailsModel = new FeeStructureDetailsModel();
		
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
        $this->loadCommonViews('Feestructure/index', $data);
    }

    public function create()
    {
        
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->academicyearModel->GetData();
		$data['castcategorys'] = $this->castategoryModel->findAllActiveCategories();
		$data['feescategorys'] = $this->feescategoryModel->findAllActivefeesCategory();
		$data['feeheadmodel'] = $this->feesheadModel;
        $this->loadCommonViews('Feestructure/create', $data);
    }

    public function store()
    {
        $feestructureModel = $this->feestructureModel;
		$feestructuredetailsModel = $this->feestructuredetailsModel;
        $validationRules = $feestructureModel->getValidationRules();
      

        
        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
			
			
            // Save caste data
            $feestructureModel->save([
                'academic_year_id' => $this->request->getPost('academic_year_id'),
				'caste_category_id' => $this->request->getPost('caste_category_id'),
				'college_id' => $this->request->getPost('college_id'),
                'status' => $this->request->getPost('status'),
            ]);
			
			for($i=0;$i<count($this->request->getPost('amount'));$i++) {
				$heads=$this->request->getPost('fee_head_id'); 
				$amt=$this->request->getPost('amount'); 
				
				$data= [
			    'fee_structure_id' =>$feestructureModel->getInsertID(),
				'amount'=>$amt[$i],
				'fee_head_id'=>$heads[$i],
				'status'=>$this->request->getPost('status'),
				'college_id'=>$this->request->getPost('college_id'),
				'caste_category_id' => $this->request->getPost('caste_category_id'),
              ];
				  //print_r($data); die();
				$insert= $feestructuredetailsModel->insert($data);
			}
			

            return redirect()->to('/feestructure')->with('success', 'Fee Structure added successfully');
        }
          
       
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->academicyearModel->GetData();
		$data['castcategorys'] = $this->castategoryModel->findAllActiveCategories();
		 $this->loadCommonViews('Feestructure/create', $data);
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
        $this->loadCommonViews('Feestructure/edit', $data);
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
        $this->loadCommonViews('Feestructure/edit', $data);
    }

    public function delete($id)
    {
        $course = $this->courseModel->find($id);

        if (!$course) {
            return redirect()->to('/feestructure')->with('error', 'Course not found');
        }

        $this->courseModel->delete($id);
        return redirect()->to('/feestructure')->with('success', 'Course deleted successfully');
    }
}
