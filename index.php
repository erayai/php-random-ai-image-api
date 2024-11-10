<?php
// 获取GET参数中的prompt
$prompt = isset($_GET['prompt']) ? $_GET['prompt'] : '';
 
// 判断prompt是否存在且不为空
if (empty($prompt)) {
    die('Prompt parameter is missing or empty.');
}
 
// 定义目录和文件名
$dir = "content";
// 取prompt的前12位内容，如果长度小于12，则直接使用prompt
$promptShort = strlen($prompt) > 12 ? substr($prompt, 0, 12) : $prompt;
$filename = $promptShort . '-' . date('Y-m-d') . '.jpg';
$filepath = $dir . '/' . $filename;
 
// 判断/content目录是否存在，如果不存在则创建该目录
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}
 
// 判断/content目录下是否存在今天的该prompt图片
if (file_exists($filepath)) {
    header('Location: ' . $filepath);
    exit;
} else {
    // 请求API获取图片
    $apiUrl = 'https://image.pollinations.ai/prompt/' . $prompt;
    $imageContent = file_get_contents($apiUrl);
 
    // 保存图片到/content目录下
    file_put_contents($filepath, $imageContent);
 
    // 跳转到该图片
    header('Location: ' . $filepath);
    exit;
}
?>
