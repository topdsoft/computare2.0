<?php
App::uses('AppController', 'Controller');
/**
 * ItemPopUps Controller
 *
 * @property ItemPopUp $ItemPopUp
 */
class ItemPopUpsController extends AppController {

	public function popup() {
		$this->Item=ClassRegistry::init('Item');
		$this->Item->recursive = 0;
		$conditions=array();
		if ($this->request->is('post') || $this->request->is('put')) {
			//search fields
			$search=array('name','sku','upc');
			foreach($search as $s) {
				//loop for all search items
				if(!empty($this->request->data['Item'][$s])) $conditions["ItemDetail.$s LIKE"]='%'.$this->request->data['Item'][$s].'%';
			}//endforeach
			
// debug($this->request->data);exit;
		}//endif
		$items=$this->paginate('Item',$conditions);
		foreach($items as $i=>$item) $items[$i]['path']=$this->Item->ItemCategory->getPath($item['Item']['category_id'],array('id','name'));
//  debug($items);exit;
		$this->set(compact('items'));
		$this->layout='popup';
	}

}
