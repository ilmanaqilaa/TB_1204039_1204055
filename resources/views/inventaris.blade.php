<html>
@php $halaman='inventaris'; @endphp

<head>
    <!-- Web Head (Include Dependencies) -->
    @include('head')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        @include('sidebar')

        <!-- Page Content -->
        <div id="content">
            <div class="container-fluid">
                @include('konten_inventaris')
                    @if(request()->session()->get('userlogin')=='Admin')
                        @yield('tabel_inventaris')
                    
                    @else
                        @yield('card_inventaris')
                    
                @endif
            </div>
        </div>  
        <!-- /Page Content -->
    </div>

    <!-- jQuery -->
    @include('footer')
</body>

</html>