  <nav class="layout-navbar {{ session()->has('siswa') ? 'layout-navbar-without-menu' : 'container-xxl' }} navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
      id="layout-navbar">
      @if (!session()->has('siswa'))
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                  <i class="bx bx-menu bx-sm"></i>
              </a>
          </div>
      @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
          <!-- Search -->
          <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                  @if (session()->has('siswa'))
                      {{-- image dan name --}}
                      <a href="{{ route('siswa.dashboard.index') }}" class="text-decoration-none text-body">
                          <img src="{{ asset('assets/bilikbelajar/icon/icon.png') }}" alt=""
                              class="w-px-40 h-auto" width="70">
                          <span class="fw-semibold ms-1">{{ env('APP_NAME') }} </span>
                      </a>
                  @else
                      {{-- <i class="bx bx-search fs-4 lh-0"></i>
                      <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                          aria-label="Search..." /> --}}
                  @endif
              </div>
          </div>
          <!-- /Search -->

          <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- Place this tag where you want the button to render. -->


              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                      <div class="avatar avatar-online">
                          @if (session()->has('siswa'))
                              <span class="avatar-initial rounded-circle bg-primary">
                                  {{ substr(strtoupper(session()->get('siswa')->nama), 0, 2) }}
                              </span>
                          @else
                              <span class="avatar-initial rounded-circle bg-primary">
                                  {{ substr(strtoupper(Auth::user()->username), 0, 2) }}
                              </span>
                          @endif
                      </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                          <a class="dropdown-item" href="#">
                              <div class="d-flex">
                                  <div class="flex-shrink-0 me-3">
                                      <div class="avatar avatar-online">
                                          @if (session()->has('siswa'))
                                              <span class="avatar-initial rounded-circle bg-primary">
                                                  {{ substr(strtoupper(session()->get('siswa')->nama), 0, 2) }}
                                              </span>
                                          @else
                                              <span class="avatar-initial rounded-circle bg-primary">
                                                  {{ substr(strtoupper(Auth::user()->username), 0, 2) }}
                                              </span>
                                          @endif
                                      </div>
                                  </div>
                                  <div class="flex-grow-1">
                                      <span class="fw-semibold d-block">
                                          @if (session()->has('siswa'))
                                              {{ ucwords(session()->get('siswa')->nama) }}
                                          @else
                                              {{ ucwords(Auth::user()->username) }}
                                          @endif

                                      </span>
                                      <small class="text-muted">
                                          @if (session()->has('siswa'))
                                              {{ ucwords(session()->get('siswa')->asal_sekolah) }} -
                                              {{ ucwords(session()->get('siswa')->kelas) }}
                                          @else
                                              Guru
                                          @endif
                                      </small>
                                  </div>
                              </div>
                          </a>
                      </li>
                      <li>
                          <div class="dropdown-divider"></div>
                      </li>
                      <li>
                          <a class="dropdown-item"
                              href="{{ session()->has('siswa') ? route('siswa.profile.index') : route('guru.profile.index') }}">
                              <i class="bx bx-user me-2"></i>
                              <span class="align-middle">My Profile</span>
                          </a>
                      </li>


                      <li>
                          <div class="dropdown-divider"></div>
                      </li>
                      <li>
                          @if (session()->has('siswa'))
                              <form action="{{ route('siswa.logout') }}" method="post">
                                  @csrf
                                  <button class="dropdown-item">
                                      <i class="bx bx-power-off me-2"></i>
                                      <span class="align-middle">Keluar</span>
                                  </button>
                              </form>
                          @else
                              <form action="{{ route('logout') }}" method="post">
                                  @csrf
                                  <button class="dropdown-item">
                                      <i class="bx bx-power-off me-2"></i>
                                      <span class="align-middle">Keluar</span>
                                  </button>
                              </form>
                          @endif

                      </li>
                  </ul>
              </li>
              <!--/ User -->
          </ul>
      </div>
  </nav>
