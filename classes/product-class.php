<?php 
/*****************
    * Product Class File
    * @category   Product File
    * @version    $Id: product-class.php V1.0 $
    * @author     Shobhit Srivastav(shobhit833@gmail.com).
    * Create Date 08-01-2017
    * Update Date 08-01-2017
*****/

include_once("database-class.php");
class product extends database // class for admin login validation 
{
	/*
		sanitize_data() is used to validate input fields
		@param : STRING ($input date)
		@returnparam : STRING
	*/
	public function sanitize_data($input_data) 
	{
			$searchArr=array("document","write","alert","%","$",";","+","|","#","<",">",")","(","'","\'",",","<img","src=",".ini","<iframe","java:","window.open","http","!",":boot",".com",".exe",".php",".js",".txt","@",".css");	
			$input_data	= 	str_replace("script","",$input_data);
			$input_data	= 	str_replace("iframe","",$input_data);
			$input_data	= 	str_replace($searchArr,"",$input_data);
			$input_data	=	trim($input_data);
			$input_data	= 	strip_tags($input_data);
			return htmlentities(stripslashes($input_data), ENT_QUOTES);
	}
	/*
		GetUnitquntity() is used get unit quantity
		@param : NONE
		@returnparam : Array
	*/
	public function GetUnitquntity(){
			$this -> tableName 			= 	"product_matser";
			$this -> selectFields		=	"quantity";
			$this -> limit				=	"";
			$res 						= 	$this -> select();
			return	mysql_fetch_array($res);
	
	}
	/*
		GetActiveCurrency() is used get active currency
		@param : NONE
		@returnparam : STRING
	*/
	public function GetActiveCurrency(){
			$this -> tableName 			= 	"currency_master";
			$this -> selectFields		=	"name";
			$this -> limit				=	"";
			$this -> condition			=	"status = '1'";
			$res 						= 	$this -> select();
			return	mysql_fetch_array($res);
	
	}
	/*
		countchar() is used count unique char in string
		@param : STRING
		@returnparam : ARRAY
	*/
	function countchar($str){
		$iscount = array();
		$strcount = array();
		for($i=0;$i<strlen($str);$i++)
		{
			if(!in_array($str[$i],$iscount)){
				$char = $str[$i];
				$strcount[$char] = substr_count($str,$str[$i]);

			}
		
		}
		return $strcount;
	}
	/*
		scan() is used find cost
		@param : STRING(pcode,price)
		@returnparam : ARRAY
	*/
	public function scan($pname,$pquantity){
		$this -> tableName 			= 	"product";
		$this -> selectFields		=	"quantity,price";
		$this -> condition			=	"pcode = '".$pname."' AND quantity = '".$pquantity."'";
		$res 						= 	$this -> select();
		return	mysql_fetch_array($res);
	}
	/*
		CheckVolumePrice() is used find voulme price
		@param : STRING(pcode)
		@returnparam : ARRAY
	*/
	public function CheckVolumePrice($pname){
		$this -> tableName 			= 	"product";
		$this -> selectFields		=	"quantity,price";
		$this -> condition			=	"pcode = '".$pname."' AND quantity != '1'";
		$res 						= 	$this -> select();
		return	mysql_fetch_array($res);
	}
	/*
		GetProductDetail() is used get all the product details
		@param : NONE
		@returnparam : ARRAY
	*/
	public function GetProductDetail(){
		$this -> tableName 			= 	"product";
		$this -> selectFields		=	"";
		$this -> condition			=	"";
		$res 						= 	$this -> select();
		return $res;
	}
}	
?>