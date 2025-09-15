<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\module\EnquiryModel;
use App\Models\module\BlogEnquiryModel;
use App\Models\module\SubscriberModel;
use App\Models\module\ResigtrationModel;



use App\Models\coreModule\SettingModel;

class Enquiry extends BaseController
{


  public function __construct()
    {

        $settingModel = new SettingModel();
        $default_img = $settingModel->asObject()->where(array('key'=>'config_logo'))->first();
        $this->config_logo = $default_img->value; 
             
    }


   public function enquiry()
    {
       $model = new EnquiryModel();
        $data['page_title'] ='All Enquiry List';

        // pagination
        $data['perPage'] = 10;
        $data['detail'] = $model->asObject()->select('enquiry.*,sol.name as solution_name')->join('solutions as sol','enquiry.solution=sol.id','left')->orderBy('enquiry.id','asc')->paginate($data['perPage']);
        
        
        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

        $data['total'] = $model->countAllResults();

        $data['data'] = $model->paginate($data['perPage']);
        $data['pager'] = $model->pager;

        $data['pages'] = floor($data['total']/$data['perPage']);
        $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
         // end

        echo view('admin/module/enquiry',$data);
    }
    
    
    
    function delete_enquiry(){
       $model = new EnquiryModel();
      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
         if ($id) {
             
            foreach($id as $value){
                $model->delete(array('id'=>$value));
               }
           $this->session->setFlashdata('success','Record Delete successfully');
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/enquiry');
    }


////////////////



   public function blog_enquiry()
    {
        
       $model = new BlogEnquiryModel();
        $data['page_title'] ='All Blog Enquiry List';

        // pagination
        $data['perPage'] = 10;
       
       
       $data['typeList'] = $model->asObject()->select('type')->distinct('type')->findAll(); 
       
    //   echo "<pre>";
    //   print_r($data['typeList']); exit;
       $like = [];
       $where = [];
       if(!empty($this->request->getVar('type'))){
           $where['blog_enquiry.type'] = $this->request->getVar('type');
       }
        if(!empty($this->request->getVar('name'))){
           $like['blog_enquiry.name'] = $this->request->getVar('name');
       }
       
       
        $data['detail'] = $model->asObject()->select('blog_enquiry.*,sol.name as solution_name')->join('solutions as sol','blog_enquiry.solution=sol.id','left')->where($where)->like($like)->orderBy('blog_enquiry.id','desc')->paginate($data['perPage']);
        
        
        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

        $data['total'] = $model->where($where)->like($like)->countAllResults();

        $data['data'] = $model->paginate($data['perPage']);
        $data['pager'] = $model->pager;

        $data['pages'] = floor($data['total']/$data['perPage']);
        $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
         // end

        echo view('admin/module/blog_enquiry',$data);
    }
    
    
    
    function delete_blog_enquiry(){
       $model = new BlogEnquiryModel();
      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
         if ($id) {
             
            foreach($id as $value){
                $model->delete(array('id'=>$value));
               }
           $this->session->setFlashdata('success','Record Delete successfully');
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/blog_enquiry');
    }







   public function subscribers()
    {
        
       $model = new SubscriberModel();
        $data['page_title'] ='All Subscribers List';

        // pagination
        $data['perPage'] = 10;
       
       
    
    //   echo "<pre>";
    //   print_r($data['typeList']); exit;
       $like = [];
       $where = [];
       if(!empty($this->request->getVar('type'))){
           $where['email'] = $this->request->getVar('email');
       }
       if(!empty($this->request->getVar('email'))){
           $like['email'] = $this->request->getVar('email');
       }
       
        $data['detail'] = $model->asObject()->where($where)->like($like)->orderBy('id','desc')->paginate($data['perPage']);
        
        
        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

        $data['total'] = $model->where($where)->like($like)->countAllResults();

        $data['data'] = $model->paginate($data['perPage']);
        $data['pager'] = $model->pager;

        $data['pages'] = floor($data['total']/$data['perPage']);
        $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
         // end

        echo view('admin/module/subscribers',$data);
    }
    
    
    
    function delete_subscribers(){
       $model = new SubscriberModel();
      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
         if ($id) {
             
            foreach($id as $value){
                $model->delete(array('id'=>$value));
               }
           $this->session->setFlashdata('success','Record Delete successfully');
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/subscribers');
    }


////////////////////////



   public function registration_enquiry()
    {
        
       $model = new ResigtrationModel();
        $data['page_title'] ='All Registration Enquiry List';

        // pagination
        $data['perPage'] = 10;
       
     
       $like = [];
       $where = [];
       if(!empty($this->request->getVar('type'))){
           $where['blog_enquiry.type'] = $this->request->getVar('type');
       }
        if(!empty($this->request->getVar('name'))){
           $like['blog_enquiry.name'] = $this->request->getVar('name');
       }
       
       
        $data['detail'] = $model->asObject()->select('resistration_enquiry.*,bl.title as event_name')->join('blogs as bl','resistration_enquiry.blog_id=bl.id','left')->where($where)->like($like)->orderBy('resistration_enquiry.id','desc')->findAll();
        // echo "<pre>";
        // print_r($data['detail']);
        
        // $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

        // $data['total'] = $model->where($where)->like($like)->countAllResults();

        // $data['data'] = $model->paginate($data['perPage']);
        // $data['pager'] = $model->pager;

        // $data['pages'] = floor($data['total']/$data['perPage']);
        // $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
         // end

        echo view('admin/module/registration_enquiry',$data);
    }
    
    
    
    function delete_registration_enquiry(){
       $model = new ResigtrationModel();
      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
         if ($id) {
             
            foreach($id as $value){
                $model->delete(array('id'=>$value));
               }
           $this->session->setFlashdata('success','Record Delete successfully');
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/registration_enquiry');
    }








}
