<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;


class Article extends Model{

    //默认情况下，Eloquent 预期你的数据表中存在 created_at 和 updated_at 两个字段 。
    //如果你不想让 Eloquent 自动管理这两个列， 请将模型中的 $timestamps 属性设置为 false：
    public $timestamps = false;

    //请注意，我们并没有告诉 Eloquent 我们的 Flight 模型使用哪个数据表。 除非明确地指定了其它名称，否则将使用类的复数形式来作为表名。
    //因此，在这种情况下，Eloquent 将假设 Flight 模型存储的是 flights 数据表中的数据。
    //你可以通过在模型上定义 table 属性来指定自定义数据表：
    public $table = 'article';

}