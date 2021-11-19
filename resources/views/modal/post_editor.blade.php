<div class="modal fade" id="ModalCreatePost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tạo bài viết</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="">
                        <div class="input_title">
                            <label for="title">Nhập tiêu đề</label>
                            <input type="text" name="post_title" id="post_title" />
                        </div>

                        <div class="row d-flex mb-3">
                            <label for="">Tags</label>
                            <div class="col-md-12">
                                <select id="choices-multiple-remove-button" placeholder="Select tags" multiple></select>
                            </div>
                        </div>

                        <textarea name="post_content" id="post_content"></textarea>
                        <input type="button" name="submit_data" value="Publish" class="publish_btn" />
                    </form>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

{{-- post_editor --}}
<script type="text/javascript" src="{{ URL::asset('css/components/ckeditor/ckeditor.js') }}"></script>
<script>
    // CKEDITOR.replace("post_content");
</script>

{{-- multiSelectTag --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css" />
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

<script src="{{ URL::asset('js/user/tags.js'); }}"></script>

<script src="{{ URL::asset('js/user/post-editor.js'); }}"></script>