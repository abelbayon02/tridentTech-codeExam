<?php 
/*
	-------------------------------
	|THIS CLASS IF FOR GLOBAL DATA|
	-------------------------------
*/
class CoreFunctions{
	public function __construct($host = 'localhost', $name = 'root', $password='', $dbname='trident')
	{
		$this->connection = new mysqli($host, $name, $password, $dbname);
		if($this->connection->connect_error){
			$this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
		}
	}
	public function SELECT_QUERY($type, $table, $params='')
	{
		$inject = ($params == '')?"":" WHERE $params";

		$select_query = $this->connection -> query("SELECT $type FROM $table $inject")or die(mysql_error());
		$fetch = $select_query -> fetch_array();
		return $fetch;
	}
	public function INSERT_QUERY($table,$data)
	{	
		
	    $fields = array_keys($data);

	    $sql = "INSERT INTO ".$table."
	    (`".implode('`,`', $fields)."`)
	    VALUES('".implode("','", $data)."')";

	    $return_insert = $this->connection -> query($sql);
	    
        if($return_insert){
            $val = 1;
        }else{
            $val = 0;
        }
	    
	    return $val;

	}
	public function SELECT_LOOP_QUERY($type , $table , $params = ''){
		$data = array();
	    $inject = ($params=='')?"":"WHERE $params";

	    $select_query = $this->connection -> query("SELECT $type FROM $table $inject");
	    while ($row = $select_query -> fetch_array()){
	        $data[] = $row;
	    }
	    return $data;
	}

	public function DELETE_QUERY($table_name, $where_clause=''){
	    $whereSQL = '';
	    if(!empty($where_clause)){
	        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
	            $whereSQL = " WHERE ".$where_clause;
	        }else{
	            $whereSQL = " ".trim($where_clause);
	        }
	    }
	    $sql = "DELETE FROM ".$table_name.$whereSQL;
	    
	    $return_delete = $this->connection -> query($sql);
	    
	    if($return_delete){
	    	$val = 1;
	    }else{
	    	$val = 0;
	    }

	    return $val;
	}
	public function UPDATE_QUERY($table_name, $form_data, $where_clause=''){
	    $whereSQL = '';
	    if(!empty($where_clause)){
	        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
	            $whereSQL = " WHERE ".$where_clause;
	        }else{
	            $whereSQL = " ".trim($where_clause);
	        }
	    }
	    $sql = "UPDATE ".$table_name." SET ";
	    $sets = array();
	    foreach($form_data as $column => $value)
	    {
	         $sets[] = "`".$column."` = '".$value."'";
	    }
	    $sql .= implode(', ', $sets);
	    $sql .= $whereSQL;

	    $return_query = $this->connection -> query($sql);
	    if($return_query){
	    	$val = 1;
	    }else{
	    	$val = 0;
	    }

	    return $val;
	}
	public function GETCURRENTDATE(){
		ini_set('date.timezone','UTC');
		date_default_timezone_set('UTC');
		$today = date('H:i:s');
		$date = date('Y-m-d H:i:s', strtotime($today)+28800);
		
		return $date;
	}
	public function PRODUCT_CATEGORY_LIST()
	{
		$data = array();
		$sql = $this->SELECT_LOOP_QUERY("*","product_category","");
		$count = 1;
		if(is_array($sql)){
			foreach($sql as $row){
				$data[] = array(
					"count" => $count++,
					"name" => "<input type='text' class='form-control' id='catName".$row['category_id']."' value='".$row['category_name']."'>",
					"description" => "<input type='text' rows='3' id='catDesc".$row['category_id']."' class='form-control' value='".$row['category_desc']."'>",
					"action" => "<button class='btn btn-info btn-sm' id='updateBtn".$row['category_id']."' onclick='updateCategory(".$row['category_id'].")'><span class='fa fa-pencil'></span></button><button class='btn btn-danger btn-sm' id='deleteBtn".$row['category_id']."' onclick='deleteCategory(".$row['category_id'].")'><span class='fa fa-trash' ></span></button>"
				);
			}
		}

		return $data;
	}
	public function PRODUCT_CATEGORY()
	{
		$option = "<option value=''>&mdash; Please Choose &mdash;</option>";
		$sql = $this->SELECT_LOOP_QUERY("*","product_category","");
		if(is_array($sql)){
			foreach($sql as $row){
				$option .= "<option value='".$row['category_id']."'>".$row['category_name']."</option>";
			}
		}

		return $option;
	}
	public function PRODUCT_CATEGORY_SELECTED($category_id)
	{
		$option = "<option value=''>&mdash; Please Choose &mdash;</option>";
		$sql = $this->SELECT_LOOP_QUERY("*","product_category","");
		if(is_array($sql)){
			foreach($sql as $row){
				$selected = ($row['category_id'] == $category_id)?"selected":"";
				$option .= "<option ".$selected." value='".$row['category_id']."'>".$row['category_name']."</option>";
			}
		}

		return $option;
	}
	public function PRODUCT_LIST()
	{
		$data = array();
		$sql = $this->SELECT_LOOP_QUERY("*","products ORDER BY date_added DESC","");
		$count = 1;
		if(is_array($sql)){
			foreach($sql as $row){
				$data[] = array(
					"count" => $count++,
					"name" => "<input type='text' class='form-control' id='prodName".$row['product_id']."' value='".$row['product_name']."'>",
					"category" => "<select class='form-control' id='categID".$row['product_id']."'>".$this->PRODUCT_CATEGORY_SELECTED($row['product_category'])."</select>",
					"price" => "<input type='text' class='form-control' id='prodPrice".$row['product_id']."' value='".$row['price']."'>",
					"date_added" => date("F d, Y H:iA", strtotime($row['date_added'])),
					"action" => "<button class='btn btn-info btn-sm' id='updateBtn".$row['product_id']."' onclick='updateproduct(".$row['product_id'].")'><span class='fa fa-pencil'></span></button><button class='btn btn-danger btn-sm' id='deleteBtn".$row['product_id']."' onclick='deleteproduct(".$row['product_id'].")'><span class='fa fa-trash' ></span></button>"
				);
			}
		}

		return $data;
	}
	
}