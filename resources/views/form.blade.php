<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$_POST php://input在Post请求上传文件时有什么不同</title>
</head>
<body>
{{--<form action="article" method="post" enctype="multipart/form-data">--}}
<form action="article" method="post" enctype="text/plain">
{{--    <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
    <input type="file" name="up" value="fg">
    <input type="text" name="tt" >
    <input type="submit" value="提交">
</form>
</body>
</html>