<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\module\MediaModel;
use App\Models\Cms\AdvModel;
use App\Models\coreModule\SettingModel;


class Media extends BaseController
{
   
   public function __construct()
	{

	    $settingModel = new SettingModel();
        $default_img = $settingModel->asObject()->where(array('key'=>'config_logo'))->first();
        $this->config_logo = $default_img->value; 
             
	}


 function blogs(){
 	
		$model = new MediaModel();
		$data['page_title'] ='Blogs List';

		$data['typeList'] = [
            'BLOG' => 'BLOG',
            'CASE_STUDY' => 'CASE STUDY',
            'EBOOK' => 'EBOOK',
            'WHITEPAPER' => 'WHITEPAPER',
            'DEMAND' => 'DEMAND',
            'PODCAST' => 'PODCAST',
            'EVENTS' => 'EVENTS',
            'TECH' => 'TECH',
            'FIREWALL' => 'FIREWALL'
        ];
        $data['scopeList'] = array('GLOBAL'=>'GLOBAL','INDIA'=>'INDIA');

	    $data['blogCategoryList'] = $this->AdminModel->all_fetch('blog_category',array('status'=>1));

        $query = array();
	    $like = array();
		$categoryCondition = null;
		
	    if(!empty($_GET['type'])){
	        $query['type'] = $_GET['type'];
	    }
        if (!empty($_GET['category'])) {
            $category = $_GET['category'];
        
            if (strpos($category, ',') !== false) {
                $categoryIds = explode(',', $category); 
                $conditions = [];
        
                foreach ($categoryIds as $catId) {
                    $conditions[] = "FIND_IN_SET('$catId', cyb_blogs.category)";
                }
        
                $categoryCondition = '(' . implode(' OR ', $conditions) . ')';
            } else {
                $categoryCondition = "FIND_IN_SET('$category', cyb_blogs.category)";
            }
        }

	   if(!empty($_GET['name'])){
	        $like['title'] = $_GET['name']; 
	    }


		$data['perPage'] = 10;
			
		$builder = $model->asObject()
			->select('cyb_blogs.*, bc.name as category_name')
			->join('blog_category as bc', 'FIND_IN_SET(bc.id, cyb_blogs.category)', 'left')
			->orderBy('cyb_blogs.id', 'desc');
		
		if (!empty($query)) {
			$builder->where($query);
		}
		
		if (!empty($like)) {
			$builder->like($like);
		}
		
		if (!empty($categoryCondition)) {
			$builder->where($categoryCondition, null, false); // Prevent escaping
		}
		
		$data['detail'] = $builder->paginate($data['perPage']);
		
		$blogs = [];
		foreach ($data['detail'] as $blog) {
			$blogs[$blog->id]['data'] = $blog;
		
			if (!isset($blogs[$blog->id]['categories'])) {
				$blogs[$blog->id]['categories'] = [];
			}
			$blogs[$blog->id]['categories'][] = $blog->category_name;
		}
		
		$data['groupedBlogs'] = $blogs;
		// echo "<pre>";print_r($data['groupedBlogs']);die;
	  	$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

		$data['total'] = $model->select('cyb_blogs.*')
		  ->join('blog_category as bc', 'FIND_IN_SET(bc.id, cyb_blogs.category)', 'left')
		  ->where($query)
		  ->like($like)
		  ->countAllResults();

		$data['data'] = $model->paginate($data['perPage']);
		$data['pager'] = $model->pager;

		$data['pages'] = round($data['total']/$data['perPage']);
		$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
		
		$data['config_logo'] = $this->config_logo;
		return  view('admin/module/blogs',$data);
	}
	public function advBlogArea(){
        $model = new AdvModel();
        $save = array();
        if($this->request->getMethod()=='post'){
            if($this->request->getVar('adv_id') == '1'){
                if($this->request->getVar('Advtype') == 'none'){
                    $save['adv_title'] = $this->request->getVar('adv_title');
					$save['adv_url'] = $this->request->getVar('adv_url');
                    if(!empty($_FILES['adv_img']['name'])){
            			$file = $this->request->getFile('adv_img');
            			if($file->isValid() && !$file->hasMoved()){
            				$file_name = $file->getName();
            				if($file->move('uploads/images/', $file_name)){
            					$save['adv_img'] =  'uploads/images/'.$file_name;
            				}
            			}else{
            				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
            				exit;
            			}
            		}

					$save['blog_id'] = '';	
                }else{
					$save['adv_title'] = '';
					$save['adv_url'] = '';
					$save['adv_img'] = '';
                    $save['blog_id'] = $this->request->getVar('subtype');
                }
                $save['updated_at'] = date('Y-m-d H:i:s');
				// print_r($save);die;
                $result = $model->update(array('id'=>1),$save);
    			if($result){
    				session()->setFlashdata('success','Record Insert success');
    				return redirect()->to('admin/blogs');
    			}else{
    				session()->setFlashdata('error','Record update unsuccess');
    				return redirect()->to('admin/blogs');
    			}
			}
			if($this->request->getVar('adv_id') == '2'){
				// print_r($_POST);die;
				if($this->request->getVar('Advtype') == 'none'){
					$save['adv_title'] = $this->request->getVar('adv_title');
					$save['adv_url'] = $this->request->getVar('adv_url');
					if(!empty($_FILES['adv_img']['name'])){
						$file = $this->request->getFile('adv_img');
						if($file->isValid() && !$file->hasMoved()){
							$file_name = $file->getName();
							if($file->move('uploads/images/', $file_name)){
								$save['adv_img'] =  'uploads/images/'.$file_name;
							}
						}else{
							throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
							exit;
						}
					}

					$save['blog_id'] = '';	
				}else{
					$save['adv_title'] = '';
					$save['adv_url'] = '';
					$save['adv_img'] = '';
					$save['blog_id'] = $this->request->getVar('subtype');
				}
				$save['updated_at'] = date('Y-m-d H:i:s');
				// print_r($save);die;
				$result = $model->update(array('id'=>2),$save);
				if($result){
					session()->setFlashdata('success','Record Insert success');
					return redirect()->to('admin/blogs');
				}else{
					session()->setFlashdata('error','Record update unsuccess');
					return redirect()->to('admin/blogs');
				}
			}
            
        } 
    }

	public function returnBlogs(){
        $model = new MediaModel();
        
        $type = $this->request->getVar('typeSelected');
        $advList = $model->asObject()
            ->select('blogs.*')
            ->groupStart()
                ->where('feature', 1)
                ->where('type', $type)
                ->where('status', 1)
            ->groupEnd()
            ->orderBy('blogs.id', 'desc')
            ->findAll();
            
        return json_encode($advList);
    }

	public function add_blog($id = false){
      
        $model = new MediaModel();
    	$data['typeList'] = [
            'BLOG' => 'BLOG',
            'CASE_STUDY' => 'CASE STUDY',
            'EBOOK' => 'EBOOK',
            'WHITEPAPER' => 'WHITEPAPER',
            'DEMAND' => 'DEMAND',
            'PODCAST' => 'PODCAST',
            'EVENTS' => 'EVENTS',
            'TECH' => 'TECH',
            // 'FIREWALL' => 'FIREWALL'
        ];
		$data['scopeList'] = array('GLOBAL'=>'GLOBAL','INDIA'=>'INDIA');
		
		$data['authorList'] = $this->AdminModel->all_fetch('author',null);

        $data['blogCategoryList'] = $this->AdminModel->all_fetch('blog_category',array('status'=>1),'sort_order','asc');
		
		if(!empty($id)) {
		$data['page_title'] = 'Edit Blog';
		$data['form_action'] = 'admin/add_blog/'.$id;	
		$row = 	$model->asObject()->where('id',$id)->first($id);
		$data['feature'] =  $row->feature;
		$data['title'] = $row->title;
		$data['description'] = $row->description;
		$data['status'] = $row->status;
		$data['image'] = $row->image; 
		$data['slug'] = $row->slug; 
		$data['type'] = $row->type; 
		$data['scope'] = $row->scope; 
		$data['location'] = $row->location; 
		$data['category'] = $row->category;
		$data['description2'] = $row->description2; 
		$data['metaTitle'] = $row->metaTitle; 
		$data['metaDescription'] = $row->metaDescription; 
		$data['metaKeyword'] = $row->metaKeyword; 
		$data['thumbnail'] =  $row->thumbnail; 
		$data['shortDescription'] =  $row->shortDescription; 
		$data['publish'] =  $row->publish;
		$data['event_end_date'] =  $row->event_end_date;
        $data['trending'] =  $row->trending; 
        $data['whitepaper_download'] =  $row->whitepaper_download;
        $data['video'] =  $row->video;
        $data['podcast'] = $row->podcast;
        $data['upcoming'] =  $row->upcoming;
        $data['industry'] = $row->industry;	
        $data['client'] = $row->client;
        $data['spotlight'] = $row->spotlight;
        $data['sticky'] = $row->sticky;
        $data['alt_tag2'] = $row->alt_tag2;
        $data['alt_tag'] = $row->alt_tag;
        $data['audio'] = $row->audio;
        $data['author'] = $row->author;
        
        $data['readingTime'] = $row->readingTime;
        
        $data['event_image'] = $row->event_image;
        $data['event_description'] = $row->event_description;
        $data['event_description1'] = $row->event_description1;
        $data['sort_order'] = $row->sort_order;
        $data['size'] = $row->size;
		
		
		
		
		
		
		}else{
		$data['page_title'] = 'Add Blogs';
		$data['form_action'] ='admin/add_blog';
		$data['feature'] =  '';
		$data['category'] =  '';
		$data['title'] = '';
		$data['description'] = '';
		$data['status'] = '';
		$data['image'] =  '';
		$data['thumbnail'] =  '';
		$data['shortDescription'] =  '';
	    $data['location'] =  '';
		$data['slug'] = ''; 
		$data['metaTitle'] = '';
		$data['metaDescription'] = '';
		$data['metaKeyword'] = '';
		$data['note'] = '';
		$data['description2'] =  '';
		$data['category_id'] = '';
		$data['publish'] =  '';
		$data['event_end_date'] = '';
		$data['type'] = ''; 
		$data['scope'] = '';  
		$data['trending'] =  '';  
		$data['whitepaper_download'] = '';  
		$data['video'] = ''; 
		$data['podcast'] = ''; 
		$data['upcoming'] =   '';
		$data['industry'] = '';
		$data['client'] = '';
		$data['spotlight'] = '';
        $data['sticky'] = '';
        $data['alt_tag2'] = '';
        $data['alt_tag'] = '';
        $data['audio'] = '';
        
        $data['author'] =  '';
        $data['readingTime'] = '';
        $data['event_image'] = '';
        $data['event_description'] = '';
        $data['event_description1'] = '';
        $data['sort_order'] = '';
		$data['size'] = '';
			
			
		
		}


		$rules =[
			'title'=>['lable'=>'Title','rules'=>'required']
		];
		if($this->request->getMethod()=='post'){

		if($this->validate($rules)==false){
			$data['validation'] = $this->validator;
		}else{	
		$save = array();
		$save['feature'] =     $this->request->getVar('feature');
		$save['title'] =     $this->request->getVar('title');
        $selectCat = $this->request->getVar('category');
		if (is_array($selectCat)) {
            $selection = implode(',', $selectCat);
        }
        $save['category'] = $selection;
        $save['shortDescription'] =     $this->request->getVar('shortDescription');
	
		if($this->request->getVar('slug')){
		$save['slug'] =     sfu($this->request->getVar('slug'));
		}else{
		$save['slug'] =     sfu($this->request->getVar('title'));
		} 
		$save['description'] =     $this->request->getVar('description');
		$save['status'] =     $this->request->getVar('status');
		$save['metaTitle'] = $this->request->getVar('metaTitle');
		$save['metaDescription'] = $this->request->getVar('metaDescription');
		$save['metaKeyword'] = $this->request->getVar('metaKeyword');
		$save['publish'] = $this->request->getVar('publish');
		$save['event_end_date'] = $this->request->getVar('event_end_date');
		$save['description2'] = $this->request->getVar('description2');
		$save['type'] = $this->request->getVar('type');
		$save['location'] = $this->request->getVar('location');
			
		$save['trending'] = $this->request->getVar('trending');	
		$save['upcoming'] = $this->request->getVar('upcoming');	
	
		$save['industry'] = $this->request->getVar('industry');	
		$save['client'] = $this->request->getVar('client');	
		$save['spotlight'] = $this->request->getVar('spotlight');	
		
		$save['sticky'] = $this->request->getVar('sticky');
        $save['alt_tag2'] = $this->request->getVar('alt_tag2');
        $save['alt_tag'] = $this->request->getVar('alt_tag');
        $save['author'] = $this->request->getVar('author');
        $save['readingTime'] = $this->request->getVar('readingTime');
        
        $save['sort_order'] = $this->request->getVar('sort_order');
        $save['size'] = $this->request->getVar('size');
        
        
        
        $save['event_description'] = $this->request->getVar('event_description');
        
        $save['event_description1'] = $this->request->getVar('event_description1');
			
				
			
			
			
			


		if(!empty($_FILES['event_image']['name'])){
			$file = $this->request->getFile('event_image');
			if($file->isValid() && !$file->hasMoved()){
				$file_name = $file->getName();
				if($file->move('uploads/images/', $file_name)){
					$save['event_image'] =  'uploads/images/'.$file_name;
				}
			}else{
				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
				exit;
			}
		}	
			
			
			
			
			
			
   	    if(!empty($_FILES['whitepaper_download']['name'])){
			$file = $this->request->getFile('whitepaper_download');
			if($file->isValid() && !$file->hasMoved()){
				$file_name = $file->getName();
				if($file->move('uploads/images/', $file_name)){
					$save['whitepaper_download'] =  'uploads/images/'.$file_name;
				}
			}else{
				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
				exit;
			}
		}	
			
	if(!empty($_FILES['audio']['name'])){
			$file = $this->request->getFile('audio');
			if($file->isValid() && !$file->hasMoved()){
				$file_name = $file->getRandomName();
				if($file->move('uploads/images/', $file_name)){
					$save['audio'] =  'uploads/images/'.$file_name;
				}
			}else{
				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
				exit;
			}
		}	
			
					
	if(!empty($_FILES['video']['name'])){
			$file = $this->request->getFile('video');
			if($file->isValid() && !$file->hasMoved()){
				$file_name = $file->getRandomName();
				if($file->move('uploads/images/', $file_name)){
					$save['video'] =  'uploads/images/'.$file_name;
				}
			}else{
				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
				exit;
			}
		}
		if(!empty($_FILES['podcast']['name'])){
			$file = $this->request->getFile('podcast');
			if($file->isValid() && !$file->hasMoved()){
				$file_name = $file->getRandomName();
				if($file->move('uploads/images/', $file_name)){
					$save['podcast'] =  'uploads/images/'.$file_name;
				}
			}else{
				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
				exit;
			}
		}
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

		if(!empty($_FILES['thumbnail']['name'])){
			$file = $this->request->getFile('thumbnail');
			if($file->isValid() && !$file->hasMoved()){
				$file_name = $file->getRandomName();
				if($file->move('uploads/images/', $file_name)){
					$save['thumbnail'] =  'uploads/images/'.$file_name;
				}
			}else{
				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
				exit;
			}
		}

		if(!empty($id)){
			$save['id'] = $id;
			$save['modify_date'] = date('Y-m-d H:i:s');

			$result = $model->update(array('id'=>$id),$save);
			if($result){
				session()->setFlashdata('success','Record update success');
				return redirect()->to('admin/add_blog/'.$id);
			}else{
				session()->setFlashdata('error','Record update unsuccess');
				return redirect()->to('admin/add_blog/'.$id);
			}
		}else{
			$save['create_date'] = date('Y-m-d H:i:s');
			$save['modify_date'] = date('Y-m-d H:i:s');
			$result = $model->insert($save); // work for both mehtod // $model->insert($save);
			if($result){
				session()->setFlashdata('success','Record Insert success');
				return redirect()->to('admin/blogs');
			}else{
				session()->setFlashdata('error','Record update unsuccess');
				return redirect()->to('admin/add_blog');
			}

		   }

		  }
	   
	    }
		return view('admin/module/add_blog',$data);

	}



function delete_blogs(){
	$model = new MediaModel();
	$ids = $this->request->getVar('selected');
	if($ids){
		foreach($ids as  $key => $value){
			$model->delete(array('id'=>$value));
		}
		$this->session->setFlashdata('success','Record Delete success');
	}
	return redirect()->to('admin/blogs');
}


//////////////////////////


public function blog_category()
	{

	$data['page_title']         ='All Blog Category';
	$data['details']		    = $this->AdminModel->all_fetch('blog_category',null);	
	$data['config_logo'] 		= $this->config_logo;
	return view('admin/module/blog_category',$data); 

 	}


	
 public function add_blog_category($id=false)
	{			  


    if (!empty($id)) {
		$data['page_title']   ='Edit Blog Category';
		$data['form_action']  = 'admin/add_blog_category/'.$id;
		$row 			      = $this->AdminModel->fs('blog_category',array('id'=>$id));

		$data['name']         = $row->name;
		$data['sort_order'] = @$row->sort_order;	
		$data['slug'] = @$row->slug;	

        $data['status'] = $row->status;

    }else{

	    $data['page_title']  ='Add Blog category';	
	    $data['form_action'] = 'admin/add_blog_category';
	    $data['name']       = '';
	    $data['slug']       = '';
	    $data['status']         = '';
	    $data['sort_order']         = '';
    }

    if ($this->request->getMethod()=='post') {
  
    $rules = [
		'name'=> ['label'=>'Name','rules'=>'trim']
		
    ];
	
	if ($this->validate($rules)==false) {
	  $data['validation'] = $this->validator;
	}else{

	  $save= array();
      $save['sort_order'] =     $this->request->getVar('sort_order');
      $save['status'] =     $this->request->getVar('status');
      $save['name'] =     $this->request->getVar('name');
     
 
      if ($id) {
          $save['id'] =  $id;
          $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $this->AdminModel->updateData('blog_category',$save,array('id'=>$id));
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_blog_category/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_blog_category/'.$id);
          }
      }else{

         $save['create_date'] = date('Y-m-d H:i:s');
         $save['modify_date'] = date('Y-m-d H:i:s');
         $result=  $this->AdminModel->insertData('blog_category',$save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/blog_category');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/blog_category');
          }

        }
	 
	  } 
     }
	return view('admin/module/add_blog_category',$data);

 	}

 

function delete_blog_category(){

  if ($this->request->getVar('selected')) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
     	$this->AdminModel->deleteData('blog_category',array('id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/blog_category');
}

/////////////////



public function whatis_category()
	{

	$data['page_title']         ='All Whatis Category';
	$data['details']		    = $this->AdminModel->all_fetch('whatis_cat',null);	
	$data['config_logo'] 		= $this->config_logo;
	return view('admin/module/whatis_category',$data); 

 	}


	
 public function add_whatis_category($id=false)
	{			  


    if (!empty($id)) {
		$data['page_title']   ='Edit What IS Category';
		$data['form_action']  = 'admin/add_whatis_category/'.$id;
		$row 			      = $this->AdminModel->fs('whatis_cat',array('id'=>$id));

		$data['cat_name']         = $row->cat_name;
		$data['sort_order'] = @$row->sort_order;	
		$data['slug'] = @$row->slug;	

        $data['status'] = $row->status;

    }else{

	    $data['page_title']  ='Add Blog category';	
	    $data['form_action'] = 'admin/add_whatis_category';
	    $data['name']       = '';
	    $data['slug']       = '';
	    $data['status']         = '';
	    $data['sort_order']         = '';
    }

    if ($this->request->getMethod()=='post') {
  
    $rules = [
		'cat_name'=> ['label'=>'Name','rules'=>'trim']
		
    ];
	
	if ($this->validate($rules)==false) {
	  $data['validation'] = $this->validator;
	}else{

	  $save= array();
      $save['sort_order'] =     $this->request->getVar('sort_order');
      $save['status'] =     $this->request->getVar('status');
      $save['cat_name'] =     $this->request->getVar('cat_name');
     
 
      if ($id) {
          $save['id'] =  $id;
          $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $this->AdminModel->updateData('whatis_cat',$save,array('id'=>$id));
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_whatis_category/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_whatis_category/'.$id);
          }
      }else{

         $save['create_date'] = date('Y-m-d H:i:s');
         $save['modify_date'] = date('Y-m-d H:i:s');
         $result=  $this->AdminModel->insertData('whatis_cat',$save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/whatis_category');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/whatis_category');
          }

        }
	 
	  } 
     }
	return view('admin/module/add_whatis_category',$data);

 	}

 

function delete_whatis_category(){

  if ($this->request->getVar('selected')) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
     	$this->AdminModel->deleteData('whatis_cat',array('id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/whatis_category');
}



/////////////////


public function author()
	{

	$data['page_title']         ='All Authors List';
	$data['details']		    = $this->AdminModel->all_fetch('author',null);	
	$data['config_logo'] 		= $this->config_logo;
	return view('admin/module/author',$data); 

 	}


	
 public function add_author($id=false)
	{			  


    if (!empty($id)) {
		$data['page_title']   ='Edit Authors';
		$data['form_action']  = 'admin/add_author/'.$id;
		$row 			      = $this->AdminModel->fs('author',array('id'=>$id));

		$data['name']         = $row->name;	
		$data['photo'] = @$row->photo;	
		$data['description'] = @$row->description;	
        $data['status'] = $row->status;
        $data['designation'] = $row->designation;
    }else{

	    $data['page_title']  ='Add Authors';	
	    $data['form_action'] = 'admin/add_author';
	    $data['name']       = '';
	    $data['photo']       = '';
	    $data['status']         = '';
	    $data['description']         = '';
	      $data['designation'] = '';
    }

    if ($this->request->getMethod()=='post') {
  
    $rules = [
		'name'=> ['label'=>'Name','rules'=>'required']
		
    ];
	
	if ($this->validate($rules)==false) {
	  $data['validation'] = $this->validator;
	}else{

	  $save= array();
      $save['description'] =     $this->request->getVar('description');
      $save['status'] =     $this->request->getVar('status');
      $save['name'] =     $this->request->getVar('name');
     $save['designation'] =     $this->request->getVar('designation');
     
     
     
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
          $result=  $this->AdminModel->updateData('author',$save,array('id'=>$id));
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_author/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_author/'.$id);
          }
      }else{

         $save['create_date'] = date('Y-m-d H:i:s');
         $save['modify_date'] = date('Y-m-d H:i:s');
         $result=  $this->AdminModel->insertData('author',$save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/author');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/author');
          }

        }
	 
	  } 
     }
	return view('admin/module/add_author',$data);

 	}

 

function delete_author(){

  if ($this->request->getVar('selected')) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
     	$this->AdminModel->deleteData('author',array('id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/author');
}






}
