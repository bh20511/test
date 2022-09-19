<?php
require __DIR__.'/parts/connect_db.php';

$postData=[
    'name' => "陳小華's 愛犬",
    'email' =>'12wawa.ttt.com',
    'mobile' =>'0912345682',
    'birthday' =>'1998-05-21',
    'address' =>  '台東市', 
];



//sql injection sql隱碼攻擊



$sql = "INSERT INTO `address_book`(
    `name`,`email`,`mobile`,
    `birthday`,`address`,`created_at`)VALUES(
        ?,?,?,
        ?,?,NOW()
) ";

$stmt = $pdo -> prepare($sql);
$stmt-> execute([
$postData['name'],
$postData['email'],
$postData['mobile'],
$postData['birthday'],
$postData['address'],
]);

echo $stmt->rowCount();
