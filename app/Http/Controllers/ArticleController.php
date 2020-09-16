<?php
namespace App\Http\Controllers;

use App\Http\Models\Article;    // 需要去掉bootstrap/app.php的$app->withEloquent()的注释;
use DB;                         // 需要去掉bootstrap/app.php的$app->withFacades()的注释;

class ArticleController{

    public function index_g($id){

        $res = Article::find($id);
        var_dump($res);
        var_dump($res->toArray());

    }

}