@extends('layouts.landing')
@section('content')
    <main class="main">

        <!-- Hero Section for Privacy Policy -->
        <section id="privacy-hero" class="hero section">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="display-4 mb-4">Kebijakan Privasi</h1>
                        <p class="lead">Terakhir diperbarui: 31 Maret 2025</p>
                        <p class="text-muted">Kebijakan Privasi ini menjelaskan kebijakan dan prosedur kami tentang
                            pengumpulan, penggunaan, dan pengungkapan informasi Anda ketika menggunakan Layanan.</p>
                    </div>
                </div>
            </div>
        </section><!-- /Hero Section -->

        <!-- Privacy Policy Content -->
        <section id="privacy-content" class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <!-- Table of Contents -->
                        <div class="sticky-top" style="top: 100px;" data-aos="fade-right">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Isi</h5>
                                </div>
                                <div class="card-body">
                                    <nav class="nav flex-column">
                                        <a class="nav-link" href="#interpretasi">Interpretasi & Definisi</a>
                                        <a class="nav-link" href="#pengumpulan-data">Pengumpulan Data</a>
                                        <a class="nav-link" href="#jenis-data">Jenis Data</a>
                                        <a class="nav-link" href="#penggunaan-data">Penggunaan Data</a>
                                        <a class="nav-link" href="#penyimpanan-data">Penyimpanan Data</a>
                                        <a class="nav-link" href="#transfer-data">Transfer Data</a>
                                        <a class="nav-link" href="#hapus-data">Hapus Data</a>
                                        <a class="nav-link" href="#pengungkapan-data">Pengungkapan Data</a>
                                        <a class="nav-link" href="#keamanan-data">Keamanan Data</a>
                                        <a class="nav-link" href="#privasi-anak">Privasi Anak</a>
                                        <a class="nav-link" href="#tautan-eksternal">Tautan Eksternal</a>
                                        <a class="nav-link" href="#perubahan-kebijakan">Perubahan Kebijakan</a>
                                        <a class="nav-link" href="#kontak">Kontak</a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="privacy-content" data-aos="fade-left">

                            <!-- Introduction -->
                            <div class="content-section mb-5">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Penting:</strong> Kami menggunakan Data Pribadi Anda untuk menyediakan dan
                                    meningkatkan Layanan. Dengan menggunakan Layanan, Anda menyetujui pengumpulan dan
                                    penggunaan informasi sesuai dengan Kebijakan Privasi ini.
                                </div>
                            </div>

                            <!-- Interpretasi dan Definisi -->
                            <div id="interpretasi" class="content-section mb-5">
                                <h2 class="section-title">
                                    <i class="fas fa-book"></i> Interpretasi dan Definisi
                                </h2>

                                <h3 class="subsection-title">Interpretasi</h3>
                                <p class="content-text">Kata-kata yang huruf awalnya menggunakan huruf kapital memiliki
                                    makna yang didefinisikan dalam kondisi berikut. Definisi berikut akan memiliki makna
                                    yang sama terlepas dari apakah mereka muncul dalam bentuk tunggal atau jamak.</p>

                                <h3 class="subsection-title">Definisi</h3>
                                <p class="content-text">Untuk keperluan Kebijakan Privasi ini:</p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="definition-card">
                                            <h5><i class="fas fa-user-circle"></i> Akun</h5>
                                            <p>Akun unik yang dibuat untuk Anda mengakses Layanan kami atau bagian dari
                                                Layanan kami.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="definition-card">
                                            <h5><i class="fas fa-building"></i> Afiliasi</h5>
                                            <p>Entitas yang mengendalikan, dikendalikan oleh atau berada di bawah kendali
                                                bersama dengan suatu pihak.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="definition-card">
                                            <h5><i class="fas fa-mobile-alt"></i> Aplikasi</h5>
                                            <p>Mengacu pada Layanan Desa, program perangkat lunak yang disediakan oleh
                                                Perusahaan.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="definition-card">
                                            <h5><i class="fas fa-home"></i> Perusahaan</h5>
                                            <p>Mengacu pada Layanan Desa (disebut sebagai "Perusahaan", "Kami", "Kita" atau
                                                "Milik Kami").</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="definition-card">
                                            <h5><i class="fas fa-flag"></i> Negara</h5>
                                            <p>Mengacu pada: Indonesia</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="definition-card">
                                            <h5><i class="fas fa-laptop"></i> Perangkat</h5>
                                            <p>Perangkat apa pun yang dapat mengakses Layanan seperti komputer, ponsel, atau
                                                tablet digital.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pengumpulan dan Penggunaan Data -->
                            <div id="pengumpulan-data" class="content-section mb-5">
                                <h2 class="section-title">
                                    <i class="fas fa-database"></i> Pengumpulan dan Penggunaan Data Pribadi Anda
                                </h2>
                            </div>

                            <!-- Jenis Data yang Dikumpulkan -->
                            <div id="jenis-data" class="content-section mb-5">
                                <h3 class="subsection-title">Jenis Data yang Dikumpulkan</h3>

                                <div class="data-type-section">
                                    <h4><i class="fas fa-user"></i> Data Pribadi</h4>
                                    <p class="content-text">Saat menggunakan Layanan Kami, Kami mungkin meminta Anda untuk
                                        memberikan informasi yang dapat diidentifikasi secara pribadi yang dapat digunakan
                                        untuk menghubungi atau mengidentifikasi Anda.</p>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="feature-list">
                                                <li><i class="fas fa-envelope"></i> Alamat email</li>
                                                <li><i class="fas fa-user"></i> Nama depan dan nama belakang</li>
                                                <li><i class="fas fa-phone"></i> Nomor telepon</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="feature-list">
                                                <li><i class="fas fa-map-marker-alt"></i> Alamat, Provinsi, Kode Pos, Kota
                                                </li>
                                                <li><i class="fas fa-chart-line"></i> Data Penggunaan</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="data-type-section">
                                    <h4><i class="fas fa-chart-bar"></i> Data Penggunaan</h4>
                                    <p class="content-text">Data Penggunaan dikumpulkan secara otomatis saat menggunakan
                                        Layanan.</p>
                                    <div class="alert alert-light">
                                        <p><strong>Data yang dapat dikumpulkan meliputi:</strong></p>
                                        <ul>
                                            <li>Alamat Protokol Internet perangkat Anda (misalnya alamat IP)</li>
                                            <li>Jenis browser, versi browser</li>
                                            <li>Halaman Layanan kami yang Anda kunjungi</li>
                                            <li>Waktu dan tanggal kunjungan Anda</li>
                                            <li>ID unik perangkat dan data diagnostik lainnya</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="data-type-section">
                                    <h4><i class="fas fa-share-alt"></i> Informasi dari Layanan Media Sosial Pihak Ketiga
                                    </h4>
                                    <p class="content-text">Perusahaan memungkinkan Anda membuat akun dan masuk untuk
                                        menggunakan Layanan melalui Layanan Media Sosial Pihak Ketiga berikut:</p>

                                    <div class="social-media-grid">
                                        <div class="social-item">
                                            <i class="fab fa-google"></i>
                                            <span>Google</span>
                                        </div>
                                        <div class="social-item">
                                            <i class="fab fa-facebook"></i>
                                            <span>Facebook</span>
                                        </div>
                                        <div class="social-item">
                                            <i class="fab fa-instagram"></i>
                                            <span>Instagram</span>
                                        </div>
                                        <div class="social-item">
                                            <i class="fab fa-twitter"></i>
                                            <span>Twitter</span>
                                        </div>
                                        <div class="social-item">
                                            <i class="fab fa-linkedin"></i>
                                            <span>LinkedIn</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="data-type-section">
                                    <h4><i class="fas fa-mobile-alt"></i> Informasi yang Dikumpulkan saat Menggunakan
                                        Aplikasi</h4>
                                    <p class="content-text">Saat menggunakan Aplikasi Kami, untuk memberikan fitur Aplikasi
                                        Kami, Kami dapat mengumpulkan, dengan izin Anda sebelumnya:</p>

                                    <div class="permission-cards">
                                        <div class="permission-card">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <h5>Informasi Lokasi</h5>
                                            <p>Informasi mengenai lokasi Anda</p>
                                        </div>
                                        <div class="permission-card">
                                            <i class="fas fa-address-book"></i>
                                            <h5>Buku Kontak</h5>
                                            <p>Informasi dari buku telepon Perangkat Anda</p>
                                        </div>
                                        <div class="permission-card">
                                            <i class="fas fa-camera"></i>
                                            <h5>Kamera & Galeri</h5>
                                            <p>Gambar dan informasi lain dari kamera dan galeri foto Perangkat Anda</p>
                                        </div>
                                    </div>

                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <strong>Catatan:</strong> Anda dapat mengaktifkan atau menonaktifkan akses ke
                                        informasi ini kapan saja, melalui pengaturan Perangkat Anda.
                                    </div>
                                </div>
                            </div>

                            <!-- Penggunaan Data Pribadi -->
                            <div id="penggunaan-data" class="content-section mb-5">
                                <h3 class="subsection-title">Penggunaan Data Pribadi Anda</h3>
                                <p class="content-text">Perusahaan dapat menggunakan Data Pribadi untuk tujuan berikut:</p>

                                <div class="usage-grid">
                                    <div class="usage-card">
                                        <i class="fas fa-cogs"></i>
                                        <h5>Menyediakan dan Memelihara Layanan</h5>
                                        <p>Termasuk memantau penggunaan Layanan kami.</p>
                                    </div>
                                    <div class="usage-card">
                                        <i class="fas fa-user-cog"></i>
                                        <h5>Mengelola Akun Anda</h5>
                                        <p>Mengelola pendaftaran Anda sebagai pengguna Layanan.</p>
                                    </div>
                                    <div class="usage-card">
                                        <i class="fas fa-handshake"></i>
                                        <h5>Pelaksanaan Kontrak</h5>
                                        <p>Pengembangan, kepatuhan dan pelaksanaan kontrak pembelian.</p>
                                    </div>
                                    <div class="usage-card">
                                        <i class="fas fa-phone"></i>
                                        <h5>Menghubungi Anda</h5>
                                        <p>Melalui email, telepon, SMS, atau komunikasi elektronik lainnya.</p>
                                    </div>
                                    <div class="usage-card">
                                        <i class="fas fa-bullhorn"></i>
                                        <h5>Memberikan Penawaran</h5>
                                        <p>Berita, penawaran khusus dan informasi umum tentang barang dan layanan.</p>
                                    </div>
                                    <div class="usage-card">
                                        <i class="fas fa-tasks"></i>
                                        <h5>Mengelola Permintaan</h5>
                                        <p>Melayani dan mengelola permintaan Anda kepada Kami.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Penyimpanan Data -->
                            <div id="penyimpanan-data" class="content-section mb-5">
                                <h3 class="subsection-title">Penyimpanan Data Pribadi Anda</h3>
                                <div class="info-box">
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <h5>Periode Penyimpanan</h5>
                                        <p class="content-text">Perusahaan akan menyimpan Data Pribadi Anda hanya selama
                                            diperlukan untuk tujuan yang ditetapkan dalam Kebijakan Privasi ini. Kami akan
                                            menyimpan dan menggunakan Data Pribadi Anda sejauh yang diperlukan untuk
                                            mematuhi kewajiban hukum kami, menyelesaikan perselisihan, dan menegakkan
                                            perjanjian dan kebijakan hukum kami.</p>

                                        <p class="content-text"><strong>Data Penggunaan</strong> umumnya disimpan untuk
                                            periode waktu yang lebih singkat, kecuali ketika data ini digunakan untuk
                                            memperkuat keamanan atau meningkatkan fungsionalitas Layanan Kami.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Transfer Data -->
                            <div id="transfer-data" class="content-section mb-5">
                                <h3 class="subsection-title">Transfer Data Pribadi Anda</h3>
                                <div class="alert alert-info">
                                    <i class="fas fa-globe"></i>
                                    <p><strong>Transfer Lintas Batas:</strong> Informasi Anda, termasuk Data Pribadi,
                                        diproses di kantor operasi Perusahaan dan di tempat lain di mana pihak-pihak yang
                                        terlibat dalam pemrosesan berada. Ini berarti informasi ini dapat ditransfer ke —
                                        dan dipelihara di — komputer yang terletak di luar negara bagian, provinsi, negara,
                                        atau yurisdiksi pemerintahan lainnya.</p>

                                    <p>Persetujuan Anda terhadap Kebijakan Privasi ini diikuti dengan pengiriman informasi
                                        tersebut mewakili persetujuan Anda terhadap transfer tersebut.</p>
                                </div>
                            </div>

                            <!-- Hapus Data -->
                            <div id="hapus-data" class="content-section mb-5">
                                <h3 class="subsection-title">Hapus Data Pribadi Anda</h3>
                                <div class="rights-section">
                                    <h5><i class="fas fa-user-shield"></i> Hak Anda</h5>
                                    <p class="content-text">Anda memiliki hak untuk menghapus atau meminta agar Kami
                                        membantu menghapus Data Pribadi yang telah Kami kumpulkan tentang Anda.</p>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="right-card">
                                                <i class="fas fa-edit"></i>
                                                <h6>Akses Pengaturan</h6>
                                                <p>Anda dapat memperbarui, mengubah, atau menghapus informasi Anda dengan
                                                    masuk ke Akun Anda dan mengunjungi bagian pengaturan akun.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="right-card">
                                                <i class="fas fa-envelope"></i>
                                                <h6>Hubungi Kami</h6>
                                                <p>Anda juga dapat menghubungi Kami untuk meminta akses, koreksi, atau
                                                    penghapusan informasi pribadi yang telah Anda berikan.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <strong>Catatan:</strong> Kami mungkin perlu menyimpan informasi tertentu ketika
                                        kami memiliki kewajiban hukum atau dasar hukum untuk melakukannya.
                                    </div>
                                </div>
                            </div>

                            <!-- Pengungkapan Data -->
                            <div id="pengungkapan-data" class="content-section mb-5">
                                <h3 class="subsection-title">Pengungkapan Data Pribadi Anda</h3>

                                <div class="disclosure-types">
                                    <div class="disclosure-card">
                                        <i class="fas fa-building"></i>
                                        <h5>Transaksi Bisnis</h5>
                                        <p>Jika Perusahaan terlibat dalam merger, akuisisi atau penjualan aset, Data Pribadi
                                            Anda mungkin ditransfer. Kami akan memberikan pemberitahuan sebelum Data Pribadi
                                            Anda ditransfer.</p>
                                    </div>

                                    <div class="disclosure-card">
                                        <i class="fas fa-gavel"></i>
                                        <h5>Penegakan Hukum</h5>
                                        <p>Dalam keadaan tertentu, Perusahaan mungkin diminta untuk mengungkapkan Data
                                            Pribadi Anda jika diminta oleh hukum atau sebagai respons terhadap permintaan
                                            yang sah dari otoritas publik.</p>
                                    </div>

                                    <div class="disclosure-card">
                                        <i class="fas fa-shield-alt"></i>
                                        <h5>Persyaratan Hukum Lainnya</h5>
                                        <p>Perusahaan dapat mengungkapkan Data Pribadi Anda dengan itikad baik bahwa
                                            tindakan tersebut diperlukan untuk:</p>
                                        <ul class="mt-2">
                                            <li>Mematuhi kewajiban hukum</li>
                                            <li>Melindungi dan membela hak atau properti Perusahaan</li>
                                            <li>Mencegah atau menyelidiki kemungkinan kesalahan</li>
                                            <li>Melindungi keselamatan pribadi Pengguna atau publik</li>
                                            <li>Melindungi terhadap tanggung jawab hukum</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Keamanan Data -->
                            <div id="keamanan-data" class="content-section mb-5">
                                <h3 class="subsection-title">Keamanan Data Pribadi Anda</h3>
                                <div class="security-section">
                                    <div class="alert alert-success">
                                        <i class="fas fa-lock"></i>
                                        <div>
                                            <h5>Komitmen Keamanan</h5>
                                            <p>Keamanan Data Pribadi Anda penting bagi Kami, tetapi ingat bahwa tidak ada
                                                metode transmisi melalui Internet, atau metode penyimpanan elektronik yang
                                                100% aman. Meskipun Kami berusaha menggunakan cara yang dapat diterima
                                                secara komersial untuk melindungi Data Pribadi Anda, Kami tidak dapat
                                                menjamin keamanan absolutnya.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Privasi Anak -->
                            <div id="privasi-anak" class="content-section mb-5">
                                <h3 class="subsection-title">Privasi Anak</h3>
                                <div class="children-privacy">
                                    <div class="alert alert-warning">
                                        <i class="fas fa-child"></i>
                                        <div>
                                            <h5>Perlindungan Anak di Bawah 13 Tahun</h5>
                                            <p>Layanan Kami tidak ditujukan untuk siapa pun yang berusia di bawah 13 tahun.
                                                Kami tidak secara sengaja mengumpulkan informasi yang dapat diidentifikasi
                                                secara pribadi dari siapa pun yang berusia di bawah 13 tahun.</p>

                                            <p><strong>Jika Anda adalah orang tua atau wali</strong> dan Anda mengetahui
                                                bahwa anak Anda telah memberikan Data Pribadi kepada Kami, silakan hubungi
                                                Kami.</p>

                                            <p><strong>Jika Kami mengetahui</strong> bahwa Kami telah mengumpulkan Data
                                                Pribadi dari siapa pun yang berusia di bawah 13 tahun tanpa verifikasi
                                                persetujuan orang tua, Kami mengambil langkah-langkah untuk menghapus
                                                informasi tersebut dari server Kami.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tautan ke Situs Web Lain -->
                            <div id="tautan-eksternal" class="content-section mb-5">
                                <h3 class="subsection-title">Tautan ke Situs Web Lain</h3>
                                <div class="external-links">
                                    <div class="info-box">
                                        <i class="fas fa-external-link-alt"></i>
                                        <div>
                                            <p class="content-text">Layanan Kami mungkin berisi tautan ke situs web lain
                                                yang tidak dioperasikan oleh Kami. Jika Anda mengklik tautan pihak ketiga,
                                                Anda akan diarahkan ke situs pihak ketiga tersebut.</p>

                                            <p class="content-text"><strong>Kami sangat menyarankan</strong> Anda untuk
                                                meninjau Kebijakan Privasi dari setiap situs yang Anda kunjungi.</p>

                                            <p class="content-text">Kami tidak memiliki kendali atas dan tidak bertanggung
                                                jawab atas konten, kebijakan privasi, atau praktik dari situs atau layanan
                                                pihak ketiga mana pun.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Perubahan Kebijakan -->
                            <div id="perubahan-kebijakan" class="content-section mb-5">
                                <h3 class="subsection-title">Perubahan pada Kebijakan Privasi Ini</h3>
                                <div class="policy-changes">
                                    <div class="info-box">
                                        <i class="fas fa-sync-alt"></i>
                                        <div>
                                            <p class="content-text">Kami dapat memperbarui Kebijakan Privasi Kami dari
                                                waktu ke waktu. Kami akan memberi tahu Anda tentang perubahan apa pun dengan
                                                memposting Kebijakan Privasi baru di halaman ini.</p>

                                            <p class="content-text">Kami akan memberi tahu Anda melalui email dan/atau
                                                pemberitahuan yang mencolok di Layanan Kami, sebelum perubahan menjadi
                                                efektif dan memperbarui tanggal "Terakhir diperbarui" di bagian atas
                                                Kebijakan Privasi ini.</p>

                                            <p class="content-text"><strong>Anda disarankan</strong> untuk meninjau
                                                Kebijakan Privasi ini secara berkala untuk setiap perubahan. Perubahan pada
                                                Kebijakan Privasi ini efektif ketika diposting di halaman ini.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kontak -->
                            <div id="kontak" class="content-section mb-5">
                                <h3 class="subsection-title">Hubungi Kami</h3>
                                <div class="contact-section">
                                    <p class="content-text">Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini,
                                        Anda dapat menghubungi kami:</p>

                                    <div class="contact-card">
                                        <i class="fas fa-envelope"></i>
                                        <div>
                                            <h5>Email</h5>
                                            <p><a href="mailto:info@layanan-desa.com">info@layanan-desa.com</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Privacy Policy Content -->

    </main>

    <style>
        /* Custom Styles for Privacy Policy */
        .privacy-content {
            font-family: 'Inter', sans-serif;
        }

        .section-title {
            color: #2c3e50;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .subsection-title {
            color: #34495e;
            margin-top: 25px;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .content-text {
            color: #5a6c7d;
            line-height: 1.7;
            text-align: justify;
            margin-bottom: 15px;
        }

        .content-section {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .definition-card,
        .usage-card,
        .permission-card,
        .disclosure-card,
        .right-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #3498db;
            transition: transform 0.2s;
        }

        .definition-card:hover,
        .usage-card:hover,
        .permission-card:hover,
        .disclosure-card:hover,
        .right-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .definition-card h5,
        .usage-card h5,
        .permission-card h5,
        .disclosure-card h5,
        .right-card h6 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .definition-card i,
        .usage-card i,
        .permission-card i,
        .disclosure-card i,
        .right-card i {
            color: #3498db;
            margin-right: 10px;
            font-size: 1.2em;
        }

        .social-media-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .social-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
        }

        .social-item:hover {
            border-color: #3498db;
            transform: translateY(-2px);
        }

        .social-item i {
            font-size: 2em;
            color: #3498db;
            margin-bottom: 8px;
            display: block;
        }

        .permission-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .permission-card {
            text-align: center;
            border-left: none;
            border-top: 4px solid #e74c3c;
        }

        .permission-card i {
            font-size: 2.5em;
            color: #e74c3c;
            margin-bottom: 15px;
            display: block;
        }

        .usage-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .usage-card {
            border-left-color: #2ecc71;
        }

        .feature-list {
            list-style: none;
            padding: 0;
        }

        .feature-list li {
            padding: 8px 0;
            color: #5a6c7d;
        }

        .feature-list li i {
            color: #3498db;
            margin-right: 10px;
            width: 20px;
        }

        .info-box,
        .contact-card {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            border-left: 5px solid #3498db;
            display: flex;
            align-items: flex-start;
        }

        .info-box i,
        .contact-card i {
            font-size: 2em;
            color: #3498db;
            margin-right: 20px;
            margin-top: 5px;
        }

        .info-box h5,
        .contact-card h5 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .rights-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #e9ecef;
        }

        .disclosure-types {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .disclosure-card {
            border-left-color: #f39c12;
        }

        .disclosure-card ul {
            color: #5a6c7d;
            margin-top: 10px;
        }

        .disclosure-card ul li {
            margin-bottom: 5px;
        }

        .security-section,
        .children-privacy,
        .external-links,
        .policy-changes {
            margin: 20px 0;
        }

        .contact-card a {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }

        .contact-card a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        /* Table of Contents Styles */
        .nav-link {
            color: #5a6c7d;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s;
            font-size: 0.9em;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: #3498db;
            color: white !important;
            text-decoration: none;
        }

        /* Alert Customizations */
        .alert {
            border: none;
            border-radius: 8px;
            padding: 20px;
        }

        .alert-info {
            background-color: #e8f4fd;
            color: #1e5799;
            border-left: 4px solid #3498db;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border-left: 4px solid #ffc107;
        }

        .alert-success {
            background-color: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
        }

        .alert-light {
            background-color: #fefefe;
            color: #495057;
            border: 1px solid #e9ecef;
        }

        /* Responsive Design */
        @media (max-width: 768px) {

            .usage-grid,
            .permission-cards {
                grid-template-columns: 1fr;
            }

            .social-media-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .content-section {
                padding: 20px;
            }

            .info-box,
            .contact-card {
                flex-direction: column;
                text-align: center;
            }

            .info-box i,
            .contact-card i {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Active Section Highlighting */
        .content-section:target {
            background-color: #f0f8ff;
            border: 2px solid #3498db;
        }

        /* Custom Scrollbar for Table of Contents */
        .nav {
            max-height: 400px;
            overflow-y: auto;
        }

        .nav::-webkit-scrollbar {
            width: 4px;
        }

        .nav::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .nav::-webkit-scrollbar-thumb {
            background: #3498db;
            border-radius: 2px;
        }

        .nav::-webkit-scrollbar-thumb:hover {
            background: #2980b9;
        }

        /* Hero Section Styles */
        #privacy-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }

        #privacy-hero h1 {
            font-weight: 700;
            margin-bottom: 20px;
        }

        #privacy-hero .lead {
            font-size: 1.1em;
            opacity: 0.9;
        }

        #privacy-hero .text-muted {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        /* Card Header Styles */
        .card-header {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            border-bottom: none;
        }

        .card {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        /* Animation Classes */
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

        /* Print Styles */
        @media print {

            .sticky-top,
            .nav {
                display: none;
            }

            .content-section {
                box-shadow: none;
                border: 1px solid #ddd;
                page-break-inside: avoid;
            }

            .section-title {
                page-break-after: avoid;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for navigation links
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        // Remove active class from all links
                        navLinks.forEach(navLink => navLink.classList.remove('active'));

                        // Add active class to clicked link
                        this.classList.add('active');

                        // Smooth scroll to target
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Highlight active section on scroll
            const sections = document.querySelectorAll('.content-section[id]');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        const activeLink = document.querySelector(`.nav-link[href="#${id}"]`);

                        // Remove active class from all links
                        navLinks.forEach(navLink => navLink.classList.remove('active'));

                        // Add active class to current section link
                        if (activeLink) {
                            activeLink.classList.add('active');
                        }
                    }
                });
            }, {
                rootMargin: '-20% 0px -80% 0px'
            });

            sections.forEach(section => {
                observer.observe(section);
            });

            // Add loading animation to cards
            const cards = document.querySelectorAll(
                '.definition-card, .usage-card, .permission-card, .disclosure-card, .right-card');

            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Add click effect to social media items
            const socialItems = document.querySelectorAll('.social-item');
            socialItems.forEach(item => {
                item.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                });
            });

            // Back to top functionality
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

            // Add hover effects to info boxes
            const infoBoxes = document.querySelectorAll('.info-box, .contact-card');
            infoBoxes.forEach(box => {
                box.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                    this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.1)';
                });

                box.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                });
            });
        });
    </script>
@endsection
