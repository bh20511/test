<?php require __DIR__ . '/parts/connect_db2.php';
$pageName = 'list';

$rows = [];
// 如果有資料
    $sql ="SELECT * FROM product_category";
    
    $rows = $pdo->query($sql)->fetchAll();

    echo json_encode($rows,JSON_UNESCAPED_UNICODE);