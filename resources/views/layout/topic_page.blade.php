{{-- 
    carousel:   -số lượt thích nhiều nhắt
                -số lượt comment nhiều nhất
                -số lượt view nhiều nhất 
    btn: xem tất cả -> chuyển đến 1 trang khác show toàn bộ bài viết      
    filter:     -time,..

--}}
@extends('layout.app-user') @push('styles')
<link rel="stylesheet" href="{{ URL::asset('css/style_topic_page.css'); }}" />
@endpush @section('content')
<div class="topic_page">
    <form action="" class="search_topic">
        <div class="input-group mb-3 input-group-lg">
            <button
                class="btn btn-outline-secondary"
                type="submit"
                id="button-addon1"
            >
                <i class="fas fa-search fa-lg"></i>
            </button>
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder=""
                aria-label="Example text with button addon"
                aria-describedby="button-addon1"
            />
        </div>
    </form>
    <div class="pin_container" id="alltopic"></div>
</div>
@endsection @push('scripts')
<script src="{{ URL::asset('js/user/topic_page.js'); }}"></script>
@endpush
