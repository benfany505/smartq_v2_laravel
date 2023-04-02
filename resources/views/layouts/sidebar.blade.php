  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="./" class="brand-link">
          <img src="{{ asset('') }}assets/dist/img/smartq.png" alt="ETN Logo"
              class="brand-image img-circle elevation-1" style="opacity: 2">
          <span class="brand-text font-weight-light text-sm">SmartQ Antrean V2</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">

                  {{-- check if $profile->image_url has valid image --}}
                  @if (Auth::user()->image_url != '')
                      <img src="{{ asset('') }}{{ Auth::user()->image_url }}" alt="image" id="user_photo"
                          class="img-circle elevation-2">
                  @else
                      <img src="{{ asset('') }}assets/dist/img/no_photo.png" class="img-circle elevation-2"
                          alt="User Image">
                  @endif
              </div>
              {{-- <div class="info">
                  <a href="#" class="d-block">Benfany Aditia</a>
              </div> --}}
              @if (Auth::check())
                  <div class="info">
                      <a href="#" class="d-block">{{ Auth::user()->full_name }}</a>
                      {{-- <a href="#" class="d-block">{{ Auth::user()->email }}</a> --}}
                  </div>
              @endif
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-3 " style="padding-bottom: 70px">
              <ul class="nav nav-pills nav-sidebar flex-column nav-legacy text-sm" data-widget="treeview" role="menu"
                  data-accordion="false">

                  <li class="nav-item">
                      <a href="/dashboard" class="nav-link">
                          <i class="nav-icon fas fa-home"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/lihat_antrean" class="nav-link">
                          <i class="nav-icon fas fa-desktop"></i>
                          <p>
                              Lihat Antrean
                          </p>
                      </a>
                  </li>

                  {{-- only for administrator --}}
                  @if (Auth::user()->role == 'administrator')
                      <li class="nav-item">
                          <a href="/list_companies" class="nav-link">
                              <i class="nav-icon fas fa-cogs"></i>
                              <p>
                                  Konfigurasi
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="/konfigurasi/umum" class="nav-link ">
                                      <i class="far  nav-icon"></i>
                                      <p>Umum</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="/konfigurasi/layanan" class="nav-link">
                                      <i class="far  nav-icon"></i>
                                      <p>Layanan</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="/konfigurasi/loket" class="nav-link">
                                      <i class="far  nav-icon"></i>
                                      <p>Loket</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="/konfigurasi/alur" class="nav-link">
                                      <i class="far  nav-icon"></i>
                                      <p>Alur</p>
                                  </a>
                              </li>

                          </ul>
                      </li>
                      <li class="nav-item menu-close">
                          <a href="/users/users" class="nav-link ">
                              <i class="nav-icon fas fa-users"></i>
                              <p>
                                  Users
                                  {{-- <i class="right fas fa-angle-left"></i> --}}
                              </p>
                          </a>

                      </li>
                      <li class="nav-item menu-close">
                          <a href="#" class="nav-link ">
                              <i class="nav-icon far fa-file-alt"></i>
                              <p>
                                  Laporan
                                  {{-- <i class="right fas fa-angle-left"></i> --}}
                              </p>
                          </a>

                      </li>
                  @endif
                  {{-- end only for administrator --}}





                  <li class="nav-item menu-close">
                      <a href="#" class="nav-link ">
                          <i class="nav-icon fas fa-user"></i>
                          <p>
                              Profil Saya
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">

                          <li class="nav-item">
                              <a href="/profile_saya/edit_profile" class="nav-link">
                                  <i class="far  nav-icon"></i>
                                  <p>Edit Profile</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/logout" class="nav-link"
                                  onclick="event.preventDefault(); document.getElementById('formLogout').submit()">
                                  <i class="far  nav-icon"></i>
                                  <p>Logout</p>

                              </a>
                              <form method="POST" id="formLogout" action="/logout">@csrf</form>
                          </li>

                      </ul>
                  </li>


              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
