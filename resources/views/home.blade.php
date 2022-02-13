<html>
@php $halaman='order_p'; @endphp

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

                @if(request()->session()->get('userlogin')=='Admin')
                @include('konten_order-admin')
                @else
                @include('konten_order-user')
                @endif
            </div>
        </div>
    </div>

    <!-- jQuery -->
    @include('footer')
</body>

</html>