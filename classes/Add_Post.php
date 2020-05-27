<?php 
require_once '../wp-admin/includes/media.php';
require_once '../wp-admin/includes/file.php';
require_once '../wp-admin/includes/image.php';

Class Add_Post{
	public $post;
	
	function __construct($post_data, $images, $terms){
		wp_update_post( wp_slash($post_data) );
		$post_id = wp_insert_post($post_data);
		$this->post = get_post($post_id);
		
		$this->set_images($images);
		$this->set_terms($terms);
	}
	
	private static function create_image($image, $post_id){
		global $wpdb;
	 
		$img_id = media_sideload_image( trim($image), $post_id, null, 'id' );
		
		if( is_wp_error($img_id) ){ 
			return false;
		}
		else {
			return $img_id;
		}
	}
	
	private static function get_images_array($images_array){
		$converted_images_array = [];
		foreach($images_array as $image){
			$converted_images_array[] = ['image' => (string)$image];
		}
		return $converted_images_array;
	}
	
	public function set_images($images){
		$images_ids = array();
		
		foreach($images as $image){
			if(strlen($image) > 5){
				$id_img = self::create_image($image, $this->post->ID);
				if($id_img != false){
					$images_ids[] = $id_img;
				}
			}
		}
		update_post_meta( $this->post->ID, '_thumbnail_id', $images_ids[0] );
		update_post_meta( $this->post->ID, 'accommodation_images', self::get_images_array($images_ids) );
	} 
	
	public function set_terms($args){
		foreach($args as $term_type => $term_content){
			$terms = [];
			
			foreach($term_content['list'] as $term_item ){
				$term = get_term_by( $term_content['by'], $term_item, $term_type );
				if($term === false){
					$term = wp_insert_term( $term_item, $term_type, array(
						'description' => '',
						'slug'        => '',
					) );
				}
				
				$terms[] = $term->term_id;
			}
			
			wp_set_post_terms( $this->post->ID, $terms, $term_type );
		}
		
	}
}
?>