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
        Schema::create('master_pegawai', function (Blueprint $table) {
            $table->increments('pegawai_id');
            $table->string('pegawai_nama');
            $table->string('nomoridentitas');
            $table->string('nomorindukpegawai')->unique();
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
            $table->unsignedInteger('pegawai_id');
            $table->unsignedInteger('pekerjaan_id');
            $table->string('no_pendonor');
            $table->string('jenisidentitas', 50);
            $table->string('no_identitas');
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tgllahir');
            $table->string('jenis_kelamin');
            $table->string('alamat_lengkap');
            $table->timestamps();

            $table->foreign('pegawai_id')->references('pegawai_id')->on('master_pegawai')->onDelete('cascade');
            $table->foreign('pekerjaan_id')->references('pekerjaan_id')->on('master_pekerjaan')->onDelete('cascade');
        });

        Schema::create('daftardonor', function (Blueprint $table) {
            $table->increments('daftardonor_id');
            $table->unsignedInteger('pendonor_id');
            $table->unsignedInteger('ruangan_id');
            $table->string('no_formulir');
            $table->integer('nama_petugas_id');
            $table->text('keterangan_donasi')->nullable();
            $table->integer('donasi_ke');
            $table->timestamp('create_time')->nullable();
            $table->timestamp('update_time')->nullable();
            $table->integer('ruangan_rekruitmen_id');
            $table->timestamp('waktu_pendaftaran');
            $table->string('status');
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
            $table->unsignedInteger('pegawai_id');
            $table->unsignedInteger('pendonor_id');
            $table->timestamp('tglseleksidonor');
            $table->string('jenisdonor');
            $table->string('tekanandarah');
            $table->string('td_systolic');
            $table->string('td_diastoliic'); // spelled exactly as in prompt
            $table->string('detaknadi');
            $table->boolean('is_gagalseleksi');
            $table->timestamps();

            $table->foreign('daftardonor_id')->references('daftardonor_id')->on('daftardonor')->onDelete('cascade');
            $table->foreign('pegawai_id')->references('pegawai_id')->on('master_pegawai')->onDelete('cascade');
            $table->foreign('pendonor_id')->references('pendonor_id')->on('pendonor')->onDelete('cascade');
        });

        Schema::create('jawaban_kuesioner', function (Blueprint $table) {
            $table->unsignedInteger('seleksidonor_id');
            $table->unsignedInteger('daftardonor_id');
            $table->unsignedInteger('kuesionerdonor_id');
            $table->boolean('ceklist');
            $table->timestamps();

            $table->primary(['seleksidonor_id', 'kuesionerdonor_id']);
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
    }
};
