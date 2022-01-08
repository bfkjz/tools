<?php
header('Access-Control-Allow-Origin: *');
echo "<p>http://域名/api.php?http://api.xxx.xxx</p>";
$geturl = urldecode($_SERVER['QUERY_STRING']);
$method = $_SERVER['REQUEST_METHOD'];
$headers =apache_request_headers();
//var_dump($headers);
//var_dump($_POST);
$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $geturl); 
if ($method == 'POST') {
    curl_setopt($ch, CURLOPT_POST, 1);   //定义提交类型 1：POST ；0：GET 
} elseif ($method == 'GET') {
    curl_setopt($ch, CURLOPT_POST, 0);   //定义提交类型 1：POST ；0：GET 
} elseif ($method == 'PUT') {
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "put");
} elseif ($method == 'DELETE') {
    echo "Method is DELETE\n";
    echo "未设置 DELETE 请求 | ";
} else {
    echo "Method unknown\n";
    echo "未定义 ".$method." 请求模式 | ";
}
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HEADER,0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST); 
    $res = curl_exec($ch);
    if(curl_errno($ch)){
        echo 'Error:' . curl_error($ch);
    }else{
    echo $res;
    }
    curl_close($ch);//关闭

?>
