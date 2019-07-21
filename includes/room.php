<?php
	require_once(LIB_PATH.DS.'database.php');
	class Room{
		
		protected static $tbl_name = "room";
		function db_fields(){
			global $mydb;
			return $mydb->getFieldsOnOneTable(self::$tbl_name);
		}
		
		function listOfroom(){
			global $mydb;
			$mydb->setQuery("select * from ".self::$tbl_name);
			$cur = $mydb->loadResultList();
			return $cur;
		
		}
		
		function single_room($id=0){
				global $mydb;
				$mydb->setQuery("select * from ".self::$tbl_name." where `roomNo`= {$id} limit 1");
				$cur = $mydb->loadSingleResult();
				return $cur;
		}
		
		function find_all_room($name=""){
				global $mydb;
				$mydb->setQuery("select * from  ".self::$tbl_name." where `typename` ='{$name}'");
				$cur = $mydb->executeQuery();
				$row_count = $mydb->num_rows($cur);
				return $row_count;
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
		
		public function save() {
			return isset($this->id) ? $this->update() : $this->create();
		}
		
		public function create() {
			global $mydb;
			
			$attributes = $this->sanitized_attributes();
			$sql = "insert into ".self::$tbl_name." (";
			$sql .= join(", ", array_keys($attributes));
			$sql .= ") values ('";
			$sql .= join("', '", array_values($attributes));
			$sql .= "')";
			echo $mydb->setQuery($sql);
		
			if($mydb->executeQuery()) {
				$this->id = $mydb->insert_id();
				return true;
			} else {
				return false;
			}
		}

		public function update($id=0) {
			global $mydb;
			$attributes = $this->sanitized_attributes();
			$attribute_pairs = array();
			foreach($attributes as $key => $value) {
				$attribute_pairs[] = "{$key}='{$value}'";
			}
			
			$sql = "update ".self::$tbl_name." set ";
			$sql .= join(", ", $attribute_pairs);
			$sql .= " where roomNo=". $id;
			$mydb->setQuery($sql);
			
			if(!$mydb->executeQuery()){
				return false;
			}  	

		}

		public function delete($id=0) {
			global $mydb;
			$sql = "delete from ".self::$tbl_name;
			$sql .= " where roomNo=". $id;
			$sql .= " limit 1 ";
			$mydb->setQuery($sql);

			if(!$mydb->executeQuery()) {
				return false;
			}
		}			
	}
?>