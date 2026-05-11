<?php
// ── Placeholder data — replace with DB queries later ──
$stats = [
    ['num' => '48',  'label' => 'Total Fasilitas'],
    ['num' => '12',  'label' => 'Proyek Aktif'],
    ['num' => '230', 'label' => 'Laporan Diselesaikan'],
];

$facilities = [
    [
        'name'   => 'Puskesmas Pusat',
        'addr'   => 'Jl. Sudirman No. 12',
        'type'   => 'Kesehatan',
        'status' => 'open',
        'photo'  => 'assets/puskesmas.jpg',   // place your photo here
    ],
    [
        'name'   => 'Perpustakaan Umum',
        'addr'   => 'Jl. Merdeka No. 5',
        'type'   => 'Pendidikan',
        'status' => 'open',
        'photo'  => 'assets/perpustakaan.jpg',
    ],
    [
        'name'   => 'Stadion Kota',
        'addr'   => 'Jl. Olahraga No. 1',
        'type'   => 'Olahraga',
        'status' => 'maintenance',
        'photo'  => 'assets/stadion.jpg',
    ],
    [
        'name'   => 'Taman Kota',
        'addr'   => 'Jl. Taman No. 3',
        'type'   => 'Ruang Hijau',
        'status' => 'open',
        'photo'  => 'assets/taman.jpg',
    ],
];

$pengumuman = [
    [
        'tanggal'   => '18',
        'month' => 'Apr',
        'title' => 'Renovasi Stadion Kota dimulai',
        'body'  => 'Pengerjaan renovasi tribun dan lapangan utama telah resmi dimulai. Diperkirakan selesai Agustus 2025.',
    ],
    [
        'tanggal'   => '10',
        'month' => 'Apr',
        'title' => 'Jam operasional Perpustakaan diperbarui',
        'body'  => 'Mulai 15 April, perpustakaan umum kini buka hingga pukul 18.00 setiap Senin–Jumat.',
    ],
    [
        'tanggal'   => '02',
        'month' => 'Apr',
        'title' => 'Pembangunan Taman Baru di Kecamatan Timur',
        'body'  => 'Proyek area hijau seluas 2 hektar mulai tahap perencanaan dan akan segera memasuki tender.',
    ],
];
?>

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- HERO --}}
<section class="hero">
  <div class="hero-pill">
    <span class="hero-dot"></span>
    Informasi Fasilitas Publik
  </div>
  <h1>Fasilitas kota yang <span class="hero-accent">terbuka</span> untuk semua warga</h1>
  <p>Temukan informasi lengkap tentang fasilitas publik di kota Anda — jam operasional, kondisi terkini, dan proyek pembangunan yang sedang berjalan.</p>
</section>

{{-- STATS STRIP --}}
<div class="info-strip">
  @foreach ($stats as $s)
  <div class="info-strip-item">
    <div class="info-num">{{ $s['num'] }}</div>
    <div class="info-label">{{ $s['label'] }}</div>
  </div>
  @endforeach
</div>

{{-- FACILITIES --}}
<div class="section">
  <div class="section-header">
    <div class="section-title">Fasilitas publik</div>
  </div>

  <div class="fac-grid">
    @foreach ($facilities as $f)
    <div class="fac-card">
      <div class="fac-photo">
        @if (!empty($f->photo) && file_exists(public_path('images/fasilitas/' . $f->photo)))
          <img src="{{ asset('images/fasilitas/' . $f->photo) }}" alt="{{ $f->name }}">
        @else
          <div class="fac-photo-placeholder">{{ $f->name }}</div>
        @endif
      </div>
      <div class="fac-body">
        <div class="fac-name">{{ $f->name }}</div>
        <div class="fac-addr">{{ $f->address }}</div>
        <div class="fac-footer">
          <span class="tag {{ $f->status === 'open' ? 'tag-open' : 'tag-maint' }}">
            {{ $f->status === 'open' ? 'Buka' : 'Renovasi' }}
          </span>
          <span class="fac-type">{{ $f->type }}</span>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <hr class="divider">

  {{-- PENGUMUMAN — from DB --}}
  <div class="section-header">
    <div class="section-title">Pengumuman terbaru</div>
  </div>

  @if($pengumuman->isEmpty())
    <p style="font-size:13px; color:var(--text-muted);">Belum ada pengumuman.</p>
  @else
  <div class="news-list">
    @foreach ($pengumuman as $p)
    <div class="news-item">
      <div class="news-date-block">
        <div class="news-date-day">{{ $p->tanggal->format('d') }}</div>
        <div class="news-date-mon">{{ $p->tanggal->translatedFormat('M') }}</div>
      </div>
      <div class="news-body">
        <h4>{{ $p->judul }}</h4>
        <p>{{ $p->isi }}</p>
      </div>
    </div>
    @endforeach
  </div>
  @endif

</div>

@endsection
