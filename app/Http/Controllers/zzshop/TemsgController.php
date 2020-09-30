<?php
namespace App\Http\Controllers\zzshop;
use App\Curl\Curl;
use App\Email\PHPMailer;
use App\Email\SMTP;
use App\Http\Controllers\Controller;

class TemsgController extends Controller{

    public function sendEmail(){
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

            //服务器配置
            $mail->CharSet ="UTF-8";                     //设定邮件编码
            $mail->SMTPDebug = 0;                        // 调试模式输出
            $mail->isSMTP();                             // 使用SMTP
            $mail->Host = 'smtp.163.com';                // SMTP服务器
            $mail->SMTPAuth = true;                      // 允许 SMTP 认证
            $mail->Username = 'skx9314@163.com';                // SMTP 用户名  即邮箱的用户名
            $mail->Password = 'TVSCTUYUEWEVWKKD';             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
            $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
            $mail->Port = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

            $mail->setFrom('skx9314@163.com', 'skx9314');  //发件人
            $mail->addAddress('2608153909@qq.com', 'Tenny');  // 收件人
            //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
            $mail->addReplyTo('skx9314@163.com', 'skx9314'); //回复的时候回复给哪个邮箱 建议和发件人一致
            //Content
            $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $mail->Subject = '测试' . time();
            $mail->Body    = '<h1>测试呢我</h1>' . date('Y-m-d H:i:s');
            $mail->AltBody = '现不现实';

            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "Message sent success!";
            }
    }

}