@extends('layout.app-user')

@push('styles')
<link rel="stylesheet" href="{{ URL::asset('css/style_home_page.css'); }}" />
@endpush

@section('content')
<div class="home_page">
    <div class="pin_container">
        <div class="card card_small">
            <div class="card_title">Tiêu đề rất rất rất rất rất rất rất rất rất
                rất rất rất rất rất rất rất rất rất rất rất rất rất
                rất rất rất rất rất rất rất rất rất rất rất rất rất
                rất rất rất rất rất rất rất rất rất rất rất rất rất
                rất rất rất rất rất rất rất rất rất rất rất rất rất
                rất rất rất rất rất rất rất rất rất rất rất rất rất
                rất rất rất rất rất rất rất </div>
            <div class="card_content">
                <p>
                    đây là nội dung rất rất rất rất rất rất rất rất rất
                    rất rất rất rất rất rất rất rất rất rất rất rất rất
                    rất rất rất rất rất rất rất rất rất rất rất rất rất
                    rất rất rất rất rất rất rất rất rất rất rất rất rất
                    rất rất rất rất rất rất rất rất rất rất rất rất rất
                    rất rất rất rất rất rất rất rất rất rất rất rất rất
                    rất rất rất rất rất rất rất rất rất rất rất rất rất
                    rất rất rất rất rất rất rất rất rất rất rất rất rất
                    rất rất rất rất rất rất rất rất rất rất rất rất rất
                    rất rất rất rất rất rất rất rất rất rất rất rất rất
                    rất rất rất rất rất rất rất rất rất rất rất rất rất
                    rất rất rất rất rất rất rất rất rất rất rất rất rất
                    rất rất rất rất rất rất rất rất rất rất rất rất rất
                    rất rất rất rất rất rất rất rất rất rất rất rất rất
                    rất rất rất rất rất rất rất rất rất rất rất rất rất
                    rất rất rất dài
                </p>
            </div>
            <div class="card_status">
                <div class="like"><i class="fas fa-heart"></i>15</div>
                <div class="comment"><i class="fas fa-comment"></i>10</div>
                <div class="view"><i class="fas fa-eye"></i>50</div>
            </div>
        </div>
        <div class="card card_medium"></div>
        <div class="card card_large"></div>
        <div class="card card_medium"></div>
        <div class="card card_small"></div>
        <div class="card card_small"></div>
        <div class="card card_medium"></div>
        <div class="card card_large"></div>
        <div class="card card_small"></div>
        <div class="card card_large"></div>
        <div class="card card_medium"></div>
        <div class="card card_medium"></div>
        <div class="card card_small"></div>
        <div class="card card_small"></div>
    </div>
    <div class="reference">
        <form class="search" action="">
            <input type="text" class="search_field" placeholder="Tìm kiếm" name="search" />
        </form>
        <div class="hot_topic">
            <h1>Chủ đề hot</h1>
            <a href="">Mlem rất rất rất rất rất rất rất rất rất rất rất rất
                rất rất rất rất rất rất rất rất rất rất</a>
            <a href="">Học hànhh </a>
            <a href="">Kinh doanh buôn bán</a>
            <a href="">Ngôn ngữ lập trình</a>
            <a href="">Laptop gaming</a>
            <a href="">Học online</a>
            <a href="">Quận Hoàn Kiếm</a>
            <a href="">Topic 8</a>
            <a href="">Topic 9</a>
            <a href="">Topic 10</a>
            <a id="all_topic" href="">Hiển thị tất cả</a>
        </div>
    </div>
</div>
@endsection