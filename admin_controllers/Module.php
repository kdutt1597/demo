<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\module\TeamModel;
use App\Models\module\TestimonialModel;
use App\Models\module\PartnerModel;
use App\Models\module\PageModel;
use App\Models\module\FaqModel;
use App\Models\coreModule\SettingModel;



use App\Models\Cms\ResourceModel;
use App\Models\Cms\AwardsModel;
use App\Models\Cms\JourneyModel;
use App\Models\Cms\ParterTagModel;


class Module extends BaseController
{
    

   public function __construct()
  {

      $settingModel = new SettingModel();
        $default_img = $settingModel->asObject()->where(array('key'=>'config_logo'))->first();
        $this->config_logo = $default_img->value; 
             
  }

  function team(){

  $model = new TeamModel();
  $permission = $this->AdminModel->permission($this->uri->getSegment(2));
  if(empty($permission)){
     return  redirect()->to('admin/permission-denied');
  } 
    
    $data['page_title'] = 'All Leadership List';
    $data['detail'] = $model->asObject()->findAll();

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


    $data['config_logo'] = $this->config_logo;
    echo view('admin/module/team',$data);

}
  
 

function add_team($id=false)
 {

  $model = new TeamModel();
     $data['typeList'] = array('BOARD'=>'BOARD MEMBER','MANAGEMENT'=>'MANAGEMENT','LEADERSHIP'=>'LEADERSHIP');
 
  if(!empty($id)) {
    
    $data['page_title'] = ' Edit team';
    $data['form_action'] ='admin/add_team/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();
    $data['photo'] =  $row->photo;   
    $data['status'] = $row->status;
    $data['name'] = $row->name;
    $data['designation'] = $row->designation;
    $data['type'] = $row->type;
 $data['linkedin'] = $row->linkedin;

    $data['description'] = $row->description;
    $data['sort_order'] = $row->sort_order; 
         
    }else{
    
    $data['page_title'] = ' Add team';
    $data['form_action'] ='admin/add_team';
    $data['photo'] = '';   
    $data['description'] = '';
    $data['name'] = '';
    $data['designation'] = '';
      $data['type'] = '';
    $data['status'] ='';
    $data['sort_order'] = '';
    $data['linkedin'] = '';

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
      'name' =>'required'
    ];     
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{
    
      $save= array();
      $save['sort_order'] =     $this->request->getVar('sort_order');
      $save['status'] =     $this->request->getVar('status');
      $save['name'] =     $this->request->getVar('name');
      $save['designation'] =     $this->request->getVar('designation');
      $save['description'] =     $this->request->getVar('description');
       $save['linkedin'] =     $this->request->getVar('linkedin');      
     $save['type'] =     $this->request->getVar('type');
             
             
    if(!empty($_FILES['photo']['name'])){
      $file = $this->request->getFile('photo');
      if($file->isValid() && !$file->hasMoved()){
        $file_name = $file->getRandomName();
        if($file->move('uploads/images/', $file_name)){
          $save['photo'] =  'uploads/images/'.$file_name;
        }
      }else{
        throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
        exit;
      }
    }


 
      if ($id) {
          $save['id'] =  $id;
          $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $model->update(array('id'=>$id),$save);
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_team/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_team/'.$id);
          }
      }else{

         $save['create_date'] = date('Y-m-d H:i:s');
         $save['modify_date'] = date('Y-m-d H:i:s');
         $result=  $model->insert($save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/team');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_team');
          }

      }

  }

  }
 echo view('admin/module/add_team',$data);

}

function delete_team(){
   $model = new TeamModel();
  if ($this->request->getVar()) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
      foreach ($id as $key => $value) {
      $model->delete(array('id'=>$value));
      }     
      $this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/team');
}

////////////////////////////////


function testimonial(){
  
  $model = new TestimonialModel();
  $permission = $this->AdminModel->permission($this->uri->getSegment(2));
  if(empty($permission)){
    return redirect()->to('admin/permission-denied');
  }   
    
  $data['page_title'] = 'Testimonial';
  
   // pagination
    $data['perPage'] = 10;
    $data['detail'] = $model->asObject()->orderBy('id','asc')->paginate($data['perPage']);
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

    $data['total'] = $model->countAllResults();

    $data['data'] = $model->paginate($data['perPage']);
    $data['pager'] = $model->pager;

    $data['pages'] = floor($data['total']/$data['perPage']);
    $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
  // end
  
  $data['config_logo'] = $this->config_logo;
  echo view('admin/module/testimonial',$data);

  }


  function add_testimonial($id=false)
  {    

   $data['typeList'] = array('TESTIMONIAL'=>'TESTIMONIAL','CAREER'=>'CAREER');

    $model = new TestimonialModel();
      
  if(!empty($id)) {
  $data['page_title'] = ' Edit Testimonial';
  $data['form_action'] ='admin/add_testimonial/'.$id;
  $row = $model->asObject()->where(array('id'=>$id))->first();
  $data['image'] = $row->image; 
  $data['name'] = $row->name;
  $data['designation'] = $row->designation;
  $data['description'] = $row->description;
  $data['sort_order'] = $row->sort_order;
  $data['url_link'] = $row->url_link; 
  $data['status'] = $row->status;
  $data['type'] = $row->type;     
  }else{
  $data['page_title'] = ' Add Testimonial';
  $data['form_action'] ='admin/add_testimonial';
  $data['image'] = ''; 
  $data['name'] = '';
  $data['designation'] = '';
  $data['description'] = '';
  $data['sort_order'] = '';
  $data['url_link'] = ''; 
  $data['status'] = '';
  $data['type'] = '';

  }
  
  if($this->request->getMethod()=='post'){
    
    $rules = [
      'name'=>'required'
    ];
  
   if ($this->validate($rules)==false) {
      $data['validation'] = $this->validator;
    
  } else{
  
  $save= array();
  $save['name'] = $this->request->getVar('name');
  $save['url_link'] = $this->request->getVar('url_link');
  $save['designation'] = $this->request->getVar('designation');
  $save['description'] = $this->request->getVar('description');
  $save['sort_order'] = $this->request->getVar('sort_order');
  $save['status'] = $this->request->getVar('status');
  $save['type'] = $this->request->getVar('type');
    
  $file = $this->request->getFile('image');
  if(!empty($file->getClientName())){
    if($file->isValid() && !$file->hasMoved()){
      $file_name = $file->getRandomName();
      if($file->move('uploads/images/', $file_name)){
        $save['image'] = 'uploads/images/'.$file_name;
      }
    }else{
      throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
      exit;
    }
  }


  if ($id) {
    $save['modify_date'] = date('Y-m-d H:i:s');
    $result=  $model->update(array('id'=>$id),$save);
    if ($result) {
    $this->session->setFlashdata('success','Record Update successfully');
    return redirect()->to('admin/add_testimonial/'.$id);
    }else{
    $this->session->setFlashdata('error','Record not update');
    return redirect()->to('admin/add_testimonial/'.$id);
    }
  }else{
    $save['create_date'] = date('Y-m-d H:i:s');
    $save['modify_date'] = date('Y-m-d H:i:s');
    $result=  $model->insert($save);
    if ($result) {
    $this->session->setFlashdata('success','Record insert successfully');
    return redirect()->to('admin/testimonial');
    }else{
    $this->session->setFlashdata('error','Record not insert');
    return redirect()->to('admin/add_testimonial');
    }
    }
    }
    }
   return view('admin/module/add_testimonial',$data);
}

  function delete_testimonial()
  {
  $model = new TestimonialModel();
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
  return redirect()->to('admin/testimonial');
  }

  //////////////

  function partners(){
      $model = new PartnerModel();
    $permission = $this->AdminModel->permission($this->uri->getSegment(2));
    if(empty($permission)){
       return redirect()->to('admin/permission-denied');
    }    
      
    $data['page_title'] = 'All Clients List';
     // pagination
    $data['perPage'] = 10;
    $data['detail'] = $model->asObject()->select('partners.*,pt.name as tag_name')->join('partertags pt','partners.tag_id=pt.id','left')->orderBy('id','asc')->paginate($data['perPage']);
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

    $data['total'] = $model->countAllResults();

    $data['data'] = $model->paginate($data['perPage']);
    $data['pager'] = $model->pager;

    $data['pages'] = floor($data['total']/$data['perPage']);
    $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
     // end
    $data['config_logo'] = $this->config_logo;
    echo view('admin/module/partners',$data);

    }


    function add_partner($id=false)
    {    error_reporting(0);
     $ParterTagModel = new ParterTagModel();
      $data['tagList'] = $ParterTagModel->asObject()->where('status',1)->findAll();     

        $data['typeList'] = array('PARTNER'=>'PARTNER','CUSTOMER'=>'CUSTOMER'); 

    $model = new PartnerModel();  
    if(!empty($id)) {
    $data['page_title'] = ' Edit Clients';
    $data['form_action'] ='admin/add_partner/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();
    $data['status'] = $row->status;
    $data['name'] = $row->name;
    $data['image'] = $row->image;  
    $data['sort_order'] = $row->sort_order; 
    $data['tag_id'] = $row->tag_id;   
    $data['type'] = $row->type; 
    
    }else{
    $data['page_title'] = ' Add Clients';
    $data['form_action'] ='admin/add_partner';
    $data['name'] = '';
    $data['status'] = '';
    $data['image'] =  '';
    $data['sort_order'] = ''; 
    $data['tag_id'] = '';  
        $data['type'] = '';   
    }
      
    if($this->request->getMethod()=='post'){
      $rules = [
        'title'=>'trim'
      ];
    
      if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
    } else{

    $save= array();
    $save['name'] = $this->request->getVar('name');
    $save['status'] = $this->request->getVar('status');
    $save['sort_order'] = $this->request->getVar('sort_order');
    $save['tag_id'] = $this->request->getVar('tag_id');
    $save['type'] = $this->request->getVar('type');

    $file = $this->request->getFile('image');
     if(!empty($file->getClientName())){
    if($file->isValid() && !$file->hasMoved()){
      $file_name = $file->getRandomName();
      if($file->move('uploads/images/', $file_name)){
        $save['image'] = 'uploads/images/'.$file_name;
      }
     }else{
      throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
      exit;
    }
    }


    if ($id) {

      $save['modify_date'] = date('Y-m-d H:i:s');
      $result=  $model->update(array('id'=>$id),$save);
      if ($result) {
      $this->session->setFlashdata('success','Record Update successfully');
      return redirect()->to('admin/add_partner/'.$id);
      }else{
      $this->session->setFlashdata('error','Record not update');
      return redirect()->to('admin/add_partner/'.$id);
      }

    }else{

      $save['create_date'] = date('Y-m-d H:i:s');
      $save['modify_date'] = date('Y-m-d H:i:s');
      $result=  $model->insert($save);
      if ($result) {
      $this->session->setFlashdata('success','Record insert successfully');
      return redirect()->to('admin/partners');
      }else{
        $this->session->setFlashdata('error','Record not insert');
        return redirect()->to('admin/add_partner');
        }
      }
     }
   }
    return view('admin/module/add_partner',$data);
  }

  
  function delete_partner()
    {
    $model = new PartnerModel();
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
    return redirect()->to('admin/partners');
  }
////////////////////////////////////////////////

   function faqs(){
      $model = new FaqModel();
    $permission = $this->AdminModel->permission($this->uri->getSegment(2));
    if(empty($permission)){
       return redirect()->to('admin/permission-denied');
    }    
      
    $data['page_title'] = 'All Faqs List';
     // pagination
    $data['perPage'] = 10;
    $data['detail'] = $model->asObject()->orderBy('id','asc')->paginate($data['perPage']);
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

    $data['total'] = $model->countAllResults();

    $data['data'] = $model->paginate($data['perPage']);
    $data['pager'] = $model->pager;

    $data['pages'] = floor($data['total']/$data['perPage']);
    $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
     // end
    $data['config_logo'] = $this->config_logo;
    echo view('admin/module/faqs',$data);

    }


    function add_faq($id=false)
    {    

    $model = new FaqModel();  
    if(!empty($id)) {
    $data['page_title'] = ' Edit Partner';
    $data['form_action'] ='admin/add_faq/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();
    $data['status'] = $row->status;
    $data['question'] = $row->question;
    $data['answer'] = $row->answer;  
    $data['sort_order'] = $row->sort_order; 
    $data['type'] = $row->type; 

    }else{
    $data['page_title'] = ' Add Partner';
    $data['form_action'] ='admin/add_faq';
    $data['question'] = '';
    $data['status'] = '';
    $data['answer'] =  '';
    $data['sort_order'] = ''; 
    $data['type'] = '';  
    }
      
    if($this->request->getMethod()=='post'){
      $rules = [
        'title'=>'trim'
      ];
    
      if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
    } else{

    $save= array();
    $save['question'] = $this->request->getVar('question');
    $save['status'] = $this->request->getVar('status');
    $save['sort_order'] = $this->request->getVar('sort_order');
      $save['answer'] = $this->request->getVar('answer');
   


    if ($id) {

      $save['modify_date'] = date('Y-m-d H:i:s');
      $result=  $model->update(array('id'=>$id),$save);
      if ($result) {
      $this->session->setFlashdata('success','Record Update successfully');
      return redirect()->to('admin/add_faq/'.$id);
      }else{
      $this->session->setFlashdata('error','Record not update');
      return redirect()->to('admin/add_faq/'.$id);
      }

    }else{

      $save['create_date'] = date('Y-m-d H:i:s');
      $save['modify_date'] = date('Y-m-d H:i:s');
      $result=  $model->insert($save);
      if ($result) {
      $this->session->setFlashdata('success','Record insert successfully');
      return redirect()->to('admin/faqs');
      }else{
        $this->session->setFlashdata('error','Record not insert');
        return redirect()->to('admin/add_faq');
        }
      }
     }
   }
    return view('admin/module/add_faq',$data);
  }

  
  function delete_faq()
    {
    $model = new FaqModel();
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
    return redirect()->to('admin/faqs');
  }

////////////////////////////////////////

     function pages(){
      $model = new PageModel();
    $permission = $this->AdminModel->permission($this->uri->getSegment(2));
    if(empty($permission)){
       return redirect()->to('admin/permission-denied');
    }    
      
    $data['page_title'] = 'All Information pages';
       // pagination
    $data['perPage'] = 10;
    $data['detail'] = $model->asObject()->orderBy('id','asc')->paginate($data['perPage']);
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

    $data['total'] = $model->countAllResults();

    $data['data'] = $model->paginate($data['perPage']);
    $data['pager'] = $model->pager;

    $data['pages'] = floor($data['total']/$data['perPage']);
    $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
     // end
    $data['config_logo'] = $this->config_logo;
    echo view('admin/module/pages',$data);

    }


  function add_pages($id=false)
   {    
      
    $data['typeList'] = array('COMPANY'=>'Company','LEGAL'=>'Legal');

    $model = new PageModel(); 
  
    if (!empty($id)) {
     $data['page_title'] = ' Edit Page';
     $data['form_action'] ='admin/add_pages/'.$id;
     $row = $this->AdminModel->fs('pages',array('id'=>$id));
    $data['title'] = $row->title; 
    $data['slug'] = $row->slug; 
    $data['description'] = $row->description; 
    $data['shortDescription'] = $row->shortDescription; 
    $data['bannerTitle'] = $row->bannerTitle; 
    $data['bannerDescription'] = $row->bannerDescription; 

     $data['metaTitle'] = $row->metaTitle; 
     $data['metaDescription'] = $row->metaDescription; 
     $data['metaKeyword'] = $row->metaKeyword; 
     $data['sort_order'] = $row->sort_order;
     $data['status'] = $row->status;
     $data['image'] = $row->image;
     $data['type'] = $row->type;
     $data['title1'] = $row->title1;
     $data['description1'] = $row->description1;
         $data['image1'] = $row->image1;
     $data['faqList'] = json_decode($row->faqList);
     
      $data['imagesList'] = $this->AdminModel->all_fetch('page_image',array('page_id'=>$row->id));
      $data['counterList'] = $this->AdminModel->all_fetch('page_counter',array('page_id'=>$row->id));
      
     
      
     }else{
     $data['page_title'] = ' Add Page';
     $data['form_action'] ='admin/add_pages';
     $data['title'] = '';
     $data['slug'] = '';
     $data['description'] = '';
     $data['metaTitle'] = '';
     $data['metaDescription'] = '';
     $data['metaKeyword'] = ''; 
     $data['sort_order'] = '';
     $data['status'] ='';
    $data['image'] = '';
    $data['shortDescription'] ='';
    $data['bannerTitle'] = '';
    $data['bannerDescription'] ='';
    $data['type'] ='';
    $data['title1'] ='';
    $data['image1'] ='';
    $data['description1'] ='';
    $data['imagesList'] =array();
    $data['counterList'] =array();
    $data['faqList'] = array();

     }
   
    if($this->request->getMethod() == "post"){

    $rules = [
    'title'=>['label' => 'Title', 'rules' => 'required'],
      ];

    if ($this->validate($rules) == FALSE)
    {

    $data['validation'] = $this->validator;

     }else{
         
     $save= array();

    $save['info']['title'] = $this->request->getVar('title');
    $save['info']['description'] = $this->request->getVar('description');
    $save['info']['metaTitle'] = $this->request->getVar('metaTitle');
    $save['info']['metaDescription'] = $this->request->getVar('metaDescription');
    if(!empty($this->request->getVar('slug'))){
    $save['info']['slug'] = sfu($this->request->getVar('slug'));   
    }else{
    $save['info']['slug'] = sfu($this->request->getVar('title'));
    }
    $save['info']['metaKeyword'] = $this->request->getVar('metaKeyword'); 
    $save['info']['sort_order'] = $this->request->getVar('sort_order');
    $save['info']['shortDescription'] = $this->request->getVar('shortDescription');
    $save['info']['bannerTitle'] = $this->request->getVar('bannerTitle');
    $save['info']['bannerDescription'] = $this->request->getVar('bannerDescription');
    $save['info']['type'] = $this->request->getVar('type');
    $save['info']['status'] = $this->request->getVar('status');
    $save['info']['title1'] = $this->request->getVar('title1');
    $save['info']['description1'] = $this->request->getVar('description1');
    
    
    
    $question = $this->request->getVar('question');
    $answer = $this->request->getVar('answer');

     $faqList = array();
     if(!empty($question)){
     foreach ($question as $key =>  $value) {
       $faq = array();
       $faq['question'] = $value;
       $faq['answer'] = $answer[$key];
       $faqList[] = $faq;
     }}

     $save['info']['faqList'] = json_encode($faqList);
    
     $file = $this->request->getFile('image');
     if(!empty($file->getClientName())){
    if($file->isValid() && !$file->hasMoved()){
      $file_name = $file->getRandomName();
      if($file->move('uploads/images/', $file_name)){
        $save['info']['image'] = 'uploads/images/'.$file_name;
      }
     }else{
      throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
      exit;
    }
    }
    
    $file = $this->request->getFile('image1');
     if(!empty($file->getClientName())){
    if($file->isValid() && !$file->hasMoved()){
      $file_name = $file->getRandomName();
      if($file->move('uploads/images/', $file_name)){
        $save['info']['image1'] = 'uploads/images/'.$file_name;
      }
     }else{
      throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
      exit;
    }
    }
    
    
    
   

// counter
    $save['counterTitle'] = $this->request->getVar('counterTitle');
    $save['counterDescription'] = $this->request->getVar('counterDescription');
    $save['counterSymbol'] = $this->request->getVar('counterSymbol');



// images
    $uploadImgData = array();
    if ($this->request->getFileMultiple('images')) {
    foreach($this->request->getFileMultiple('images') as $key => $file)
     {  
       if($file->isValid() && !$file->hasMoved()){
       $file_name = $file->getRandomName();
       if($file->move('uploads/images/', $file_name)){
        $uploadImgData[$key] = 'uploads/images/'.$file_name;
       }  
       }
     }
   }
                
        
  $save['images'] = $uploadImgData;
  $save['old_image'] = $this->request->getVar('old_image');
  $save['imagesSortOrder'] = $this->request->getVar('imagesSortOrder');



     if ($id) {
     $save['id']= $id;
     $save['modify_date'] = date('Y-m-d H:i:s');
     $result = $model->save_page($save);
     if ($result) {
       $this->session->setFlashdata('success','Record Update successfully');
       return  redirect()->to('admin/add_pages/'.$id);
     }else{
       $this->session->setFlashdata('error','Error in Update ');
       return  redirect()->to('admin/add_pages/'.$id);
     }
     }else{
     $save['modify_date'] = date('Y-m-d H:i:s');
     $save['create_date'] = date('Y-m-d H:i:s');

     $result = $model->save_page($save);
     if ($result) {
       $this->session->setFlashdata('success','Record Insert successfully');
     return  redirect()->to('admin/pages');
     }else{
       $this->session->setFlashdata('success','Error Inserting Record');
       return  redirect()->to('admin/add_pages');
     }
     }
   
  }
   }

    return view('admin/module/add_pages',$data);
  }

  
  function delete_pages()
    {
    $model = new PageModel();
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
    return redirect()->to('admin/pages');
  }



/////////////////////////////////////////



function sliders()
 {
     
    $permission = $this->AdminModel->permission($this->uri->getSegment(2));
    if(empty($permission)){
       return  redirect()->to('admin/permission-denied');
    }
    
     $data['page_title']  ='Slider List';

         // pagination
        $pager=service('pager'); 
    $data['perPage'] = 10;
   
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

    $data['total'] =  $this->AdminModel->allCount('banner',[]);

    $pager->makeLinks($data['page'],$data['perPage'],$data['total']);
      $data['pager'] = $pager;

    $data['pages'] = floor($data['total']/$data['perPage']);
    $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
    
       $data['detail'] = $this->AdminModel->all_fetch('banner',null,'','',$data['perPage'],$data['offset']);

     // end
    echo view('admin/module/sliders',$data);

 }



 function add_slider($id=false)
 {
  
   $model = new PageModel(); 
    
  if ($id) {
    $data['page_title'] = ' Edit Slider';
    $data['form_action'] ='admin/add_slider/'.$id;
    $row = $this->AdminModel->fs('banner',array('id'=>$id));
    $data['name'] = $row->name; 
    $data['heading'] = $row->heading; 
    $data['sub_heading'] = $row->sub_heading; 
    $data['slider_link'] = $row->slider_link; 
    $data['description'] = $row->description; 
    $data['sliderList'] = $this->AdminModel->all_fetch('banner_image',array('banner_id'=>$row->id),'id','asc');
       
    }else{
    $data['page_title'] = ' Add Slider';
    $data['form_action'] ='admin/add_slider';
    $data['name'] = '';
    $data['heading'] = '';
    $data['sub_heading'] = '';
    $data['slider_link'] = '';
    $data['description'] = '';
    $data['sliderList'] = array();
   
    }

 
  if($this->request->getMethod()=='post'){

  $rules =[
    'name'=>'required'
  ];

    if ($this->validate($rules)==false) {

    $data['validation'] = $this->validator;
     } else{
  
    $save= array();
    $save['info']['name'] = $this->request->getVar('name');
    $save['info']['heading'] = $this->request->getVar('heading');
    $save['info']['sub_heading'] = $this->request->getVar('sub_heading');
    $save['info']['description'] = $this->request->getVar('description');
    $save['info']['slider_link'] = $this->request->getVar('slider_link');
       
      $uploadImgData = array();
    if ($this->request->getFileMultiple('image')) {
    foreach($this->request->getFileMultiple('image') as $key => $file)
     {  
       if($file->isValid() && !$file->hasMoved()){
       $file_name = $file->getRandomName();
       if($file->move('uploads/product/', $file_name)){
         $uploadImgData[$key] = 'uploads/product/'.$file_name;
       }   
     }
     }
     }
                 
        
  $save['image'] = $uploadImgData;
  $save['old_image'] = $this->request->getVar('old_image');

  $save['title'] = $this->request->getVar('title'); 
  $save['sliderDescription'] = $this->request->getVar('sliderDescription'); 
  $save['link'] = $this->request->getVar('link');
  $save['sort_order'] = $this->request->getVar('sort_order');   

    if ($id) {
    $save['id'] = $id;
    $result = $model->save_banner($save);
      if ($result) {
        $this->session->setFlashdata('success','Record Update successfully');
        return redirect()->to('admin/add_slider/'.$id);
      }else{
        $this->session->setFlashdata('error','Error in Update ');
        return redirect()->to('admin/add_slider/'.$id);
      }
    }else{
     $save['id'] = '';
      $result = $model->save_banner($save);
      if ($result) {
        $this->session->setFlashdata('success','Record Insert successfully');
        return redirect()->to('admin/sliders');
      }else{
        $this->session->setFlashdata('success','Record not inserted');
         return redirect()->to('admin/add_slider');
      }
    }

   }
 }
  return view('admin/module/add_slider',$data);
}


function delete_slider()
{

 $array =  $this->request->getVar('selected');
if (!empty($array)) {
  
  foreach ($array as $key => $value) {
    $this->AdminModel->deleteData('banner',array('id'=>$value));
    $this->AdminModel->deleteData('banner_image',array('banner_id'=>$value));
  }
  $this->session->setFlashdata('success','Record Delete successfully');
   return   redirect()->to('admin/sliders');
 }   
}
///////////////////////////////////////////





function awards(){
  
  $model = new AwardsModel();
  $permission = $this->AdminModel->permission($this->uri->getSegment(2));
  if(empty($permission)){
    return redirect()->to('admin/permission-denied');
  }   
    
     $data['page_title'] = 'All Awards';
  
   // pagination
    $data['perPage'] = 10;
    $data['detail'] = $model->asObject()->orderBy('id','asc')->paginate($data['perPage']);
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

    $data['total'] = $model->countAllResults();

    $data['data'] = $model->paginate($data['perPage']);
    $data['pager'] = $model->pager;

    $data['pages'] = floor($data['total']/$data['perPage']);
    $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
  // end

    $data['config_logo'] = $this->config_logo;
  echo view('admin/module/awards',$data);

  }


  function add_award($id=false)
  {    

  $data['typeList'] = array('Award'=>'Award','Recognitions'=>'Recognitions');

    $model = new AwardsModel();
      
  if(!empty($id)) {
  $data['page_title'] = ' Edit Award';
  $data['form_action'] ='admin/add_award/'.$id;
  $row = $model->asObject()->where(array('id'=>$id))->first();
  $data['image'] = $row->image; 
  $data['name'] = $row->name;
  $data['pdf'] = $row->pdf;
  $data['publish'] = $row->publish;
  $data['sortOrder'] = $row->sortOrder;
  $data['status'] = $row->status; 
  $data['type'] = $row->type; 
  $data['patentNumber'] = $row->patentNumber; 
    
  }else{
  $data['page_title'] = ' Add Award';
  $data['form_action'] ='admin/add_award';
  $data['image'] = ''; 
  $data['name'] = '';
  $data['pdf'] = '';
  $data['publish'] = '';
  $data['sortOrder'] = '';
  $data['status'] = '';
  $data['type'] = '';
   $data['patentNumber'] = '';

  }
  
  if($this->request->getMethod()=='post'){
    
    $rules = [
      'name'=>'required'
    ];
  
   if ($this->validate($rules)==false) {
      $data['validation'] = $this->validator;
    
  } else{
  
  $save= array();
  $save['name'] = $this->request->getVar('name');
  $save['publish'] = $this->request->getVar('publish');
  $save['sortOrder'] = $this->request->getVar('sortOrder');
  $save['status'] = $this->request->getVar('status');
    $save['type'] = $this->request->getVar('type');
      $save['patentNumber'] = $this->request->getVar('patentNumber');
    
    
  $file = $this->request->getFile('image');
  if(!empty($file->getClientName())){
    if($file->isValid() && !$file->hasMoved()){
      $file_name = $file->getRandomName();
      if($file->move('uploads/images/', $file_name)){
        $save['image'] = 'uploads/images/'.$file_name;
      }
    }else{
      throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
      exit;
    }
  }


  if ($id) {
    $save['modify_date'] = date('Y-m-d H:i:s');
    $result=  $model->update(array('id'=>$id),$save);
    if ($result) {
    $this->session->setFlashdata('success','Record Update successfully');
    return redirect()->to('admin/add_award/'.$id);
    }else{
    $this->session->setFlashdata('error','Record not update');
    return redirect()->to('admin/add_award/'.$id);
    }
  }else{
    $save['create_date'] = date('Y-m-d H:i:s');
    $save['modify_date'] = date('Y-m-d H:i:s');
    $result=  $model->insert($save);
    if ($result) {
    $this->session->setFlashdata('success','Record insert successfully');
    return redirect()->to('admin/awards');
    }else{
    $this->session->setFlashdata('error','Record not insert');
    return redirect()->to('admin/add_award');
    }
    }
    }
    }
   return view('admin/module/add_award',$data);
}

  function delete_awards()
  {
  $model = new AwardsModel();
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
  return redirect()->to('admin/awards');
  }


///////////////////////////




function journey(){
  
    $model = new journeyModel();
    $permission = $this->AdminModel->permission($this->uri->getSegment(2));
    if(empty($permission)){
      return redirect()->to('admin/permission-denied');
    }   
    
     $data['page_title'] = 'All Journey';
  
   // pagination
    $data['perPage'] = 10;
    $data['detail'] = $model->asObject()->orderBy('id','asc')->paginate($data['perPage']);
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

    $data['total'] = $model->countAllResults();

    $data['data'] = $model->paginate($data['perPage']);
    $data['pager'] = $model->pager;

    $data['pages'] = floor($data['total']/$data['perPage']);
    $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
  // end
    $data['config_logo'] = $this->config_logo;
  echo view('admin/module/journey',$data);

  }


  function add_journey($id=false)
  {    

    $model = new journeyModel();
      
  if(!empty($id)) {
  $data['page_title'] = ' Edit Journey';
  $data['form_action'] ='admin/add_journey/'.$id;
  $row = $model->asObject()->where(array('id'=>$id))->first();
  $data['name'] = $row->name;
  $data['year'] = $row->year;
  
  $data['sortOrder'] = $row->sortOrder;
  $data['status'] = $row->status;    
  }else{
  $data['page_title'] = ' Add Journey';
  $data['form_action'] ='admin/add_journey';
  $data['year'] = ''; 
  $data['name'] = '';
  $data['sortOrder'] = '';
  $data['status'] = '';

  }
  
  if($this->request->getMethod()=='post'){
    
    $rules = [
      'name'=>'required'
    ];
  
   if ($this->validate($rules)==false) {
      $data['validation'] = $this->validator;
    
  } else{
  
  $save= array();
  $save['name'] = $this->request->getVar('name');
  $save['year'] = $this->request->getVar('year');
  $save['sortOrder'] = $this->request->getVar('sortOrder');
  $save['status'] = $this->request->getVar('status');
    


  if ($id) {
    $save['modify_date'] = date('Y-m-d H:i:s');
    $result=  $model->update(array('id'=>$id),$save);
    if ($result) {
    $this->session->setFlashdata('success','Record Update successfully');
    return redirect()->to('admin/add_journey/'.$id);
    }else{
    $this->session->setFlashdata('error','Record not update');
    return redirect()->to('admin/add_journey/'.$id);
    }
  }else{
    $save['create_date'] = date('Y-m-d H:i:s');
    $save['modify_date'] = date('Y-m-d H:i:s');
    $result=  $model->insert($save);
    if ($result) {
    $this->session->setFlashdata('success','Record insert successfully');
    return redirect()->to('admin/journey');
    }else{
    $this->session->setFlashdata('error','Record not insert');
    return redirect()->to('admin/add_journey');
    }
    }
    }
    }
   return view('admin/module/add_journey',$data);
}

  function delete_journey()
  {
  $model = new journeyModel();
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
  return redirect()->to('admin/journey');
  }


/////////////////





function resources(){
  
  $model = new ResourceModel();
  $permission = $this->AdminModel->permission($this->uri->getSegment(2));
  if(empty($permission)){
    return redirect()->to('admin/permission-denied');
  }   
    
     $data['page_title'] = 'All Resources';
  
   // pagination
    $data['perPage'] = 10;
    $data['detail'] = $model->asObject()->orderBy('id','asc')->paginate($data['perPage']);
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

    $data['total'] = $model->countAllResults();

    $data['data'] = $model->paginate($data['perPage']);
    $data['pager'] = $model->pager;

    $data['pages'] = floor($data['total']/$data['perPage']);
    $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
  // end

    $data['config_logo'] = $this->config_logo;
  echo view('admin/module/resources',$data);

  }


  function add_resource($id=false)
  {    


  $model = new ResourceModel();
      
  if(!empty($id)) {
  $data['page_title'] = ' Edit Resources';
  $data['form_action'] ='admin/add_resource/'.$id;
 
  $row = $model->asObject()->where(array('id'=>$id))->first();
  $data['image'] = $row->image; 
  $data['name'] = $row->name;
  $data['description'] = $row->description;
  $data['sortOrder'] = $row->sortOrder;
  $data['status'] = $row->status; 
  $data['link'] = $row->link; 

    
  }else{
  $data['page_title'] = ' Add Resources';
  $data['form_action'] ='admin/add_resource';
  $data['image'] = ''; 
  $data['name'] = '';

  $data['description'] = '';
  $data['sortOrder'] = '';
  $data['status'] = '';
   $data['link'] =  '';

  }
  
  if($this->request->getMethod()=='post'){
    
    $rules = [
      'name'=>'required'
    ];
  
   if ($this->validate($rules)==false) {
      $data['validation'] = $this->validator;
    
  } else{
  
  $save= array();
  $save['name'] = $this->request->getVar('name');
  $save['description'] = $this->request->getVar('description');
  $save['sortOrder'] = $this->request->getVar('sortOrder');
  $save['status'] = $this->request->getVar('status');
  $save['link'] = $this->request->getVar('link');

    
  $file = $this->request->getFile('image');
  if(!empty($file->getClientName())){
    if($file->isValid() && !$file->hasMoved()){
      $file_name = $file->getRandomName();
      if($file->move('uploads/images/', $file_name)){
        $save['image'] = 'uploads/images/'.$file_name;
      }
    }else{
      throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
      exit;
    }
  }


  if ($id) {
    $save['modify_date'] = date('Y-m-d H:i:s');
    $result=  $model->update(array('id'=>$id),$save);
    if ($result) {
    $this->session->setFlashdata('success','Record Update successfully');
    return redirect()->to('admin/add_resource/'.$id);
    }else{
    $this->session->setFlashdata('error','Record not update');
    return redirect()->to('admin/add_resource/'.$id);
    }
  }else{
    $save['create_date'] = date('Y-m-d H:i:s');
    $save['modify_date'] = date('Y-m-d H:i:s');
    $result=  $model->insert($save);
    if ($result) {
    $this->session->setFlashdata('success','Record insert successfully');
    return redirect()->to('admin/resources');
    }else{
    $this->session->setFlashdata('error','Record not insert');
    return redirect()->to('admin/add_resource');
    }
    }
    }
    }
   return view('admin/module/add_resource',$data);
}

  function delete_resources()
  {
  $model = new ResourceModel();
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
  return redirect()->to('admin/awards');
  }





}
