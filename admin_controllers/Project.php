<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Cms\ProjectModel;
use App\Models\Cms\ProjectCategoryModel;
use App\Models\coreModule\SettingModel;
use App\Models\Cms\EquipmentModel;



class Project extends BaseController
{
   
    public function __construct()
    {

        $settingModel = new SettingModel();
        $default_img = $settingModel->asObject()->where(array('key'=>'config_logo'))->first();
        $this->config_logo = $default_img->value; 
             
    }



   public function projects()
    {
       
        $model = new ProjectModel();
        $data['page_title'] ='All Projects';
         // pagination
        $data['perPage'] = 10;
        $data['detail'] = $model->asObject()->orderBy('id','asc')->paginate($data['perPage']);
        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

        $data['total'] = $model->countAllResults();

        $data['data'] = $model->paginate($data['perPage']);
        $data['pager'] = $model->pager;

        $data['pages'] = round($data['total']/$data['perPage']);
        $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
    // end
        echo view('admin/project/projects',$data);
    }


    function add_project($id=false)
     {
             
        $model = new ProjectModel();
        if(!empty($id)) {
        
        $data['page_title'] = ' Edit Projects';
        $data['form_action'] ='admin/add_project/'.$id;
        $row = $model->asObject()->where(array('id'=>$id))->first();
        
        $data['name'] =  $row->name;  
         
        $data['description'] = $row->description;
        $data['status'] = $row->status; 
        $data['sortOrder'] = $row->sortOrder; 
        $data['image'] = $row->image; 
        $data['banner'] = $row->banner; 
        $data['slug'] = $row->slug; 
        $data['metaTitle'] = $row->metaTitle; 
        $data['metaKeyword'] = $row->metaKeyword; 
        $data['metaDescription'] = $row->metaDescription; 

        }else{

        $data['page_title'] = ' Add Projects';
        $data['form_action'] ='admin/add_project';
        $data['name'] = '';    
    
        $data['image'] = ''; 
        $data['description'] = ''; 
        $data['status'] = '';
        $data['image'] = '';
        $data['sortOrder'] = ''; 
        $data['slug'] = '';
        $data['metaTitle'] = ''; 
        $data['metaKeyword'] = ''; 
        $data['metaDescription'] = ''; 
         $data['banner'] = '';  
     

        }
        
        if($this->request->getMethod()=='post'){
            
            $rules = [
                'name'=>'required'
            ];
        
         if ($this->validate($rules)==false) {
                $data['validation'] = $this->validator;
          } else{
          $save= array();
          $save['name'] =     $this->request->getVar('name');
          $save['description'] =     $this->request->getVar('description');
          $save['status'] =     $this->request->getVar('status');
          $save['sortOrder'] =     $this->request->getVar('sortOrder');
        
          if($this->request->getVar('slug')){
            $save['slug'] =     sfu($this->request->getVar('slug'));  
          }else{
            $save['slug'] =     sfu($this->request->getVar('name'));
          }
         
          $save['metaTitle'] =     $this->request->getVar('metaTitle');
          $save['metaKeyword'] =     $this->request->getVar('metaKeyword');
          $save['metaDescription'] =     $this->request->getVar('metaDescription');
                                
           if(!empty($_FILES['image']['name'])){
                $file = $this->request->getFile('image');
                if($file->isValid() && !$file->hasMoved()){
                    $file_name = $file->getRandomName();
                    if($file->move('uploads/images/', $file_name)){
                        $save['image'] =  'uploads/images/'.$file_name;
                    }
                }else{
                    throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
                    exit;
                }
            }
           
            if(!empty($_FILES['banner']['name'])){
                $file = $this->request->getFile('banner');
                if($file->isValid() && !$file->hasMoved()){
                    $file_name = $file->getRandomName();
                    if($file->move('uploads/images/', $file_name)){
                        $save['banner'] =  'uploads/images/'.$file_name;
                    }
                }else{
                    throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
                    exit;
                }
            }
           

          if ($id) {
            // print_r($save); exit;
            //   $save['modify_date'] = date('Y-m-d H:i:s');
             $result = $model->update(array('id'=>$id),$save);
              if ($result) {
              $this->session->setFlashdata('success','Record Update successfully');
              return redirect()->to('admin/add_project/'.$id);
              }else{
              $this->session->setFlashdata('error','Record not update');
              return redirect()->to('admin/add_project/'.$id);
              }
          }else{
            
           
             $result=  $model->insert($save);
              if ($result) {
             
              $this->session->setFlashdata('success','Record insert successfully');
              return redirect()->to('admin/projects');
              }else{
              $this->session->setFlashdata('error','Record not insert');
              return redirect()->to('admin/add_project');
              }
    
            }
    
          }
        }
        return view('admin/project/add_project',$data);
    
    }
    
    function delete_projects(){
        $model = new ProjectModel();
      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
         if ($id) {
             
            foreach($id as $value){
                $model->delete($value);
               }
           $this->session->setFlashdata('success','Record Delete successfully');
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/projects');
    }


//////////////////////////


    

   public function project_category()
    {
        error_reporting(0);
       
        $model = new ProjectCategoryModel();
        $data['page_title'] ='All Project Category';
         // pagination
        $data['perPage'] = 10;
        $data['detail'] = $model->asObject()->orderBy('id','asc')->paginate($data['perPage']);
        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

        $data['total'] = $model->countAllResults();

        $data['data'] = $model->paginate($data['perPage']);
        $data['pager'] = $model->pager;

        $data['pages'] = round($data['total']/$data['perPage']);
        $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
    // end
        echo view('admin/project/project_category',$data);
    }


    function add_project_category($id=false)
     {
            
        $model = new ProjectCategoryModel();
        
        $ProjectModel = new ProjectModel();
        $data['projectList'] = $ProjectModel->asObject()->findAll();
        
        
        if(!empty($id)) {
        
        $data['page_title'] = ' Edit Project Category';
        $data['form_action'] ='admin/add_project_category/'.$id;
        $row = $model->asObject()->where(array('id'=>$id))->first();
        
    
        $data['projectId'] = $row->projectId;
        $data['name'] = $row->name; 
        $data['shortDescription'] = $row->shortDescription; 
        $data['description'] = $row->description; 
        $data['image'] = $row->image; 
        $data['jobNo'] = $row->jobNo; 
        $data['sortOrder'] = $row->sortOrder; 
        $data['status'] = $row->status; 
           $data['thumbnail'] =  $row->thumbnail; 
         $data['featureList'] = $this->AdminModel->all_fetch('project_feature',array('project_category_id'=>$row->id)); 
          
         $data['equipmentList'] = $this->AdminModel->all_fetch('project_equipment',array('project_category_id'=>$row->id)); 
        
        
        

        }else{

        $data['page_title'] = ' Add Project Category';
        $data['form_action'] ='admin/add_project_category';
        $data['name'] = '';    
    
      
        $data['projectId'] = '';
        $data['name'] = ''; 
        $data['shortDescription'] = ''; 
        $data['description'] = ''; 
        $data['image'] = '';  
        $data['thumbnail'] = '';  
        $data['jobNo'] = '';
        $data['sortOrder'] = ''; 
        $data['status'] = '';   
      
         $data['featureList'] = [];
         $data['equipmentList'] = [];
        

        }
        
        if($this->request->getMethod()=='post'){
            
            $rules = [
                'name'=>'required'
            ];
        
         if ($this->validate($rules)==false) {
                $data['validation'] = $this->validator;
          } else{
          $save= array();
          $save['info']['name'] =     $this->request->getVar('name');
          $save['info']['description'] =     $this->request->getVar('description');
          $save['info']['status'] =     $this->request->getVar('status');
          $save['info']['sortOrder'] =     $this->request->getVar('sortOrder');
        
          if($this->request->getVar('slug')){
            $save['info']['slug'] =     sfu($this->request->getVar('slug'));  
          }else{
            $save['info']['slug'] =     sfu($this->request->getVar('name'));
          }
         

          $save['info']['projectId'] =     $this->request->getVar('projectId');
          $save['info']['shortDescription'] =     $this->request->getVar('shortDescription');
          $save['info']['jobNo'] =     $this->request->getVar('jobNo');
                           
         $save['equipment_old_id'] =     $this->request->getVar('equipment_old_id');
                          
                           
                                
           if(!empty($_FILES['image']['name'])){
                $file = $this->request->getFile('image');
                if($file->isValid() && !$file->hasMoved()){
                    $file_name = $file->getRandomName();
                    if($file->move('uploads/images/', $file_name)){
                        $save['info']['image'] =  'uploads/images/'.$file_name;
                    }
                }else{
                    throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
                    exit;
                }
            }
           
               if(!empty($_FILES['thumbnail']['name'])){
                $file = $this->request->getFile('thumbnail');
                if($file->isValid() && !$file->hasMoved()){
                    $file_name = $file->getRandomName();
                    if($file->move('uploads/images/', $file_name)){
                        $save['info']['thumbnail'] =  'uploads/images/'.$file_name;
                    }
                }else{
                    throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
                    exit;
                }
            }

          // EQUIPMENT  

        $featureImagesData = array();
          if ($this->request->getFileMultiple('featureImages')) {
          foreach($this->request->getFileMultiple('featureImages') as $key => $file)
           {  
             if($file->isValid() && !$file->hasMoved()){
             $file_name = $file->getRandomName();
             if($file->move('uploads/product/', $file_name)){
               $featureImagesData[$key] = 'uploads/product/'.$file_name;
             }   
           }
           }
           }
                    
        $save['featureImages'] = $featureImagesData;
        $save['feature_old_image'] = $this->request->getVar('feature_old_image');
        $save['equipmentTitle'] =  $this->request->getVar('equipmentTitle');
        $save['equipmentSlug'] = $this->request->getVar('equipmentSlug');
        $save['equipmentSortOrder'] = $this->request->getVar('equipmentSortOrder');


        // faq        
        $save['featureTitle'] =  $this->request->getVar('featureTitle');
        $save['featureDescription'] = $this->request->getVar('featureDescription');
        $save['featureSortOrder'] = $this->request->getVar('featureSortOrder');


          if ($id) {
            $save['id'] = $id;
       
             $result = $model->save_project_category($save);
              if ($result) {
              $this->session->setFlashdata('success','Record Update successfully');
              return redirect()->to('admin/add_project_category/'.$id);
              }else{
              $this->session->setFlashdata('error','Record not update');
              return redirect()->to('admin/add_project_category/'.$id);
              }

          }else{
             
             $result = $model->save_project_category($save);     
                    
              if ($result) {
             
              $this->session->setFlashdata('success','Record insert successfully');
              return redirect()->to('admin/project_category');
              }else{
              $this->session->setFlashdata('error','Record not insert');
              return redirect()->to('admin/add_project_category');
              }
    
            }
    
          }
        }
        return view('admin/project/add_project_category',$data);
    
    }
    
    function delete_project_category(){
        $model = new ProjectCategoryModel();
      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
         if ($id) {
             
            foreach($id as $value){
                $model->delete($value);
                $this->AdminModel->deleteData('project_feature',array('project_category_id'=>$value));
                 $this->AdminModel->deleteData('project_equipment',array('project_category_id'=>$value));
                
               }
           $this->session->setFlashdata('success','Record Delete successfully');
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/project_category');
    }

    
   ///////////////////////////////




   public function equipments()
    {
        error_reporting(0);
       
        $model = new EquipmentModel();
        $data['page_title'] ='All Equipment List';
         // pagination
        $data['perPage'] = 10;
        $data['detail'] = $model->asObject()->orderBy('id','asc')->paginate($data['perPage']);
        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

        $data['total'] = $model->countAllResults();

        $data['data'] = $model->paginate($data['perPage']);
        $data['pager'] = $model->pager;

        $data['pages'] = round($data['total']/$data['perPage']);
        $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
    // end
        echo view('admin/project/equipments',$data);
    }


    function add_equipment($id=false)
     {
            
        $model = new EquipmentModel();
        
        $ProjectModel = new ProjectModel();
        $data['projectList'] = $ProjectModel->asObject()->findAll();
        
        
        if(!empty($id)) {
        
        $data['page_title'] = ' Edit Equipment';
        $data['form_action'] ='admin/add_equipment/'.$id;
        $row = $model->asObject()->where(array('id'=>$id))->first();
        
        $data['projectId'] = $row->projectId;
        $data['project_category_id'] = $row->project_category_id; 
        $data['project_equipment_id'] = $row->project_equipment_id; 
        $data['name'] = $row->name; 
       
        $data['sortOrder'] = $row->sortOrder; 
        $data['status'] = $row->status; 
        

         $data['equipmentList'] = $this->AdminModel->all_fetch('equipment_feature',array('equipment_id'=>$row->id)); 
        
         $data['projectCategoryList'] = $this->AdminModel->all_fetch('project_category',array('projectId'=>$row->projectId));
         $data['projectEquipmentList'] = $this->AdminModel->all_fetch('project_equipment',array('project_category_id'=>$row->project_category_id));
// print_r($data['projectCategoryList']); exit;

        }else{

        $data['page_title'] = ' Add Equipment';
        $data['form_action'] ='admin/add_equipment';
        $data['name'] = '';    
    
      
        $data['projectId'] = '';
        $data['name'] = ''; 
        $data['project_category_id'] = ''; 
        $data['project_equipment_id'] = ''; 
      
        $data['sortOrder'] = ''; 
        $data['status'] = '';   
      
        //  $data['featureList'] = [];
         $data['equipmentList'] = [];
 
        $data['projectCategoryList']= [];
        $data['projectEquipmentList'] = [];
                

        }
        
        if($this->request->getMethod()=='post'){
            
            $rules = [
                'name'=>'required'
            ];
        
         if ($this->validate($rules)==false) {
                $data['validation'] = $this->validator;
          } else{
          $save= array();
          $save['info']['name'] =     $this->request->getVar('name');
          $save['info']['project_category_id'] =     $this->request->getVar('project_category_id');
          $save['info']['status'] =     $this->request->getVar('status');
          $save['info']['sortOrder'] =     $this->request->getVar('sortOrder');
        
          $save['info']['projectId'] =     $this->request->getVar('projectId');
          $save['info']['project_equipment_id'] =     $this->request->getVar('project_equipment_id');
          
                           
                                
           if(!empty($_FILES['image']['name'])){
                $file = $this->request->getFile('image');
                if($file->isValid() && !$file->hasMoved()){
                    $file_name = $file->getRandomName();
                    if($file->move('uploads/images/', $file_name)){
                        $save['info']['image'] =  'uploads/images/'.$file_name;
                    }
                }else{
                    throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
                    exit;
                }
            }
           
             
          // EQUIPMENT  

        $featureImagesData = array();
          if ($this->request->getFileMultiple('featureImages')) {
          foreach($this->request->getFileMultiple('featureImages') as $key => $file)
           {  
             if($file->isValid() && !$file->hasMoved()){
             $file_name = $file->getRandomName();
             if($file->move('uploads/product/', $file_name)){
               $featureImagesData[$key] = 'uploads/product/'.$file_name;
             }   
           }
           }
           }
                    
        $save['featureImages'] = $featureImagesData;
        $save['feature_old_image'] = $this->request->getVar('feature_old_image');
        $save['equipmentTitle'] =  $this->request->getVar('equipmentTitle');
        $save['equipmentDescription'] = $this->request->getVar('equipmentDescription');
        $save['equipmentApplication'] =  $this->request->getVar('equipmentApplication');
        $save['equipmentSortOrder'] = $this->request->getVar('equipmentSortOrder');



          if ($id) {
            $save['id'] = $id;
       
             $result = $model->save_project_equipment($save);
              if ($result) {
              $this->session->setFlashdata('success','Record Update successfully');
              return redirect()->to('admin/add_equipment/'.$id);
              }else{
              $this->session->setFlashdata('error','Record not update');
              return redirect()->to('admin/add_equipment/'.$id);
              }

          }else{
             
             $result = $model->save_project_equipment($save);     
                    
              if ($result) {
             
              $this->session->setFlashdata('success','Record insert successfully');
              return redirect()->to('admin/equipments');
              }else{
              $this->session->setFlashdata('error','Record not insert');
              return redirect()->to('admin/add_equipment');
              }
    
            }
    
          }
        }
        return view('admin/project/add_equipment',$data);
    
    }
    
    function delete_equipments(){
        $model = new EquipmentModel();
      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
         if ($id) {
             
            foreach($id as $value){
                $model->delete($value);
                $this->AdminModel->deleteData('project_feature',array('project_category_id'=>$value));
                 $this->AdminModel->deleteData('project_equipment',array('project_category_id'=>$value));
                
               }
           $this->session->setFlashdata('success','Record Delete successfully');
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/equipments');
    }

    
    function get_project_category(){

        $projectId  = $this->request->getVar('projectId');
        $result = $this->AdminModel->all_fetch('project_category',array('projectId'=>$projectId));
        $ss ='';
        if(!empty($result)){
             $ss .='<option value="">Select Option</option>';
            foreach($result as $value){
                $ss .='<option value="'.$value->id.'"> '.$value->name.'</option>';
            }
        }else{
          $ss .='<option value="">Not Available !</option>';
        }
        
        echo $ss; 
        
    }
    
    
        function get_project_equipment(){

        $project_category_id  = $this->request->getVar('project_category_id');
        $result = $this->AdminModel->all_fetch('project_equipment',array('project_category_id'=>$project_category_id));
        $ss ='';
        if(!empty($result)){
             $ss .='<option value="">Select Option</option>';
            foreach($result as $value){
                $ss .='<option value="'.$value->id.'"> '.$value->title.'</option>';
            }
        }else{
          $ss .='<option value="">Not Available !</option>';
        }
        
        echo $ss; 
        
    }
    

}
