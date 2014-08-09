<?php

// header指定
header("Content-Type: application/json; charset=utf-8");

// データベース接続情報
$hostname   = "mysql320.db.sakura.ne.jp";
$uname      = "yq-bin";
$upass      = "yq-bin-relay";
$dbname     = "yq-bin_relay";

// MySQLに接続
$con = mysqli_connect( $hostname, $uname, $upass, $dbname );
if( mysqli_connect_errno() ){
    error(500, sprintf("MySQL Connect Failed: %s", mysqli_connect_error()));
    exit(1);
}

// 文字セットをutf8に変更
if( !mysqli_set_charset($con, "utf8") ){
    error(500, sprintf("Error loading character set utf8: %s", mysqli_error($con)));
    exit(1);
}

// SQL文作成
$sql = "SELECT * FROM `yq-bin_relay`.`order`;";

// SELECT実行
$json = array();
if( $result = mysqli_query($con,$sql) ){
    while( $row = mysqli_fetch_assoc($result) ){
        array_push($json,$row);
    }
    mysqli_free_result($result);
}

// 接続クローズ
mysqli_close($con);

echo json_encode($json);

exit(0);

// エラーレスポンス
function error( $error_code, $error_msg ){
    $json = array(
        'error_code'    => $error_code,
        'error_msg'     => $error_msg,
    );
    echo json_encode($json);
}

?>
