<?php
//Initialize the session
session_start();


//Check if the user is logged in, if not then redirect him to login page 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

	if($_SESSION["user_type"] == 'admin'){
		header("location: admin.php");
		 exit;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<!--Script-->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
	<!--CSS--> 
	<link rel="stylesheet" href="resources/css/fyp.css">
	<link rel="stylesheet" href="resources/css/modal.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="import" href="resources/css/navigation.html">


</head>
<body>

<script>
/*var link = document.querySelector('link[rel="import"]');
	var nav = link.import.querySelector('nav');
	document.body.appendChild(nav.cloneNode(true));*/

$(function(){
  $("#nav-placeholder").load("resources/css/navigation.html");
});

	

	function checkIN(){
		$('.modal').modal('show');
		$.ajax({
				url: "http://localhost/fyp/ajax/ajax.php",
				type: "POST",
				data:{'ajaxcall':'scan'},
				success:function(data) {
					$.ajax({
						url: "http://localhost/fyp/ajax/ajax.php",
						type: "POST",
						data:{'ajaxcall':'showdata'},
						success:function(showdata) {
								var max = showdata.length - 1;
								var sex = showdata[max].sex;
								//alert(sex);
								$("#id_type").val(showdata[max].id_type);
								$("#name").val(showdata[max].fname);
								$("#address").val(showdata[max].address);
								$("#id").val(showdata[max].ic_no);
								$("#time").val(showdata[max].check_in_time);

								if (sex == "Male")
								{
								$("#male").prop("checked", true);
								}else{
								$("#female").prop("checked", true);
								}


						},
							error: function(xhr, ajaxOptions, thrownError){
								alert("Error");
							}
					});
			   },
			   complete:function(){
				$('.modal').modal('hide');
				},
			   error: function(xhr, ajaxOptions, thrownError){
				alert("Error");
			   }
		  });
	}
	
	function modal(){
       $('.modal').modal('show');
    }
	
</script>

<div id="nav-placeholder">

</div>

<div class="p-3 mb-2 bg-light text-dark">
	<h1 style="text-align:center"> Welcome to Company XXX </h1>

<div class="container">

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width: 48px">
            <div class="spinner-border" role="status">
				<span class="sr-only">Loading...</span>
			</div>
        </div>
    </div>
</div>

<!-- Form -->
<div class="row">	
	<div class="col-sm p-3 mb-2 bg-white text-dark">
	
	<form action="process/submit.php/" method="POST">
		<div class="form-group">
			
		<label class="col-sm-4 col-form-label"><legend>Name</legend></label>

				
					<input type="text" class="form-control" name="name" id="name"/>
		</div>
		<div class="form-group">	
		<label class="col-sm-4 col-form-label"><legend>Address</legend></label>

				
					<input type="text" class="form-control" name="address" id="address"/>
		</div>
		<div class="form-group">	
		<label class="col-sm-4 col-form-label"><legend>I/D Type</legend></label>

				
					<input type="text" class="form-control" name="id_type" id="id_type"/>
		</div>	
		<div class="form-group">	
		<label class="col-sm-4 col-form-label"><legend>I/D No</legend></label>

				
					<input type="text" class="form-control" name="id" id="id"/>
		</div>		
		
		<label class="col-sm-4 col-form-label"><legend>Gender</legend></label>
		<div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sex" id="male" value="Male">
          Male
        </label>
		</div>
		<div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sex" id="female" value="Female">
          Female
        </label>
		</div>

		<label class="col-sm-4 col-form-label"><legend>Department</legend></label>
		<div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="department" id="IT" value="Information Technology">
          Information Technology
        </label>
		</div>
		<div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="department" id="engineering" value="Engineering">
          Engineering
        </label>
		</div>
		<div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="department" id="hr" value="Human Resources">
          Human Resources
        </label>
		</div>
		<div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="department" id="facility" value="Facility">
          Facility
        </label>
		</div>

		<div class="form-group">	
			<label class="col-sm-4 col-form-label"><legend>Purpose</legend></label>
		</div>			<input type="text" class="form-control" name="purpose" id="purpose" value = ""/>
		<div class="form-group">
			<label class="col-sm-4 col-form-label"><legend>Person In Charge</legend></label>
					<input type="text" class="form-control" name="pic" id="pic" value = "<?php echo htmlspecialchars($_SESSION["username"]); ?>"/>
				
		</div>			
		<div class="form-group">
			<label class="col-sm-4 col-form-label"><legend>Time</legend></label>
					<input type="text" class="form-control" name="time" id="time"/>
		</div>		
		
	
		<button type="submit" class="btn btn-primary" style="float: right;margin:5px;">Submit</button>
		<button type="button" class="btn btn-primary" style="float: right;margin:5px;" onclick="checkIN();" value="Test">Scan</button>

	</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html> 