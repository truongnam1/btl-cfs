@extends('layout.app-user') @push('styles')
<link rel="stylesheet" href="{{ URL::asset('css/style_post_page.css'); }}" />
<link rel="stylesheet" href="{{ URL::asset('css/style_detail_post.css'); }}" />
@endpush @section('content')
<div class="page_post">
    <div class="content_container">
        <div class="content_container-post">
            <h1 class="title" id="title-post" id-post="{{$post->id}}" style="word-wrap: break-word">
                {{$post->title}}
            </h1>
            <div class="status">
                <i class="far fa-clock"></i>
                <div class="time">{{$post->created_at}}</div>
                <i class="fas fa-heart"></i>
                <div class="like">{{$post->reacts['total']}}</div>
                &nbspLượt thích
                <i class="fas fa-comment"></i>
                <div class="comment">{{$post->comments['total']}}</div>
                &nbspLượt bình luận
                <i class="fas fa-eye"></i>
                <div class="view">{{$post->views['total']}}</div>
                &nbspLượt xem
            </div>

            <div class="post_content" id="post-content1">
                {!!$post->content!!}
            </div>
        </div>
    </div>
    <div class="reference">
        <div class="reference_actions">
            <div class="action like" id="action-like">
                <i class="fas fa-heart fa-lg"></i>
            </div>
            <div class="action share">
                <i class="fas fa-share-alt fa-lg"></i>
            </div>
            <div
                class="action information"
                data-bs-toggle="modal"
                data-bs-target="#ModalDetailPost"
            >
                <i class="fas fa-info-circle fa-lg"></i>
            </div>
        </div>
        <div class="reference_comment">
            <h2>Bình luận</h2>
            <div class="comment_box" id="commentBox"></div>
           
                <input
                    type="text"
                    class="comment_post_field"
                    id="contentComment"
                    placeholder="   Viết bình luận"
                    name="comment_content"
                />
                <input type="button" class="btn btn-secondary" id="submitComment" value="Gửi"/>

        </div>
    </div>
</div>
@include('modal.detail_post') @endsection @push('scripts')
<script src="{{ URL::asset('js/user/react-like.js'); }}"></script>
<script src="{{ URL::asset('js/user/detail-post.js'); }}"></script>
<script src="{{ URL::asset('js/user/comment.js'); }}"></script>
@endpush
