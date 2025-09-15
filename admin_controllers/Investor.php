<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\coreModule\SettingModel;
use App\Models\Cms\CmsModel;
use App\Models\Cms\InvestorReportModel;
use App\Models\Cms\CsrReportModel;






class Investor extends BaseController
{
    
    public function __construct()
    {

        $settingModel = new SettingModel();
        $default_img = $settingModel->asObject()->where(array('key'=>'config_logo'))->first();
        $this->config_logo = $default_img->value; 
             
    }



  function investor_category(){
 
    
        $permission = $this->AdminModel->permission($this->uri->getSegment(2));
        if(empty($permission)){
           return  redirect()->to('admin/permission-denied');
        } 

       $data['page_title'] = 'All Investor Category';

        $data['detail'] =$this->AdminModel->all_fetch('investor_category',null);

    
      $data['config_logo'] = $this->config_logo;
      echo view('admin/cms/investor_category',$data);

}
  
 

function add_investor_category($id=false)
 { 

  if(!empty($id)) {
    
    $data['page_title'] = ' Edit Investor category';
    $data['form_action'] ='admin/add_investor_category/'.$id;
    $row = $this->AdminModel->fs('investor_category',array('id'=>$id));

    $data['status'] = $row->status;
    $data['name'] = $row->name;
    $data['sortOrder'] = $row->sortOrder;

    }else{
    
    $data['page_title'] = ' Add Investor category';
    $data['form_action'] ='admin/add_investor_category';
 

    $data['status'] =  ''; 
    $data['name'] =  ''; 
    $data['sortOrder'] =  ''; 
      

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
        'name' =>'required'
    ];     
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{

        $save= array();
        
        $save['status'] =     $this->request->getVar('status');
        $save['name'] =     $this->request->getVar('name');
        $save['sortOrder'] =     $this->request->getVar('sortOrder');
            
 
      if ($id) {
          $save['id'] =  $id;
        //   $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $this->AdminModel->updateData('investor_category',$save,array('id'=>$id));
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_investor_category/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_investor_category/'.$id);
          }
      }else{

        //  $save['create_date'] = date('Y-m-d H:i:s');
        //  $save['modify_date'] = date('Y-m-d H:i:s');
         $result= $this->AdminModel->insertData('investor_category',$save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/investor_category');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_investor_category');
          }

      }

  }

  }
 echo view('admin/cms/add_investor_category',$data);

}

    function delete_investor_category(){
        
      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
          
         if ($id) {
            foreach ($id as $key => $value) {
            $this->AdminModel->deleteData('investor_category',array('id'=>$value));
            }     
            $this->session->setFlashdata('success','Record Delete successfully'); 
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/investor_category');
    }



////////////

    function remove_report(){
        if(!empty($this->request->getVar('id'))){
            echo $this->AdminModel->deleteData('investor_report_list',array('id'=>$this->request->getVar('id')));
        }
    }





   public function investor_reports()
    {
    
       
        $model = new InvestorReportModel();
        $data['page_title'] ='All Investor Reports List';
         // pagination
        $data['perPage'] = 10;
        $where = [];
        if(!empty($this->request->getVar('year_id'))){
            $where['investor_reports.year_id'] = $this->request->getVar('year_id');
        }
        
          if(!empty($this->request->getVar('category_id'))){
            $where['investor_reports.category_id'] = $this->request->getVar('category_id');
        }
        
          $data['detail'] = $model->asObject()->select('investor_reports.status,investor_reports.id,financial_years.name as year_name')->join('financial_years','financial_years.id=investor_reports.year_id','left')->where($where)->orderBy('investor_reports.id','asc')->paginate($data['perPage']);
       
        
        
        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

        $data['total'] = $model->countAllResults();

        $data['data'] = $model->paginate($data['perPage']);
        $data['pager'] = $model->pager;

        $data['pages'] = round($data['total']/$data['perPage']);
        $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
    // end
    
    
     $data['categoryList'] =$this->AdminModel->all_fetch('investor_category',null,'sortOrder','asc');
      $data['yearList'] =$this->AdminModel->all_fetch('financial_years',null,'sortOrder','asc');
            
            
        echo view('admin/cms/investor_reports',$data);
    }


    function add_investor_report($id=false)
     {
         
        $model = new InvestorReportModel();
        
      
            // $data['categoryList'] =$this->AdminModel->all_fetch('investor_category',null,'sortOrder','asc');
            $data['yearList'] =$this->AdminModel->all_fetch('financial_years',null,'sortOrder','asc');

        
        
        if(!empty($id)) {
        
        $data['page_title'] = ' Edit Investor Report';
        $data['form_action'] ='admin/add_investor_report/'.$id;
        $row = $model->asObject()->where(array('id'=>$id))->first();
        
        $data['category_id'] = $row->category_id; 
        $data['year_id'] = $row->year_id; 
        $data['name'] = $row->name; 
       
        $data['sortOrder'] = $row->sortOrder; 
        $data['status'] = $row->status; 
        
        $data['reportList'] = $this->AdminModel->all_fetch('investor_report_list',array('investor_report_id'=>$row->id));
         

        }else{

        $data['page_title'] = ' Add Investor Report';
        $data['form_action'] ='admin/add_investor_report';
        $data['name'] = '';    
    
        $data['name'] = ''; 
        $data['category_id'] = ''; 
        $data['year_id'] = ''; 
      
        $data['sortOrder'] = ''; 
        $data['status'] = '';   
      
        $data['reportList']= [];


        }
        
        if($this->request->getMethod()=='post'){
            
            $rules = [
           
                 'year_id'=>'required'
            ];
        
         if ($this->validate($rules)==false) {
                $data['validation'] = $this->validator;
          } else{
          $save= array();

        //   $save['info']['name'] =     $this->request->getVar('name');
          // $save['info']['category_id'] =     $this->request->getVar('category_id');
          $save['info']['status'] =     $this->request->getVar('status');
        //   $save['info']['sortOrder'] =     $this->request->getVar('sortOrder');
        
          $save['info']['year_id'] =     $this->request->getVar('year_id');
        
                           
                                
        //   if(!empty($_FILES['image']['name'])){
        //         $file = $this->request->getFile('image');
        //         if($file->isValid() && !$file->hasMoved()){
        //             $file_name = $file->getRandomName();
        //             if($file->move('uploads/images/', $file_name)){
        //                 $save['info']['image'] =  'uploads/images/'.$file_name;
        //             }
        //         }else{
        //             throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
        //             exit;
        //         }
        //     }
           
             
          // EQUIPMENT  

        $featureImagesData = array();
          if ($this->request->getFileMultiple('featureImages')) {
          foreach($this->request->getFileMultiple('featureImages') as $key => $file)
           {  
             if($file->isValid() && !$file->hasMoved()){
             $file_name = $file->getName();
             if($file->move('uploads/product/', $file_name)){
               $featureImagesData[$key] = 'uploads/product/'.$file_name;
             }   
           }
           }
         }
                    
        $save['featureImages'] = $featureImagesData;
        $save['feature_old_image'] = $this->request->getVar('feature_old_image');
        $save['equipmentTitle'] =  $this->request->getVar('equipmentTitle');
        $save['equipmentSortOrder'] = $this->request->getVar('equipmentSortOrder');
        $save['equipment_old_id'] = $this->request->getVar('equipment_old_id');



          if ($id) {
            $save['id'] = $id;
       
             $result = $model->save_investor_reports($save);
              if ($result) {
              $this->session->setFlashdata('success','Record Update successfully');
              return redirect()->to('admin/add_investor_report/'.$id);
              }else{
              $this->session->setFlashdata('error','Record not update');
              return redirect()->to('admin/add_investor_report/'.$id);
              }

          }else{
             
             $result = $model->save_investor_reports($save);     
                    
              if ($result) {
             
              $this->session->setFlashdata('success','Record insert successfully');
              return redirect()->to('admin/investor_reports');
              }else{
              $this->session->setFlashdata('error','Record not insert');
              return redirect()->to('admin/add_investor_report');
              }
    
            }
    
          }
        }
        return view('admin/cms/add_investor_report',$data);
    
    }
    
    function delete_investor_reports(){

      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
         if ($id) {
             
            foreach($id as $value){
           
                $this->AdminModel->deleteData('investor_reports',array('id'=>$value));
                 $this->AdminModel->deleteData('investor_report_list',array('investor_report_id'=>$value));
                
               }
           $this->session->setFlashdata('success','Record Delete successfully');
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/investor_reports');
    }

///////////////////////




   public function csr_reports()
    {
        
        $model = new CsrReportModel();
        $data['page_title'] ='All Reports List';
         // pagination
        $data['perPage'] = 10;
        $data['detail'] = $model->asObject()->select('csr_reports.status,csr_reports.id,financial_years.name as year_name,csr_category.name as category_name,notice_category.name as notice_name')->join('financial_years','financial_years.id=csr_reports.year_id','left')->join('csr_category','csr_category.id=csr_reports.category_id','left')->join('notice_category','notice_category.id=csr_reports.notice_category_id','left')->orderBy('csr_reports.id','asc')->paginate($data['perPage']);
       

        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

        $data['total'] = $model->countAllResults();

        $data['data'] = $model->paginate($data['perPage']);
        $data['pager'] = $model->pager;

        $data['pages'] = round($data['total']/$data['perPage']);
        $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
    // end
        echo view('admin/cms/csr_reports',$data);
    }


    function add_csr_report($id=false)
     {
            
        $model = new CsrReportModel();
        
      
            $data['categoryList'] = $this->AdminModel->all_fetch('csr_category',null,'sortOrder','asc');
           
            $data['yearList'] =$this->AdminModel->all_fetch('financial_years',null,'sortOrder','asc');
           $data['noticeList'] =$this->AdminModel->all_fetch('notice_category',null,'sortOrder','asc');
        
        
        if(!empty($id)) {
        
        $data['page_title'] = ' Edit Report';
        $data['form_action'] ='admin/add_csr_report/'.$id;
        $row = $model->asObject()->where(array('id'=>$id))->first();
        
        $data['category_id'] = $row->category_id; 
         $data['notice_category_id'] = $row->notice_category_id; 
        
        $data['year_id'] = $row->year_id; 
        $data['name'] = $row->name; 
       
        $data['sortOrder'] = $row->sortOrder; 
        $data['status'] = $row->status; 
        
        $data['reportList'] = $this->AdminModel->all_fetch('csr_report_list',array('investor_report_id'=>$row->id));
         


        }else{

        $data['page_title'] = ' Add Report';
        $data['form_action'] ='admin/add_csr_report';
        $data['name'] = '';    
    
        $data['name'] = ''; 
        $data['category_id'] = ''; 
        $data['year_id'] = ''; 
          $data['notice_category_id'] ='';
        $data['sortOrder'] = ''; 
        $data['status'] = '';   
      
        $data['reportList']= [];


        }
        
        if($this->request->getMethod()=='post'){
            
            $rules = [
                'category_id'=>'required'
            ];
        
         if ($this->validate($rules)==false) {
                $data['validation'] = $this->validator;
          } else{
          $save= array();

        //   $save['info']['name'] =     $this->request->getVar('name');
          $save['info']['category_id'] =     $this->request->getVar('category_id');
           $save['info']['notice_category_id'] =     $this->request->getVar('notice_category_id');
          
          $save['info']['status'] =     $this->request->getVar('status');
        //   $save['info']['sortOrder'] =     $this->request->getVar('sortOrder');
        
          $save['info']['year_id'] =     $this->request->getVar('year_id');
        
                           
                                
        //   if(!empty($_FILES['image']['name'])){
        //         $file = $this->request->getFile('image');
        //         if($file->isValid() && !$file->hasMoved()){
        //             $file_name = $file->getRandomName();
        //             if($file->move('uploads/images/', $file_name)){
        //                 $save['info']['image'] =  'uploads/images/'.$file_name;
        //             }
        //         }else{
        //             throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
        //             exit;
        //         }
        //     }
           
             
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
        $save['equipmentSortOrder'] = $this->request->getVar('equipmentSortOrder');
        $save['equipment_old_id'] = $this->request->getVar('equipment_old_id');



          if ($id) {
            $save['id'] = $id;
       
             $result = $model->save_csr_reports($save);
              if ($result) {
              $this->session->setFlashdata('success','Record Update successfully');
              return redirect()->to('admin/add_csr_report/'.$id);
              }else{
              $this->session->setFlashdata('error','Record not update');
              return redirect()->to('admin/add_csr_report/'.$id);
              }

          }else{
             
             $result = $model->save_csr_reports($save);     
                    
              if ($result) {
             
              $this->session->setFlashdata('success','Record insert successfully');
              return redirect()->to('admin/csr_reports');
              }else{
              $this->session->setFlashdata('error','Record not insert');
              return redirect()->to('admin/add_csr_report');
              }
    
            }
    
          }
        }
        return view('admin/cms/add_csr_report',$data);
    
    }
    
    function delete_csr_reports(){

      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
         if ($id) {
             
            foreach($id as $value){
           
                $this->AdminModel->deleteData('csr_reports',array('id'=>$value));
                 $this->AdminModel->deleteData('csr_report_list',array('investor_report_id'=>$value));
                
               }
           $this->session->setFlashdata('success','Record Delete successfully');
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/csr_reports');
    }


    ////////////////////



  function csr_category(){
 
    
        $permission = $this->AdminModel->permission($this->uri->getSegment(2));
        if(empty($permission)){
           return  redirect()->to('admin/permission-denied');
        } 

       $data['page_title'] = 'All CSR Category';

        $data['detail'] =$this->AdminModel->all_fetch('csr_category',null);

    
      $data['config_logo'] = $this->config_logo;
      echo view('admin/cms/csr_category',$data);

}
  
 

function add_csr_category($id=false)
 {


  if(!empty($id)) {
    
    $data['page_title'] = ' Edit CSR category';
    $data['form_action'] ='admin/add_csr_category/'.$id;
    $row = $this->AdminModel->fs('csr_category',array('id'=>$id));

    $data['status'] = $row->status;
    $data['name'] = $row->name;
    $data['sortOrder'] = $row->sortOrder;

    }else{
    
    $data['page_title'] = ' Add CSR category';
    $data['form_action'] ='admin/add_csr_category';
 

    $data['status'] =  ''; 
    $data['name'] =  ''; 
    $data['sortOrder'] =  ''; 
      

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
        'name' =>'required'
    ];     
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{

        $save= array();
        
        $save['status'] =     $this->request->getVar('status');
        $save['name'] =     $this->request->getVar('name');
        $save['sortOrder'] =     $this->request->getVar('sortOrder');
            
 
      if ($id) {
          $save['id'] =  $id;
        //   $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $this->AdminModel->updateData('csr_category',$save,array('id'=>$id));
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_csr_category/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_csr_category/'.$id);
          }
      }else{

        //  $save['create_date'] = date('Y-m-d H:i:s');
        //  $save['modify_date'] = date('Y-m-d H:i:s');
         $result= $this->AdminModel->insertData('csr_category',$save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/csr_category');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_csr_category');
          }

      }

  }

  }
 echo view('admin/cms/add_csr_category',$data);

}

    function delete_csr_category(){
        
      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
          
         if ($id) {
            foreach ($id as $key => $value) {
            $this->AdminModel->deleteData('csr_category',array('id'=>$value));
            }     
            $this->session->setFlashdata('success','Record Delete successfully'); 
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/csr_category');
    }

  /////////////////////////////




  function financial_years(){
 
    
        $permission = $this->AdminModel->permission($this->uri->getSegment(2));
        if(empty($permission)){
           return  redirect()->to('admin/permission-denied');
        } 

       $data['page_title'] = 'All Fiancial Year List';

        $data['detail'] =$this->AdminModel->all_fetch('financial_years',null);

    
      $data['config_logo'] = $this->config_logo;
      echo view('admin/cms/financial_years',$data);

}
  
 

function add_financial_year($id=false)
 {


  if(!empty($id)) {
    
    $data['page_title'] = ' Edit Fiancial Year';
    $data['form_action'] ='admin/add_financial_year/'.$id;
    $row = $this->AdminModel->fs('financial_years',array('id'=>$id));

    $data['status'] = $row->status;
    $data['name'] = $row->name;
    $data['sortOrder'] = $row->sortOrder;

    }else{
    
    $data['page_title'] = ' Add Fiancial Year';
    $data['form_action'] ='admin/add_financial_year';
 

    $data['status'] =  ''; 
    $data['name'] =  ''; 
    $data['sortOrder'] =  ''; 
      

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
        'name' =>'required'
    ];     
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{

        $save= array();
        
        $save['status'] =     $this->request->getVar('status');
        $save['name'] =     $this->request->getVar('name');
        $save['sortOrder'] =     $this->request->getVar('sortOrder');
            
 
      if ($id) {
          $save['id'] =  $id;
        //   $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $this->AdminModel->updateData('financial_years',$save,array('id'=>$id));
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_financial_year/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_financial_year/'.$id);
          }
      }else{

        //  $save['create_date'] = date('Y-m-d H:i:s');
        //  $save['modify_date'] = date('Y-m-d H:i:s');
         $result= $this->AdminModel->insertData('financial_years',$save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/financial_years');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_financial_year');
          }

      }

  }

  }
 echo view('admin/cms/add_financial_year',$data);

}

    function delete_financial_years(){
        
      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
          
         if ($id) {
            foreach ($id as $key => $value) {
            $this->AdminModel->deleteData('financial_years',array('id'=>$value));
            }     
            $this->session->setFlashdata('success','Record Delete successfully'); 
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/financial_years');
    }
    
///////////////////////////



  function notice_category(){
 
    
        $permission = $this->AdminModel->permission($this->uri->getSegment(2));
        if(empty($permission)){
           return  redirect()->to('admin/permission-denied');
        } 

       $data['page_title'] = 'All Notice Category List';

        $data['detail'] =$this->AdminModel->all_fetch('notice_category',null);

    
      $data['config_logo'] = $this->config_logo;
      echo view('admin/cms/notice_category',$data);

}
  
 

function add_notice_category($id=false)
 {


  if(!empty($id)) {
    
    $data['page_title'] = ' Edit Notice Category';
    $data['form_action'] ='admin/add_notice_category/'.$id;
    $row = $this->AdminModel->fs('notice_category',array('id'=>$id));

    $data['status'] = $row->status;
    $data['name'] = $row->name;
    $data['sortOrder'] = $row->sortOrder;

    }else{
    
    $data['page_title'] = ' Add Notice Category';
    $data['form_action'] ='admin/add_notice_category';
 

    $data['status'] =  ''; 
    $data['name'] =  ''; 
    $data['sortOrder'] =  ''; 
      

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
        'name' =>'required'
    ];     
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{

        $save= array();
        
        $save['status'] =     $this->request->getVar('status');
        $save['name'] =     $this->request->getVar('name');
        $save['sortOrder'] =     $this->request->getVar('sortOrder');
            
 
      if ($id) {
          $save['id'] =  $id;
        //   $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $this->AdminModel->updateData('notice_category',$save,array('id'=>$id));
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_notice_category/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_notice_category/'.$id);
          }
      }else{

        //  $save['create_date'] = date('Y-m-d H:i:s');
        //  $save['modify_date'] = date('Y-m-d H:i:s');
         $result= $this->AdminModel->insertData('notice_category',$save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/notice_category');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_notice_category');
          }

      }

  }

  }
 echo view('admin/cms/add_notice_category',$data);

}

    function delete_notice_category(){
        
      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
          
         if ($id) {
            foreach ($id as $key => $value) {
            $this->AdminModel->deleteData('notice_category',array('id'=>$value));
            }     
            $this->session->setFlashdata('success','Record Delete successfully'); 
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/notice_category');
    }
/////////////





}