<?php 
require __DIR__ . '/parts/connect_db2.php';
$folder = __DIR__. '/store/';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST // 除錯用的
];

if(empty($_POST['store_name'])){
    $output['error'] = '參數不足';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE); 
    exit;
}

// TODO: 檢查欄位資料

$sql = "UPDATE `store` SET 
`store_name`=?,
`store_address`=?
WHERE store_sid=?";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        $_POST['store_name'],
        $_POST['store_address'],
        $_POST['store_sid']
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