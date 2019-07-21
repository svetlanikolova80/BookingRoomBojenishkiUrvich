<?php
	require_once(LIB_PATH.DS.'database.php');
	class Pagination {
		
		protected static $tbl_name = "subject";
		public $current_page;
		public $per_page;
		public $total_count;
		
		public function __construct($page = 1, $per_page = 20, $total_count=0){
			$this->current_page = (int)$page;
			$this->per_page = (int)$per_page;
			$this->total_count = (int)$total_count;
		}
		
		function count_allrecords(){
			global $mydb;
			$mydb->setQuery("select * from ".self::$tbl_name);
			$retval= $mydb->executeQuery();
			$total_count= $mydb->num_rows($retval);
			return $total_count;
		}
		
		public function offset(){
			return ($this->current_page - 1) * $this->per_page;
		}
		
		public function total_pages(){
			return ceil($this->total_count/$this->per_page);
		}
		
		public function previous_page(){
			return  $this->current_page - 1;
		}
		public function next_page(){
			return  $this->current_page + 1;			
		}
		public function First_page(){
			return $this->current_page = 0;
		}
		public function last_page(){
			return $this->total_pages();
		}
		
		public function goto_first_page(){
			return $this->current_page >= 1 ? true : false;
		}
		
		public function goto_last_page(){
			return $this->current_page < $this->total_pages() ? true : false;
		}
		public function has_previous_page(){
			return $this->previous_page() >= 1 ? true : false;
		}
		
		public function has_next_page(){
			return  $this->next_page() <= $this->total_pages() ? true : false;
		}	
		
		function db_fields(){
			global $mydb;
			return $mydb->getFieldsOnOneTable(self::$tbl_name);
		}

		static function instantiate($record) {
			$object = new self;

			foreach($record as $attribute=>$value){
				if($object->has_attribute($attribute)) {
					$object->$attribute = $value;
				}
			} 
			return $object;
		}
		
		private function has_attribute($attribute) {
			return array_key_exists($attribute, $this->attributes());
		}

		protected function attributes() { 
			global $mydb;
			$attributes = array();
			foreach($this->db_fields() as $field) {
				if(property_exists($this, $field)) {
					$attributes[$field] = $this->$field;
				}
			}
			return $attributes;
		}
		
		protected function sanitized_attributes() {
			global $mydb;
			$clean_attributes = array();
			foreach($this->attributes() as $key => $value){
				$clean_attributes[$key] = $mydb->escape_value($value);
			}
			return $clean_attributes;
		}
	}
?>