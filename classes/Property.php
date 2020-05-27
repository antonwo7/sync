<?php
Class Property{
	public $id;
	public $ref;
	public $price;
	public $pool;
	public $tag;
	public $is_new;
	public $type;
	public $town;
	public $province;
	public $beds;
	public $baths;
	public $point = array();
	public $area = array();
	public $urls = array();
	public $descriptions = array();
	public $features = array();
	public $images = array();
	
	public function get_terms_array(){
		$terms = ['acc_tag' => [], 'accommodation_type' => [], 'facility' => [], 'accommodation_location' => []];
		foreach($terms as $term_name => $term_value){
			$terms[$term_name] = [
				'by' => 'slug',
				'list' => [],
			];
		}
		$terms['accommodation_location']['by'] = 'name';
		$terms['facility']['by'] = 'name';
		
		if($this->is_new == '1')
			$terms['acc_tag']['list'][] = 'new';
		
		$terms['acc_tag']['list'][] = $this->tag;
		$terms['accommodation_location']['list'][] = $this->town;
		$terms['accommodation_type']['list'][] = $this->type;
		$terms['facility']['list'] = $this->features;
		if($this->pool == '1')
			$terms['facility']['list'][] = 'Pool';
		
		return $terms;
	}
	
	public function get_title(){
		return ucfirst($this->type) . " in " . $this->town;
	}
	
	public function get_address(){
		return $this->town . ", " . $this->province;
	}
	
	public function set_tag($tag){
		$this->tag = Config::get_tag($tag);
	}
	
	public function set_type($type){
		$this->type = Config::get_type($type);
	}
	
	public function set_is_new($is_new){
		$this->is_new = $is_new;
	}
	
	public function set_point($fields){
		foreach($fields as $field_name => $field_value){
			$this->point[$field_name] = $field_value;
		}
	}
	
	public function set_area($fields){
		foreach($fields as $field_name => $field_value){
			$this->area[$field_name] = $field_value;
		}
	}
	
	public function set_urls($urls){
		$this->urls = $urls;
	}
	
	public function set_descriptions($descriptions){
		$this->descriptions = $descriptions;
	}
	
	public function set_features($features){
		$this->features = $features;
	}
	
	public function set_images($images){
		$this->images = $images;
	}
	
	function add_image($image){
		$this->images[] = $image;
	}
}
?>