<?php
error_reporting('1');
include('../classes/product-class.php');
$objproduct = new product();
$product_code = $objproduct->sanitize_data($_POST['product_code']);
$product_quantity = $objproduct->sanitize_data($_POST['product_quantity']);
$objproduct->GetUnitquntity();	
$product_price = $objproduct->sanitize_data($_POST['product_price']);
$objproduct->tableName								=			"product";
$objproduct->fieldValues['pcode']					=			$product_code ? $product_code : '';
$objproduct->fieldValues['quantity']				=			$product_quantity ? $product_quantity : '';
$objproduct->fieldValues['price']					=			$product_price ? $product_price : '0';
$objproduct->fieldValues['currencyID']				=			1;
$objproduct->fieldValues['status']					=			1;
$insertdata 									=			$objproduct->insert();
$inserid=$objproduct -> LastInsertID();	
if($inserid) {
	header('location:../addproduct.php');
}
else{
	header('location:../addproduct.php?msg=error');

}
?>