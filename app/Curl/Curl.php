<?php
namespace App\Curl;

class Curl{

    // 将https的地址转换成http的地址
    const HTTPS_TO_HTTP_HOSTS = [
        'https://' => ['to'=>'http://'],
    ];

    public static function curlPost($url,$data,$postConfig=[],$cookie=''){

        // 是否是https
        $https = false;
        if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) $https = true ;
        $httpsToHttp = $postConfig['httpsToHttp'] ?? false;
        // 是否将指定的https的域名换成http的 true:是(否) false:否
        if($httpsToHttp) $url = self::httpsToHttp ($url);
        $checkSslDiff = $postConfig['ssl_diff'] ?? false ;

        // post参数是否需要http_build_query处理
        $dataHandle = $postConfig['dataHandle'] ?? false;
        if($dataHandle)$data = http_build_query($data);

        $isLogin = $postConfig['isLogin'] ?? false;

        $timeOut = $postConfig['timeOut'] ?? 60;

        $ch = curl_init((string)$url);
//        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HEADER, array("cookie: $cookie",));
        // 不检测证书的不同
        if($https && !$checkSslDiff){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        // 需要登陆的话传入cookie
        if($isLogin)curl_setopt($ch,CURLOPT_COOKIE,$cookie);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_TIMEOUT,(int)$timeOut);
        $output = curl_exec($ch);
        echo curl_error($ch);
        curl_close($ch);

        return $output;
    }

    public static function curlGet($url,$postConfig=[],$cookie=''){

        // 是否是https
        $https = false;
        if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) $https = true ;
        $httpsToHttp = $postConfig['httpsToHttp'] ?? false;
        // 是否将指定的https的域名换成http的 true:是(否) false:否
        if($httpsToHttp) $url = self::httpsToHttp ($url);
        $checkSslDiff = $postConfig['ssl_diff'] ?? false ;

        $isLogin = $postConfig['isLogin'] ?? false;

        $timeOut = $postConfig['timeOut'] ?? 60;

        $ch = curl_init((string)$url);
//        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HEADER, array("cookie: $cookie",));
        // 不检测证书的不同
        if($https && !$checkSslDiff){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        // 需要登陆的话传入cookie
        if($isLogin)curl_setopt($ch,CURLOPT_COOKIE,$cookie);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_TIMEOUT,(int)$timeOut);
        $output = curl_exec($ch);
        echo curl_error($ch);
        curl_close($ch);

        var_dump('$output' , $output);

        return $output;
    }

    // 将https的地址转换成http的地址
    public static function httpsToHttp($url){
        $hosts = self::HTTP_TO_HTTP_HOSTS;
        if(!$hosts || !is_array($hosts))return $url;
        foreach($hosts as $host => $val){
            $length = strlen($host);
            $lengthUrl = strlen($url);
            $toUrl = $val['to'] ?? '';
            if(!$toUrl) continue;
            if($length>$lengthUrl) continue;
            if(substr($url, 0 , $length) == $host){
                $url = substr_replace($url, $toUrl, 0 , $length);
                break;
            }
        }
        return $url;
    }
}
