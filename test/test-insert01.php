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



$sql = sprintf("INSERT INTO `address_book`(
    `name`,`email`,`mobile`,
    `birthday`,`address`,`created_at`)VALUES(
        %s,%s,%s,
        %s,%s,NOW()
) ",

$pdo->quote($postData['name']),
$pdo->quote($postData['email']),
$pdo->quote($postData['mobile']),
$pdo->quote($postData['birthday']),
$pdo->quote($postData['address']),
);

$stmt = $pdo->query($sql);
echo $stmt->rowCount();

?>