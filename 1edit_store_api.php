<?php 
require __DIR__.'/parts/admin-required.php';
require __DIR__ . '/parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST, // 除錯用的
];

if(empty($_POST['name'])){
    $output['error'] = '參數不足';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE); 
    exit;
}

// TODO: 檢查欄位資料

$sql = "UPDATE `address_book` SET 
`name`=?,
`email`=?,
`mobile`=?,
`birthday`=?,
`address`=?
WHERE sid=?";

$stmt = $pdo->prepare($sql);

$birthday = null;
if(strtotime($_POST['birthday'])!==false){
    $birthday = $_POST['birthday'];
}


try {
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['mobile'],
        $birthday,
        $_POST['address'],
        $_POST['sid']
    ]);
} catch(PDOException $ex) {
    $output['error'] = $ex->getMessage();
}


if($stmt->rowCount()){
    $output['success'] = true;
} else {
    if(empty($output['error']))
        $output['error'] = '資料沒有修改';
}
echo json_encode($output, JSON_UNESCAPED_UNICODE); 