<?php 
require __DIR__.'/parts/connect_db2.php';

$folder = __DIR__. '/rental/';

$extMap = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
];

    
$output = [
    'success' => false,
    'error' => '',
    'data' => [],
    'files' => $_FILES, // 除錯用
    'post1' => $_POST['name'],
    'post2' => $_POST['sid'],
    'post3' => $_POST['price'],

];

if(empty($_FILES['single'])){
    $output['error'] = '沒有上傳檔案';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 副檔名對應
$ext = $extMap[$_FILES['single']['type']];
if(empty($ext)){
    $output['error'] = '檔案格式錯誤: 要 jpeg, png';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 隨機檔名
$filename = md5($_FILES['single']['name']. uniqid()). $ext;
$output['filename'] = $filename;


if(! 
    move_uploaded_file(
        $_FILES['single']['tmp_name'],
        $folder. $filename
    )
) {
    $output['error'] = '無法移動上傳檔案, 注意資料夾權限問題';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}








if(empty($_POST['name']) OR empty($_POST['price'])){
    $output['error'] = '沒有足夠資訊';
    $output['code'] = 400;
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `rental`(
    `rental_product_name`,`product_category_sid`,`rental_price`,`rental_img`
)VALUES(?,?,?,?)";

$stmt = $pdo->prepare($sql);

$sql = "INSERT INTO `store`(
    `store_name`,`store_address`,`store_img`
)VALUES(?,?,?)";

try{
$stmt->execute([
    $_POST['name'],
    $_POST['sid'],
    $_POST['price'],
    $filename,
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