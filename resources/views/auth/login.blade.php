<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin — FasilitasKota</title>
@vite(['css/style.css'])
  <style>
    /* ── Login page specific styles ── */
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background: var(--bg-page);
    }

    .login-wrap {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 32px 16px;
    }

    .login-card {
      background: var(--bg-surface);
      border: 0.5px solid var(--border);
      border-radius: 16px;
      padding: 40px 36px;
      width: 100%;
      max-width: 400px;
    }

    .login-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 28px;
    }
    .login-brand-icon {
      width: 36px; height: 36px;
      background: var(--teal-600);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
    }
    .login-brand-icon svg { width: 20px; height: 20px; }
    .login-brand-name { font-size: 16px; font-weight: 500; color: var(--text-primary); line-height: 1.2; }
    .login-brand-sub  { font-size: 12px; color: var(--text-muted); }

    .login-title {
      font-size: 20px;
      font-weight: 500;
      color: var(--text-primary);
      margin-bottom: 6px;
    }
    .login-subtitle {
      font-size: 13px;
      color: var(--text-secondary);
      margin-bottom: 28px;
      line-height: 1.6;
    }

    .login-errors {
      background: #FCEBEB;
      border: 0.5px solid #F7C1C1;
      border-radius: 8px;
      padding: 12px 14px;
      font-size: 13px;
      color: #791F1F;
      margin-bottom: 18px;
    }
    .login-errors ul { padding-left: 16px; }
    .login-errors li { margin-bottom: 3px; }

    .login-status {
      background: var(--teal-50);
      border: 0.5px solid var(--teal-100);
      border-radius: 8px;
      padding: 11px 14px;
      font-size: 13px;
      color: var(--teal-800);
      margin-bottom: 18px;
    }

    .fgroup { display: flex; flex-direction: column; gap: 5px; margin-bottom: 14px; }
    .fgroup label { font-size: 12px; font-weight: 500; color: var(--text-secondary); }
    .fgroup input {
      font-size: 14px; padding: 10px 12px;
      border: 0.5px solid var(--border-med);
      border-radius: 8px;
      background: var(--bg-surface);
      color: var(--text-primary);
      width: 100%;
      transition: border-color 0.15s, box-shadow 0.15s;
    }
    .fgroup input:focus {
      outline: none;
      border-color: var(--teal-600);
      box-shadow: 0 0 0 2px rgba(29,158,117,0.12);
    }

    .login-remember {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 20px;
    }
    .login-remember input[type="checkbox"] {
      width: 15px; height: 15px;
      accent-color: var(--teal-600);
      cursor: pointer;
    }
    .login-remember label {
      font-size: 13px;
      color: var(--text-secondary);
      cursor: pointer;
    }

    .login-submit {
      width: 100%; padding: 11px;
      font-size: 15px; font-weight: 500;
      background: var(--teal-600);
      color: var(--teal-50);
      border: none; border-radius: 8px;
      cursor: pointer;
      transition: background 0.15s;
      font-family: var(--font);
    }
    .login-submit:hover { background: var(--teal-700); }

    .login-footer {
      margin-top: 20px;
      text-align: center;
      font-size: 12px;
      color: var(--text-muted);
    }
    .login-footer a {
      color: var(--teal-700);
    }
    .login-footer a:hover { text-decoration: underline; }

    .login-divider {
      border: none;
      border-top: 0.5px solid var(--border);
      margin: 20px 0;
    }

    /* ── Page footer ── */
    .login-page-footer {
      text-align: center;
      padding: 16px;
      font-size: 12px;
      color: var(--text-muted);
      border-top: 0.5px solid var(--border);
      background: var(--bg-surface);
    }
  </style>
</head>
<body>

<div class="login-wrap">
  <div class="login-card">

    {{-- Brand --}}
    <div class="login-brand">
      <div class="login-brand-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="#E1F5EE" stroke-width="2">
          <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
          <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
      </div>
      <div>
        <div class="login-brand-name">FasilitasKota</div>
        <div class="login-brand-sub">Dinas Pekerjaan Umum</div>
      </div>
    </div>

    <div class="login-title">Masuk sebagai admin</div>
    <div class="login-subtitle">Akses panel admin untuk mengelola fasilitas dan laporan warga.</div>

    {{-- Session status (e.g. password reset link sent) --}}
    @if (session('status'))
      <div class="login-status">{{ session('status') }}</div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
      <div class="login-errors">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="fgroup">
        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               placeholder="admin@fasilitaskota.id"
               value="{{ old('email') }}"
               autocomplete="email"
               autofocus>
      </div>

      <div class="fgroup">
        <label for="password">Password</label>
        <input type="password" id="password" name="password"
               placeholder="••••••••"
               autocomplete="current-password">
      </div>

      <div class="login-remember">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Ingat saya</label>
      </div>

      <button type="submit" class="login-submit">Masuk</button>
    </form>

    <hr class="login-divider">

    <div class="login-footer">
      <a href="{{ route('beranda') }}">← Kembali ke halaman utama</a>
    </div>

  </div>
</div>

<div class="login-page-footer">
  &copy; {{ date('Y') }} FasilitasKota — Dinas Pekerjaan Umum. Semua hak dilindungi.
</div>

</body>
</html>
