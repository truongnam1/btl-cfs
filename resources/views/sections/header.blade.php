<header class="header">
    <nav class="header_navbar">
        <a class="header_navbar-title" href="{{ route('home') }}">CFS</a>
        <ul class="header_navbar-pages">
            <li class="page home_page">
                <a href="{{ route('home') }}">Trang chủ</a>
            </li>
            <li class="page topic_page">
                <a href="{{ route('topic_page') }}">Chủ đề</a>
            </li>
            <li class="page introduction_page">
                <a href="">Giới thiệu</a>
            </li>
            <li class="header_navbar-item"><a href="#">Liên hệ</a></li>
        </ul>
        <div class="header_navbar-actions">
            @auth
            <div class="action-link post">
                <a a href="#" data-bs-toggle="modal" data-bs-target="#ModalCreatePost">Tạo bài viết</a>
            </div>
            @endauth @guest
            <div class="action-link register">
                <a href="#" data-bs-toggle="modal" data-bs-target="#ModalLogin">Đăng ký</a>
            </div>
            <div class="action-link login">
                <a href="#" data-bs-toggle="modal" data-bs-target="#ModalLogin">Đăng nhập</a>
            </div>
            @endguest

            @auth
            {{-- <div class="dropdown">
                <div class="nav-item dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    User&nbsp&nbsp
                    <i class="fas fa-user-circle fa-2x"></i>
                    <img class="img-profile rounded-circle"
                        src="https://hinhnen123.com/wp-content/uploads/2021/06/avt-cute-9.jpg" alt="">
                </div>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li>
                        <a class="dropdown-item" href="{{ route('my-profile') }}">Profile</a>
                    </li>
                    <li>
                        <a class="dropdown-item" id="log-out" href="#">Log out</a>
                    </li>
                </ul>
            </div> --}}

            <div class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton1" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="display-name-user"></span>
                    <img style="height: 2rem;
                    width: 2rem;" class="img-profile rounded-circle"
                        src="{{ asset ('storage/images/undraw_profile.svg')}}" id="photo-user">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="dropdownMenuButton1">
                    <li>
                        <a class="dropdown-item" href="{{ route('my-profile') }}">Trang cá nhân</a>
                    </li>
                    <li>
                        <a class="dropdown-item" id="log-out" href="#">Đăng xuất</a>
                    </li>
                </div>
            </div>
            @endauth
        </div>
    </nav>
</header>
@include('modal.login') @include('modal.post_editor')

<script>
    @auth
    document.getElementById('log-out').addEventListener('click', function() {
         firebase.auth().signOut();
         toastr.warning('Đã đăng xuất');
         setTimeout(logOut, 500);
    });
    @endauth

    function logOut() {
        window.location="{{route('user-logout')}}";
    }
</script>