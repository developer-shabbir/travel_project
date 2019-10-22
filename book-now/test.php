<!DOCTYPE html>
<html>
<head>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<title>
		test
	</title>
</head>
<body>
<form id="myform">
<div>
	<input type="text" name="txtname" id="txtname">
<input type="text" name="txtph" id="txtph">
<input type="button" name="btnSub" id="btnSub" value="Submit" class="cls-sub">

</div>

<div class="show">
	
</div>


</form>


</body>
<script type="text/javascript">
	$(document).on('click','.cls-sub',function(){
		alert('Ali');
   
   var url = "book_now_ajax.php";
   $.ajax({
     type: "POST",
     url: url,
     data: $("#myform").serialize(),
     success: function(data)
     {                  
        //$('.ajax_result').html(data);
         $('.show').html(data);
     }               
   });
  return false;
});

</script>
</html>