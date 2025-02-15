<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();
//POST値
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
//1.  DB接続します
include("funcs1.php");
$pdo = db_conn();

// //2. データ登録SQL作成

// $sql = "SELECT * FROM gs_user_table WHERE lid=:id";
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':id', $lid);
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid = :lid AND lpw = :lpw");
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();
//3. SQL実行時にエラーがある場合STOP
if ($status == false) {
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()


//5. 該当レコードがあればSESSIONに値を代入
// if(password_verify($lpw, $val["lpw"])){ //* PasswordがHash化の場合はこっちのIFを使う
if ($val["id"] != "") {
    //Login成功時
    $_SESSION["chk_ssid"]  = session_id();
    $_SESSION["kanri_flg"] = $val['kanri_flg'];
    $_SESSION["name"]      = $val['name'];
    // print_r('ログインに成功しました');
    header('Location: select1.php');
    // header('Location: detail1.php');
} else {
    //Login失敗時(Logout経由)
    // header('Location: login.php');
    header('Location: index1.php');
    // print_r('ログインに失敗しました');
}
exit();