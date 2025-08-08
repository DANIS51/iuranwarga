@extends('template')

@section('content')

<!-- Hero Section -->
<section class="py-5 text-white" style="background-color: #2a2d4f;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4" data-aos="fade-right">
        <h1 class="display-5 fw-bold">GROUP CHAT THAT’S ALL FUN & GAMES</h1>
        <p class="lead">
          Discord is great for playing games and chilling with friends, or even building a worldwide community.
          Customize your own space to talk, play, and hang out.
        </p>
        <a href="#" class="btn btn-light btn-lg rounded-pill fw-bold">Get Started</a>
      </div>
      <div class="col-lg-6 text-center" data-aos="fade-left">
        <img src="https://cdn-icons-png.flaticon.com/512/2111/2111370.png" alt="Hero" class="img-fluid" style="max-height: 300px;">
      </div>
    </div>
  </div>
</section>


<section class="py-5" style="background-color: #1e2140;">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="fw-bold text-white">Kenapa Memilih Kami?</h2>
      <p class="text-light">Kami hadir untuk memudahkan komunikasi dan koordinasi warga Anda.</p>
    </div>
    <div class="row text-center text-white">
      <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="100">
        <img src="https://img.icons8.com/ios/100/ffffff/chat--v1.png" class="mb-3" style="height: 60px;" alt="Chat Icon" />
        <h5>Chat Warga Real-time</h5>
        <p>Komunikasi cepat, langsung dari genggaman tangan Anda.</p>
      </div>
      <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="200">
        <img src="https://img.icons8.com/ios/100/ffffff/conference-call--v1.png" class="mb-3" style="height: 60px;" alt="Group Icon" />
        <h5>Kelola Anggota Mudah</h5>
        <p>Data warga tersimpan rapi dan mudah dicari.</p>
      </div>
      <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="300">
        <img src="https://img.icons8.com/ios/100/ffffff/wallet--v1.png" class="mb-3" style="height: 60px;" alt="Wallet Icon" />
        <h5>Iuran Otomatis</h5>
        <p>Kelola dan catat iuran bulanan secara otomatis dan transparan.</p>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials -->
<section class="py-5 text-white" style="background-color: #2a2d4f;">
  <div class="container text-center">
    <h2 class="fw-bold mb-5" data-aos="fade-up">Apa Kata Mereka</h2>
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <p>“Aplikasi ini bikin iuran warga jadi nggak ribet. Semua transparan dan tercatat!”</p>
        <small class="text-light">— Bu Rina, Ketua RT</small>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <p>“Gampang dipakai dan fitur-fiturnya lengkap. Bagus buat komunitas kecil kami.”</p>
        <small class="text-light">— Andi, Sekretaris RW</small>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <p>“Sekarang nggak ada lagi alasan lupa bayar iuran. Ada notifikasi dan catatannya!”</p>
        <small class="text-light">— Lina, Warga</small>
      </div>
    </div>
  </div>
</section>


<section class="py-5 text-white text-center" style="background-color: #1e2140;">
  <div class="container" data-aos="zoom-in">
    <h2 class="fw-bold mb-4">Mulai Kelola Iuran Warga dengan Mudah</h2>
    <a href="{{ route('register') }}" class="btn btn-light btn-lg rounded-pill fw-bold">Daftar Sekarang</a>
  </div>
</section>

@endsection
