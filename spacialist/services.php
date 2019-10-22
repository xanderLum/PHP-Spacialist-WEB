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

  if(isset($_POST['submit'])){
  	$bus_id=$_SESSION["bus_id"];
    $service_id = $_POST['service_id'];
    $price = $_POST['price'];
   /* $service_type= $_POST['service_type'];*/
   // $service_id =array_chunk($service_id, 10);

     for($i=0;$i<count($_POST["service_id"]); $i++)
      {
     
          $service_id=$_POST["service_id"][$i];
          $price=$_POST["price"][$service_id-1];
          console_log("Price = ".$price);
          addServicesByBusId($bus_id,$service_id,$price);
		
  	}

   /* for($i=0;$i<count($_POST["service_id"]); $i++)
      {
     
          $service_id=$_POST["service_id"][$i];
          $price=$_POST["price"][$service_id-1];
          console_log("Price = ".$price);
          addServicesByBusId($bus_id,$service_id,$price);
		
  	}*/
  
  }
    if(isset($_POST['submit1'])){
  	$bus_id=$_SESSION["bus_id"];
    $service_id = $_POST['service_id'];
    $price = $_POST['price'];
   /* $service_type= $_POST['service_type'];*/
    
    // $service_id=range('11', '20');

    
    
     for($i=0;$i<count($_POST["service_id"]); $i++)
      {
     	 
          $service_id=$_POST["service_id"][$i];
          $price=$_POST["price"][$service_id-11];
          console_log("Price = ".$price);
          addServicesByBusId($bus_id,$service_id,$price);
		
  	}

  
  }
    if(isset($_POST['submit2'])){
  	$bus_id=$_SESSION["bus_id"];
    $service_id = $_POST['service_id'];
    $price = $_POST['price'];
   /* $service_type= $_POST['service_type'];*/
    
    // $service_id=range('11', '20');

    
    
     for($i=0;$i<count($_POST["service_id"]); $i++)
      {
     	 
          $service_id=$_POST["service_id"][$i];
          $price=$_POST["price"][$service_id-21];
          console_log("Price = ".$price);
          addServicesByBusId($bus_id,$service_id,$price);
		
  	}
  	
  
  }
      if(isset($_POST['submit3'])){
  	$bus_id=$_SESSION["bus_id"];
    $service_id = $_POST['service_id'];
    $price = $_POST['price'];
   /* $service_type= $_POST['service_type'];*/
    
    // $service_id=range('11', '20');

    
    
     for($i=0;$i<count($_POST["service_id"]); $i++)
      {
     	 
          $service_id=$_POST["service_id"][$i];
          $price=$_POST["price"][$service_id-24];
          console_log("Price = ".$price);
          addServicesByBusId($bus_id,$service_id,$price);
		
  	}
  	
  
  }
 
   if(isset($_POST['update'])){
  	$bus_service_price_id = $_POST['bus_service_price_id'];
    $price = $_POST['price'];
   
    /*$service_id = $_POST['service_id'];*/
    
      if($price != ''){
       $update= updateService($bus_service_price_id,$price);
       //echo $update;
       /* for($i=0;$i<count($_POST["service_id"]); $i++)
      	{
          $service_id=$_POST["service_id"][$i];
          addServicesByStaffId($staff_id,$service_id);*/
        echo "<script> window.location='services.php?s=Service Updated';</script>";
      }else{
        echo "<script> window.location='services.php?m=Price must not be empty';</script>";
      }
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
			<li class="active"><a href="services.php"><em class="fa fa-list">&nbsp;</em> Services</a></li>
			<li><a href="staff.php"><em class="fa fa-user-circle">&nbsp;</em> Staff</a></li>
			<li><a href="transaction.php"><em class="fa fa-address-book-o">&nbsp;</em> Transactions</a></li>
			<li><a href="appointment.php"><em class="fa fa-calendar">&nbsp;</em> Appointments</a></li>
			<!-- <li><a href="ratings.php"><em class="fa fa-comments">&nbsp;</em> Ratings and Feedbacks</a></li> -->
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
				<h1 class="page-header">Services</h1>
			</div>
		</div><!--/.row-->
		

		<div class="panel panel-container">
			<div class="panel panel-default">
					<div class="panel-heading">
						Services Offered
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
						<div class="col-md-6">
						<div  style="text-align: left; ">
						<span class="input-group-btn">
								<button onclick="document.getElementById('add').style.display='block'"class=" btn btn-primary " >Add Service</button>
						</span></div>
						</div><br/>
						<!-- <div class="col-md-6">
						<div class="form-group">
										<label>Service Types</label>
										<select id= "table" class="form-control" name="service_type" onchange = "showTable()">
											<option value="all">All Services</option>
											<option value=1>Body Massage</option>
											<option value=2>Facial</option>
											<option value=3>Foot Massage</option>
											<option value=4>Nail Services</option>
											
										</select>
									</div>
						</div> -->

					

					
				

						<table class="table table-striped table-advance table-hover" id="myTable">
               			 <thead>
                  			<tr>
                    			<th><i class="fa fa-list-ol"></i> Services</th>
                    			<th><i class="fa fa-type"></i> Service Type </th>
                    			<th><i class="fa fa-clock-o"></i> Duration </th>
                    			<th><i class="fa fa-money"></i> Price </th>
                    			<th><i class="fa fa-tasks"></i> Action </th>


                   				
			                  </tr>  
			                </thead>
			              <tbody>
			              <?php  $bus_id=$_SESSION["bus_id"];?>
						 <?php $data = getServicesByBusId($bus_id) ;

         					 if(isset($_SESSION["bus_id"])){
        						foreach($data as $datas){
           						echo '<tr>';
            					?>
            				
            				<td><?php echo $datas['service_id'] .' '.$datas['service_name']; ; ?></td>
            				<td><?php echo $datas['service_type'] ?></td>
            				<td><?php echo strtoupper($datas['duration']); ?></td>
            				<td><?php echo "Php"."&nbsp;".strtoupper($datas['price']); ?></td>
							
		
							 <td>
              					<div class="btn-group">
              						<button  class="btn btn-success" onclick="document.getElementById('edit<?php echo $datas['bus_service_price_id']; ?>').style.display='block'"  >&#9998 </button>
									<button class="btn btn-danger" onclick="document.getElementById('delete<?php echo $datas['bus_service_price_id']; ?>').style.display='block'" >&times </button> 
								</div>
							</td>
							<!-- EDIT -->
            <div id="edit<?php echo $datas['bus_service_price_id']; ?>" class="w3-modal">
              <div class="w3-modal-content " style="width:30%">
                <header class="w3-container w3-blue">
                  <span onclick="document.getElementById('edit<?php echo $datas['bus_service_price_id']; ?>').style.display='none'" class="w3-btn w3-display-topright">x</span>
                  <h2><i class="fa fa-pencil-square-o"></i> Edit</h2>
                </header>
                <div class="w3-container w3-text-white w3-white">
                  <h2 class="w3-center"><i class="fa fa-info"></i> Edit Service Price</h2>
                  <form method="POST" class="w3-container w3-margin">
                  <div class="w3-row w3-section">
                      
                        <p><label><b>Business Service Price ID</b></label>
                      
                        <input type="number" name="bus_service_price_id" value="<?php echo $datas['bus_service_price_id']; ?>"  class="w3-input w3-border" style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold" readonly>
                      </p>
                      <p><label><b>Service Name</b></label>
                        <input type="text" name="service_name" value="<?php echo $datas['service_name']; ?>" placeholder="Service Name" class="w3-input w3-border" style="color:black" readonly>
                      </p>
                    	<p><label><b>Duration</b></label>
                        <input type="text" name="duration" value="<?php echo $datas['duration']; ?>" placeholder="Duration" class="w3-input w3-border" style="color:black" readonly>  
                    	</p>  
                   
                    <p><label><b>Price</b></label>
                        <input type="number" name="price" value="<?php echo $datas['price']; ?>" placeholder="Price" class="w3-input w3-border" style="color:black" >
                      
                    </p>
                     
                    
                   

                      <button name="update" class="w3-btn w3-margin w3-blue w3-round-large w3-right"><i class="fa fa-save"></i> Update</button>
                  </form>
                </div>
              </div>
              </div>
               </div> 
							 <!-- DELETE -->

           
            <div id="delete<?php echo $datas['bus_service_price_id']; ?>" class="w3-modal">
              <div class="w3-modal-content " style="width:30%">
                <header class="w3-container w3-blue">
                  <span onclick="document.getElementById('delete<?php echo $datas['bus_service_price_id']; ?>').style.display='none'" class="w3-btn w3-display-topright">x</span>
                  <h2><i class="fa fa-trash"></i> Delete</h2>
                </header>
                <div class="w3-card-4 w3-white">
                  <div class="w3-container w3-center">
                    <h3><i class="fa fa-warning"></i> Delete Service</h3>
                    <!-- <img src="img/blank.png" alt="Avatar" style="width:100px;border-radius:50%"> -->
                    <!-- <h5 class="w3-large"><i class="fa fa-id-card-o"></i> <?php echo $datas['bus_service_price_id']; ?></h5> -->
                    <h5 class="w3-large"><h5>Service name:</h5> <?php echo $datas['service_id'].' '.$datas['service_name']; ?></h5>
                    <h5 class="w3-small"><i class="fa fa-clock-o"></i> <?php echo ' : '.$datas['duration']; ?></h5>
                    <h5 class="w3-small"><i class="fa fa-money"></i> <?php echo ' : '.$datas['price']; ?></h5>
                    <div class="w3-section">
                       <input type="hidden" name="bus_service_price_id" value="<?php echo $datas['bus_service_price_id']; ?>">
                      <a href="deleteService.php?bus_service_price_id=<?php echo $datas['bus_service_price_id']; ?>"><button class="w3-btn w3-red w3-round"><i class="fa fa-trash"></i> Delete</button></a>
                      <button onclick="document.getElementById('delete<?php echo $datas['bus_service_price_id']; ?>').style.display='none'" class="w3-btn w3-green w3-round"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
     				 	
     			</div>
     						
					</div>
		</div>
            			 <?php
           				 echo '</tr>';
          					}
         				}
          				?>
          		                
							</div>

          				</tbody>
     				 </table>
     						 <!-- ADD -->
  <div id="add" class="w3-modal">
    <div class="w3-modal-content " style="width:50%">
      <header class="w3-container w3-blue">
        <span onclick="document.getElementById('add').style.display='none'" class="w3-btn w3-display-topright">x</span>
        <h2><i class="fa fa-user-plus"></i> Add</h2>
      </header>
      <div class="w3-container w3-text-white w3-white">

        <h2 class="w3-center"><i class="fa fa-info"></i> Services</h2>
          <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"> 
            </div>
           
            
            	<form action = "services.php" method= "post">
						<div class="form-group">
										<h5>Service Types:</h5>
										<select id= "ID" class="form-control" name="service_type" onchange="showForm()" >
											<option >---SELECT SERVICE TYPE----</option>
											<option value="bodymassage">Body Massage</option>
											<option value="facial">Facial</option>
											<option value="footmassage">Foot Massage</option>
											<option value="nailservice">Nail Services</option>
										</select>
						</div>
						
						<div id = "s1" style = "display:none;">
							
							<div class="row">        
          						<div class="panel-body">
									<table class="table table-striped table-advance table-hover" id="myTable">
               			 			<thead>
                  					<tr>
		                    			<th><i class="fa fa-list-ol"></i> Services</th>
		                    			<th><i class="fa fa-user"></i> Duration </th>
		                    			<th><i class="fa fa-user"></i> Price </th>
                   				
				                  </tr>  
				                </thead>
				              <tbody>
			              <?php  $bus_id=$_SESSION["bus_id"];?>
						 <?php $data = getDefaultBodyMassage();

         					 if(isset($_SESSION["bus_id"])){
        						foreach($data as $datas){
           						echo '<tr>';
            					?>
            				<form role="form" method="post"  enctype="multipart/form-data" autocomplete="on">
            				<td><input type="checkbox" name="service_id[]" value="<?php echo $datas['service_id'] ;?>"><?php echo $datas['service_id'] .' '.$datas['service_name']; ; ?></td>
            				<td><?php echo strtoupper($datas['duration']); ?></td>
            				<td><div class="form-group">
								<input class="form-control" placeholder="Php" name="price[]" type="number" value="">
							</div></td>


            			 <?php
           				 echo '</tr>';
          					}
         				}
          				?>
          		                
							</div>
          				</tbody>
     				 </table>
     				 	<div style="text-align: center;"><input type="submit"  class="btn btn-primary" name="submit" value="Submit" align="center"></div>
     				 	</form>
     			</div>			
				</div>
			</div>
				 <div id = "s2" style = "display:none">
				 	
				<div class="row">        
          						<div class="panel-body">
									<table class="table table-striped table-advance table-hover" id="myTable">
               			 			<thead>
                  					<tr>
		                    			<th><i class="fa fa-list-ol"></i> Services</th>
		                    			<th><i class="fa fa-user"></i> Duration </th>
		                    			<th><i class="fa fa-user"></i> Price </th>
                   				
				                  </tr>  
				                </thead>
				              <tbody>
			              <?php  $bus_id=$_SESSION["bus_id"];?>
						 <?php $data = getDefaultFacial();

         					 if(isset($_SESSION["bus_id"])){
        						foreach($data as $datas){
           						echo '<tr>';
            					?>
            				<form role="form" method="post"  enctype="multipart/form-data" autocomplete="on">
            				<td><input type="checkbox" name="service_id[]" value="<?php echo $datas['service_id'] ;?>"><?php echo $datas['service_id'] .' '.$datas['service_name']; ; ?></td>
            				<td><?php echo strtoupper($datas['duration']); ?></td>
            				<td><div class="form-group">
								<input class="form-control" placeholder="Php" name="price[]" type="number" value="">
							</div></td>


            			 <?php
           				 echo '</tr>';
          					}
         				}
          				?>
          		                
							</div>
          				</tbody>
     				 </table>
     				 	<div style="text-align: center;"><input type="submit"  class="btn btn-primary" name="submit1" value="Submit" align="center"></div>
     				 	</form>
     			</div>			
				</div>
			</div>
			<div id = "s3" style = "display:none">
							  	<div class="row">        
          						<div class="panel-body">
									<table class="table table-striped table-advance table-hover" id="myTable">
               			 			<thead>
                  					<tr>
		                    			<th><i class="fa fa-list-ol"></i> Services</th>
		                    			<th><i class="fa fa-user"></i> Duration </th>
		                    			<th><i class="fa fa-user"></i> Price </th>
                   				
				                  </tr>  
				                </thead>
				              <tbody>
			              <?php  $bus_id=$_SESSION["bus_id"];?>
						 <?php $data = getDefaultFootMassage();

         					 if(isset($_SESSION["bus_id"])){
        						foreach($data as $datas){
           						echo '<tr>';
            					?>
            				<form role="form" method="post"  enctype="multipart/form-data" autocomplete="on">
            				<td><input type="checkbox" name="service_id[]" value="<?php echo $datas['service_id'] ;?>"><?php echo $datas['service_id'] .' '.$datas['service_name']; ; ?></td>
            				<td><?php echo strtoupper($datas['duration']); ?></td>
            				<td><div class="form-group">
								<input class="form-control" placeholder="Php" name="price[]" type="number" value="">
							</div></td>


            			 <?php
           				 echo '</tr>';
          					}
         				}
          				?>
          		                
							</div>
          				</tbody>
     				 </table>
     				 	<div style="text-align: center;"><input type="submit"  class="btn btn-primary" name="submit2" value="Submit" align="center"></div>
				</form>
		</div></div></div>

          	<div id = "s4" style = "display:none">
							  	<div class="row">        
          						<div class="panel-body">
									<table class="table table-striped table-advance table-hover" id="myTable">
               			 			<thead>
                  					<tr>
		                    			<th><i class="fa fa-list-ol"></i> Services</th>
		                    			<th><i class="fa fa-user"></i> Duration </th>
		                    			<th><i class="fa fa-user"></i> Price </th>
                   				
				                  </tr>  
				                </thead>
				              <tbody>
			              <?php  $bus_id=$_SESSION["bus_id"];?>
						 <?php $data = getDefaultNailService();

         					 if(isset($_SESSION["bus_id"])){
        						foreach($data as $datas){
           						echo '<tr>';
            					?>
            				<form role="form" method="post"  enctype="multipart/form-data" autocomplete="on">
            				<td><input type="checkbox" name="service_id[]" value="<?php echo $datas['service_id'] ;?>"><?php echo $datas['service_id'] .' '.$datas['service_name']; ; ?></td>
            				<td><?php echo strtoupper($datas['duration']); ?></td>
            				<td><div class="form-group">
								<input class="form-control" placeholder="Php" name="price[]" type="number" value="">
							</div></td>


            			 <?php
           				 echo '</tr>';
          					}
         				}
          				?>
          		                
							</div>
          				</tbody>
     				 </table>
     				 	<div style="text-align: center;"><input type="submit"  class="btn btn-primary" name="submit3" value="Submit" align="center"></div>
				</form>
		</div>
        
     
      </div>
      </div>
    </div><div></div></div>
		</div>
        </form>
      </div>
      </div>
    </div><div></div>
</div><div></div></div><div>
	

									
		</div>
				 
		</div><!--/.row-->
	</div>	<!--/.main-->
	 
		
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
		   function showForm() {
		     var selopt = document.getElementById("ID").value;
		      if (selopt == "bodymassage") {
		           document.getElementById('s1').style.display = 'block';
		           document.getElementById('s2').style.display = 'none';
		           document.getElementById('s3').style.display = 'none';
		           document.getElementById('s4').style.display = 'none';

		         }
		     if (selopt=="facial"){
		           document.getElementById('s1').style.display = 'none';
		           document.getElementById('s2').style.display = 'block';
		           document.getElementById('s3').style.display = 'none';
		           document.getElementById('s4').style.display = 'none';

		       }
		     if (selopt=="footmassage"){
		           document.getElementById('s1').style.display = 'none';
		           document.getElementById('s2').style.display = 'none';
		           document.getElementById('s3').style.display = 'block';
		           document.getElementById('s4').style.display = 'none';

		     }
		     if (selopt=="nailservice"){
		           document.getElementById('s1').style.display = 'none';
		           document.getElementById('s2').style.display = 'none';
		           document.getElementById('s3').style.display = 'none';
		           document.getElementById('s4').style.display = 'block';
		           
		     }
		 }
	 </script>
		
</body>
</html>