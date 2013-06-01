<?php
App::uses('AppController', 'Controller');
/**
 * Images Controller
 *
 * @property Image $Image
 */
class ImagesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Images');
		$this->set('add_menu',true);
		$this->Image->recursive = 0;
		$this->set('images', $this->paginate());
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','View image');
		$this->Image->id = $id;
		if (!$this->Image->exists()) {
			throw new NotFoundException(__('Invalid image'));
		}
		$this->set('image', $this->Image->read(null, $id));
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

/**
 * add method
 * @param item_id => will add image to item
 * @return void
 */
	public function add() {
		$this->set('formName','Upload Image');
		$this->set('add_menu',true);
		//check if imageTypes are set up
		
		if ($this->request->is('post')) {
			//save image(s)
			$imgDir='img/'.Configure::read('Company').'/';
			if(!is_dir($imgDir)) mkdir($imgDir,0770);
			//check directory setting in imageSettings
			$image_dir=ClassRegistry::init('ImageSetting')->field('image_dir',array('active'));
			//if set then add to working directory
			if($image_dir!='') $imgDir.=$image_dir.'/';
			unset($image_dir);
// debug($this->request->data);debug($this->passedArgs);exit;
			$imageSuccess=$imageFail=0;
			$failList=array();
			foreach($this->request->data['Images'] as $image) {
				//loop for all images uploaded
				$filetype = $image['type'];
				if (($filetype != "image/jpeg")  && ($filetype != "image/jpg") && ($filetype != "image/gif") && ($filetype != "image/png")) {
//					$this->Session->setFlash(__('Please choose a file of type:JPG,GIF or PNG.'));
					$imageFail++;
					$failList[]=$image['name'];
				} else {
					//filetype ok
					if(!is_dir($imgDir)) mkdir($imgDir,0770);
					if(!is_dir($imgDir.'thumbnails')) mkdir($imgDir.'thumbnails',0770);
					$path=$imgDir;
					//get next auto increment number to use in filename
					$q=$this->Image->query('SHOW TABLE STATUS where Name= "images"');
//debug($q);exit;
					$filename=$q[0]['TABLES']['Auto_increment'].str_replace(".", "", strtotime ("now"));
					//add ext
					if($filetype=='image/gif') $ext='.gif';
					else if($filetype=='image/png') $ext='.png';
					else $ext='.jpg';
					$tmpFile=$image['tmp_name'];
					if(is_uploaded_file($tmpFile)) {
						//file upload valid
						if($ext=='.jpg')$img_src=ImageCreateFromjpeg($tmpFile);
						else if($ext=='.png')$img_src=imagecreatefrompng($tmpFile);
						else $img_src=imagecreatefromgif($tmpFile);
						//create thumbnail
						$scale=50;
						$width = imagesx($img_src);
						$height = imagesy($img_src);
						$ratiox = $width / $height * $scale;
						$ratioy = $height / $width * $scale;
						//Calculate resampling
						$newheight = ($width <= $height) ? $ratioy : $scale;
						$newwidth = ($width <= $height) ? $scale : $ratiox;
						//Calculate cropping (division by zero)
						$cropx = ($newwidth - $scale != 0) ? ($newwidth - $scale) / 2 : 0;
						$cropy = ($newheight - $scale != 0) ? ($newheight - $scale) / 2 : 0;
						// Setup Resample & Crop buffers
						$resampled = imagecreatetruecolor($newwidth, $newheight);
						$cropped = imagecreatetruecolor($scale, $scale);
						//Resample
						imagecopyresampled($resampled, $img_src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
						//Crop
						imagecopy($cropped, $resampled, 0, 0, $cropx, $cropy, $newwidth, $newheight);
						// Save the cropped image
						if($ext=='.jpg')imagejpeg($cropped,$path.'thumbnails/'.$filename.$ext,80);
						else if($ext=='.png')imagepng($cropped,$path.'thumbnails/'.$filename.$ext);
						else imagegif($cropped,$path.'thumbnails/'.$filename.$ext);
						//get file size from imageSettings
						$max_image_size=ClassRegistry::init('ImageSetting')->field('max_image_size',array('active'));
						if($max_image_size>0) $size=$max_image_size;
						else $size=1200;
						//check size of file
						if($width>$size || $height>$size) {
							//resize image
							$true_width = imagesx($img_src);
							$true_height = imagesy($img_src);

							if ($true_width>=$true_height) {
								$width=$size;
								$height = ($width/$true_width)*$true_height;
							} else {
								$height=$size;
								$width = ($height/$true_height)*$true_width;
							}//endif
							$cropped = ImageCreateTrueColor($width,$height);
							imagecopyresampled ($cropped, $img_src, 0, 0, 0, 0, $width, $height, $true_width, $true_height);
							// Save the cropped image
							if($ext=='.jpg')imagejpeg($cropped,$path.$filename.$ext,80);
							else if($ext=='.png')imagepng($cropped,$path.$filename.$ext);
							else imagegif($cropped,$path.$filename.$ext);
						} else {
							//no need to resize
							copy($tmpFile,$path.$filename.$ext);
						}//endif 
						//to use cake HTML helper that adds 'img/' we want to remove that directory from the filenames
						$shortPath=substr($path,4);
						$this->request->data['Image']['filename']=$shortPath.$filename.$ext;
						$this->request->data['Image']['thumbnail']=$shortPath.'thumbnails/'.$filename.$ext;
						$this->request->data['Image']['id']=null;
						$this->request->data['Image']['created_id']=$this->Auth->user('id');
// debug($this->request->data);debug($filename);exit;
						$this->Image->create();
						if ($this->Image->save($this->request->data)) {
							//saved ok
							$imageSuccess++;
							//check for adding image to item
							if(isset($this->passedArgs['item_id'])) {
								//set item to use this image
								$this->Image->ImagesItem->create();
								$this->Image->ImagesItem->save(array('item_id'=>$this->passedArgs['item_id'],'image_id'=>$this->Image->getInsertId()));
							}//endif
						} else {
							//record failed to save
							$imageFail++;
							$failList[]=$image['name'];
						}//endif
					} else {
						//not uploaded file
						$imageFail++;
						$failList[]=$image['name'];
					}//endif check for uploaded file
				}//endif filetype
			}//end foreach loop for all files uploaded
			if($imageSuccess==0 && $imageFail==0) $this->Session->setFlash(__('No Image selected. Please, try again.'));
			else if ($imageFail>0) {
				//some files not ok
				$msg="$imageSuccess file";
				if($imageSuccess!=1) $msg.='s';
				$msg.=" were uploaded.  $imageFail file";
				if($imageFail>1) $msg.='s';
				$msg.=" failed to upload.  Failed file";
				if($imageFail>1) $msg.='s';
				$msg.=':';
				foreach($failList as $fail) $msg.=' '.$fail;
				$this->Session->setFlash($msg);
			} else {
				//all good
				$msg="$imageSuccess file";
				if($imageSuccess!=1) $msg.='s';
				$msg.=' Uploaded Successfully';
				$this->Session->setFlash($msg,'default',array('class'=>'success'));
				//check for redirect
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('controller'=>'images','action' => 'index'));
			}
		} else {
			//get referer info
/*			$exp=explode('/',$this->referer());
			if(count($exp)>3)$controller=$exp[count($exp)-3];
			else $controller=null;
			if($specific && $controller=='locos') {
				//assign image to loco
				$this->request->data['Loco']['Loco'][0]=$exp[count($exp)-1];
				$this->set('loco',$this->Image->Loco->read(null,$exp[count($exp)-1]));
			}//endif
			if($specific && $controller=='cars'){
				//assign image to car
				$this->request->data['Car']['Car'][0]=$exp[count($exp)-1];
				$this->set('car',$this->Image->Car->read(null,$exp[count($exp)-1]));
			}//endif
			$this->request->data['in']['redirect']=$this->referer(array('action'=>'index'));
//			debug($exp);exit;*/
			
			
		}
		$items = $this->Image->Item->find('list');
		$this->set(compact('items'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Image');
		$this->Image->id = $id;
		if (!$this->Image->exists()) {
			throw new NotFoundException(__('Invalid image'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
// debug($this->request->data);exit;
			//add image to item
			if(!$this->request->data['Image']['item_id']) {
				//item_id has not been set
				$this->redirect(array('action' => 'index'));
			}//endif
			//check for existing item-image pair
			if($this->Image->ImagesItem->field('id',array(array('image_id'=>$this->request->data['Image']['id'],'item_id'=>$this->request->data['Image']['item_id'])))) {
				//pair-found
				$this->redirect(array('action' => 'index'));
			}//endif
			if ($this->Image->ImagesItem->save(array('image_id'=>$this->request->data['Image']['id'],'item_id'=>$this->request->data['Image']['item_id']))) {
				//saved ok
				$this->Session->setFlash(__('The image has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				//failed save (usually due to existing item-image pair)
				$this->Session->setFlash(__('The image could not be saved. Please, try again.'));
			}//endif
		} else {
			//get defaults
			$this->request->data = $this->Image->read(null, $id);
		}//endif
		$items = array(null=>'')+$this->Image->Item->find('list');
		$this->set(compact('items'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->set('formName','Delete Image');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Image->id = $id;
		if (!$this->Image->exists()) {
			throw new NotFoundException(__('Invalid image'));
		}
		//get image data
		$image=$this->Image->read();
		if ($this->Image->delete()) {
			//unlink files
			unlink('img/'.$image['Image']['filename']);
			unlink('img/'.$image['Image']['thumbnail']);
			$this->Session->setFlash(__('Image deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Image was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
