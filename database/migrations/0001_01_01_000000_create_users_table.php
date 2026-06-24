<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('provinsi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('kabupaten', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provinsi_id');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('provinsi_id')->references('id')->on('provinsi')->onDelete('cascade');
        });

        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kabupaten_id');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('kabupaten_id')->references('id')->on('kabupaten')->onDelete('cascade');
        });

        Schema::create('kelurahan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kecamatan_id');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('kecamatan_id')->references('id')->on('kecamatan')->onDelete('cascade');
        });

        Schema::create('master_pegawai', function (Blueprint $table) {
            $table->increments('pegawai_id');
            $table->unsignedInteger('loginuser_id')->nullable();
            $table->string('nama_pegawai');
            $table->string('jenisidentitas')->nullable();
            $table->string('noidentitas');
            $table->string('nomorindukpegawai')->unique();
            $table->integer('provinsi_id')->nullable();
            $table->integer('kabupaten_id')->nullable();
            $table->integer('kecamatan_id')->nullable();
            $table->integer('kelurahan_id')->nullable();
            $table->string('tempatlahir_pegawai')->nullable();
            $table->date('tgl_lahirpegawai')->nullable();
            $table->string('jeniskelamin')->nullable();
            $table->string('statusperkawinan')->nullable();
            $table->text('alamat_pegawai')->nullable();
            $table->string('agama')->nullable();
            $table->string('golongandarah')->nullable();
            $table->string('rhesus')->nullable();
            $table->string('alamatemail')->nullable();
            $table->string('notelp_pegawai')->nullable();
            $table->string('nomobile_pegawai')->nullable();
            $table->string('warganegara_pegawai')->nullable();
            $table->double('tinggibadan')->nullable();
            $table->double('beratbadan')->nullable();
            $table->boolean('pegawai_aktif')->default(true);
            $table->boolean('is_admin')->default(false);
            $table->timestamps();
        });

        Schema::create('master_pekerjaan', function (Blueprint $table) {
            $table->increments('pekerjaan_id');
            $table->string('pekerjaan_nama');
            $table->boolean('pekerjaan_aktif');
            $table->timestamps();
        });

        Schema::create('master_ruangan', function (Blueprint $table) {
            $table->increments('ruangan_id');
            $table->string('ruangan_nama');
            $table->string('ruangan_singkatan');
            $table->boolean('pekerjaan_aktif'); // Matches prompt exactly
            $table->timestamps();
        });

        Schema::create('login_user', function (Blueprint $table) {
            $table->increments('loginuser_id');
            $table->unsignedInteger('pegawai_id');
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('statusaktif')->default(true);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('pegawai_id')->references('pegawai_id')->on('master_pegawai')->onDelete('cascade');
        });

        Schema::create('pendonor', function (Blueprint $table) {
            $table->increments('pendonor_id');
            $table->string('no_pendonor')->nullable();
            $table->string('jenisidentitas')->nullable();
            $table->string('no_identitas')->nullable();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir')->nullable();
            $table->date('tgllahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('alamat_lengkap')->nullable();
            $table->double('beratbadan_kg')->nullable();
            $table->double('tinggibadan_cm')->nullable();
            $table->string('notelp_pendonor')->nullable();
            $table->string('nomobile_pendonor')->nullable();
            $table->unsignedInteger('pekerjaan_id')->nullable();
            $table->string('statusperkawinan')->nullable();
            $table->string('gol_darah')->nullable();
            $table->string('rhesus')->nullable();
            $table->boolean('is_pernah_donor')->nullable();
            $table->integer('donasi_ke_sblm')->nullable();
            $table->date('tgl_donor_terakhir')->nullable();
            $table->string('tempat_donor_terakhir')->nullable();
            $table->integer('donasi_ke')->nullable();
            $table->timestamp('create_time')->nullable();
            $table->timestamp('update_time')->nullable();
            $table->integer('create_loginpemakai_id')->nullable();
            $table->integer('update_loginpemakai_id')->nullable();
            $table->integer('create_ruangan')->nullable();
            $table->unsignedInteger('pegawai_id')->nullable();
            $table->integer('propinsi_id')->nullable();
            $table->integer('kabupaten_id')->nullable();
            $table->integer('kecamatan_id')->nullable();
            $table->integer('kelurahan_id')->nullable();
            $table->string('agama')->nullable();
            $table->timestamps();

            $table->foreign('pegawai_id')->references('pegawai_id')->on('master_pegawai')->onDelete('cascade');
            $table->foreign('pekerjaan_id')->references('pekerjaan_id')->on('master_pekerjaan')->onDelete('cascade');
        });

        Schema::create('daftardonor', function (Blueprint $table) {
            $table->increments('daftardonor_id');
            $table->unsignedInteger('pendonor_id');
            $table->string('no_formulir');
            $table->string('nama_petugas');
            $table->text('keterangan_donasi')->nullable();
            $table->integer('donasi_ke');
            $table->timestamp('create_time')->nullable();
            $table->timestamp('update_time')->nullable();
            $table->integer('create_ruangan')->nullable();
            $table->integer('ruangan_rekruitmen_id');
            $table->timestamp('waktu_pendaftaran');
            $table->string('status')->comment('Seleksi, Diterima, Ditolak');
            $table->boolean('bataldonordarah')->default(false);
            $table->string('gol_darah')->nullable();
            $table->string('rhesus')->nullable();
            $table->unsignedInteger('ruangan_id');
            $table->integer('dpjp_id')->nullable();
            $table->integer('beratbadan_kg');
            $table->integer('tinggibadan_cm');
            $table->timestamps();

            $table->foreign('pendonor_id')->references('pendonor_id')->on('pendonor')->onDelete('cascade');
            $table->foreign('ruangan_id')->references('ruangan_id')->on('master_ruangan')->onDelete('cascade');
        });

        Schema::create('kuesionerdonor', function (Blueprint $table) {
            $table->increments('kuesionerdonor_id');
            $table->integer('kuesioner_urutan');
            $table->string('kuesioner_desc');
            $table->boolean('jawaban_lolos');
            $table->boolean('kuesioner_aktif');
            $table->timestamp('create_time')->nullable();
            $table->timestamp('update_time')->nullable();
            $table->integer('create_loginpemakai_id');
            $table->integer('update_loginpemakai_id');
            $table->integer('create_ruangan');
            $table->timestamps();
        });

        Schema::create('seleksidonor', function (Blueprint $table) {
            $table->increments('seleksidonor_id');
            $table->unsignedInteger('daftardonor_id');
            $table->unsignedInteger('pegawai_id')->nullable();
            $table->unsignedInteger('pendonor_id');
            $table->timestamp('tglseleksidonor');
            $table->string('jenisdonor');
            $table->string('td_systolic');
            $table->string('td_diastoliic');
            $table->string('kadar_hb');
            $table->string('suhu_tubuh');
            $table->string('detaknadi');
            $table->string('gol_darah');
            $table->string('rhesus');
            $table->boolean('alasan_ditolak')->nullable();
            $table->boolean('bb_rendah')->nullable();
            $table->boolean('usia_kurang')->nullable();
            $table->boolean('hb_rendah')->nullable();
            $table->boolean('medis_lain')->nullable();
            $table->boolean('medis_tk_tinggi')->nullable();
            $table->boolean('medis_td_rendah')->nullable();
            $table->boolean('minum_obat')->nullable();  
            $table->boolean('medis_pasca_op')->nullable();      
            $table->boolean('medis_hb_17')->nullable();
            $table->boolean('medis_vaksin')->nullable();
            $table->boolean('medis_bb_lebih')->nullable();
            $table->boolean('perilakuberesiko')->nullable();
            $table->boolean('perilakuberesiko_homo')->nullable();   
            $table->boolean('perilakuberesiko_tatto')->nullable();
            $table->boolean('perilakuberesiko_freesx')->nullable();
            $table->boolean('perilakuberesiko_penasun')->nullable();
            $table->boolean('perilakuberesiko_napi')->nullable();
            $table->boolean('riwberpergian')->nullable();
            $table->boolean('riwbepergian_endemik')->nullable();
            $table->boolean('riwbepergian_hiv')->nullable();
            $table->boolean('riwbepergian_sapigila')->nullable();
            $table->boolean('lain_lain')->nullable();
            $table->boolean('lain_lain_tdkkembali')->nullable();        
            $table->boolean('lain_lain_donortua')->nullable();
            $table->text('catatan_dokter')->nullable();
            $table->text('keterangan_donor')->nullable();
            $table->string('status_donor_kunjungan')->nullable();
            $table->timestamp('tanggal_donor_berhasil')->nullable();
            $table->timestamps();

            $table->foreign('daftardonor_id')->references('daftardonor_id')->on('daftardonor')->onDelete('cascade');
            $table->foreign('pegawai_id')->references('pegawai_id')->on('master_pegawai')->onDelete('cascade');
            $table->foreign('pendonor_id')->references('pendonor_id')->on('pendonor')->onDelete('cascade');
        });

        Schema::create('jawaban_kuesioner', function (Blueprint $table) {
            $table->unsignedInteger('seleksidonor_id')->nullable();
            $table->unsignedInteger('daftardonor_id')->nullable();
            $table->unsignedInteger('kuesionerdonor_id')->nullable();
            $table->boolean('ceklist');
            $table->timestamps();

            $table->foreign('seleksidonor_id')->references('seleksidonor_id')->on('seleksidonor')->onDelete('cascade');
            $table->foreign('daftardonor_id')->references('daftardonor_id')->on('daftardonor')->onDelete('cascade');
            $table->foreign('kuesionerdonor_id')->references('kuesionerdonor_id')->on('kuesionerdonor')->onDelete('cascade');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('jawaban_kuesioner');
        Schema::dropIfExists('seleksidonor');
        Schema::dropIfExists('kuesionerdonor');
        Schema::dropIfExists('daftardonor');
        Schema::dropIfExists('pendonor');
        Schema::dropIfExists('login_user');
        Schema::dropIfExists('master_ruangan');
        Schema::dropIfExists('master_pekerjaan');
        Schema::dropIfExists('master_pegawai');
        Schema::dropIfExists('kelurahan');
        Schema::dropIfExists('kecamatan');
        Schema::dropIfExists('kabupaten');
        Schema::dropIfExists('provinsi');
    }
};
