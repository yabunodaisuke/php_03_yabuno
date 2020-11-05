<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$price  = $_POST["price"];
$text = $_POST["text"];
// $kanri_flg = $_POST["kanri_flg"];
// $age    = $_POST["age"];
$id    = $_POST["id"];
// var_dump($id);


include("funcs1.php");
$pdo = db_conn();
//３．データ登録SQL作成
// $stmt = $pdo->prepare('UPDATE FROM gs_user_table WHERE id = :id');
$stmt = $pdo->prepare("UPDATE gs_an_table SET name=:name,price=:price,text=:text WHERE id=:id");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':price', $price, PDO::PARAM_INT);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':text', $text, PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':kanri_flg', h($kanri_flg), PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':naiyou', h($naiyou), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行



//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect("select1.php");
}
