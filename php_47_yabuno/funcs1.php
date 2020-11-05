<?php

session_start();


//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()

function db_conn()
{

try {
    $db_name = "gs_php03";    //データベース名
    $db_id   = "root";      //アカウント名
    $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
    $db_host = "localhost"; //DBホスト
    $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
    // これが必要（追加）
    return $pdo;

} catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage());
}
}
//SQLエラー関数：sql_error($stmt)
function sql_error($stmt)
{
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);

}

//リダイレクト関数: redirect($file_name)
function redirect($file_name)
{
header("Location" . $file_name);
    exit();
}


// ログインチェク処理
function sessionCheck()
{
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()) {
        // ログインに異常がある人
        exit('LOGIN Error');
    } else {
        // ログインokな人
        // SES ID を新しくしてあげる。
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }

}