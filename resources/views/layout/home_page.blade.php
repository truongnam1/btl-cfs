@extends('layout.app-user') @push('styles')
<link rel="stylesheet" href="{{ URL::asset('css/style_home_page.css'); }}" />
@endpush @section('content')
<div class="home_page">
    
    @isset($topicName)
        <style>
            .pin_container {
                margin-top: 1.55rem;
            }
            .topicName {
                position: relative;
                top: -1.54rem;
                z-index: 1;
                margin-left: 10px;
                margin-bottom: 0;
                font-size: 1.5rem;
                font-weight: 600;
                padding: 0.4rem 0;
            }

        </style>
    @endisset
    <div class="pin_container" id="pin_container">
        @isset($topicName)
        
        {{-- <div class="topicName" id="{{ $topicId }}"> --}}
            <h2 class="topicName" id="{{ $topicId }}">Chủ đề {{ $topicName }}</h2>
        {{-- </div> --}}
        @endisset
        <div id="load_data_message"></div>
    </div>

    <div class="reference">
        <form class="search" action="">
            <input type="text" class="search_field" placeholder="Tìm kiếm" name="search" />
        </form>
        <div class="hot_topic" id="hotTopic">
            <h2 class="hot-title-topic">Chủ đề hot</h2>
            <a id="all_topic" href="{{ route('topic_page') }}">Hiển thị tất cả</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ URL::asset('js/user/post_all.js'); }}"></script>
<script src="{{ URL::asset('js/user/hot_tags.js'); }}"></script>
@endpush