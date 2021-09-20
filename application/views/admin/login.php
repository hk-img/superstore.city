<html>
<head>
<title>AYR Group Admin Login</title>
<!-- metatags-->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<link href="<?php echo root(); ?>web_root/admin_root/login/css/style.css" rel="stylesheet" type="text/css" media="all"/><!--stylesheet-css-->
<link rel="stylesheet" href="<?php echo root(); ?>web_root/admin_root/login/css/font-awesome.css"><!--fontawesome-->
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet"><!--online fonts-->
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"><!--online fonts-->
<style>
	.error{
		color:white; 
	}
</style>
</head>
<?php 
	if($this->session->userdata('store100mlmadmin')){
		header("location:".base_url('admin'));
		die;
	}
?>
<body>
	<div class="w3ls-main"> 
			<div class="wthree-container" style="margin-top:7%">
				<div class="wthree-form">
					<div class="agileits-2">
						<h2>login</h2>
					</div>
					<form action="#" name="adminSignin" id="adminSignin" method="post">
					<span id="responsesMsg"> </span>
						<div class="w3-user">
							<span><i class="fa fa-user-o" aria-hidden="true"></i></span>
							<input type="text" name="username" placeholder="Username" required="">
						</div>
						<div class="clear"></div>
						<div class="w3-psw">
							<span><i class="fa fa-key" aria-hidden="true"></i></span>
							<input type="password" name="password" placeholder="Password" required="">
							
						</div>
						<div class="clear"></div> 
						<div class="clear"></div>
						<div class="w3l-submit">
							<input type="submit" value="login">
						</div>
						<div class="clear"></div>
					</form>
				</div>
			</div>
	</div> 
		<script src="<?php echo base_url(); ?>web_root/admin_root/js/bootstrap.min.js"></script>
	<!-- custom scrollbar plugin -->
	<!-- Compiled and minified JavaScript -->
	<script src="<?php echo $root; ?>web_root/admin_root/js/materialize.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script> 
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script>
// SIGN IN FORM
$(function() {
  $("form[name='adminSignin']").validate({
    // Specify validation rules
    rules: {
      username: "required",
      password: "required", 
     },
    // Specify validation error messages
    messages: {
      username: "Enter Username",
      password: "Enter Password",
     }, 
    submitHandler: function(form) {
		$('#responsesMsg').html('');
		var url = "<?php echo root(); ?>";
		$.ajax({
			url: url+"admin/Login/AdminLoginEnd",
			type: 'post',
			dataType: 'json',
			data: $('form#adminSignin').serialize(),
			success: function(data) { 
				if(data.status==1){
					$('#responsesMsg').html('<h3 style="color:white;"> '+ data.msg +'</h3>').show().fadeOut(5000); 
					setTimeout(function(){ window.location.href="<?php echo root();  ?>admin/dashboard";}, 500);
				 }else{
					$('#responsesMsg').html('<h3 style="color:white;"> '+ data.msg +'</h3>').show().fadeOut(5000); 
				}
					  }
		});
	
	 return false;
    }
  });
});

</script>
</body>
</html>

					
					
					
