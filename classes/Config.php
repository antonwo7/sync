<?php
Class Config{
	private static $xml_url = 'https://probaseinternational.com/kyero/todos';
	
	private static $defaults = array(
		'Type' => 'Apartment',
		'Town' => 'Alicante'
	);
	
	private static $tags = array(
		'sale' => 'sale',
		'rent' => 'rent'
	);
	
	private static $types = array(
		'Duplex' => 'apartment',
		'Bungalow Top Floor' => 'bungalow',
		'Bungalow' => 'bungalow',
		'Bungalow Ground Floor' => 'bungalow',
		'Villa' => 'villa',
		'Semi-detached villa' => 'villa',
		'Apartment' => 'apartment',
		'Penthouse' => 'apartment',
		'Country House' => 'country-house',
		'Detached House' => 'townhouse',
		'Apartment Ground Floor' => 'apartment',
		'Apartment Top Floor' => 'apartment',
		'Parking' => 'commercial',
		'Townhouse' => 'townhouse'
	);
	
	public static function get_default($field){
		if(isset(self::$default[$field]))
			return self::$default[$field];
		return "";
	}
	
	public static function get_xml(){
		return self::$xml_url;
	}
	
	public static function get_tag($xml_tag){
		if(isset(self::$tags[$xml_tag]))
			return self::$tags[$xml_tag];
		return "";
		return self::$tags;
	}
	
	public static function get_type($xml_type){
		if(isset(self::$types[$xml_type]))
			return self::$types[$xml_type];
		return "";
	}
}
?>