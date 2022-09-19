<?php
header('Content-Type: application/json');

$folder = __DIR__. '/uploads/'; // 上傳檔案的資料夾

$extMap = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
];

$output = [
    'success' => false,
    'error' => '',
    'data' => [],
    'files' => $_FILES, // 除錯用
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

$output['success'] = true;

echo json_encode($output, JSON_UNESCAPED_UNICODE);
