<?php
    include_once('../info.php');
    header('Location: ./b.php');

	extract($_POST);
	
	$sql = "UPDATE rma_item
			SET rma_item.status='".$status."'
			WHERE rma_item.uid = '".$uid."';";

    $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

    if(mysqli_connect_error()){
        exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

	$result = mysqli_query($mysqli, $sql);

	exit;
?>
