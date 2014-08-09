<?php
	//POSTされたデータ
	$orderUSER = $_POST["user"];
	$orderSTART =  $_POST["start"];
	$orderGOAL = $_POST["goal"];
	$orderTEMP = $_POST["temp"];

	echo $orderUSER;
	echo $orderSTART;
	echo $orderGOAL;
	
	$sql = "";

	//データベース接続情報
	$dbType = "mysql";
	$dbTable = "advertise";
	$hostname = "mysql320.db.sakura.ne.jp";
	$uname = "yq-bin";
	$upass = "yq-bin-relay";
	$dbname = "yq-bin_relay";

	//MySQL に接続する。
	if( !$res_dbcon = mysqli_connect( $hostname, $uname, $upass) ){
		print "MYSQL への接続に失敗しました。";
		exit;
	}

	$con=mysqli_connect($hostname,$uname,$upass,$dbname);
	/* 文字セットを utf8 に変更します */
	if (!mysqli_set_charset($con, "utf8")) {
	    printf("Error loading character set utf8: %s\n", mysqli_error($con));
	} else {
	    printf("Current character set: %s\n", mysqli_character_set_name($con));
	}

	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	//$sql = "INSERT INTO `yq-bin_relay`.`order` (`ID`, `USERNAME`, `START`, `GOAL`, `DATE`, `TEMP`) VALUES (NULL, \'$orderUSER\', \'$orderSTART\', \'$orderGOAL\', $orderDATE, NULL);";
	$sql = "INSERT INTO `yq-bin_relay`.`order` (`ID`, `USERNAME`, `START`, `GOAL`, `DATE`, `TEMP`) VALUES (NULL, '$orderUSER', '$orderSTART', '$orderGOAL', CURRENT_TIMESTAMP, NULL);";
	mysqli_query($con,$sql);
	mysqli_close($con);

?>
