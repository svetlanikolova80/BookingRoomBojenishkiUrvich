<?php

	require_once(LIB_PATH.DS.'database.php');
	class User{
		
		protected static $tbl_name = "useraccounts";
		
		function db_fields(){
			global $mydb;
			return $mydb->getFieldsOnOneTable(self::$tbl_name);
		}
		
		function listOfmembers(){
			global $mydb;
			$mydb->setQuery("select * from ".self::$tbl_name);
			$cur = $mydb->loadResultList();
			return $cur;		
		}
		
		function single_user($id=0){
				global $mydb;
				$mydb->setQuery("select * from ".self::$tbl_name." where `ACCOUNT_ID`= {$id} limit 1");
				$cur = $mydb->loadSingleResult();
				return $cur;
		}
		
		function find_all_user($name=""){
				global $mydb;
				$mydb->setQuery("select * from  ".self::$tbl_name." where  `ACCOUNT_NAME` ='{$name}'");
				$cur = $mydb->executeQuery();
				$row_count = $mydb->num_rows($cur);
				return $row_count;
		}

		static function AuthenticateUser($email="", $h_upass=""){
			global $mydb;
			$mydb->setQuery("select * from `useraccounts` where `ACCOUNT_USERNAME`='" . $email . "' and `ACCOUNT_PASSWORD`='" . $h_upass ."' limit 1");
			$cur = $mydb->executeQuery();
			$row_count = $mydb->num_rows($cur);
			if ($row_count == 1){
				$found_user = $mydb->loadSingleResult();
				$_SESSION['admin_ID'] 	 = $found_user->ACCOUNT_ID;
				$_SESSION['admin_ACCOUNT_NAME']    = $found_user->ACCOUNT_NAME;
				$_SESSION['admin_ACCOUNT_USERNAME']= $found_user->ACCOUNT_USERNAME;
				$_SESSION['admin_ACCOUNT_PASSWORD']= $found_user->ACCOUNT_PASSWORD;
				$_SESSION['admin_ACCOUNT_TYPE']    = $found_user->ACCOUNT_TYPE;
				return true;
			} else {
				return false;
			}	
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
			$sql .= ") value ('";
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
			$sql .= " where ACCOUNT_ID=". $id;
			$mydb->setQuery($sql);
			if(!$mydb->executeQuery()){
				return false;
			} 	

		}

		public function delete($id=0) {
			global $mydb;
			$sql = "delete from ".self::$tbl_name;
			$sql .= " where ACCOUNT_ID=". $id;
			$sql .= " limit 1 ";
			$mydb->setQuery($sql);

			if(!$mydb->executeQuery()) {
				return false;
			}
		}			
	}
?>