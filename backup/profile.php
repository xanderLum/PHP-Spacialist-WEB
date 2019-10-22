<?php
	session_start();
	if(!isset($_SESSION["bus_logo"]))
	{
		header("location: index.php");
		exit;
	}
?>
<?php

	  require_once '../dbcontroller/dbfunctions1.php';
	

?>
<?php include_once('pusher.php');?>
<?php  $bus_id=$_SESSION["bus_id"];?>
<?php
  if(isset($_POST['save'])){
  	$bus_id=$_SESSION["bus_id"];
    $openhr = $_POST['open_hr'];
    $closehr = $_POST['close_hr'];

	createSched($bus_id,$openhr,$closehr);
	echo"<script>window.location='profile.php?s=Schedule Successfully Added';</script>";

		
        
    //}	
   /* else{
        echo"<script>window.location='profile.php?m=Fill in all the fields';</script>";
    }*/
	
     
 }
 ?>
<?php
		if(isset($_POST['update'])){
				$bus_id = $_SESSION['bus_id'];
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
											$rows = update($fullpath,$bus_name,$owner,$address,$bus_email,$bus_password,$contact_no,$dti_no,$maps_latitude,$maps_longitude,$bus_id);
										
										 	if(count($rows) > 0) {
												$data['success'] = 'success';
												$pusher->trigger('my-channel', 'my-event', $rows);
												header('location:profile.php?s=Successfully Updated');
											}
										

								 }
								else{
										header('location:profile.php?s=File not uploaded');
								}
								

							}else{
									header('location:profile.php?m=Password does not match');
						}
						

					}else{
							header('location:profile.php?m=Fields must not be empty');
				}	
				}else{
					header('location:profile.php?m=Password must be six characters');
				}
		}
			
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Spacialist - Dashboard</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Spartner</span></a>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-bell"></em><span class="label label-danger"><?php  $bus_id=$_SESSION["bus_id"];?><?php echo CountNotification($bus_id)?></span>
					</a>
						<ul class="dropdown-menu dropdown-messages">
							 <?php $bus_id=$_SESSION["bus_id"];?>
						 	 <?php $data = CountNotification($bus_id) ;

         					 if(isset($_SESSION["bus_id"])){
        						foreach($data as $datas){
           						echo '<tr>';
            					?>
            				
            				<td><?php echo $datas['service_id'] .' '.$datas['service_name']; ; ?></td>
            				<td><?php echo strtoupper($datas['duration']); ?></td>
            				<td><?php echo "Php"."&nbsp;".strtoupper($datas['price']); ?></td>


            			 <?php
           				 echo '</tr>';
          					}
         				}
          				?>
							<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
									</a>
									<div class="message-body"><small class="pull-right">3 mins ago</small>
										<a href="#"><strong>John Doe</strong> commented on <strong>your photo</strong>.</a>
									<br /><small class="text-muted">1:24 pm - 25/03/2015</small></div>
								</div>
							</li>
							<li class="divider"></li>
							<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
									</a>
									<div class="message-body"><small class="pull-right">1 hour ago</small>
										<a href="#">New message from <strong>Jane Doe</strong>.</a>
									<br /><small class="text-muted">12:27 pm - 25/03/2015</small></div>
								</div>
							</li>
							<li class="divider"></li>
							<li>
								<div class="all-button"><a href="#">
									<em class="fa fa-inbox"></em> <strong>All Messages</strong>
								</a></div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo $_SESSION["bus_name"]; ?> </div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li ><a href="home.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li class="active"><a href="profile.php"><em class="fa fa-address-card">&nbsp;</em> Profile</a></li>
			<li ><a href="services.php"><em class="fa fa-list">&nbsp;</em> Services</a></li>
			<li ><a href="staff.php"><em class="fa fa-user-circle">&nbsp;</em> Staff</a></li>
			<li><a href="transaction.php"><em class="fa fa-address-book-o">&nbsp;</em> Transactions</a></li>
			<li><a href="appointment.php"><em class="fa fa-calendar">&nbsp;</em> Appoinments</a></li>
			<li><a href="ratings.php"><em class="fa fa-comments">&nbsp;</em> Ratings and Feedbacks</a></li>
			<li><a href="reports.php"><em class="fa fa-bar-chart">&nbsp;</em> Reports</a></li>
			<!--<li><a href="charts.html"><em class="fa fa-bar-chart">&nbsp;</em> Charts</a></li>-->
			<!--<li><a href="elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>-->
			<!--<li><a href="panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>-->
			<!--<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
					</a></li>
				</ul>
			</li>-->
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Profile</h1>
			</div>
		</div><!--/.row-->
		
				
		
			
		<div class="panel panel-container">
			<div class="panel panel-default">
					<div class="panel-heading">
						Business Hours
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-cogs"></em>
							</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 1
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 2
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 3
											</a></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
					<form role="form" method="post"  enctype="multipart/form-data" autocomplete="on">
						<fieldset>
							<label>Open hr:</label>
							<div class="form-group">
								<input class="form-control" placeholder="Open hour" name="open_hr" type="time" value="">
							</div>
							<label>Close hr:</label>
							<div class="form-group">
								<input class="form-control" placeholder="Closing hour" name="close_hr" type="time" value="">
							</div>
							<div>
							<input type="submit"  class="btn btn-primary" name="save" value="Save" align="center">

							</div>
						<fieldset>

					</form>
					
          
					</div>
					
					</div>
		</div>
		<div class="panel panel-container">
			<div class="panel panel-default">
					<div class="panel-heading">
						Edit Profile
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-cogs"></em>
							</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 1
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 2
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 3
											</a></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
					<?php $data = getBusinessByBusId($bus_id) ;
          				if(isset($_SESSION["bus_id"])){
          				foreach($data as $datas){
           				 
            			?>	
						<form role="form" method="post"  enctype="multipart/form-data" autocomplete="on">
						<?php if(isset($_GET['m'])){
							?>
						<div class="w3-center w3-border w3-border-red w3-round-large" style="width:60%;margin-left:20%;margin-right:20%;background-color:rgba(0,0,0,0.5)">
							<!-- <p class="w3-text-red"><i class="fa fa-warning"></i> <b><?php echo $_GET['m']; ?></b></p> -->
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
								<input class="form-control" placeholder="Business Name" name="bus_name" type="text" value="<?php echo $datas['bus_name'];?>">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Owner" name="owner" type="text" value="<?php echo $datas['owner'];?>">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Address" name="address" type="text" value="<?php echo $datas['address'];?>">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Email" name="bus_email" type="email" value="<?php echo $datas['bus_email'];?>">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="bus_password" type="password" value="<?php echo $datas['bus_password'];?>">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Confirm Password" name="confirm" type="password" value="<?php echo $datas['bus_password'];?>">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Contact Number" name="contact_no" type="number" value="<?php echo $datas['contact_no'];?>">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="DTI Number" name="dti_no" type="number" value="<?php echo $datas['dti_no'];?>">
							</div>
							<!-- <div class="form-group">
									<label>DTI photo</label>
									<input type="file" id="upload1" name="upload1">
									
							</div> -->
							<div class="form-group">
								<input class="form-control" placeholder="Map Latitude" name="maps_latitude" type="decimal"value="<?php echo $datas['maps_latitude'];?>">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Map Longitude" name="maps_longitude" type="decimal" value="<?php echo $datas['maps_longitude'];?>">
							</div>
							
							<!-- <div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div> -->
							<!-- <div class="panel-footer">
						<span class="input-group-btn">
								<button class="btn btn-primary btn-md" id="btn-todo">Submit</button>
						</span></div> -->
						<div>
							<input type="submit"  class="btn btn-primary" name="update" value="Update" align="center">

							</div>
							<br/>
							

						</fieldset>
					</form>
					 <?php
            				
         			 }
         		}
          ?>
					</div>
					
					</div>
		</div>
		
		

		</div><!--/.row-->
	</div>	<!--/.main-->

	<script type="text/javascript">
	var previewImage = function(event){
		var imageView = document.getElementById('image');
		imageView.src = URL.createObjectURL(event.target.files[0]);
	}
</script>

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></scri	pt>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>