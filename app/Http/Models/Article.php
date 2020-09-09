<?php
namespace App\Http\Models;

class Article{

    public function getData($id){
        $sql = "select * from article where id = $id"
    }
}