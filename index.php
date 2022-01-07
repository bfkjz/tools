<?php
header('Access-Control-Allow-Origin: *');
$geturl = urldecode($_SERVER['QUERY_STRING']);
function getIsPostRequest()
{
  return isset($_SERVER['REQUEST_METHOD']) && !strcasecmp($_SERVER['REQUEST_METHOD'],'POST');
}
if(getIsPostRequest())  {
    //是 post 请求
  $get_url_data = explode('?',$geturl)[1];
  parse_str($get_url_data,$headers);
  //var_dump($headers);
    //初始化
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl,CURLOPT_URL,$geturl);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 0);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0);
    curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS,$_POST);
    //执行命令
    $cont_data=curl_exec($curl);
    if(curl_errno($curl))
    {
        echo 'Error:' . curl_error($curl);
    }
    else
    {
        echo $cont_data;    
    }
    //关闭URL请求
    curl_close($curl);

} else {
    //是 get 请求
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$geturl); //设置访问的url地址
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//不输出内容
$result = curl_exec($ch);
curl_close ($ch);
echo $result;


}

?>
