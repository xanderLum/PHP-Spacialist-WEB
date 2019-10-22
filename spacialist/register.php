<?php /*include_once '../config/database.php';

	  include_once '../objects/business.php';*/

	  include '../dbcontroller/dbfunctions1.php';

	 /* session_start();
	  if(isset($_SESSION["bus_name"]))
	{
		header("location: home.php");
		exit;
	}	*/

?>
<?php include_once('pusher.php');?>
<?php 
      if(isset($_POST['register'])){
      	//console.log("gooo");
      			$image = $_FILES['upload']['name'];
				$bus_name = $_POST['bus_name'];
				$owner = $_POST['owner'];
				$address=$_POST['address'];
				$bus_email = $_POST['bus_email'];
				$bus_password = $_POST['bus_password'];
				$contact_no=$_POST['contact_no'];
				$dti_no = $_POST['dti_no'];
				$maps_latitude=$_POST['maps_latitude'];
				$maps_longitude=$_POST['maps_longitude'];
				$confirm=$_POST['confirm'];

				if($image != ''){
					$file = "img/".$image;
				}
				else{
					$file = "blank.png";
				}
				
				if(strlen($bus_password) >= 6){
					if($bus_name != ''  && $bus_email != ''){
 
							if($bus_password == $confirm){
								
								if(is_uploaded_file($_FILES["upload"]["tmp_name"])){

										move_uploaded_file($_FILES['upload']['tmp_name'], $file);
	
											$fullpath = "myspa/spacialist/".$file;
											$rows = create($fullpath,$bus_name,$owner,$address,$bus_email,$bus_password,$contact_no,$dti_no,$maps_latitude,$maps_longitude);
										
										 	if(count($rows) > 0) {
												$data['success'] = 'success';
												$pusher->trigger('my-channel', 'my-event', $rows);
												header('location:index.php?s=Registration Successful');
											}
										

								 }
								else{
										header('location:index.php?s=File not uploaded');
								}
								

							}else{
									header('location:register.php?m=Password does not match');
						}
						

					}else{
							header('location:register.php?m=Fields must not be empty');
				}	
				}else{
					header('location:register.php?m=Password must be six characters');
				}
			
		}
		
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Spacialist - Register</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
		
					<form role="form" method="post"  enctype="multipart/form-data" autocomplete="on">
						<?php if(isset($_GET['m'])){
							?>
						<div class="w3-center w3-border w3-border-red w3-round-large" style="width:60%;margin-left:20%;margin-right:20%;background-color:rgba(0,0,0,0.5)">
							<p class="w3-text-red"><i class="fa fa-warning"></i> <b><?php echo $_GET['m']; ?></b></p>
						</div>
						<?php } ?>
						<div class="w3-third " align="center" style="width:150px;height:100px" >
						<label class="file-upload" for="upload" style="cursor: pointer;">
						<img src="blank.png" style="width:80%;height: 100%" id="image" align="center">

						</label>
						<input type="file" id="upload" style="visibility: hidden" name="upload" onchange="previewImage(event)">
						</div>
						<br/><br/>
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Business Name" name="bus_name" type="text" >
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Owner" name="owner" type="text" value="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Address" name="address" type="text" value="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Email" name="bus_email" type="email" value="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="bus_password" type="password" value="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Confirm Password" name="confirm" type="password" value="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Contact Number" name="contact_no" type="number" value="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="DTI Number" name="dti_no" type="number" value="">
							</div>
							<!-- <div class="form-group">
									<label>DTI photo</label>
									<input type="file" id="upload1" name="upload1">
									
							</div> -->
							<div class="form-group">
								<input class="form-control" placeholder="Map Latitude" name="maps_latitude" type="decimal" value="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Map Longitude" name="maps_longitude" type="decimal" value="">
							</div>
							
							<!-- <div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div> -->
							<div>
							<input type="submit"  class="btn btn-primary" name="register" value="Register" align="center">

							</div>
							<br/>
							 <p class="change_link">
									Already have an account ?
									<a href="index.php" class="to_register">Login here</a>
							</p>

						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	<script type="text/javascript">
	var previewImage = function(event){
		var imageView = document.getElementById('image');
		imageView.src = URL.createObjectURL(event.target.files[0]);
	}
	</script>

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
