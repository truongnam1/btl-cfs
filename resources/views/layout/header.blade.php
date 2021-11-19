<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="{{ URL::asset('css/style_header.css'); }}" />
        <title>CFS</title>
    </head>
    <body>
        <header class="header">
            <nav class="header_navbar">
                <a class="header_navbar-title" href="">CFS</a>
                <ul class="header_navbar-pages">
                    <li class="page home_page">
                        <a href="{{ url('home_page') }}">Trang chủ</a>
                    </li>
                    <li class="page topic_page">
                        <a href="{{ url('topic_page') }}">Chủ đề</a>
                    </li>
                    <li class="page introduction_page">
                        <a href="">Giới thiệu</a>
                    </li>
                    <li class="header_navbar-item"><a href="">Liên hệ</a></li>
                </ul>
                <div class="header_navbar-actions">
                    <div class="action-link post">
                        <a href="">Tạo bài viết</a>
                    </div>
                    <div class="action-link register">
                        <a href="">Đăng ký</a>
                    </div>
                    <div class="action-link login">
                        <a href="">Đăng nhập</a>
                    </div>
                </div>
            </nav>
        </header>
    </body>
</html>
