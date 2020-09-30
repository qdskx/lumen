<?php
namespace App\Http\Controllers\zzshop;
use App\Curl\Curl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderlistController extends Controller{

    public function orderList(){

        $cookie = 'JSESSIONID=78367367ACA9463C6DEA89C0C6570879; ROLTPAToken=PExUUEFUb2tlbj48bm9kZT5SMUZyYW1ld29yazQuMDwvbm9kZT48dGltZT4xNjAxMzUxMzA0NzgyPC90aW1lPjx1c2VyaWQ%2BNzQzMzI4ODE2PC91c2VyaWQ%2BPHBlcnNvbnV1aWQ%2BNUU1NjJEODAxQzlDMjRCMUE3MEI3MDE1NTc2QzY1MjA8L3BlcnNvbnV1aWQ%2BPHN5c2lkPi0xPC9zeXNpZD48L0xUUEFUb2tlbj4%3D';
        $url = 'http://zzds.gpmart.cn/gs4/gs4onlineretailers/supplyQuery';

        $postConfig['isLogin'] = true;
        $data['page'] = 10;
        $data['rows'] = 1;

//        $res = Curl::curlPost($url , $data , $postConfig , $cookie);

        $res = file_get_contents('2.php');

        $page_res = preg_match('/共<em class="blue">(.*?)<\/em>页/' , $res , $page);
        if(!empty($page_res)){
            $page_count = $page[1];
            for($i=1;$i<=$page_count;$i++){
                $data['rows'] = $i;

//                $result = Curl::curlPost($url , $data , $postConfig , $cookie);

                $single_order_res = preg_match_all('/<div[\s]*class="single-order">[\s]*(.*)[\s]*<\/div>/' , $res , $single_order);
                $order_status_res = preg_match_all('/<td class="order-kind right-border" style="width: 60px;">[\s]*(.*)[\s]*<\/td>/' , $res , $order_status);
                var_dump($single_order_res);
                var_dump($order_status_res);
                die;
                if(!empty($order_status_res) && !empty($single_order_res)){
                    foreach($order_status as $order_status_key => $order_status_val){
                        if($order_status_val != '确认验收'){
                            $order_info_res = $single_order[1][$order_status_key];
                            var_dump($order_info_res);
                            $orderid_res = preg_match('/<i class="order-no">(.*)</i>/' , $order_info_res , $orderids);
                            $date_res = preg_match('/<i class="deal-date">(.*).0</i>/' , $order_info_res , $dates);
                            $total_money_res = preg_match('/<td class="buyer right-border" style="width: 97px; color: red; ">[\s]*￥(.*)[\s]*<\/td>/' , $order_info_res , $total_moneys);

                            $orderid = empty($orderid_res) ? '无效的订单id' : $orderids[1];
                            $date = empty($date_res) ? '无效的时间' : $dates[1];
                            $money = empty($total_money_res) ? '无效的价格' : $total_moneys[1];

                            var_dump($orderid , $date , $money);
                            die;

                            //发送通知消息
                        }
                    }
                }



            }
        }

    }

    public function test(){
        $res = file_get_contents('1.php');
        $single_order_res = preg_match_all('/<div[\s]*class="single-order">[\s]*<div class="order-profile">(.*)[\s]*<\/div>/' , $res , $single_order);

        var_dump($single_order_res);
        var_dump($single_order);
    }

    public function send(){
        Mail::send('emails.welcome', ['key' => 'value'], function($message)
        {
            $message->to('2608153909@qq.com', '我')->subject('Welcome!');
        });
    }
}