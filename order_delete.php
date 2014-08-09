<?php

// header指定
header("Content-Type: application/json; charset=utf-8");

// 引数取得
$ids = $_GET["id"];
if( $ids === false || $ids === '' || $ids === null ){
    error(400, 'There is no argument id');
    exit(1);
}

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

// IDを分割
$ids = explode(",",$ids);

// DELETE処理
foreach( $ids as $id ){
    // SQL文作成
    $sql = "DELETE FROM `yq-bin_relay`.`order` WHERE ID = $id;";

    // SELECT実行
    if( !mysqli_query($con,$sql) ){
        error(500, sprintf("Error: %s", mysqli_error($con)));
        exit(1);
    }
}

// 接続クローズ
mysqli_close($con);

$json = array(
    'results'   =>  'delete success'
);

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
