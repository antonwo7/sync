<?php
Class Parser{
	public $property_count;
	public $xml_url;
	private $properties = array();
	
	function add_property($property){
		$this->properties[] = $property;
	}
	
	function get_properties(){
		return $this->properties;
	}
	
	function get_xml_content(){
		return file_get_html($this->xml_url);
	}
	
	function set_properties(){
		$xml_html = $this->get_xml_content();
		
		if($xml_html !== false){
			foreach($xml_html->find("property") as $xml_prop){
				$property = new Property();
				$property->ref = XML_Item::get($xml_prop, 'ref');
				$property->price = XML_Item::get($xml_prop, 'price');
				$property->pool = XML_Item::get($xml_prop, 'pool');
				$property->set_tag(XML_Item::get($xml_prop, 'price_freq'));
				$property->set_is_new(XML_Item::get($xml_prop, 'new_build'));
				$property->set_type(XML_Item::get($xml_prop, 'type'));
				$property->town = XML_Item::get($xml_prop, 'town');
				$property->province = XML_Item::get($xml_prop, 'province');
				$property->beds = XML_Item::get($xml_prop, 'beds');
				$property->baths = XML_Item::get($xml_prop, 'baths');
				$property->set_point(XML_Item::get_array($xml_prop, 'location'));
				$property->set_area(XML_Item::get_array($xml_prop, 'surface_area'));
				$property->set_urls(XML_Item::get_array($xml_prop, 'url'));
				$property->set_descriptions(XML_Item::get_array($xml_prop, 'desc'));
				$property->set_features(XML_Item::get_array($xml_prop, 'features', 'feature'));
				$property->set_images(XML_Item::get_array($xml_prop, 'images', 'url'));
				
				$this->add_property($property);
			}
			
		}
		else{
			echo "Ошибка чтения файла XML";
		}
	}
	
	function __construct(){
		$this->xml_url = Config::get_xml();
		$this->set_properties();
		
	}
} 
?>