<?php 

function conn(){
	try{
		return new PDO("mysql:host=localhost;dbname=spacialist","root","");
	}
	catch(PDOExeception $e){
		echo $e->getMessage();
	}

   /* $host = "localhost";
     $db_name = "spacialist";
     $username = "root";
     $password = "";
    // public $conn;
     $conn = null;
 
        try{
            $conn = new PDO("mysql:host=" .$host . ";dbname=" .$db_name, $username,$password);
            $conn->exec("set names utf8");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "success";
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $conn;*/
}
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

// LOGIN
function login($bus_email,$bus_password){
    $db = conn();
    $sql = "SELECT * FROM business WHERE bus_email = ? AND bus_password = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($bus_email, $bus_password));
    if($stmt->rowCount() > 0){  
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['bus_name'] = $data['bus_name'];
        $_SESSION['bus_id'] = $data['bus_id'];
        $_SESSION['bus_logo'] = $data['bus_logo'];
   
    $stmt = $db->prepare($sql);
    $stmt->execute(array($data['bus_id']));
       // $_SESSION["bus_name"] = $db["bus_name"];
         header('location:home.php');
     } else {
        header('location:index.php?m=Invalid Credentials');
     }
        $db = null;
}
//CREATE ACCOUNT
function create($bus_logo,$bus_name,$owner,$address,$bus_email,$bus_password,$contact_no,$dti_no,$maps_latitude,$maps_longitude){
	$conn = conn();
	$check = "SELECT bus_email FROM business WHERE bus_email = :bus_email";
	$st = $conn->prepare($check);
	$st->bindParam(':bus_email', $bus_email);
	$st->execute();
	if($st->rowCount() > 0){

		header('location:register.php?m=Email already exists');
	}else{
		$sql = "INSERT INTO business(bus_logo,bus_name,owner,address,bus_email,bus_password,contact_no,dti_no,maps_latitude,maps_longitude) VALUES(?,?,?,?,?,?,?,?,?,?)";
        //echo $sql;
	$stmt = $conn->prepare($sql);
	$stmt->execute(array($bus_logo,$bus_name,$owner,$address,$bus_email,$bus_password,$contact_no,$dti_no,$maps_latitude,$maps_longitude));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
   //header('location:register.php?m=Successfully added');
	}
	$conn = null;
}
function update($bus_logo,$bus_name,$owner,$address,$bus_email,$bus_password,$contact_no,$dti_no,$maps_latitude,$maps_longitude,$bus_id){
    $conn = conn();
    /*$check = "SELECT bus_email FROM business WHERE bus_email = :bus_email";
    $st = $conn->prepare($check);
    $st->bindParam(':bus_email', $bus_email);
    $st->execute();
    if($st->rowCount() > 0){

        header('location:profile.php?m=Email already exists');
    }else{*/
        //$sql = "UPDATE staff SET firstname = ?, lastname = ?, gender = ?, address = ? WHERE staff_id = ? ";
        $sql = "UPDATE business SET bus_logo=?, bus_name=?,owner=?,address=?,bus_email=?,bus_password=?,contact_no=?,dti_no=?,
                maps_latitude=?, maps_longitude=? WHERE bus_id=?";
        echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_logo,$bus_name,$owner,$address,$bus_email,$bus_password,$contact_no,$dti_no,$maps_latitude,$maps_longitude,$bus_id));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
   //header('location:register.php?m=Successfully added');
    //}
    $conn = null;
}
function getStaffByBusId($bus_id){
    $conn = conn();
    $sql = "SELECT * FROM staff where bus_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
function addStaffByBusId($bus_id,$firstname,$lastname,$gender,$address){
    $conn = conn();
    $sql = "INSERT INTO staff(bus_id,firstname,lastname,gender,address) VALUES((SELECT bus_id from business where bus_id=?),?,?,?,?)";
    //echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id,$firstname,$lastname,$gender,$address));
    $conn = null;
}

function updateStaffByBusId($firstname,$lastname,$gender,$address,$staff_id){
    $conn = conn();
    $sql = "UPDATE staff SET firstname = ?, lastname = ?, gender = ?, address = ? WHERE staff_id = ? ";
    //echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($firstname,$lastname,$gender,$address,$staff_id)); 
    $conn = null;
}
function deleteStaff($staff_id){
    $conn = conn();
    $sql = "DELETE from staff  WHERE staff_id = ? ";
    //echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($staff_id));
    $conn = null;
}
function updateApptByApptId($status,$appointment_id){
    $conn = conn();
    $sql = "UPDATE appointment SET status=? WHERE appointment_id = ? ";
    //echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($status,$appointment_id)); 
    //console_log("updateAppt appt inserted=".$appointment_id);
    $conn = null;
}
function DashboardStaff($bus_id){
    $conn = conn();
    $sql = "SELECT COUNT(*) from staff where bus_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $count=$stmt->fetchColumn();
    return $count;
}
function DashboardClients($bus_id){
    $conn = conn();
    $sql = "SELECT COUNT(DISTINCT user_id) from transaction where bus_id=? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $count=$stmt->fetchColumn();
    return $count;
}
function DashboardBookings($bus_id){
    $conn = conn();
    $sql = "SELECT COUNT(*) from transaction where bus_id=? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $count=$stmt->fetchColumn();
    return $count;
}
function DashboardAppointments($bus_id){
    $conn = conn();
    $sql = "SELECT COUNT(*) from appointment a inner join transaction t on a.transaction_id=t.transaction_id where bus_id=? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $count=$stmt->fetchColumn();
    return $count;
}
function getTransactionByBusId($bus_id){
    $conn = conn();
    $sql = "SELECT t.transaction_id,b.bus_name,u.firstname,t.payment_id,t.payment_transaction_id,t.payment_details,t.amount,t.created_dt from transaction t inner join business b on t.bus_id=b.bus_id inner join user u on t.user_id=u.user_id where t.bus_id=? ORDER BY t.created_dt";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
function getAppointmentByBusId($bus_id){
    $conn = conn();
    $sql = "SELECT a.appointment_id,a.appointment_name,a.appointment_desc,a.status,t.transaction_id,b.bus_id,b.bus_name,u.firstname,sd.staff_schedule_id,sd.start_time,sd.end_time,sd.sched_date,sd.created_dt,ss.staff_service_id, st.staff_id,st.firstname,s.service_id,s.service_name from appointment a inner join transaction t on a.transaction_id= t.transaction_id inner join user u on t.user_id=u.user_id inner join business b on. t.bus_id=b.bus_id inner join staff_schedule sd on a.staff_schedule_id = sd.staff_schedule_id inner join staff_service ss on sd.staff_service_id= ss.staff_service_id inner join staff st on ss.staff_id=st.staff_id inner join service s on ss.service_id=s.service_id where t.bus_id=? ORDER BY sd.sched_date,sd.start_time";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
function getApptByBusId($bus_id){
    $conn = conn();
    $sql = "SELECT a.appointment_id,a.appointment_name,a.appointment_desc,a.status,t.transaction_id,t.created_dt,b.bus_id,b.bus_name,u.firstname,sd.staff_schedule_id,sd.start_time,sd.end_time,sd.sched_date,sd.created_dt,ss.staff_service_id, st.staff_id,s.service_id,s.service_name from appointment a inner join transaction t on a.transaction_id= t.transaction_id inner join user u on t.user_id=u.user_id inner join business b on. t.bus_id=b.bus_id inner join staff_schedule sd on a.staff_schedule_id = sd.staff_schedule_id inner join staff_service ss on sd.staff_service_id= ss.staff_service_id inner join staff st on ss.staff_id=st.staff_id inner join service s on ss.service_id=s.service_id where t.bus_id=? ORDER BY t.created_dt desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
function getDefaultServices(){
    $conn = conn();
    $sql = "SELECT * from service ";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array());
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
function addServicesByBusId($bus_id,$service_id,$price){
    $conn = conn();
    $sql = "INSERT INTO bus_service_price(bus_id,service_id,price) VALUES((SELECT bus_id from business where bus_id=?),(SELECT service_id from service where service_id=?),?)";
    //echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id,$service_id,$price));
    $conn = null;
}
function getServicesByBusId($bus_id){
    $conn = conn();
    $sql = "SELECT * FROM service s inner join bus_service_price bsp on s.service_id=bsp.service_id where bsp.bus_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
/*function getBodyMassageByBusId($bus_id){
    $conn = conn();
    $sql = "SELECT * FROM service s inner join bus_service_price bsp on s.service_id=bsp.service_id where bsp.bus_id=? and s.service_type='body massage'";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}*/
function addServicesByStaffId($staff_id,$service_id){
    $conn = conn(); 
    $sql = "INSERT INTO staff_service(staff_id,service_id) VALUES((SELECT staff_id from staff where staff_id=?),(SELECT service_id from service where service_id=?))";
    //echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($staff_id,$service_id));
    $conn = null;
}
function CountNotification($bus_id){
    $conn = conn();
    $sql = "SELECT COUNT(*) from notification n inner join appointment a on n.appointment_id=a.appointment_id
            inner join transaction t on a.transaction_id=t.transaction_id
            inner join business b on t.bus_id=b.bus_id where b.bus_id=? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $count=$stmt->fetchColumn();
    return $count;
}
function getServicesByStaffId($staff_id){
    $conn = conn();
    $sql = "SELECT b.bus_id,b.bus_name,ss.staff_id,ss.staff_service_id,s.service_id,s.service_name,st.firstname from business b inner join staff st on b.bus_id=st.bus_id inner join staff_service ss on ss.staff_id=st.staff_id inner join service s on ss.service_id=s.service_id where st.staff_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($staff_id));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
function getUsersByUserId($bus_id){
    $conn = conn();
    $sql = "SELECT u.user_id,u.firstname,u.lastname,u.phone_num,u.email,u.address,b.bus_id,count(t.user_id)as NumberOfTimesBooked from transaction t inner join business b on t.bus_id=b.bus_id inner join user u on t.user_id=u.user_id where b.bus_id=? GROUP BY t.user_id,b.bus_id ORDER BY NumberOfTimesBooked desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
function getAllServicesByStaffId($bus_id){
    $conn = conn();
    $sql = "SELECT st.staff_id,st.firstname, s.service_id,s.service_name,ss.staff_service_id,b.bus_id from staff st inner join staff_service ss on st.staff_id=ss.staff_id inner join service s on s.service_id=ss.service_id inner join business b on st.bus_id=b.bus_id where b.bus_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($staff_id));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
function getBusHoursByBusId($bus_id){
    $conn = conn();
    $sql = "SELECT b.bus_id,b.bus_name,boh.open_hr,boh.close_hr from business b inner join business_operating_hr boh on b.bus_id= boh.bus_id where b.bus_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
/*function profilePic($bus_id){
    $conn = conn();
    $query = "select bus_logo from business WHERE bus_id = ?"; 
    $stmt = $conn->prepare( $query );
 
// bind the id of the image you want to select
    $stmt->bindParam(1, $_GET['bus_id']);
    $stmt->execute();
 
// to verify if a record is found
    $num = $stmt->rowCount();
 
if( $num ){
    // if found
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // specify header with content type,
    // you can do header("Content-type: image/jpg"); for jpg,
    // header("Content-type: image/gif"); for gif, etc.
    header("Content-type: image/png");
    
    //display the image data
    print $row['data'];
    exit;
}
}*/
function getBusinessByBusId($bus_id){
    $conn = conn();
    $sql = "SELECT * FROM business where bus_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
function createSched($bus_id,$openhr,$closehr){
    $conn = conn();
    /*$check = "SELECT boh.open_hr,boh.close_hr FROM business_operating_hr boh inner join business b on boh.bus_id=b.bus_id
                WHERE b.bus_id = ?";
    $st = $conn->prepare($check);
    $st->bindParam(1, $bus_id);
    $st->execute();
    if($st->rowCount() > 0){
       $sql = "UPDATE business_operating_hr boh inner join business b on boh.bus_id=b.bus_id SET boh.open_hr=?, boh.close_hr=?
                where b.bus_id=?";
                $stmt = $conn->prepare($sql);
        console_log("$bus_id=".$bus_id);
        console_log("$openhr=".$openhr);
       console_log("$closehr=".$closehr);
       $sql->bindParam(1, $openhr);
       $sql->bindParam(2, $closehr);
       $sql->bindParam(3, $bus_id);

         try {  
      // $stmt->execute(array($bus_id,$openhr,$closehr));
           $stmt->execute(); 

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage() . "<br />\n";
        return false;
    }
       
       
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;

    }
    else{*/
    $sql = "INSERT INTO business_operating_hr(bus_id,open_hr,close_hr)VALUES((SELECT bus_id from business where bus_id=?),?,?)";
    //echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id,$openhr,$closehr));
   /* $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
    }*/
    $conn = null;
}
function deleteService($bus_service_price_id){
    $conn = conn();
    $sql = "DELETE from bus_service_price WHERE bus_service_price_id = ? ";
    //echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_service_price_id));
    $conn = null;
}
function updateService($bus_service_price_id,$price){
    $conn = conn();
    $sql = "UPDATE bus_service_price SET price=? WHERE bus_service_price_id = ? ";
    //echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($price,$bus_service_price_id)); 
    //console_log("updateAppt appt inserted=".$appointment_id);
    $conn = null;

}
function getDefaultBodyMassage(){
    $conn = conn();
    $sql = "SELECT * from service where service_type='body massage' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array());
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
function getDefaultFacial(){
    $conn = conn();
    $sql = "SELECT * from service where service_type='facial' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array());
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
function getDefaultFootMassage(){
    $conn = conn();
    $sql = "SELECT * from service where service_type='foot massage' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array());
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
function getDefaultNailService(){
    $conn = conn();
    $sql = "SELECT * from service where service_type='nail service' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array());
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
//business with body massage selected
function getBodyMassageByBusId($bus_id){
    $conn = conn();
    $sql = "SELECT b.bus_id,bsp.service_id,s.service_name,s.duration,bsp.price from bus_service_price bsp inner join service s on bsp.service_id=s.service_id inner join business b on b.bus_id=bsp.bus_id where s.service_type='body massage' and b.bus_id=? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}
function getClientsByStaffId($bus_id){
    $conn = conn();
    $sql = "SELECT  st.staff_id,st.firstname,st.lastname,st.gender,st.address,COUNT(ss.staff_service_id) as NumberofClientsServed
            from staff st
            inner join staff_service ss
            on ss.staff_id=st.staff_id
            inner join staff_schedule sd
            on ss.staff_service_id=sd.staff_service_id
            inner join business b 
            on st.bus_id=b.bus_id
            where b.bus_id=?
            GROUP BY b.bus_id,st.staff_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($bus_id));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}

/*function getSpartnerProfile($id) {
    $conn = conn();
    $sql = "SELECT * FROM spartner WHERE spartner_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;
    return $row;
}

function updateSpartProfile($name,$location,$username,$password,$profile_picture, $id) {
    $conn = conn();
    $sql = "UPDATE spartner SET name = ?, location = ?, username = ?, password = ?, profile_picture = ? WHERE spartner_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($name,$location,$username,$password,$profile_picture, $id));
    $conn = null;
}
// function logout($id){
//     $conn = conn();
//     $sql = "UPDATE spartner SET status = 'DEACTIVATED' WHERE spartner_id = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute(array($id));
// }

function getStaff(){
	$conn = conn();
	$sql = "SELECT * FROM spartner_staff";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$conn = null;
	return $data;
}
function addStaff($fname,$lname,$mname,$gender,$phone){
	$conn = conn();
	$sql = "INSERT INTO spartner_staff(fname,lname,mname,gender,phone) VALUES(?,?,?,?,?)";
	$stmt = $conn->prepare($sql);
	$stmt->execute(array($fname,$lname,$mname,$gender,$phone));
	$conn = null;
}
function deleteUser($id){
    $conn = conn();
    $sql = "DELETE FROM spartner_staff WHERE staff_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($id));
    $conn = null; 
}

function updateStaff($fname,$lname,$mname,$gender,$phone,$staffid){
	$conn = conn();
	$sql = "UPDATE spartner_staff SET fname = ?, lname = ?, mname = ?, gender = ?, phone = ? WHERE staff_id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute(array($fname,$lname,$mname,$gender,$phone,$staffid));
	$conn = null;
}
function serviceType(){
    $conn = conn();
    $sql = "SELECT * FROM services";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
    $conn = null;
}

function addService($a,$b){
    $conn = conn();
    $sql = "SELECT * FROM services WHERE service = :service OR id = :service";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":service", $a);
    $stmt->execute();
    if($stmt->rowCount() == 0) {
    $sql = "INSERT INTO services(service, service_image) VALUES(?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($a,$b));
    $a = $conn->lastInsertId();
    }
    $conn = null;
    return $a;
}
function addServiceType($a,$b,$c,$d,$e,$f){
    $conn = conn();
    $sql = "INSERT INTO service_types(service_type,service_id, service_hour, service_type_price, user_types, user_types_id) VALUES(?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($a,$b,$c,$d,$e,$f));
    $conn = null;
}

function getCategory(){
    $conn = conn();
    $sql = "SELECT * FROM  service_types";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
    $conn = null;
}
function deleteService($id){
    $conn = conn();
    $sql = "DELETE FROM services WHERE service_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($id));
    if($stmt->rowCount() > 0){
        echo "<script> window.location='services.php?e=Service removed&style=warning&head='; </script>";
    }else{
        echo "<script> window.location='services.php?e=An error occured&style=danger&head='; </script>";
    }
    $conn = null;    
}

function updateService($service_name, $service_type_id, $service_hour, $service_price, $service_id) {
    $conn = conn();
    $sql = "UPDATE services SET  service_name = ?, service_type_id = ?, service_hour = ?,service_price = ? WHERE service_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($service_name, $service_type_id, $service_hour, $service_price, $service_id));
    $con = null;
    // return 
}

function getService(){
    $conn = conn();
    $sql = "SELECT * FROM services s JOIN service_types t ON s.id = t.service_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
    $conn = null;
}
function getServiceType($id){
    $conn = conn();
    $sql = "SELECT * FROM services s, service_types st WHERE st.service_type_id = s.service_type_id AND st.service_type = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($id));
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
    $conn = null;
}

function getSched(){
    $conn = conn();
    $sql = "SELECT * FROM spartner_schedule";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
    $conn = null;
}
function addSched($date, $time){
    $conn = conn();
    $sql = "INSERT INTO spartner_schedule(date,time) VALUES(?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($date,$time));
    $conn = null;
}
function deleteSched($a){
    $conn = conn();
    $sql = "DELETE FROM spartner_schedule WHERE sched_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($a));
    $conn = null; 
}

function updateSched($date,$time,$schedid){
	$conn = conn();
	$sql = "UPDATE spartner_schedule SET date = ?, time = ? WHERE sched_id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute(array($date,$time,$schedid));
	$conn = null;
}
function updateStatus($id, $deactivate){
    $conn = conn();
    $sql = "UPDATE spartner_schedule SET status = ? WHERE sched_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($deactivate,$id));

}
function Dashboard(){
    $conn = conn();
    $sql = "SELECT COUNT(*) from spacialite";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $count=$stmt->fetchColumn();
    return $count;
}
function getClient(){
    $conn = conn();
    $sql = "SELECT * FROM spacialite_boooking";
    $stmt = $conn->prepare($sql);
    $stmt ->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $data;
}*/

