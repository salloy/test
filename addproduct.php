<h1>Add Products in to store</h1>
<table>
<form method="post" action="action/addaction.php">
  <tr>
  	<td>	
  		<input type="text" name="product_code" id="product_code" placeholder = "Product Code" />
    </td>
  </tr>
  <tr>
  	<td>      
 		<input type="text" name="product_quantity" id="product_quantity" placeholder = "Product Quantity" />
    </td>
  </tr>
  <tr>
  	<td>       
 	 <input type="text" name="product_price" id="product_price" placeholder = "Product Price" />
    </td>
  </tr>
  <tr>
  	<td>    
  	   <button type="submit" name="submit">Submit</button>
       <input type="button" name="Back" value="Back" onclick="GoBack();">
    </td>
  </tr>     
</form>
</table>
<script type="text/javascript">
	function GoBack(){
		window.history.back();
	}


</script>
