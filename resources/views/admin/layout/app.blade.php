<!DOCTYPE html>
<html lang="en">

<head>
    @routes
    @include('admin.sections.head',['title' => $title])
    {{-- firebase --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.0.3-202181503543/firebase-app-compat.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.0.3-202181503543/firebase-auth-compat.min.js">
    </script>
    <script src="{{asset('js/firebase/config.js')}}"></script>



    @stack('styles')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('admin.sections.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('admin.sections.topbar')

                @yield('content')

            </div>
            @include('admin.sections.footer')
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('admin.sections.modal-logout')

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"
        integrity="sha512-0QbL0ph8Tc8g5bLhfVzSqxe9GERORsKhIn1IrpxDAgUsbBGz/V7iSav2zzW325XGd1OMLdL4UiqRJj702IeqnQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/admin/sb-admin-2.min.js')}}"></script>
    <script src="{{ asset('js/admin/admin-base.js')}}"></script>


    {{-- toast --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    @stack('scripts')
</body>

</html>