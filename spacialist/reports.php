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
<?php
 if(isset($_POST['update'])){
  	$appointment_id = $_POST['appointment_id'];
  	$status = $_POST['status'];
    
   // console.log("appointment_id:".$appointment_id);
    /*$service_id = $_POST['service_id'];*/
    
      //if($status != '' ){
        updateApptByApptId($status,$appointment_id);
       //echo $update;
       /* for($i=0;$i<count($_POST["service_id"]); $i++)
      	{
          $service_id=$_POST["service_id"][$i];
          addServicesByStaffId($staff_id,$service_id);*/
        echo "<script> window.location='appointment.php?s=Appointment Updated';</script>";
      //}else{
        //echo "<script> window.location='appointment.php?m=Status must not be empty';</script>";
      //}
    }
  ?>
<link rel="stylesheet" type="text/css" href="css/w3.css">
 <link href="css/style-responsive.css" rel="stylesheet" />
  <link href="css/datatable.css" rel="stylesheet" />

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
						 	 <?php $data = getApptByBusId($bus_id) ;

         					 if(isset($_SESSION["bus_id"])){
        						foreach($data as $datas){
           						
            					?>
            				
            				<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
									</a>
									<div class="message-body"><small class="pull-right">new</small>
										<a href="appointment.php"><strong><?php echo $datas['firstname']; ?></strong> booked an appointment on
										 <strong><?php echo $datas['sched_date']; ?></strong> <strong>@<?php echo date("g:i a",strtotime($datas['start_time'])).'-'.date("g:i a",strtotime($datas['end_time']));; ?></strong></a>
									<br /><small class="text-muted"><?php echo $datas['created_dt']; ?></small></div>
								</div>
							</li>
            				


            			 <?php
           				
          					}
         				}
          				?>
							
							<!-- <li>
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
							</li> -->
							<li class="divider"></li>
							<li>
								<div class="all-button"><a href="appointment.php">
									<em class="fa fa-inbox"></em> <strong>All Appointments</strong>
								</a></div>
							</li>
						</ul>
					</li>
					<!-- <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-bell"></em><span class="label label-info">5</span>
					</a>
						<ul class="dropdown-menu dropdown-alerts">
							<li><a href="#">
								<div><em class="fa fa-envelope"></em> 1 New Message
									<span class="pull-right text-muted small">3 mins ago</span></div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-heart"></em> 12 New Likes
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-user"></em> 5 New Followers
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li>
						</ul>
					</li> -->
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
				<!--<img src= <?php echo "data:image/jpeg;base64,'.base64_encode($bus_logo->load()) .'" ?>/>'; -->
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo $_SESSION["bus_name"]; ?> </div>
				<div class="profile-usertitle-name">
					 <?php $bus_id=$_SESSION["bus_id"];?>
						 	 <?php $data = getBusHoursByBusId($bus_id) ;

         					 if(isset($_SESSION["bus_id"])){
        						foreach($data as $datas){
           							
            					?>
            					 <h5 class="w3-small"><?php echo date("g:i a",strtotime($datas['open_hr'])).'-'.date("g:i a",strtotime($datas['close_hr']))?></h5>
            		 <?php
           				
          					}
         				}
          				?>

				</div>
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
			<li><a href="profile.php"><em class="fa fa-address-card">&nbsp;</em> Profile</a></li>
			<li ><a href="services.php"><em class="fa fa-list">&nbsp;</em> Services</a></li>
			<li><a href="staff.php"><em class="fa fa-user-circle">&nbsp;</em> Staff</a></li>
			<li><a href="transaction.php"><em class="fa fa-address-book-o">&nbsp;</em> Transactions</a></li>
			<li ><a href="appointment.php"><em class="fa fa-calendar">&nbsp;</em> Appointments</a></li>
			<!-- <li><a href="ratings.php"><em class="fa fa-comments">&nbsp;</em> Ratings and Feedbacks</a></li> -->
			<li class="active"><a href="reports.php"><em class="fa fa-bar-chart">&nbsp;</em> Reports</a></li>
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
				<h1 class="page-header">Reports</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="panel panel-default">
					<div class="panel-heading">
						Top Clients
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
						<table class="table table-striped table-advance table-hover" id="myTable">
                <thead>
                  <tr>
                   <!--  <th><i class="fa fa-list-ol"></i>ID</th> -->
                    <th  > User_Id</th>
                   <!--  <th><i class="fa fa-transgender-alt"></i> Client</th> -->
                    <th > Firstname</th>
                   <!--  <th> Appointment Desc.</th> -->
                    <th > Lastname</th>
                    <th > Client_Email</th>
                    <th > Client_Phone</th>
                    <th > Client_Address</th>
                    <th > Number of Times Booked</th>
                    
                  </tr>  
                </thead>
              <tbody>

          <?php $data = getUsersByUserId($bus_id) ;
          if(isset($_SESSION["bus_id"])){
          foreach($data as $datas){
            echo '<tr>';
            ?>
            <td><?php echo strtoupper($datas['user_id']); ?></td>
            <td><?php echo strtoupper($datas['firstname']); ?></td>
            <td ><?php echo strtoupper($datas['lastname']); ?></td>
            <td ><?php echo strtoupper($datas['email']); ?></td>
            <td ><?php echo strtoupper($datas['phone_num']); ?></td>
            <td ><?php echo strtoupper($datas['address']); ?></td>
            <td align="center"><?php echo strtoupper($datas['NumberOfTimesBooked']); ?></td>

            
           
            <?php
            echo '</tr>';
          }
         }
          ?>
        </tbody>
      </table>
					</div>
					<!--<div class="panel-footer">
						<span class="input-group-btn">
								<button class="btn btn-primary btn-md" id="btn-todo">Submit</button>
						</span></div>-->
					</div>

		</div>
		<div class="panel panel-container">
			<div class="panel panel-default">
					<div class="panel-heading">
						# of Clients served by each Massage Therapist
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
						<table class="table table-striped table-advance table-hover" id="myTable">
                <thead>
                  <tr>
                   <!--  <th><i class="fa fa-list-ol"></i>ID</th> -->
                    <th  > Staff ID</th>
                   <!--  <th><i class="fa fa-transgender-alt"></i> Client</th> -->
                    <th > Firstname</th>
                   <!--  <th> Appointment Desc.</th> -->
                    <th > Lastname</th>
                    <th > Gender</th>
                    <th > Address</th>
                    <th > Number of Clients Served</th>
                    
                  </tr>  
                </thead>
              <tbody>

          <?php $data = getClientsByStaffId($bus_id);
          if(isset($_SESSION["bus_id"])){
          foreach($data as $datas){
            echo '<tr>';
            ?>
            <td><?php echo strtoupper($datas['staff_id']); ?></td>
            <td><?php echo strtoupper($datas['firstname']); ?></td>
            <td ><?php echo strtoupper($datas['lastname']); ?></td>
            <td ><?php echo strtoupper($datas['gender']); ?></td>
            <td ><?php echo strtoupper($datas['address']); ?></td>
            <td align="center"><?php echo strtoupper($datas['NumberofClientsServed']); ?></td>

            
           
            <?php
            echo '</tr>';
          }
         }
          ?>
        </tbody>
      </table>
					</div>
					<!--<div class="panel-footer">
						<span class="input-group-btn">
								<button class="btn btn-primary btn-md" id="btn-todo">Submit</button>
						</span></div>-->
					</div>

		</div>
		</div>

	
            </section>
          </div>
        </div>
        <!-- page end-->
      </section>

	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
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
	<script type="text/javascript">
  $(document).ready(function(){
    $('#myTable').DataTable({
      "bInfo": false
    });
  });

 
</script>
		
</body>
</html>