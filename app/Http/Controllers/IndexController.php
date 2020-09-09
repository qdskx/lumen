<?php
namespace App\Http\Controllers;

class IndexController {

    public function index_g($id){
        var_dump($id);
        $data = file_get_contents('php://input');   //获取不到
        var_dump($data);
        var_dump(json_decode($data , true));
    }

    public function index_p(){
        var_dump($_POST);
        $data = file_get_contents('php://input');
        var_dump($data);
        var_dump(json_decode($data , true));
    }

    public function index_put($id){
        var_dump($id);
        var_dump($_POST);
        $data = file_get_contents('php://input');
        var_dump($data);
        var_dump(json_decode($data , true));
        var_dump($_SERVER['REQUEST_METHOD']);
    }

    public function index_d($id){
        var_dump($id);
        $data = file_get_contents('php://input');
        var_dump($data);
        var_dump(json_decode($data , true));
        var_dump($_SERVER['REQUEST_METHOD']);
    }

    public function index(){
        $str = '{"supplierCode';
        var_dump(strlen($str));
        var_dump(mb_strlen($str , 'utf8'));
    }
}