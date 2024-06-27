<?php
// 获取请求中的 category 参数
$category = isset($_GET['category']) ? $_GET['category'] : null;

// 定义文件路径
$imgtxt_path = 'imgtxt/';
$default_pc_file = $imgtxt_path . 'pc-random.txt';
$default_mob_file = $imgtxt_path . 'mob-random.txt';
$default_file = $imgtxt_path . 'rimg.txt';

// 判断设备类型函数
function isMobile() {
    return preg_match('/(android|iphone|ipad|mobile)/i', $_SERVER['HTTP_USER_AGENT']);
}

// 根据分类获取文件路径
function getFilePath($category) {
    global $imgtxt_path;
    if ($category) {
        if (isMobile()) {
            $file = $imgtxt_path . 'mob-' . $category . '.txt';
        } else {
            $file = $imgtxt_path . 'pc-' . $category . '.txt';
        }
        if (file_exists($file)) {
            return $file;
        }
    }
    return null;
}

// 从文件中随机选择一行
function getRandomLine($filePath) {
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return $lines[array_rand($lines)];
}

// 获取图片链接
if ($category) {
    $filePath = getFilePath($category);
    if (!$filePath) {
        header("HTTP/1.0 404 Not Found");
        echo "Category not found.";
        exit;
    }
} else {
    if (isMobile()) {
        $filePath = $default_mob_file;
    } else {
        $filePath = $default_pc_file;
    }
    if (!file_exists($filePath)) {
        $filePath = $default_file;
    }
}

$imageUrl = getRandomLine($filePath);
if ($imageUrl) {
    header('Content-Type: image/jpeg');
    readfile($imageUrl);
} else {
    header("HTTP/1.0 404 Not Found");
    echo "Image not found.";
}
?>
