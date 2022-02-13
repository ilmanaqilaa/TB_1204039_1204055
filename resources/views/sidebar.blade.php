<!-- Sidebar  -->
<nav id="sidebar">
    <div class="sidebar-header text-center">             
        <img src='images/logo.png' style="max-width: 50px; max-height: 50px;">
        <b>Venon</b>               
    </div>
    
    <ul class="list-unstyled components">
        <li class="text-center @if($halaman == 'order_p' || $halaman == 'riwayat_order_p') active @endif">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                <i class="fa fa-chart-bar fa-2x" style="margin-right: 0px;"></i>
                <p>Peminjaman</p>                         
            </a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li class="@if($halaman == 'order_p') active @endif">
                    <a href="{{ url('/home') }}">                                    
                        <i class="fa fa-archive fa-2x" style="margin-right: 0px;"></i>
                        <p>Order Peminjaman</p>                                     
                    </a>
                </li>
                @if(request()->session()->get('userlogin')=='Admin')
                <li class="@if($halaman == 'riwayat_order_p') active @endif">
                    <a href="{{ url('/riwayat') }}">
                        <i class="fa fa-archive fa-2x" style="margin-right: 0px;"></i>
                        <p>Riwayat Peminjaman</p>                                
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @if(request()->session()->get('userlogin')=='Admin')
        <li class="text-center @if($halaman == 'inventaris') active @endif">
            <a href="{{ url('/inventaris') }}">                          
                <i class="fa fa-archive fa-2x" style="margin-right: 0px;"></i>
                <p>Data Inventaris</p>                            
            </a>
        </li>
        @else(request()->session()->get('userlogin')=='Murid')
        <li class="text-center @if($halaman == 'inventaris') active @endif">
            <a href="{{ url('/inventaris') }}">                          
                <i class="fa fa-archive fa-2x" style="margin-right: 0px;"></i>
                <p>Pinjam Inventaris</p>                            
            </a>
        </li>
        @endif
        @if(request()->session()->get('userlogin')=='Admin')
        <li class="text-center @if($halaman == 'pembelian') active @endif">
            <a href="/pembelian">                              
                <i class="fa fa-cart-plus fa-2x" style="margin-right: 0px;"></i>
                <p>Pembelian</p>                        
            </a>
        </li>
        <li class="text-center @if($halaman == 'laporan') active @endif">
            <a href="/laporan">                               
                <i class="fa fa-book fa-2x" style="margin-right: 0px;"></i>
                <p>Laporan</p>                             
            </a>
        </li>
        <li class="text-center @if($halaman == 'peminjam') active @endif">
            <a href="/peminjam">                                
                <i class="fa fa-user fa-2x" style="margin-right: 0px;"></i>
                <p>Data Peminjam</p>                                   
            </a>
        </li>
        @endif
        <li class="text-center logout">
            <a href="{{url('/logout')}}">                                
                <i class="fa fa-power-off fa-2x" style="margin-right: 0px;"></i>
                <p>Logout</p>                                   
            </a>
        </li>
    </ul>
</nav>
            