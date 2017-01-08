<?php 
/*****************
    * Data Base Class File
    * @category   Class File
    * @version    $Id: datasbase-class.php V1.0 $
    * @author     Shobhit Srivastav(shobhit833@gmail.com).
    * Create Date 08-01-2017
    * Update Date 08-01-2017
*****/
include_once("config-class.php");
ini_set('display_erros',1);
class database extends config
{
		public 	$tableName				=	"";	
		public 	$fieldValues			=	array();	// normal values
		public 	$fieldValuesNotQuotes	=	array();	// values that do not require quotes around them
		public 	$fieldValuesSpecial		=	array();	// values that require addslashes or striptags
		
		public	$selectFields			=	"";
		public 	$query 					= 	"";
		public 	$condition				=	"";
		public 	$limit					=	"";
		
		function __construct(){
			$conn = mysql_connect("localhost","root","") or die(mysql_error());
			mysql_select_db("pos")  or die('You have to import pos db in mysql from database folder first');
		}

		
		/*
		insert() is used to insert data from database
		@param : freeFlag(Free/notFree) : it is used to print query based on i/p
		@returnparam : STRING
	   */
		
		
		function insert($freeFlag='')
		{
		$arrStr =	$this->createStringInsertUpdate("Insert");
		
		$this->query = "insert into ".$this->tableName." ".$arrStr['fields']." values ".$arrStr['values'];
			echo $this->query;
			$q	= mysql_query($this->query);
			
			
			if($freeFlag != "notFree")
				$this -> setObjectValuesFree();
				
			return $q;
		}

		/*
		update() is used to update data from database
		@param : freeFlag(Free/notFree) : it is used to print query based on i/p
		@returnparam : STRING
	   */
		
		function update($freeFlag='')
		{
			$str 	= "";
			
			$str =	$this -> createStringInsertUpdate("Update");	
			
			$this -> query = "update ".$this->tableName." "." set ".$str." where ".$this->condition;
			
			$result_up 	= mysql_query($this -> query);
			
			if($result_up)
			{
				$arr['Result'] 			= true;
				$arr['RowsAffected']	= mysql_affected_rows();
			}	
		else
			{
				$arr['Result'] = $this -> query."<br>".mysql_error();
			}	
			
			if($freeFlag != "notFree")
				$this -> setObjectValuesFree();
			
			return $arr;
		}

		/*
		delete() is used to delete data from database
		@param : freeFlag(Free/notFree) : it is used to print query based on i/p
		@returnparam : STRING
	   */
	function delete($freeFlag='')
	{
		$str 	=	"delete from " . $this->tableName . " where " . $this->condition;
		if($this -> limit != "")
			$str = $str." limit ".$this->limit;	
		
		$result		=	mysql_query($str);
		
		if($freeFlag != "notFree")
			$this -> setObjectValuesFree();
				
		
		return $result;
	}
	
	/*
		delete_all() is used to delete all the data from database
		@param : freeFlag(Free/notFree) : it is used to print query based on i/p
		@returnparam : STRING
	   */

	function delete_all($freeFlag='')
	{
		$str="delete from ".$this->tableName;
		$result = mysql_query($str);
		if($freeFlag != "notFree")
			$this -> setObjectValuesFree();
		return $result;
	}
	/*
		select() is used to select data from database
		@param : freeFlag(Free/notFree) : it is used to print query based on i/p
		@returnparam : STRING
	*/
	function select($freeFlag='')
	{
	
	 	$str = "select *  from ".$this->tableName;
		
		if($this -> selectFields != "")
	 	$str	=	"select ".$this->selectFields." from ".$this->tableName;
		if($this -> condition != "")
			$str = $str." where ".$this -> condition;
		if($this -> limit != "")
			$str = $str."  limit ".$this -> limit;	
		 $this-> query = $str;
		 
		$query = mysql_query($str);
		if($freeFlag != "notFree")
			$this -> setObjectValuesFree();
		 return $query;
	}
	
	/*
		setObjectValuesFree() is used to free/blank all the variables
		@param : NO
		@returnparam : NO
	*/
	
	function setObjectValuesFree()
	{
		$this -> tableName		=	"";	
		$this -> fieldValues			=	array();	// normal values
		$this -> fieldValuesNotQuotes	=	array();	// values that do not require quotes around them
		$this -> fieldValuesSpecial		=	array();	// values that require addslashes or striptags
		$this -> selectFields	=	"";
		$this -> query 			= 	"";
		$this -> condition		=	"";
	}

		
	/*
		createStringInsertUpdate() is used to to create insert/update query based on operation type
		@param : STRING(Insert/Update)
		@returnparam : NO
	*/	
	
	
	function createStringInsertUpdate($operationType)
		{
			$strFields = "(";
			$strValues = "("; 
			$i = 0; 				
				
			if(count($this->fieldValues) > 0)
			{
				foreach($this->fieldValues as $key => $val)
				{
					if($i >= 1)
						$addComma	=	",";
					else
						$addComma	=	"";	
					
					if($operationType == "Insert")
					{
						$strFields .= $addComma."`".$key."`";
						$strValues .= $addComma."'".$val."'";
					}
					else	// update
					{
						$str .= $addComma.$key." = '".$val."'";
					}
									
					$i++;
				}  // end foreach 
			}
		
			
			// Wtihout quotes
			
			if(count($this->fieldValuesNotQuotes)>0)
			{
			
			foreach($this->fieldValuesNotQuotes as $key => $val)
				{
					if($i >= 1)
						$addComma	=	",";
					else
						$addComma	=	"";	
						
					
					if($operationType == "Insert")
					{
						$strFields .= $addComma."`".$key."`";
						$strValues .= $addComma.$val;
					}
					else
					{
						$str .= $addComma.$key." = ".$val;
					}	
					
				$i++;
				}  	
			 }	
			 
			 
			 // Special
			
			if(count($this->fieldValuesSpecial)>0)
			{
			foreach($this->fieldValuesSpecial as $key => $val)
				{
					if($i >= 1)
						$addComma	=	",";
					else
						$addComma	=	"";	
					
					if($operationType == "Insert")
					{
						$strFields .= $addComma."`".$key."`";
						$strValues .= $addComma."'".$this -> postDataConvert($val)."'";
					}
					else
					{
						$str .= $addComma."`".$key."` = '".$this -> postDataConvert($val)."'";
					}
						
				$i++;
				}  	
			 }	
		
		if($operationType == "Insert")
			{
					$strFields = $strFields.")";
					$strValues = $strValues.")";
					
					$arrStr['fields']	=	$strFields;
					$arrStr['values']	=	$strValues;
					
					return $arrStr;	
			}
		else
			{
					return $str;
			}	
		
		}
	/*
		lastInsertID() is used to find last insert id of the product
		@param : NO
		@returnparam : NO
	*/	
	function lastInsertID()
	{
		global $conn;
		return mysql_insert_id();
	}
	
	
	/*
		closeConnection() is used to close connection of database
		@param : $conn (connection handler)
		@returnparam : NO
	*/		
			
	function closeConnection($conn) // close conection
	{
		mysql_close($conn);
	} 
	/*
		GetActiveCurrency to find active currency id from master table
		@param : NO
		@returnparam : STRING
	*/
	
	function GetActiveCurrency(){
	
	}
	
}
?>