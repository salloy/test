<?php
include('classes/product-class.php');
$objproduct = new product();
$getunitquantity =	$objproduct->GetUnitquntity();
$getactivecurrency = $objproduct->GetActiveCurrency();
$unitquantity = $getunitquantity['quantity'];
$activecurrency = $getactivecurrency['name'];
$getproductdetail = $objproduct->GetProductDetail();
//$totalprice = 0;
?>

<table align="center" border="0px" cellspacing="1" cellpadding="8">
	<form method="post" action="">
	<tr>
      <td><input type="text" name="product_txt" id="product_txt"  placeholder = "Scan Items"/></td>
      <td><button type="submit" name="submit" onclick="return validateform();">Submit</button></td>
      <td><a href="addproduct.php">Add More Price</a></td>
    </tr>
    </form>
	<tr>
    	<td>Product Code</td>
        <td>Product Quantity</td>
        <td>Price</td>
     </tr>   
     <?php while($result = mysql_fetch_array($getproductdetail)){?>
     <tr>
     	<td><?php echo $result['pcode'];?></td>
        <td><?php echo $result['quantity'];?></td>
        <td><?php echo $result['price'].''.$activecurrency;?></td>
     </tr>
     <?php } ?>
</table>


<?php
	if(isset($_REQUEST['product_txt'])){
		$product_txt = $_REQUEST['product_txt'] ? $_REQUEST['product_txt'] : '';
		$str = $objproduct->sanitize_data($product_txt);
		$getcharcount = $objproduct->countchar($str);
		$totalprice = 0;
		foreach($getcharcount as $key=>$value)
		{
			if($value > 1){
				$chkvolumeprice = $objproduct->CheckVolumePrice($key);
				if($value >= $chkvolumeprice['quantity']){
					//$getvolumeprice = $objproduct->scan($key,$value);
					$totalprice = $totalprice + $chkvolumeprice['price'];
					$remainingitem = $value - $chkvolumeprice['quantity'];
				}
				if($remainingitem > 0){
					$getunitprice = $objproduct->scan($key,1);
					$totalprice = $remainingitem*$getunitprice['price'] + $totalprice;
				}
			}
			else{
				//echo $key;
				$getunitprice = $objproduct->scan($key,'1');
				$totalprice = $value*$getunitprice['price'] + $totalprice;
			}
			
			
		}
	}
	if(isset($totalprice)){		
	 	echo 'Total Price is '. $totalprice.''.$activecurrency;
	}	
	
?>
<script type="text/javascript">
	function validateform(){
		var product_txt = document.getElementById('product_txt');
		if(product_txt == '')
		{
			alert('please enter scan code');
			return false;
		}	
	}


</script>