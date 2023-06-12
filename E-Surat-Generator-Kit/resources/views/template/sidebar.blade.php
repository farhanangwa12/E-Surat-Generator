 {{-- Pengadaan --}}
 @if (auth()->user()->role == 'pengadaan')
     <nav id="sidebar" class="sidebar js-sidebar">
         <div class="sidebar-content js-simplebar">
             <a class="sidebar-brand" href="index.html">
                 <span class="align-middle">E-Surat-Generator-kit</span>
             </a>

             <ul class="sidebar-nav">
                 <li class="sidebar-header">
                     Data Master
                 </li>

                 <li class="sidebar-item {{ Request::is('pengadaan/dashboard') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('dashboard.pengadaan') }}">
                         <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                     </a>
                 </li>

                 <li class="sidebar-item {{ Request::is('pengadaan/kontrakthp1/pengajuankontrak') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('pengajuankontrak.index') }}">
                         <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">
                             Pengajuan Kontrak Kerja</span>
                     </a>
                 </li>
                 <li class="sidebar-item {{ Request::is('pengadaan/kontrakthp2/negoharga') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('negoharga') }}">
                         <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">
                             Nego Harga</span>
                     </a>
                 </li>
                 <li class="sidebar-item {{ Request::is('pengadaan/tandatangan/tandatangan') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('tandatangan.pengadaan') }}">
                         <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">
                             Validasi Pengadaan</span>
                     </a>
                 </li>

                 <li class="sidebar-item {{ Request::is('users') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('users') }}">
                         <i class="align-middle" data-feather="user"></i> <span class="align-middle">Managemen
                             User</span>
                     </a>
                 </li>

                 <li class="sidebar-item {{ Request::is('pegawai') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('pegawai') }}">
                         <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Managemen
                             Pegawai</span>
                     </a>
                 </li>

                 <li class="sidebar-item {{ Request::is('vendor') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('vendor') }}">
                         <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">
                             Managemen Vendor</span>
                     </a>
                 </li>



             </ul>

         </div>
     </nav>
 @endif
 @if (auth()->user()->role == 'manager')
     <nav id="sidebar" class="sidebar js-sidebar">
         <div class="sidebar-content js-simplebar">
             <a class="sidebar-brand" href="index.html">
                 <span class="align-middle">E-Surat-Generator-kit</span>
             </a>

             <ul class="sidebar-nav">
                 <li class="sidebar-header">
                     Data Master
                 </li>

                 <li class="sidebar-item {{ Request::is('manager/dashboard') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('dashboard.manager') }}">
                         <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                     </a>
                 </li>

                 <li class="sidebar-item {{ Request::is('jenisdokumen') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('jenisdokumen') }}">
                         <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Jenis
                             Dokumen Vendor</span>
                     </a>
                 </li>

                 <li class="sidebar-item {{ Request::is('manager/tandatangan') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('tandatangan.manager') }}">
                         <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">
                             Tanda Tangan Kontrak</span>
                     </a>
                 </li>

                 <li class="sidebar-item {{ Request::is('users') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('users') }}">
                         <i class="align-middle" data-feather="user"></i> <span class="align-middle">Managemen
                             User</span>
                     </a>
                 </li>

                 <li class="sidebar-item {{ Request::is('pegawai') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('pegawai') }}">
                         <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Managemen
                             Pegawai</span>
                     </a>
                 </li>

                 <li class="sidebar-item {{ Request::is('vendor') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('vendor') }}">
                         <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">
                             Managemen Vendor</span>
                     </a>
                 </li>



             </ul>

         </div>
     </nav>
 @endif
 @if (auth()->user()->role == 'vendor')
     <nav id="sidebar" class="sidebar js-sidebar">
         <div class="sidebar-content js-simplebar">
             <a class="sidebar-brand" href="index.html">
                 <span class="align-middle">Vendor</span>
             </a>

             <ul class="sidebar-nav">
                 <li class="sidebar-header">
                     Data Vendor
                 </li>

                 <li class="sidebar-item {{ Request::is('vendor/dashboard') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('dashboard.vendor') }}">
                         <i class="align-middle" data-feather="sliders"></i> <span
                             class="align-middle">Dashboard</span>
                     </a>
                 </li>

                 {{-- <li class="sidebar-item {{ Request::is('vendor/vendor/kelengkapandok') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('kelengkapandok') }}">
                         <i class="align-middle" data-feather="user"></i> <span class="align-middle">Kelengkapan
                             Dokumen</span>
                     </a>
                 </li> --}}

                 <li class="sidebar-item {{ Request::is('vendor/vendor/kontrakkerja') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('isikontrak') }}">
                         <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Pengisian
                             Kontrak
                             Kerja</span>
                     </a>
                 </li>

                 <li class="sidebar-item {{ Request::is('vendor/vendor/tandatangan') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('tandatangan') }}">
                         <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">
                             Tanda Tangan</span>
                     </a>
                 </li>
                 <li class="sidebar-item {{ Request::is('pengadaan/dashboard') ? 'active' : '' }}">
                     <a class="sidebar-link" href="{{ route('vendor.kontrakkerja') }}">
                         <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">
                             Kontrak Kerja</span>
                     </a>
                 </li>




             </ul>

         </div>
     </nav>
 @endif
