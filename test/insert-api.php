<?php 
require __DIR__.'/parts/connect_db.php';


$output = [
    'success' => false,
    'error' => '',
    'code'=> 0,
    'postData' =>$_POST,
];

if(empty($_POST['name'])){
    $output['error'] = '參數不足';
    $output['code'] = 400;
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `address_book`(
    `name`,`email`,`mobile`,`birthday`,`address`,`created_at`
)VALUES(?,?,?,?,?,NOW())";

$stmt = $pdo->prepare($sql);

$birthday = null;
if(strtotime($_POST['birthday']!==false)){
    $birthday = $_POST['birthday'];
}
try{
$stmt->execute([
    $_POST['name'],
    $_POST['email'],
    $_POST['mobile'],
    $_POST['birthday'],
    $_POST['address'],
]);
} catch(PDOException $ex){
    $output['error'] =$ex->getMessage();
}

if($stmt->rowCount()){
    $output['success']= true;
}else{
    $output['error'] = '資料庫沒有新增';
}

echo json_encode($output,JSON_UNESCAPED_UNICODE);
?>