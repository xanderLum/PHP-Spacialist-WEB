<?php include '../dbcontroller/dbfunctions1.php';?>
<?php
  
if(!isset($_SESSION['bus_id'])){
	//$bus_id=$_SESSION["bus_id"];
	if(isset($_GET['bus_service_price_id'])){
		$bus_service_price_id = $_GET['bus_service_price_id'];
		deleteService($bus_service_price_id);
		header('location:services.php?s=Deleted Service');
	}

}	else {
		header('location:services.php?m= Cannot be deleted');
	}

?>




