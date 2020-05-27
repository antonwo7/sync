<?php
Class XML_Item{
	public static function get_nocdata($innertext){
		return (string) simplexml_load_string("<x>$innertext</x>");
	}
	public static function get($xml_item, $field){
		if($xml_item->find($field, 0))
			return trim($xml_item->find($field, 0)->innertext);
		return Config::get_default($field);
	}

	public static function get_array($xml_item, $field, $subfield = false){
		$xml_field_items = array();
		$xml_field = $xml_item->find($field, 0);

		$filter = ((!$subfield) ? "*" : $subfield);
		$tag = ((!$subfield) ? "" : $subfield);
		
		if($xml_field !== null){
			foreach($xml_field->find($filter) as $i => $element){
				$xml_field_items[((!$subfield) ? $element->tag : $i)] = self::get_nocdata($element->innertext);
			}
		}
		return $xml_field_items;
	}
}
?>