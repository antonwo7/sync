<?php 
require_once '../wp-admin/includes/media.php';
require_once '../wp-admin/includes/file.php';
require_once '../wp-admin/includes/image.php';

Class Update_Post{
	private $found_id;
	private $property;
	
	function __construct($found_id, $property){
		$this->property = $property;
		$this->found_id = $found_id;
		$this->check_property();
	}
	
	private function check_property(){
		if($this->found_id !== false){
			$this->check_description();
			$this->check_price();
		}
	}
	
	private function check_description(){
		$post_args = array(
		  'ID'           => $this->found_id,
		  'post_content' => $this->property->descriptions['en']
		);
		wp_update_post( $post_args );	
	}
	
	private function check_price(){
		update_post_meta( $this->found_id, 'accommodation_sale_cost', $this->property->price );		
	}

}
?>