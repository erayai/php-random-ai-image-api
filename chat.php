<?php

$baseTargetUrl = 'https://text.pollinations.ai/';

// 处理GET请求
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $ch = curl_init();
    
    if (isset($_GET['prompt']) && !empty($_GET['prompt'])) {
        $targetUrl = $baseTargetUrl . urlencode($_GET['prompt']);
        
        curl_setopt($ch, CURLOPT_URL, $targetUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
        } else {
            echo $response;
        }
    } else {
        echo "The 'prompt' parameter is missing or empty.";
    }
    
    curl_close($ch);
}

// 处理POST请求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ch = curl_init();
    
    $postData = file_get_contents('php://input');
    curl_setopt($ch, CURLOPT_URL, $baseTargetUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($postData)
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    } else {
        // 封装返回的数据
$data = [
    "id" => "chatcmpl-ANJZGVj3VpFxVMDdyIY0U7SOPENAI",
    "choices" => [
        [
            "index" => 0,
            "message" => [
                "role" => "assistant",
                "content" => $response
            ],
            "logprobs" => null,
            "finish_reason" => "stop"
        ]
    ],
    "created" => time(),
    "model" => "openai",
    "object" => "chat.completion"
];
        
        echo json_encode($data);
    }
    
    curl_close($ch);
}

?>
