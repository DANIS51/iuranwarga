@extends('template')

@section('content')


<section id="beranda" class="py-5 text-white" style="background-color: #2a2d4f;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4" data-aos="fade-right">
        <h1 class="display-5 fw-bold">MENGELOLA IURAN WARGA LEBIH MUDAH</h1>
        <p class="lead">
          Setiap transaksi tercatat otomatis, laporan keuangan dapat diakses kapan saja, dan warga bisa memeriksa status pembayaran mereka secara langsung melalui dashboard. Tak hanya itu, sistem notifikasi juga memastikan tidak ada iuran yang terlewat.
        </p>
        <p class="lead">
          Cocok digunakan oleh pengurus lingkungan, perumahan, komunitas, bahkan organisasi sosial. Dengan tampilan yang sederhana dan fitur yang lengkap, semua orang bisa menggunakannya tanpa harus paham teknologi.
        </p>
        <a href="#fitur" class="btn btn-light btn-lg rounded-pill fw-bold">Coba Sekarang</a>
      </div>
      <div class="col-lg-6 text-center" data-aos="fade-left">
        <img src="https://cdn-icons-png.flaticon.com/512/1055/1055646.png" alt="Iuran Warga" class="img-fluid" style="max-height: 300px;">
      </div>
    </div>
  </div>
</section>


<section id="fitur" class="py-5" style="background-color: #1e2140;">
<section class="py-5" style="background-color: #1e2140;">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="fw-bold text-white">Kenapa Memilih Kami?</h2>
      <p class="text-light">
        Aplikasi kami dirancang khusus untuk mempermudah pengurus lingkungan dalam mengelola warganya. Dengan fitur yang lengkap, intuitif, dan terus berkembang, kami berkomitmen menjadi mitra digital terbaik untuk RT, RW, maupun komunitas Anda.
      </p>
    </div>
    <div class="row text-center text-white">
      <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="100">
        <img src="https://img.icons8.com/ios/100/ffffff/chat--v1.png" class="mb-3" style="height: 60px;" alt="Chat Icon" />
        <h5>Chat Warga Real-time</h5>
        <p>
          Fasilitas komunikasi internal antar warga atau antara warga dengan pengurus RT kini jadi lebih mudah. Semua bisa dilakukan langsung dalam satu aplikasi—tanpa perlu grup WhatsApp tambahan.
        </p>
      </div>
      <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="200">
        <img src="https://img.icons8.com/ios/100/ffffff/conference-call--v1.png" class="mb-3" style="height: 60px;" alt="Group Icon" />
        <h5>Kelola Anggota Mudah</h5>
        <p>
          Data seluruh warga tersimpan rapi, lengkap dengan alamat, nomor HP, status pembayaran, dan histori aktivitas. Anda tidak perlu repot mencatat ulang, cukup cari nama dan semua data langsung muncul.
        </p>
      </div>
      <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="300">
        <img src="https://img.icons8.com/ios/100/ffffff/wallet--v1.png" class="mb-3" style="height: 60px;" alt="Wallet Icon" />
        <h5>Iuran Otomatis</h5>
        <p>
          Atur jadwal iuran bulanan atau tahunan, sistem akan otomatis mencatat dan mengirim notifikasi ke warga. Semua transaksi terekam dengan detail dan bisa dilihat oleh warga maupun pengurus.
        </p>
      </div>
    </div>
  </div>
</section>



<section id="testimoni" class="py-5 text-white" style="background-color: #2a2d4f;">
  <div class="container text-center">
    <h2 class="fw-bold mb-5" data-aos="fade-up">Apa Kata Mereka</h2>
    <div class="row g-4">
      <!-- Baris Pertama -->
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <p class="fst-italic">
          “Aplikasi ini bikin iuran warga jadi nggak ribet. Semua transparan dan tercatat! Saya nggak perlu lagi tulis-tulis di buku catatan, tinggal buka HP aja.”
        </p>
        <small class="text-light">— Bu Rina, Ketua RT 03</small>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <p class="fst-italic">
          “Gampang dipakai dan fitur-fiturnya lengkap. Bagus banget buat komunitas kecil kami yang tadinya masih catat manual. Sekarang tinggal klik-klik aja.”
        </p>
        <small class="text-light">— Pak Andi, Sekretaris RW 07</small>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <p class="fst-italic">
          “Sekarang nggak ada lagi alasan lupa bayar iuran. Ada notifikasi tiap bulan dan saya bisa lihat histori pembayaran sendiri.”
        </p>
        <small class="text-light">— Lina, Warga</small>
      </div>

      <!-- Baris Kedua, diberi margin-top -->
      <div class="w-100 d-none d-md-block mt-4"></div> <!-- Pemisah baris hanya di layar medium ke atas -->

      <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
        <p class="fst-italic">
          “Sangat membantu dalam laporan bulanan ke kelurahan. Data tinggal export, nggak perlu ketik ulang lagi.”
        </p>
        <small class="text-light">— Pak Joko, Bendahara RW</small>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
        <p class="fst-italic">
          “Saya bisa pantau semua iuran dari rumah, bahkan saat di luar kota. Sangat praktis dan efisien.”
        </p>
        <small class="text-light">— Ibu Sari, Warga</small>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
        <p class="fst-italic">
          “Kesan pertama saya: modern, ringan, dan sangat cocok untuk RT/RW digital. Bantu banget kerja pengurus.”
        </p>
        <small class="text-light">— Dimas, Karang Taruna</small>
      </div>
    </div>
  </div>
</section>


<section class="py-5 text-white" style="background: linear-gradient(135deg, #1e2140, #2a2d4f);">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0" data-aos="fade-right">
        <h2 class="fw-bold mb-3">Mulai Kelola Iuran Warga dengan Mudah</h2>
        <p class="lead">
          Tidak perlu lagi pencatatan manual, Excel rumit, atau lupa mengingatkan warga soal pembayaran.
          Semua bisa dilakukan secara otomatis, transparan, dan rapi—langsung dari dashboard Anda.
        </p>
        <ul class="list-unstyled">
          <li class="mb-2">✅ <strong>Pencatatan Otomatis</strong> tanpa repot</li>
          <li class="mb-2">✅ <strong>Histori Lengkap</strong> untuk warga & pengurus</li>
          <li class="mb-2">✅ <strong>Notifikasi Otomatis</strong> tiap bulan</li>
        </ul>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg rounded-pill fw-bold mt-3">Daftar Sekarang</a>
      </div>
      <div class="col-md-6 text-center" data-aos="fade-left">
        <img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" alt="Ilustrasi Iuran Komunitas Putih" class="img-fluid" style="max-height: 300px; filter: brightness(0) invert(1);">
      </div>
    </div>
  </div>
</section>






<section id="kontak" class="py-5 text-white" style="background-color: #2a2d4f;">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="fw-bold">Hubungi Kami</h2>
      <p class="text-light">
        Punya pertanyaan atau butuh bantuan? Kami siap membantu Anda kapan saja.
      </p>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
        <form>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" placeholder="Nama Anda">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="email@example.com">
          </div>
          <div class="mb-3">
            <label for="pesan" class="form-label">Pesan</label>
            <textarea class="form-control" id="pesan" rows="4" placeholder="Tulis pesan Anda..."></textarea>
          </div>
          <button type="submit" class="btn btn-light fw-bold rounded-pill">Kirim Pesan</button>
        </form>
      </div>
    </div>
    <div class="text-center mt-4 text-light" data-aos="fade-up" data-aos-delay="200">
      <p>Email: <a href="mailto:smkypctasikmalaya@gmail.com" class="text-white fw-bold">smkypctasikmalaya@gmail.com</a></p>
      <p>Telepon: <span class="fw-bold">+62 812-3456-7890</span></p>
    </div>
  </div>
</section>

@endsection
