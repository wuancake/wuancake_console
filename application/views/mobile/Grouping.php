<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>grouping</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/mobile/css/base.css"/>
    <link rel="stylesheet" href="/public/mobile/css/public.css"/>

    <style>


    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="title">
    <h2>午安煎饼计划</h2>
</div>


<div class="grouping">
    <p class="text-center">选择要加入的分组</p>

    <form class="genre" action="/index.php/user/join_group" method="post">
        <label class="radio-inline">
            <input type="radio" name="genre" id="PHP" value="1">PHP组
        </label>
        <label class="radio-inline">
            <input type="radio" name="genre" id="Web" value="2">Web前端组
        </label>
        <label class="radio-inline">
            <input type="radio" name="genre" id="UI" value="3">UI设计组
        </label>
        <label class="radio-inline">
            <input type="radio" name="genre" id="Android" value="4">Android组
        </label>
        <label class="radio-inline">
            <input type="radio" name="genre" id="PM" value="5">产品经理组
        </label>
        <label class="radio-inline">
            <input type="radio" name="genre" id="QA" value="6">软件测试组
        </label>
        <label class="radio-inline">
            <input type="radio" name="genre" id="Java" value="7">Java组
        </label>
        <div class="center-block">
            <button id="genreBtn" type="submit" class="btn btn-default">确定</button>
        </div>
    </form>


</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>
