<?php
// 获取分类参数
$category = $_GET['category'];

// 根据设备类型确定分类文件名
if (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false) {
    $fileName = 'mob-' . $category . '.txt';  // 手机设备
} else {
    $fileName = 'pc-' . $category . '.txt';   // PC 设备
}

// 定义图片文件夹路径和分类文件名
$imageFolder = 'imgtxt/';
$file = $imageFolder . $fileName;

// 检查文件是否存在
if (file_exists($file)) {
    // 读取文件内容
    $images = file($file, FILE_IGNORE_NEW_LINES);

    // 输出为 JSON 格式
    echo json_encode($images);
} else {
    // 如果文件不存在，返回空数组
    echo json_encode([]);
}
?>
