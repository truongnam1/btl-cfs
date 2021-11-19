@extends('layout.app-user')

@push('styles')
<link rel="stylesheet" href="{{ URL::asset('css/style_profile_page.css'); }}" />
@endpush

@section('content')
<div class="container">
   <div class="main-body">
      <div class="row">
         <div class="col-lg-4">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                     <img src="{{$userFirebase->photoUrl ?? 'https://bootdey.com/img/Content/avatar/avatar6.png'}}"
                        alt="{{$userFirebase->displayName}}" class="rounded-circle p-1 bg-light" width="110">
                     <div class="mt-3">
                        <h4 class="name" id='{{$user_id}}'>{{$userFirebase->displayName}}</h4>
                        {{-- <p class="text-secondary mb-1">Full Stack Developer</p>
                        <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                        <button class="btn btn-primary">Follow</button>
                        <button class="btn btn-outline-primary">Message</button> --}}
                     </div>
                  </div>
                  {{--
                  <hr class="my-4">
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-globe me-2 icon-inline">
                              <circle cx="12" cy="12" r="10"></circle>
                              <line x1="2" y1="12" x2="22" y2="12"></line>
                              <path
                                 d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                              </path>
                           </svg>Website</h6>
                        <span class="text-secondary">https://bootdey.com</span>
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-github me-2 icon-inline">
                              <path
                                 d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                              </path>
                           </svg>Github</h6>
                        <span class="text-secondary">bootdey</span>
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-twitter me-2 icon-inline text-info">
                              <path
                                 d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                              </path>
                           </svg>Twitter</h6>
                        <span class="text-secondary">@bootdey</span>
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-instagram me-2 icon-inline text-danger">
                              <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                              <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                              <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                           </svg>Instagram</h6>
                        <span class="text-secondary">bootdey</span>
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-facebook me-2 icon-inline text-primary">
                              <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                           </svg>Facebook</h6>
                        <span class="text-secondary">bootdey</span>
                     </li>
                  </ul> --}}
               </div>
            </div>
         </div>
         <div class="col-lg-8">

            {{-- đổi tên, đổi mật khẩu ở page khác --}}

            {{-- <div class="card">
               <div class="card-body">

                  <div class="row mb-3">
                     <div class="col-sm-3">
                        <h6 class="mb-0">Full Name</h6>
                     </div>
                     <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" value="John Doe">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                     </div>
                     <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" value="john@example.com">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="col-sm-3">
                        <h6 class="mb-0">Phone</h6>
                     </div>
                     <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" value="(239) 816-9029">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="col-sm-3">
                        <h6 class="mb-0">Mobile</h6>
                     </div>
                     <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" value="(320) 380-4539">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="col-sm-3">
                        <h6 class="mb-0">Address</h6>
                     </div>
                     <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" value="Bay Area, San Francisco, CA">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-3"></div>
                     <div class="col-sm-9 text-secondary">
                        <input type="button" class="btn btn-primary px-4" value="Lưu">
                     </div>
                  </div>
               </div>
            </div> --}}
            <div class="row">
               <div class="col-sm-12" id="post-container">
                  <div class="card header">
                     <h2>Posts</h2>
                  </div>
                  {{-- lấy post bằng api --}}

                  {{-- <div class="card">
                     <button type="button" class="btn-close"></button>
                     <h1 class="post_title">Đây là title</h1>
                     <div class="post_status">
                        <i class="far fa-clock"></i>
                        <div class="time"> 25-02-2021 18:25 GMT+7</div>
                        <i class="fas fa-heart"></i>
                        <div class="like">15</div><label for=""> Lượt thích</label>
                        <i class="fas fa-comment"></i>
                        <div class="comment">10</div><label for=""> Lượt bình luận</label>
                        <i class="fas fa-eye"></i>
                        <div class="view">50</div><label for=""> Lượt xem</label>
                     </div>
                     <div class="post_content">NGA THỰC HIỆN BỘ PHIM ĐIỆN ẢNH ĐẦU TIÊN ĐƯỢC QUAY NGOÀI VŨ TRỤ Nếu như
                        Hollywood được xem như là nơi thực hiện những bom tấn khủng lấy đề tài về vũ trụ nhưng chỉ quay
                        với những phông xanh thì ở "Hành tinh Nga" đã đưa cả đạo diễn và diễn viên lên Trạm không gian
                        Quốc tế (ISS) để quay phim thật ngoài không gian. Theo truyền thông Nga đưa tin, sáng nay tàu vũ
                        trụ Soyuz MS-19 mang theo phi hành gia Anton Shkaplerov, nữ diễn viên Yulia Peresild và đạo diễn
                        điện ảnh Klim Shipenko lên trạm ISS để thực hiện bộ phim điện ảnh mang tên 'Challenge', là sự
                        hợp tác của Cơ quan vũ trụ Liên bang Nga Roscomos, kênh truyền hình TV Channel One và hãng phim
                        Yellow, Black and White. Bộ phim kể về một bác sĩ phẫu thuật phải tiến hành cứu chữa phi hành
                        gia bị ốm trong vũ trụ bởi tình trạng sức khỏe không cho phép bệnh nhân bay về Trái Đất. Ngoài
                        diễn viên là bác sĩ phẫu thuật là nữ diễn viên Yulia Peresild thì các vai diễn còn lại đều chính
                        do các phi hành gia tại trạm ISS thực hiện. Trước đó, bên Hollywood cũng công bố dự án phim điện
                        ảnh Hollywood đầu tiên quay ngoài không gian do Tom Cruise đóng chính. Dự án này hiện vẫn đang
                        trong khâu phát triển. Nguồn: tổng hợp từ Zingnews và VNExpressđ</div>
                  </div> --}}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDeletePost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Xoá bài viết</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         Bài viết sẽ không thể khôi phuc khi bị xoá
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
         <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="deletePost()">Đồng ý</button>
       </div>
     </div>
   </div>
 </div>

@endsection

@push('scripts')
<script src="{{ URL::asset('js/user/post_user.js'); }}"></script>
@endpush