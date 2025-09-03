@extends('layouts.landing')
@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="privacy-hero" class="hero section">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="display-4 mb-4">Kebijakan Privasi</h1>
                        <p class="lead">Layanan Desa Akat Fadedo</p>
                        <p class="text-muted">Terakhir diperbarui: 31 Maret 2025</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Privacy Policy Content -->
        <section id="privacy-content" class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <!-- Pendahuluan -->
                        <div class="content-section mb-5" data-aos="fade-up">
                            <h2><i class="fas fa-info-circle"></i> Pendahuluan</h2>
                            <p>Kebijakan Privasi ini menjelaskan bagaimana Pemerintah Desa Akat Fadedo mengumpulkan,
                                menggunakan, dan melindungi informasi pribadi Anda ketika menggunakan aplikasi "Layanan
                                Desa" dan layanan digital lainnya yang kami sediakan.</p>

                            <div class="alert alert-info">
                                <strong>Komitmen Kami:</strong> Kami berkomitmen untuk melindungi privasi dan keamanan data
                                pribadi warga desa sesuai dengan Undang-Undang No. 27 Tahun 2022 tentang Pelindungan Data
                                Pribadi (UU PDP).
                            </div>
                        </div>

                        <!-- Data yang Kami Kumpulkan -->
                        <div class="content-section mb-5" data-aos="fade-up">
                            <h2><i class="fas fa-database"></i> Data yang Kami Kumpulkan</h2>

                            <h3>1. Data Pribadi untuk Layanan Administratif</h3>
                            <ul class="data-list">
                                <li><strong>Identitas:</strong> Nama lengkap, NIK, tempat/tanggal lahir, jenis kelamin</li>
                                <li><strong>Alamat:</strong> Alamat lengkap, RT/RW, nomor rumah</li>
                                <li><strong>Kontak:</strong> Nomor HP, email (jika ada)</li>
                                <li><strong>Dokumen:</strong> KTP, KK, dokumen pendukung lainnya</li>
                                <li><strong>Foto:</strong> Pas foto untuk keperluan dokumen resmi</li>
                            </ul>

                            <h3>2. Data untuk Pengaduan Masyarakat</h3>
                            <ul class="data-list">
                                <li>Nama pelapor dan kontak</li>
                                <li>Lokasi kejadian/masalah</li>
                                <li>Deskripsi pengaduan</li>
                                <li>Foto/video pendukung (jika ada)</li>
                                <li>Waktu dan tanggal pelaporan</li>
                            </ul>

                            <h3>3. Data Teknis Aplikasi</h3>
                            <ul class="data-list">
                                <li>Alamat IP perangkat</li>
                                <li>Jenis perangkat dan browser</li>
                                <li>Waktu akses dan aktivitas dalam aplikasi</li>
                                <li>Data lokasi (untuk layanan yang memerlukan)</li>
                            </ul>
                        </div>

                        <!-- Tujuan Penggunaan Data -->
                        <div class="content-section mb-5" data-aos="fade-up">
                            <h2><i class="fas fa-bullseye"></i> Tujuan Penggunaan Data</h2>

                            <div class="purpose-grid">
                                <div class="purpose-card">
                                    <i class="fas fa-file-alt"></i>
                                    <h4>Pembuatan Surat</h4>
                                    <p>Memproses permohonan surat keterangan domisili, surat pengantar, dan dokumen
                                        administratif lainnya sesuai kebutuhan warga.</p>
                                </div>

                                <div class="purpose-card">
                                    <i class="fas fa-comments"></i>
                                    <h4>Penanganan Pengaduan</h4>
                                    <p>Menindaklanjuti laporan dan keluhan masyarakat terkait pelayanan publik,
                                        infrastruktur, dan masalah lainnya di desa.</p>
                                </div>

                                <div class="purpose-card">
                                    <i class="fas fa-chart-pie"></i>
                                    <h4>Transparansi APBDes</h4>
                                    <p>Menyediakan akses informasi anggaran desa yang transparan dan akuntabel kepada
                                        masyarakat.</p>
                                </div>

                                <div class="purpose-card">
                                    <i class="fas fa-newspaper"></i>
                                    <h4>Informasi dan Berita</h4>
                                    <p>Menyampaikan informasi terkini tentang program, kegiatan, dan perkembangan desa
                                        kepada warga.</p>
                                </div>

                                <div class="purpose-card">
                                    <i class="fas fa-shield-alt"></i>
                                    <h4>Keamanan dan Verifikasi</h4>
                                    <p>Memverifikasi identitas pemohon layanan dan mencegah penyalahgunaan sistem.</p>
                                </div>

                                <div class="purpose-card">
                                    <i class="fas fa-chart-line"></i>
                                    <h4>Evaluasi Layanan</h4>
                                    <p>Menganalisis penggunaan layanan untuk meningkatkan kualitas pelayanan kepada
                                        masyarakat.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Keamanan Data -->
                        <div class="content-section mb-5" data-aos="fade-up">
                            <h2><i class="fas fa-lock"></i> Keamanan dan Perlindungan Data</h2>

                            <div class="security-measures">
                                <div class="security-item">
                                    <i class="fas fa-server"></i>
                                    <div>
                                        <h4>Penyimpanan Aman</h4>
                                        <p>Data disimpan dalam server lokal dengan enkripsi dan backup rutin. Akses terbatas
                                            hanya untuk petugas yang berwenang.</p>
                                    </div>
                                </div>

                                <div class="security-item">
                                    <i class="fas fa-user-shield"></i>
                                    <div>
                                        <h4>Akses Terkontrol</h4>
                                        <p>Sistem login dengan autentikasi ganda dan pembatasan akses berdasarkan jabatan
                                            dan kewenangan petugas.</p>
                                    </div>
                                </div>

                                <div class="security-item">
                                    <i class="fas fa-history"></i>
                                    <div>
                                        <h4>Log Aktivitas</h4>
                                        <p>Semua aktivitas akses dan perubahan data tercatat dalam sistem log untuk audit
                                            dan pemantauan.</p>
                                    </div>
                                </div>

                                <div class="security-item">
                                    <i class="fas fa-trash-alt"></i>
                                    <div>
                                        <h4>Penghapusan Data</h4>
                                        <p>Data yang tidak diperlukan akan dihapus sesuai jadwal retensi dan peraturan yang
                                            berlaku.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hak Anda sebagai Warga -->
                        <div class="content-section mb-5" data-aos="fade-up">
                            <h2><i class="fas fa-gavel"></i> Hak Anda sebagai Warga</h2>

                            <div class="rights-section">
                                <div class="alert alert-success">
                                    <h4><i class="fas fa-info-circle"></i> Berdasarkan UU PDP, Anda memiliki hak:</h4>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="right-item">
                                            <i class="fas fa-eye"></i>
                                            <div>
                                                <h5>Hak Akses</h5>
                                                <p>Mengetahui data pribadi apa saja yang kami miliki tentang Anda</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="right-item">
                                            <i class="fas fa-edit"></i>
                                            <div>
                                                <h5>Hak Pembetulan</h5>
                                                <p>Meminta perbaikan jika ada data yang tidak akurat</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="right-item">
                                            <i class="fas fa-ban"></i>
                                            <div>
                                                <h5>Hak Pembatasan</h5>
                                                <p>Membatasi penggunaan data untuk tujuan tertentu</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="right-item">
                                            <i class="fas fa-trash"></i>
                                            <div>
                                                <h5>Hak Penghapusan</h5>
                                                <p>Meminta penghapusan data yang tidak diperlukan</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="right-item">
                                            <i class="fas fa-download"></i>
                                            <div>
                                                <h5>Hak Portabilitas</h5>
                                                <p>Mendapatkan salinan data dalam format yang dapat dibaca</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="right-item">
                                            <i class="fas fa-times-circle"></i>
                                            <div>
                                                <h5>Hak Penarikan Persetujuan</h5>
                                                <p>Menarik persetujuan penggunaan data kapan saja</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Berbagi Data -->
                        <div class="content-section mb-5" data-aos="fade-up">
                            <h2><i class="fas fa-share-alt"></i> Berbagi Data dengan Pihak Lain</h2>

                            <div class="alert alert-warning">
                                <strong>Prinsip Kami:</strong> Data pribadi Anda TIDAK akan dijual atau diperdagangkan
                                kepada pihak ketiga untuk kepentingan komersial.
                            </div>

                            <h3>Data dapat dibagikan dalam kondisi berikut:</h3>
                            <ul class="sharing-list">
                                <li><strong>Instansi Pemerintah:</strong> Kepada Kecamatan, Kabupaten, atau instansi terkait
                                    untuk keperluan administrasi yang sah</li>
                                <li><strong>Kewajiban Hukum:</strong> Jika diminta oleh penegak hukum dengan surat perintah
                                    yang sah</li>
                                <li><strong>Keadaan Darurat:</strong> Untuk melindungi keselamatan warga dalam situasi
                                    emergency</li>
                                <li><strong>Persetujuan Anda:</strong> Dengan persetujuan tertulis dari Anda untuk tujuan
                                    tertentu</li>
                            </ul>
                        </div>

                        <!-- Penyimpanan Data -->
                        <div class="content-section mb-5" data-aos="fade-up">
                            <h2><i class="fas fa-archive"></i> Penyimpanan Data</h2>

                            <div class="storage-info">
                                <div class="storage-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <div>
                                        <h4>Periode Penyimpanan</h4>
                                        <ul>
                                            <li><strong>Data Administratif:</strong> Sesuai peraturan arsip desa (minimal 10
                                                tahun)</li>
                                            <li><strong>Data Pengaduan:</strong> 3 tahun setelah penyelesaian</li>
                                            <li><strong>Data Teknis:</strong> 1 tahun untuk analisis sistem</li>
                                            <li><strong>Data Backup:</strong> 5 tahun untuk pemulihan sistem</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="storage-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div>
                                        <h4>Lokasi Penyimpanan</h4>
                                        <p>Data disimpan di server lokal Kantor Desa Akat Fadedo dengan sistem backup ke
                                            cloud server Indonesia yang tersertifikasi.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cookie dan teknologi Pelacakan -->
                        <div class="content-section mb-5" data-aos="fade-up">
                            <h2><i class="fas fa-cookie-bite"></i> Cookie dan Teknologi Pelacakan</h2>

                            <p>Aplikasi kami menggunakan cookie dan teknologi serupa untuk:</p>
                            <ul class="cookie-list">
                                <li><strong>Session Cookie:</strong> Menjaga sesi login Anda tetap aktif</li>
                                <li><strong>Preferensi Cookie:</strong> Mengingat pengaturan bahasa dan tampilan</li>
                                <li><strong>Analytics Cookie:</strong> Memahami pola penggunaan untuk perbaikan layanan</li>
                                <li><strong>Security Cookie:</strong> Melindungi dari serangan keamanan</li>
                            </ul>

                            <div class="alert alert-info">
                                <strong>Catatan:</strong> Anda dapat mengelola pengaturan cookie melalui browser Anda, namun
                                menonaktifkan cookie dapat mempengaruhi fungsi aplikasi.
                            </div>
                        </div>

                        <!-- Privasi Anak -->
                        <div class="content-section mb-5" data-aos="fade-up">
                            <h2><i class="fas fa-child"></i> Perlindungan Data Anak</h2>

                            <div class="child-protection">
                                <div class="alert alert-warning">
                                    <strong>Perhatian:</strong> Untuk warga di bawah 17 tahun, penggunaan layanan harus
                                    didampingi dan atas persetujuan orang tua/wali.
                                </div>

                                <h3>Perlindungan Khusus:</h3>
                                <ul>
                                    <li>Data anak di bawah 17 tahun memerlukan persetujuan orang tua/wali</li>
                                    <li>Penggunaan data anak sangat terbatas untuk keperluan administrasi saja</li>
                                    <li>Data anak tidak akan dibagikan kecuali untuk kepentingan terbaik anak</li>
                                    <li>Orang tua/wali dapat mengakses dan mengontrol data anak mereka</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Perubahan Kebijakan -->
                        <div class="content-section mb-5" data-aos="fade-up">
                            <h2><i class="fas fa-sync-alt"></i> Perubahan Kebijakan Privasi</h2>

                            <p>Kebijakan Privasi ini dapat berubah dari waktu ke waktu. Kami akan memberitahu perubahan
                                melalui:</p>
                            <ul>
                                <li>Pengumuman di aplikasi dan website desa</li>
                                <li>Pemberitahuan melalui SMS/WhatsApp (jika perubahan signifikan)</li>
                                <li>Pengumuman di papan pengumuman desa</li>
                                <li>Sosialisasi dalam pertemuan warga</li>
                            </ul>

                            <div class="alert alert-info">
                                <strong>Saran:</strong> Periksa kebijakan ini secara berkala untuk memahami bagaimana kami
                                melindungi informasi Anda.
                            </div>
                        </div>

                        <!-- Kontak dan Pengaduan -->
                        <div class="content-section mb-5" data-aos="fade-up">
                            <h2><i class="fas fa-phone"></i> Kontak dan Pengaduan Privasi</h2>

                            <p>Jika Anda memiliki pertanyaan, keluhan, atau ingin menggunakan hak-hak Anda terkait data
                                pribadi, hubungi kami melalui:</p>

                            <div class="contact-grid">
                                <div class="contact-card">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div>
                                        <h5>Kantor Desa</h5>
                                        <p>Desa Akat Fadedo<br>
                                            Kec. Seram Timur<br>
                                            Kab. Seram Bagian Timur, Maluku</p>
                                    </div>
                                </div>

                                <div class="contact-card">
                                    <i class="fas fa-phone"></i>
                                    <div>
                                        <h5>Telepon</h5>
                                        <p>+62 822-2360-7709<br>
                                            <small>Jam Kerja: 08:00 - 16:00 WIT<br>Senin - Jumat</small>
                                        </p>
                                    </div>
                                </div>

                                <div class="contact-card">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <h5>Email</h5>
                                        <p>admindesa@akatfadedo.com<br>
                                            <small>Respon dalam 2x24 jam</small>
                                        </p>
                                    </div>
                                </div>

                                <div class="contact-card">
                                    <i class="fas fa-user-tie"></i>
                                    <div>
                                        <h5>Petugas Perlindungan Data</h5>
                                        <p>Sekretaris Desa<br>
                                            <small>Bertanggung jawab atas penanganan keluhan privasi</small>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="complaint-process">
                                <h3>Prosedur Pengaduan:</h3>
                                <ol>
                                    <li><strong>Ajukan pengaduan</strong> secara tertulis dengan identitas jelas</li>
                                    <li><strong>Kami akan merespon</strong> dalam maksimal 3 hari kerja</li>
                                    <li><strong>Investigasi</strong> akan dilakukan dalam 14 hari kerja</li>
                                    <li><strong>Tindak lanjut</strong> akan diinformasikan kepada Anda</li>
                                    <li><strong>Jika tidak puas</strong>, Anda dapat melaporkan ke Kominfo Kabupaten</li>
                                </ol>
                            </div>
                        </div>

                        <!-- Penutup -->
                        <div class="content-section mb-5" data-aos="fade-up">
                            <div class="closing-statement">
                                <h2><i class="fas fa-handshake"></i> Komitmen Kami</h2>
                                <p class="lead">Pemerintah Desa Akat Fadedo berkomitmen untuk terus meningkatkan
                                    perlindungan data pribadi warga desa. Kami percaya bahwa transparansi dan akuntabilitas
                                    dalam pengelolaan data adalah kunci kepercayaan masyarakat.</p>

                                <div class="commitment-box">
                                    <h4>Janji Kami kepada Warga:</h4>
                                    <ul>
                                        <li>Selalu mengutamakan keamanan dan privasi data Anda</li>
                                        <li>Menggunakan data hanya untuk kepentingan pelayanan publik</li>
                                        <li>Memberikan layanan yang transparan dan dapat dipertanggungjawabkan</li>
                                        <li>Terus belajar dan meningkatkan sistem keamanan data</li>
                                        <li>Menghormati hak-hak Anda sebagai pemilik data pribadi</li>
                                    </ul>
                                </div>

                                <p class="text-center mt-4">
                                    <strong>Desa Akat Fadedo - Melayani dengan Teknologi, Melindungi dengan Hati</strong>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main>

    <style>
        /* Basic Styles */
        .content-section {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .content-section h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .content-section h3 {
            color: #34495e;
            margin-top: 25px;
            margin-bottom: 15px;
        }

        /* Data Lists */
        .data-list,
        .sharing-list,
        .cookie-list {
            list-style: none;
            padding: 0;
        }

        .data-list li,
        .sharing-list li,
        .cookie-list li {
            padding: 8px 0;
            border-bottom: 1px solid #ecf0f1;
        }

        .data-list li:last-child,
        .sharing-list li:last-child,
        .cookie-list li:last-child {
            border-bottom: none;
        }

        /* Purpose Grid */
        .purpose-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .purpose-card {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
            border-top: 4px solid #3498db;
            transition: transform 0.2s;
        }

        .purpose-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .purpose-card i {
            font-size: 2.5em;
            color: #3498db;
            margin-bottom: 15px;
        }

        .purpose-card h4 {
            color: #2c3e50;
            margin-bottom: 15px;
        }

        /* Security Measures */
        .security-measures {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .security-item {
            display: flex;
            align-items: flex-start;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #27ae60;
        }

        .security-item i {
            font-size: 2em;
            color: #27ae60;
            margin-right: 20px;
            margin-top: 5px;
        }

        .security-item h4 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        /* Rights Section */
        .right-item {
            display: flex;
            align-items: flex-start;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #e74c3c;
        }

        .right-item i {
            font-size: 1.5em;
            color: #e74c3c;
            margin-right: 15px;
            margin-top: 5px;
        }

        .right-item h5 {
            color: #2c3e50;
            margin-bottom: 8px;
        }

        /* Storage Info */
        .storage-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .storage-item {
            display: flex;
            align-items: flex-start;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #f39c12;
        }

        .storage-item i {
            font-size: 2em;
            color: #f39c12;
            margin-right: 20px;
            margin-top: 5px;
        }

        .storage-item h4 {
            color: #2c3e50;
            margin-bottom: 15px;
        }

        /* Contact Grid */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .contact-card {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
            border-top: 4px solid #9b59b6;
        }

        .contact-card i {
            font-size: 2em;
            color: #9b59b6;
            margin-bottom: 15px;
        }

        .contact-card h5 {
            color: #2c3e50;
            margin-bottom: 15px;
        }

        /* Complaint Process */
        .complaint-process {
            background: #e8f5e8;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .complaint-process h3 {
            color: #27ae60;
        }

        .complaint-process ol li {
            margin-bottom: 10px;
            line-height: 1.6;
        }

        /* Commitment Box */
        .commitment-box {
            background: #e3f2fd;
            padding: 25px;
            border-radius: 8px;
            border-left: 5px solid #2196f3;
            margin: 20px 0;
        }

        .commitment-box h4 {
            color: #1976d2;
            margin-bottom: 15px;
        }

        .commitment-box ul li {
            margin-bottom: 8px;
            line-height: 1.6;
        }

        /* Closing Statement */
        .closing-statement {
            text-align: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            border-radius: 10px;
        }

        .closing-statement h2 {
            color: white;
            border-bottom: 2px solid white;
        }

        .closing-statement .lead {
            font-size: 1.1em;
            margin-bottom: 30px;
        }

        /* Hero Section */
        #privacy-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 8px;
            padding: 20px;
        }

        .alert-info {
            background-color: #e3f2fd;
            color: #1565c0;
            border-left: 4px solid #2196f3;
        }

        .alert-warning {
            background-color: #fff3e0;
            color: #e65100;
            border-left: 4px solid #ff9800;
        }

        .alert-success {
            background-color: #e8f5e8;
            color: #2e7d32;
            border-left: 4px solid #4caf50;
        }

        /* Responsive Design */
        @media (max-width: 768px) {

            .purpose-grid,
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .content-section {
                padding: 20px;
            }

            .security-item,
            .right-item,
            .storage-item {
                flex-direction: column;
                text-align: center;
            }

            .security-item i,
            .right-item i,
            .storage-item i {
                margin-right: 0;
                margin-bottom: 15px;
            }

            #privacy-hero {
                padding: 60px 0;
            }

            .closing-statement {
                padding: 30px 20px;
            }
        }

        /* Animation */
        .content-section {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Utility Classes */
        .text-justify {
            text-align: justify;
        }

        .mb-custom {
            margin-bottom: 2rem;
        }

        /* Print Styles */
        @media print {
            .content-section {
                box-shadow: none;
                border: 1px solid #ddd;
                page-break-inside: avoid;
            }

            .purpose-card,
            .contact-card {
                break-inside: avoid;
            }

            #privacy-hero {
                background: none !important;
                color: #333 !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for internal links
            const links = document.querySelectorAll('a[href^="#"]');

            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Back to top button
            let backToTopBtn = document.createElement('button');
            backToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
            backToTopBtn.className = 'btn btn-primary position-fixed';
            backToTopBtn.style.cssText = `
                bottom: 20px;
                right: 20px;
                z-index: 1000;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                display: none;
                box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
            `;
            backToTopBtn.title = 'Kembali ke atas';
            document.body.appendChild(backToTopBtn);

            // Show/hide back to top button
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopBtn.style.display = 'block';
                } else {
                    backToTopBtn.style.display = 'none';
                }
            });

            // Back to top click event
            backToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Add hover effects to cards
            const cards = document.querySelectorAll('.purpose-card, .contact-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Highlight important sections
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.02)';
                    this.style.transition = 'all 0.2s ease';
                });

                alert.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });

            // Copy to clipboard functionality for contact info
            const contactCards = document.querySelectorAll('.contact-card');
            contactCards.forEach(card => {
                card.addEventListener('click', function() {
                    const textContent = this.textContent.trim();
                    if (navigator.clipboard) {
                        navigator.clipboard.writeText(textContent).then(() => {
                            // Show temporary feedback
                            const originalHTML = this.innerHTML;
                            this.innerHTML =
                                '<i class="fas fa-check"></i><div><h5>Disalin!</h5><p>Informasi kontak telah disalin</p></div>';
                            setTimeout(() => {
                                this.innerHTML = originalHTML;
                            }, 2000);
                        });
                    }
                });
            });

            // Reading progress indicator
            const progressBar = document.createElement('div');
            progressBar.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 0%;
                height: 4px;
                background: linear-gradient(to right, #3498db, #2ecc71);
                z-index: 9999;
                transition: width 0.3s ease;
            `;
            document.body.appendChild(progressBar);

            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset;
                const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                const scrollPercent = (scrollTop / docHeight) * 100;
                progressBar.style.width = scrollPercent + '%';
            });

            // Print functionality
            const printBtn = document.createElement('button');
            printBtn.innerHTML = '<i class="fas fa-print"></i> Cetak';
            printBtn.className = 'btn btn-outline-primary position-fixed';
            printBtn.style.cssText = `
                bottom: 80px;
                right: 20px;
                z-index: 1000;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            `;
            printBtn.title = 'Cetak halaman ini';
            document.body.appendChild(printBtn);

            printBtn.addEventListener('click', function() {
                window.print();
            });
        });
    </script>
@endsection
