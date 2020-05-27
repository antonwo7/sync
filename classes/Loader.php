<?php
Class Loader{
	private $parser;
	private $loaded_posts;
	
	function __construct(){
		$this->parser = new Parser();
		$this->loaded_posts = new Loaded_Posts();
	}
	
	public function load(){
		$properties = $this->parser->get_properties();
		
		foreach($properties as $i => $property){
			//if($i>=55) break;
			$found_id = $this->loaded_posts->check_loaded($property->ref);
			if(!$found_id){
				$post_data = array(
					'post_title'    => $property->get_title(),
					'post_status'   => 'publish',
					'post_type'     => 'accommodation',
					'description'   => $property->descriptions['en'],
					'post_content'  => $property->descriptions['en'],
					'comment_status' => 'open',
					'meta_input'    => array(
						'accommodation_address' => $property->get_address(),
						'accommodation_latitude' => $property->point['latitude'],
						'accommodation_longitude' => $property->point['longitude'],
						'accommodation_sale_cost' => $property->price,
						'accommodation_square' => $property->area['built'],
						'accommodation_bedrooms' => $property->beds,
						'accommodation_bathrooms' => $property->baths,
						'accommodation_disabled_room_types' => '1',
						'accommodation_property_id' => $property->ref
					)
				);
				
				$property_post = new Add_Post($post_data, $property->images, $property->get_terms_array());
			}
			else{
				$update_post = new Update_Post($found_id, $property);
			}
			
			//break;
		}
	}
}
?>