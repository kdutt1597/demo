<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Cms\MerakiCatModel;
use App\Models\Cms\MerakiMediaModel;
use App\Models\coreModule\SettingModel;

class Meraki extends BaseController
{
      public function __construct()
    {

        $settingModel = new SettingModel();
        $default_img = $settingModel->asObject()->where(array('key'=>'config_logo'))->first();
        $this->config_logo = $default_img->value; 
             
    }
    
    public function index(){

		$model = new MerakiCatModel();
// 		echo $this->uri->getSegment(2);die;
		$permission = $this->AdminModel->permission($this->uri->getSegment(2));
		if(empty($permission)){
		return  redirect()->to('admin/permission-denied');
		} 
		
		$data['page_title'] = 'All Meraki Category List';

		$query = array();
			$like = array();
			if(!empty($_GET['type'])){
				$query['type'] = $_GET['type']; 
			}

		if(!empty($_GET['name'])){
				$like['keyword'] = $_GET['name']; 
			}


		// pagination
			$data['perPage'] = 10;
			$data['detail'] = $model->asObject()->where($query)->like($like)->orderBy('meraki_cats.id','asc')->paginate($data['perPage']);
			$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

			$data['total'] = $model->where($query)->like($like)->countAllResults();

			$data['data'] = $model->paginate($data['perPage']);
			$data['pager'] = $model->pager;

			$data['pages'] = round($data['total']/$data['perPage']);
			$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
		// end


		$data['config_logo'] = $this->config_logo;
		echo view('admin/product/meraki_cats',$data);

	}
	
	public function add_meraki_cats($id=false){
	    
        $model = new MerakiCatModel();
        
        if (!empty($id)) {
            $data['page_title'] = 'Edit Meraki Cats';
            $data['form_action'] = 'admin/add_meraki_cats/' . $id;
            $row = $model->asObject()->where(['id' => $id])->first();
    
            $data['name'] = $row->name;
            $data['shortDescription'] = $row->short_description;
            $data['description'] = $row->description;
            $data['metaTitle'] = $row->metaTitle;
            $data['metaKeyword'] = $row->metaKeyword;
            $data['metaDescription'] = $row->metaDescription;
            $data['sort_order'] = $row->sort_order;
            $data['status'] = $row->status;
            $data['slug'] = $row->slug;
        } else {
            $data['page_title'] = 'Add Meraki Cats';
            $data['form_action'] = 'admin/add_meraki_cats';
            $data['name'] = '';
            $data['shortDescription'] = '';
            $data['description'] = '';
            $data['metaTitle'] = '';
            $data['metaKeyword'] = '';
            $data['metaDescription'] = '';
            $data['sort_order'] = '';
            $data['status'] = '';
            $data['slug'] = '';
        }
    
        if ($this->request->getMethod() == 'post') {
            
            $rules = [
                'name' => 'required'
            ];
    
            if ($this->validate($rules) == false) {
                $data['validation'] = $this->validator;
            } else {
                $save = [];
                $save['name'] = $this->request->getVar('name');
                $save['short_description'] = $this->request->getVar('shortDescription');
                $save['description'] = $this->request->getVar('description');
                $save['metaTitle'] = $this->request->getVar('metaTitle');
                $save['metaKeyword'] = $this->request->getVar('metaKeyword');
                $save['metaDescription'] = $this->request->getVar('metaDescription');
                $save['sort_order'] = $this->request->getVar('sort_order');
                $save['status'] = $this->request->getVar('status');
                $save['slug'] = $this->request->getVar('slug');
    
                if (!empty($this->request->getVar('slug'))) {
                    $save['slug'] = sfu($this->request->getVar('slug'));
                } else {
                    $save['slug'] = sfu($this->request->getVar('name'));
                }
                
                if ($id) {
                    $save['id'] = $id;
                    $result = $model->update(array('id'=>$id),$save);
                    if ($result) {
                        $this->session->setFlashdata('success', 'Record updated successfully');
                        return redirect()->to('admin/add_meraki_cats/' . $id);
                    } else {
                        $this->session->setFlashdata('error', 'Error in update');
                        return redirect()->to('admin/add_meraki_cats/' . $id);
                    }
                } else {
                    $save['id'] = '';
                    $result = $model->insert($save);
                    if ($result) {
                        $this->session->setFlashdata('success', 'Record inserted successfully');
                        return redirect()->to('admin/meraki_cats');
                    } else {
                        $this->session->setFlashdata('error', 'Record not inserted');
                        return redirect()->to('admin/add_meraki_cats');
                    }
                }
            }
        }
        
        echo view('admin/product/add_meraki_cats', $data);
	}
	
	public function delete_meraki_cats(){
       $model = new MerakiCatModel();
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
         
      return redirect()->to('admin/meraki_cats');
    }
    
    public function meraki_blogs(){
        $model = new MerakiMediaModel();
        $data['page_title'] = 'Blogs List';
        
        // Type and scope lists
        $data['typeList'] = [
            'BLOG' => 'BLOG',
            'EBOOK' => 'EBOOK',
            'WHITEPAPER' => 'WHITEPAPER',
            'PODCAST' => 'PODCAST'
        ];
        $data['scopeList'] = ['GLOBAL' => 'GLOBAL', 'INDIA' => 'INDIA'];
        
        $data['perPage'] = 10;
        
        // Build query with filters
        $builder = $model->asObject()
            ->select('cyb_meraki_blog.*')
            ->orderBy('cyb_meraki_blog.id', 'desc');
        
        // Apply type filter
        if (!empty($_GET['type'])) {
            $builder->where('type', $_GET['type']);
        }
        
        // Apply name/title filter
        if (!empty($_GET['name'])) {
            $builder->like('title', $_GET['name']);
        }
        
        // Get paginated results
        $data['detail'] = $builder->paginate($data['perPage']);
        
        // Process blogs (no category logic needed)
        $blogs = [];
        foreach ($data['detail'] as $blog) {
            $blogs[$blog->id]['data'] = $blog;
        }
        $data['groupedBlogs'] = $blogs;
        
        // Pagination setup
        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;
        $data['total'] = $model->countAllResults();
        $data['data'] = $model->paginate($data['perPage']);
        $data['pager'] = $model->pager;
        $data['pages'] = round($data['total'] / $data['perPage']);
        $data['offset'] = $data['page'] <= 1 ? 0 : $data['page'] * $data['perPage'] - $data['perPage'];
        
        $data['config_logo'] = $this->config_logo;
        return view('admin/module/meraki_blogs', $data);
    }

    public function add_meraki_blog($id = false){
        
        
        $model = new MerakiMediaModel();
    	$data['typeList'] = array('BLOG'=>'BLOG','EBOOK'=>'EBOOK','WHITEPAPER'=>'WHITEPAPER','PODCAST'=>'PODCAST');
		
		if(!empty($id)) {
		$data['page_title'] = 'Edit Blog';
		$data['form_action'] = 'admin/add_meraki_blog/'.$id;	
		$row = 	$model->asObject()->where('id',$id)->first($id);
		$data['footer'] =  $row->footer;
		$data['title'] = $row->title;
		$data['description'] = $row->description;
		$data['status'] = $row->status;
		$data['image'] = $row->image;
		$data['slug'] = $row->slug; 
		$data['type'] = $row->type;
		$data['metaTitle'] = $row->metaTitle; 
		$data['metaDescription'] = $row->metaDescription; 
		$data['metaKeyword'] = $row->metaKeyword; 
		$data['thumbnail'] =  $row->thumbnail; 
		$data['shortDescription'] =  $row->shortDescription; 
		$data['publish'] =  $row->publish;
        $data['whitepaper_download'] =  $row->whitepaper_download;
        $data['podcast'] = $row->podcast;
        $data['alt_tag2'] = $row->alt_tag2;
        $data['alt_tag'] = $row->alt_tag;
        $data['sort_order'] = $row->sort_order;
		
		
		}else{
		$data['page_title'] = 'Add Blogs';
		$data['form_action'] ='admin/add_meraki_blog';
		$data['footer'] =  '';
		$data['title'] = '';
		$data['description'] = '';
		$data['status'] = '';
		$data['image'] =  '';
		$data['thumbnail'] =  '';
		$data['shortDescription'] =  '';
		$data['slug'] = ''; 
		$data['metaTitle'] = '';
		$data['metaDescription'] = '';
		$data['metaKeyword'] = '';
		$data['publish'] =  ''; 
		$data['type'] = '';
		$data['whitepaper_download'] = '';
		$data['podcast'] = '';
        $data['alt_tag2'] = '';
        $data['alt_tag'] = '';
        $data['sort_order'] = '';
		
		}


		$rules =[
			'title'=>['lable'=>'Title','rules'=>'required']
		];
		if($this->request->getMethod()=='post'){

		if($this->validate($rules)==false){
			$data['validation'] = $this->validator;
		}else{	
		$save = array();
		$save['footer'] =     $this->request->getVar('footer');
		$save['title'] =     $this->request->getVar('title');
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
		$save['type'] = $this->request->getVar('type');
	    $save['alt_tag2'] = $this->request->getVar('alt_tag2');
	    $save['alt_tag'] = $this->request->getVar('alt_tag');
        
        $save['sort_order'] = $this->request->getVar('sort_order');
			

			
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
				return redirect()->to('admin/add_meraki_blog/'.$id);
			}else{
				session()->setFlashdata('error','Record update failed');
				return redirect()->to('admin/add_meraki_blog/'.$id);
			}
		}else{
			$save['create_date'] = date('Y-m-d H:i:s');
			$save['modify_date'] = date('Y-m-d H:i:s');
			$result = $model->insert($save); // work for both mehtod // $model->insert($save);
			if($result){
				session()->setFlashdata('success','Record Insert success');
				return redirect()->to('admin/meraki_blogs');
			}else{
				session()->setFlashdata('error','Record update unsuccess');
				return redirect()->to('admin/add_meraki_blog');
			}

		   }

		  }
	   
	    }
		return view('admin/module/add_meraki_blog',$data);

	}



function delete_blogs(){
	$model = new MerakiMediaModel();
	$ids = $this->request->getVar('selected');
	if($ids){
		foreach($ids as  $key => $value){
			$model->delete(array('id'=>$value));
		}
		$this->session->setFlashdata('success','Record Delete success');
	}
	return redirect()->to('admin/meraki_blogs');
}

    
}