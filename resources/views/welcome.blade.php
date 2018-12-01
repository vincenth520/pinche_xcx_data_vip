<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/app.css">
        <link rel="stylesheet" href="css/common.css">
        <title>同城拼车后台管理系统</title>
        <style>
            input[type="file"] {
                display: none;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <app></app>
        </div>
    </body>
</html>
<script>
    const AppUrl = '{{ Request::getSchemeAndHttpHost() }}';
</script>
<script src="js/app.js"></script>
