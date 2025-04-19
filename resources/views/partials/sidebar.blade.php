 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
     <div class="app-brand demo">
         <a href="{{ route('guru.dashboard.index') }}" class="app-brand-link">
             <span class="app-brand-logo demo">
                 <img src="{{ asset('assets/bilikbelajar/icon/icon.png') }}" width="50" />
             </span>
             <span class="app-brand-text menu-text fw-bolder" style="font-size: 20px">Bilik Belajar</span>
         </a>

         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
             <i class="bx bx-chevron-left bx-sm align-middle"></i>
         </a>
     </div>

     <div class="menu-inner-shadow"></div>

     <ul class="menu-inner py-1">
         <!-- Dashboard -->
         <li class="menu-item {{ request()->is('guru/dashboard*') ? 'active' : '' }}">
             <a href="{{ route('guru.dashboard.index') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-home-circle"></i>
                 <div data-i18n="Analytics">Dashboard</div>
             </a>
         </li>

         <!-- Layouts -->


         <li class="menu-header small text-uppercase">
             <span class="menu-header-text">Kelola</span>
         </li>
         <li class="menu-item {{ request()->is('guru/cptp*') ? 'active' : '' }}">
             <a href="{{ route('guru.cptp.index') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-target-lock"></i>
                 <div data-i18n="Layouts">Capaian & Tujuan Pembelajaran</div>
             </a>


         </li>
         <li class="menu-header small text-uppercase">
             <span class="menu-header-text">Kursus</span>
         </li>
         <li class="menu-item {{ request()->is('guru/materi*') ? 'active' : '' }}">
             <a href="{{ route('guru.materi.index') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-dock-top"></i>
                 <div data-i18n="Account Settings">Materi</div>
             </a>

         </li>



     </ul>
 </aside>
