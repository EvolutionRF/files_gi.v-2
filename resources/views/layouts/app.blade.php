<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') &mdash; Files Guru Inovatif</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    @livewireStyles

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->
</head>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            @include('components.header')

            <!-- Sidebar -->
            @include('components.sidebar')

            <!-- Content -->
            @yield('main')

            <!-- Footer -->
            @include('components.footer')
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

    @stack('scripts')

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        jQuery(document).ready(function($) {
            $(".show-modal").on("show.bs.modal", (event) => {
                var button = $(event.relatedTarget);
                var modal = $(this);
                var title = button.data('title');
                var url = button.data('url');

                modal.find(".modal-title-custom").html(title);
                modal.find(".modal-body-custom").load(url);
            });

            $(".right_modal").on("show.bs.modal", (event) => {
                var button = $(event.relatedTarget);
                var modal = $(this);
                var title = button.data('title');
                var url = button.data('url');

                modal.find(".modal-title-custom").html(title);
                modal.find(".detail-body").load(url);
            });

            $(".right_modal").on("hide.bs.modal", (event) => {
                console.log('rest');
            });



            $(".notification").on("show.bs.dropdown", (event) => {
                var button = $(event.relatedTarget);
                var dropdown = $(this);
                var url = button.data('url');
                dropdown.find(".dropdown-body-custom").load(url);
            });




        });

            $('.dropdown-item').click(function(){
                // var data = "";
                data = $(this).attr('data-route');
                $('#activity-tab2').on("show.bs.tab",(event)=>{
                    var tab = $("#activity");
                    // console.log(data);
                    tab.load(data);
                });
            });



    </script>
    @livewireScripts
</body>

</html>
