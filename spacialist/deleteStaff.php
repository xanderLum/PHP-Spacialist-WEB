<?php include '../dbcontroller/dbfunctions1.php';?>
<?php
  
if(!isset($_SESSION['bus_id'])){
	//$bus_id=$_SESSION["bus_id"];
	if(isset($_GET['staff_id'])){
		$staff_id = $_GET['staff_id'];
		deleteStaff($staff_id);
		header('location:staff.php?s=Deleted Staff');
	}

}	else {
		header('location:staff.php?m= Cannot be deleted');
	}

?>




