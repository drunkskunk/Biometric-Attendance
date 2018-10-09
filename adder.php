<?php
if(isset($_GET['bid'])){
	$mysqli = new MySQLi('localhost', 'username', 'password', 'db_name');   // Database connectivity
	if($mysqli->errno){
		header("location: index.php");
	}
	$stmt = $mysqli->prepare("SELECT username FROM userdb WHERE bid = '".$_GET['bid']."'");
	$stmt->execute();
	$stmt->bind_result($total); 
	$stmt->fetch(); 
	$stmt->close();
	$stmt1 = $mysqli->prepare("SELECT COUNT(username) FROM minner WHERE username = '".$total."' and date='".date("d-m-Y")."'");
	$stmt1->execute();
	$stmt1->bind_result($total2); 
	$stmt1->fetch(); 
	$stmt1->close();
	
	$stmt3 = $mysqli->prepare("SELECT COUNT(username) FROM mouter WHERE username = '".$total."' and date='".date("d-m-Y")."'");
	$stmt3->execute();
	$stmt3->bind_result($total3); 
	$stmt3->fetch(); 
	$stmt3->close();
	
	if(($total2+$total3)%2==0){
		// put it in In
			echo 'Welcome '.$total;
						$myvar1=strtotime(date("h:i a")) + 5.5*60*60;
			$stmt2 = $mysqli->prepare("insert into minner values('".$total."','".date("d-m-Y",$myvar1)."','".date("h:i a",$myvar1)."')");
			$stmt2->execute();
	$stmt2->fetch(); 
	$stmt2->close();
	}
	else{
		// Put it in out
			echo 'Goodbye '.$total;
			$myvar=strtotime(date("h:i a")) + 5.5*60*60;
			$stmt3 = $mysqli->prepare("insert into mouter values('".$total."','".date("d-m-Y",$myvar)."','".date("h:i a",$myvar)."')");
			$stmt3->execute();
	$stmt3->fetch(); 
	$stmt3->close();
	
	}
		$mysqli->close();

}
?>
