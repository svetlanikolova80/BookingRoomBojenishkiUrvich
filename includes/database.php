<?php

	require_once(LIB_PATH.DS."config.php");

	class Database {
		var $sql_string = '';
		var $error_no = 0;
		var $error_msg = '';
		private $conn;
		public $last_query;
		private $magic_quotes_active;
		private $real_escape_string_exists;
		
		function __construct() {
			$this->open_connection();
			$this->magic_quotes_active = get_magic_quotes_gpc();
			$this->real_escape_string_exists = function_exists("mysql_real_escape_string");
		}
		
		public function open_connection() {
			$this->conn = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
			if(!$this->conn){
				echo "Проблем с връзката с базата данни";
				exit();
			} else {
				$db_select = mysql_select_db(DB_NAME,$this->conn);
				if (!$db_select) {
					echo "Проблем с конкретната база данни";
					exit();
				}
			}

		}
		
		function setQuery($sql='') {
			$this->sql_string=$sql;
		}
		
		function executeQuery() {
			$result = mysql_query($this->sql_string, $this->conn);
			$this->confirm_query($result);
			return $result;
		}	
		
		private function confirm_query($result) {
			if(!$result){
				$this->error_no = mysql_errno( $this->conn );
				$this->error_msg = mysql_error( $this->conn );
				return false;				
			}
			return $result;
		} 
		
		function loadResultList( $key='' ) {
			$cur = $this->executeQuery();
			
			$array = array();
			while ($row = mysql_fetch_object( $cur )) {
				if ($key) {
					$array[$row->$key] = $row;
				} else {
					$array[] = $row;
				}
			}
			mysql_free_result( $cur );
			return $array;
		}
		
		function loadSingleResult() {
			$cur = $this->executeQuery();
				
			while ($row = mysql_fetch_object( $cur )) {
			return $data = $row;
			}
			mysql_free_result( $cur );			
		}
		
		function getFieldsOnOneTable( $tbl_name ) {
		
			$this->setQuery("DESC ".$tbl_name);
			$rows = $this->loadResultList();
			
			$fieldsArray = array();
			for ( $x = 0; $x < count( $rows ); $x++ ) {
				$fieldsArray[] = $rows[$x]->Field;
			}
			
			return $fieldsArray;
		}	

		public function fetch_array($result) {
			return mysql_fetch_array($result);
		}
		
		public function num_rows($result_set) {
			return mysql_num_rows($result_set);
		}
	  
		public function insert_id() {
			return mysql_insert_id($this->conn);
		}
	  
		public function affected_rows() {
			return mysql_affected_rows($this->conn);
		}
		
		 public function escape_value( $value ) {
			if( $this->real_escape_string_exists ) { 
				if( $this->magic_quotes_active ) {
					$value = stripslashes( $value ); 
				}
				$value = mysql_real_escape_string( $value );
			} else {
				if( !$this->magic_quotes_active ) { 
					$value = addslashes( $value ); 
				}
			}
			return $value;
		}
		
		public function close_connection() {
			if(isset($this->conn)) {
				mysql_close($this->conn);
				unset($this->conn);
			}
		}
	} 
	
	$mydb = new Database();

?>
