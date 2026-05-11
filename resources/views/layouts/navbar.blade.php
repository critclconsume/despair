<nav class="navbar">
  <a href="{{ route('beranda') }}" class="nav-brand">
    <div class="nav-brand-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="#E1F5EE" stroke-width="2">
        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
        <polyline points="9 22 9 12 15 12 15 22"/>
      </svg>
    </div>
    <div>
      <div class="nav-brand-name">FasilitasKota</div>
      <div class="nav-brand-sub">Dinas Pekerjaan Umum</div>
    </div>
  </a>

  <div class="nav-links">
    <a href="{{ route('beranda') }}"
       class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}">
      Beranda
    </a>
    <a href="{{ route('proyek') }}"
       class="nav-link {{ request()->routeIs('proyek') ? 'active' : '' }}">
      Proyek
    </a>
    <a href="{{ route('panduan') }}"
       class="nav-link {{ request()->routeIs('panduan') ? 'active' : '' }}">
      Buku Panduan
    </a>
  </div>

  <div class="nav-right">
    <a href="{{ route('lapor') }}" class="nav-cta">Laporkan Masalah</a>

    {{-- Admin login button — shows only when not logged in --}}
    @guest
      <a href="{{ route('login') }}" class="nav-admin-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/>
          <polyline points="10 17 15 12 10 7"/>
          <line x1="15" y1="12" x2="3" y2="12"/>
        </svg>
        Login Admin
      </a>
    @endguest

    {{-- If already logged in as admin, show link to panel --}}
    @auth
      <a href="{{ route('admin.dashboard') }}" class="nav-admin-btn nav-admin-active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <rect x="3" y="3" width="7" height="7" rx="1"/>
          <rect x="14" y="3" width="7" height="7" rx="1"/>
          <rect x="3" y="14" width="7" height="7" rx="1"/>
          <rect x="14" y="14" width="7" height="7" rx="1"/>
        </svg>
        Panel Admin
      </a>
    @endauth
  </div>
</nav>
