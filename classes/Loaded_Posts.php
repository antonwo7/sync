<?php 
Class Loaded_Posts{
	private $loaded_posts = [];
	
	function __construct(){
		$args = array( 'post_type' => 'accommodation', 'posts_per_page' => -1 );
		$posts = get_posts( $args );
		
		foreach($posts as $post){
			$post_id = $post->ID;
			$post_ref = get_post_meta( $post->ID, 'accommodation_property_id', true );
			$this->loaded_posts[$post_id] = $post_ref;
		}
	}
	public function check_loaded($ref){
		$key = array_search($ref, $this->loaded_posts);
		if($key !== false)
			return $key;
		return false;
	}
	
	public function get_loaded_posts(){
		return $this->loaded_posts;
	}
	
	
}

?>