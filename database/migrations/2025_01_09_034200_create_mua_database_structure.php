<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hapus tabel jika sudah ada untuk menghindari error "Table already exists"
        // Urutan penghapusan penting karena Foreign Key constraints
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('kegiatan');
        Schema::dropIfExists('donasi');
        Schema::dropIfExists('partnerships'); // Ubah nama tabel jadi plural (standar Laravel)
        Schema::dropIfExists('berita');
        Schema::dropIfExists('pengguna');
        Schema::dropIfExists('pengeluaran');
        Schema::dropIfExists('admin');
        Schema::enableForeignKeyConstraints();

        // 1. Tabel Admin
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
        });

        // Insert Data Admin Default
        DB::table('admin')->insert([
            ['nama' => 'admin1', 'email' => 'admin1@mua.com', 'password' => 'admin111'], // Password belum di-hash sesuai dump, sebaiknya di-hash di aplikasi
            ['nama' => 'admin2', 'email' => 'admin2@mua.com', 'password' => 'admin222'],
            ['nama' => 'admin3', 'email' => 'admin3@mua.com', 'password' => 'admin333'],
            ['nama' => 'admin4', 'email' => 'admin4@mua.com', 'password' => 'admin444'],
        ]);

        // 2. Tabel Pengguna (Users)
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->date('tgl_lahir')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->string('role', 20)->default('user'); // Tambahan kolom role agar LoginController berfungsi
            $table->rememberToken();
            $table->timestamps();
        });

        // 3. Tabel Berita
        Schema::create('berita', function (Blueprint $table) {
            $table->increments('id_berita');
            $table->string('judul', 255);
            $table->text('deskripsi')->nullable();
            $table->string('gambar', 255)->nullable();
            $table->date('tanggal');
            $table->string('lokasi', 50);
            $table->string('peserta', 100);
            $table->string('tag1', 20);
            $table->string('tag2', 20);
            $table->string('tag3', 20);
            $table->timestamps();
        });

        // Insert Data Berita
        DB::table('berita')->insert([
            ['id_berita' => 1, 'judul' => 'tanambakau', 'deskripsi' => 'Kegiatan penanaman 100 bibit mangrove di kawasan pesisir untuk menjaga ekosistem laut dan mencegah abrasi pantai. Kami melibatkan masyarakat lokal untuk merawat bibit yang telah ditanam.', 'gambar' => 'berita/CeMNaOPoxx2phehp4mpietU4hnwvtHbbNlqvbsp7.jpg', 'tanggal' => '2026-01-11', 'lokasi' => 'Pantai Trisik', 'peserta' => '65 Peserta', 'tag1' => 'Konservasi', 'tag2' => 'Mangrove', 'tag3' => 'Komunitas'],
            ['id_berita' => 2, 'judul' => 'Workshop Eco-Printing', 'deskripsi' => 'Pelatihan pembuatan kain ramah lingkungan menggunakan pewarna alami dari daun dan bunga. Program ini bertujuan memberdayakan ibu-ibu PKK setempat.', 'gambar' => 'berita/2isi07zoBcRmpYDCFWmmJRqYS5dNYEOJIeY2NE7i.jpg', 'tanggal' => '2024-03-08', 'lokasi' => 'Yogyakarta', 'peserta' => '25 Peserta', 'tag1' => 'Workshop', 'tag2' => 'Eco', 'tag3' => 'Pemberdayaan'],
            ['id_berita' => 3, 'judul' => 'Edukasi Lingkungan di Sekolah', 'deskripsi' => 'Program edukasi interaktif tentang pentingnya menjaga lingkungan dan keanekaragaman hayati. Siswa diajak bermain sambil belajar memilah sampah.', 'gambar' => 'berita/XTjLNaWm5XmIqT4qLDxHjMmFWQKPnSJBjExG7A8P.webp', 'tanggal' => '2024-02-22', 'lokasi' => 'SDN 1 Bantul', 'peserta' => '40 Siswa', 'tag1' => 'Edukasi', 'tag2' => 'Sekolah', 'tag3' => 'Anak-anak'],
            ['id_berita' => 4, 'judul' => 'Bersih Pantai Bersama', 'deskripsi' => 'Aksi bersih pantai rutin untuk mengurangi sampah plastik yang mencemari laut. Sampah yang terkumpul akan dipilah dan didaur ulang.', 'gambar' => 'berita/2lFtYwtC6Xix30DOVf2vTMidBzUdPsSa9EtkF3Ow.jpg', 'tanggal' => '2024-12-28', 'lokasi' => 'Pantai Baru', 'peserta' => '50 Relawan', 'tag1' => 'Bersih Pantai', 'tag2' => 'Sampah', 'tag3' => 'Relawan'],
            ['id_berita' => 5, 'judul' => 'Monitoring Satwa Langka', 'deskripsi' => 'Kegiatan penelitian dan monitoring populasi Elang Jawa di Taman Nasional Gunung Merapi. Data ini penting untuk strategi konservasi ke depan.', 'gambar' => 'berita/nErpZCvmtnHeZ2ZT0PIC3c0Z7yKgKizncQaD5hSG.jpg', 'tanggal' => '2025-01-02', 'lokasi' => 'TN Gunung Merapi', 'peserta' => '15 Peneliti', 'tag1' => 'Bersih Pantai', 'tag2' => 'Sampah', 'tag3' => 'Relawan'],
            ['id_berita' => 6, 'judul' => 'Pelatihan Budidaya Organik', 'deskripsi' => 'Workshop budidaya tanaman organik tanpa pestisida kimia. Petani diajarkan cara membuat pupuk kompos dan pestisida nabati.', 'gambar' => 'berita/DnqKZpXurXs33Us110DLGqvrNkb9U2lXorXLtGMu.jpg', 'tanggal' => '2024-04-05', 'lokasi' => 'Pantai Baru', 'peserta' => '20 Petani', 'tag1' => 'Pertanian', 'tag2' => 'Organik', 'tag3' => 'Pelatihan'],
            ['id_berita' => 8, 'judul' => 'mbappe meninggal', 'deskripsi' => '💀💀💀', 'gambar' => 'berita/k6lnlaJA99xo3HWvr9OX6krw2nPuBQqZT8ChCb1F.jpg', 'tanggal' => '2026-02-07', 'lokasi' => 'Pantai Trisik', 'peserta' => '1 mbappe', 'tag1' => 'rest', 'tag2' => 'in', 'tag3' => 'peace'],
            ['id_berita' => 9, 'judul' => 'jose mourinho', 'deskripsi' => 'special1', 'gambar' => 'berita/1AN2BaMbfIIN4G7fMrwPnPNnIaTSizf4sOTWiYUG.png', 'tanggal' => '2026-01-01', 'lokasi' => 'emyu', 'peserta' => '1 mbappe', 'tag1' => 'Edukasi', 'tag2' => 'in', 'tag3' => 'ssasasdasf'],
        ]);

        // 4. Tabel Partnerships (Disatukan & Diperbarui)
        Schema::create('partnerships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('logo')->nullable(); // Path gambar di storage
            $table->string('website_url')->nullable(); // Tambahan kolom website_url
            $table->enum('kategori', ['reguler', 'eksklusif', 'pengawasan'])->default('reguler'); // Tambahan kolom kategori
            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0); // Tambahan kolom urutan
            $table->timestamps();
        });

        // 5. Tabel Donasi
        Schema::create('donasi', function (Blueprint $table) {
            $table->increments('id_donasi');
            $table->unsignedBigInteger('id_campaign')->nullable(); // Tambahkan kolom id_campaign
            $table->string('jenis'); // Ubah jenis menjadi string (untuk 'satwa', 'karang', dll)
            $table->decimal('nominal', 15, 2);
            $table->enum('status', ['pending', 'berhasil', 'gagal'])->default('pending');
            $table->string('snap_token', 255)->nullable();
            $table->text('catatan')->nullable();
            $table->string('bukti_transfer', 255)->nullable();
            $table->dateTime('tanggal'); // Ubah ke dateTime agar lebih presisi
            $table->unsignedBigInteger('id_user'); // Sesuaikan tipe data dengan id pengguna
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('pengguna')->onDelete('cascade');
            $table->foreign('id_campaign')->references('id_campaign')->on('campaign')->onDelete('set null'); // Perbaiki FK ke id_campaign
        });

        // 6. Tabel Kegiatan
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->increments('id_kegiatan');
            $table->text('deskripsi')->nullable();
            $table->string('gambar', 255)->nullable();
            $table->string('judul', 255);
            $table->date('tanggal');
            $table->unsignedInteger('id_berita')->nullable();

            $table->foreign('id_berita')->references('id_berita')->on('berita')->onDelete('set null');
        });

        // 7. Tabel Pengeluaran
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->decimal('nominal', 15, 2);
            $table->date('tanggal');
            $table->string('kategori');
            $table->string('bukti')->nullable();
            $table->timestamps();
        });

        // --- STORED PROCEDURES & FUNCTIONS ---
        
        // Procedure: hapus_user
        DB::unprepared('DROP PROCEDURE IF EXISTS hapus_user');
        DB::unprepared('
            CREATE PROCEDURE hapus_user(IN p_id_user INT)
            BEGIN
                DELETE FROM pengguna WHERE id = p_id_user;
            END
        ');

        // Procedure: sp_edit_profil_pengguna
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_edit_profil_pengguna');
        DB::unprepared('
            CREATE PROCEDURE sp_edit_profil_pengguna(IN p_id INT, IN p_nama_baru VARCHAR(100), IN p_hp_baru VARCHAR(20))
            BEGIN
                UPDATE pengguna SET nama = p_nama_baru, no_hp = p_hp_baru WHERE id = p_id;
            END
        ');

        // Procedure: sp_tambah_berita_kegiatan
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_tambah_berita_kegiatan');
        DB::unprepared("
            CREATE PROCEDURE sp_tambah_berita_kegiatan(IN p_judul_berita VARCHAR(255), IN p_deskripsi VARCHAR(255), IN p_tgl DATE)
            BEGIN
                DECLARE last_id INT;
                START TRANSACTION;
                INSERT INTO berita (judul, deskripsi, tanggal) VALUES (p_judul_berita, p_deskripsi, p_tgl);
                SET last_id = LAST_INSERT_ID();
                INSERT INTO kegiatan (judul, deskripsi, tanggal, id_berita) 
                VALUES (CONCAT('Kegiatan: ', p_judul_berita), 'Realisasi Berita', p_tgl, last_id);
                COMMIT;
            END
        ");

        // Function: fn_total_donasi_keseluruhan
        DB::unprepared('DROP FUNCTION IF EXISTS fn_total_donasi_keseluruhan');
        DB::unprepared('
            CREATE FUNCTION fn_total_donasi_keseluruhan() RETURNS DECIMAL(15,2)
            DETERMINISTIC
            BEGIN
                DECLARE total DECIMAL(15,2);
                SELECT IFNULL(SUM(nominal), 0) INTO total FROM donasi;
                RETURN total;
            END
        ');

        // Function: fn_status_donatur
        DB::unprepared('DROP FUNCTION IF EXISTS fn_status_donatur');
        DB::unprepared("
            CREATE FUNCTION fn_status_donatur(p_id_user INT) RETURNS VARCHAR(50)
            DETERMINISTIC
            BEGIN
                DECLARE total DECIMAL(15,2);
                DECLARE status VARCHAR(50);
                SELECT IFNULL(SUM(nominal), 0) INTO total FROM donasi WHERE id_user = p_id_user;
                IF total >= 5000000 THEN SET status = 'Donatur Utama';
                ELSEIF total >= 1000000 THEN SET status = 'Donatur Aktif';
                ELSE SET status = 'Donatur Biasa';
                END IF;
                RETURN status;
            END
        ");

        // --- TRIGGERS ---

        // Trigger: trg_cegah_hapus_berita
        DB::unprepared('DROP TRIGGER IF EXISTS trg_cegah_hapus_berita');
        DB::unprepared("
            CREATE TRIGGER trg_cegah_hapus_berita BEFORE DELETE ON berita FOR EACH ROW 
            BEGIN
                IF EXISTS (SELECT 1 FROM kegiatan WHERE id_berita = OLD.id_berita) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'berita tidk bisa dihapus. masih dipakai di kegiatan';
                END IF;
            END
        ");

        // Trigger: trg_validasi_judul_berita
        DB::unprepared('DROP TRIGGER IF EXISTS trg_validasi_judul_berita');
        DB::unprepared("
            CREATE TRIGGER trg_validasi_judul_berita BEFORE INSERT ON berita FOR EACH ROW 
            BEGIN
                IF NEW.judul IS NULL OR NEW.judul = '' THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'judul jgn kosong';
                END IF;
            END
        ");

        // Trigger: trg_set_tanggal_donasi
        DB::unprepared('DROP TRIGGER IF EXISTS trg_set_tanggal_donasi');
        DB::unprepared("
            CREATE TRIGGER trg_set_tanggal_donasi BEFORE INSERT ON donasi FOR EACH ROW 
            BEGIN
                IF NEW.tanggal IS NULL THEN
                    SET NEW.tanggal = CURDATE();
                END IF;
            END
        ");

        // Trigger: trg_validasi_nominal_donasi
        DB::unprepared('DROP TRIGGER IF EXISTS trg_validasi_nominal_donasi');
        DB::unprepared("
            CREATE TRIGGER trg_validasi_nominal_donasi BEFORE INSERT ON donasi FOR EACH ROW 
            BEGIN
                IF NEW.nominal <= 0 THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Donasi harus > 0';
                END IF;
            END
        ");

        // Trigger: trg_cegah_hapus_donatur
        DB::unprepared('DROP TRIGGER IF EXISTS trg_cegah_hapus_donatur');
        DB::unprepared("
            CREATE TRIGGER trg_cegah_hapus_donatur BEFORE DELETE ON pengguna FOR EACH ROW 
            BEGIN
                IF EXISTS (SELECT 1 FROM donasi WHERE id_user = OLD.id) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'donatur tidak bisa di delete';
                END IF;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop Triggers
        DB::unprepared('DROP TRIGGER IF EXISTS trg_cegah_hapus_donatur');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_validasi_nominal_donasi');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_set_tanggal_donasi');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_validasi_judul_berita');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_cegah_hapus_berita');

        // Drop Functions & Procedures
        DB::unprepared('DROP FUNCTION IF EXISTS fn_status_donatur');
        DB::unprepared('DROP FUNCTION IF EXISTS fn_total_donasi_keseluruhan');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_tambah_berita_kegiatan');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_edit_profil_pengguna');
        DB::unprepared('DROP PROCEDURE IF EXISTS hapus_user');

        // Drop Tables
        Schema::dropIfExists('kegiatan');
        Schema::dropIfExists('donasi');
        Schema::dropIfExists('partnerships');
        Schema::dropIfExists('berita');
        Schema::dropIfExists('pengeluaran');
        Schema::dropIfExists('pengguna');
        Schema::dropIfExists('admin');
    }
};