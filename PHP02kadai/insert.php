<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$name = $_POST['name'];
$url = $_POST['url'];
$coment = $_POST['coment'];

//2. DB接続します
try {
  //ID MAMP ='root'
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_bm;charset=utf8;host=localhost','root','root');
} catch(PDOException $e){
  exit('DBConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成
$stmt=$pdo->prepare("INSERT INTO gs_bm_table(id,name,url,coment,indate)VALUES(NULL,:name,:url,:coment,sysdate())");
$stmt->bindValue(':name',$name,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url',$url,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':coment',$coment,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status=$stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:".$error[2]);
}else{
//5.index.phpへリダイレクト
header('Location: index.php');

}
?>
