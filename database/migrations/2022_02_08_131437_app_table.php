<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('app_dataporsi25', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_tagihan',50)->nullable();
            $table->string('nama_bank',50)->nullable();
            $table->string('nomor_dks',50)->nullable();
            $table->date('tanggal_dks')->nullable();
            $table->string('id_uji_ktp',50)->nullable();
            $table->string('id_uji_debitur',50)->nullable();
            $table->string('nik',50)->nullable();
            $table->string('jenis_flpp',50)->nullable();
            $table->string('nama',50)->nullable();
            $table->string('pekerjaan',50)->nullable();
            $table->string('jenis_kelamin',50)->nullable();
            $table->string('ktp_pemohon',50)->nullable();
            $table->string('npwp_pemohon',50)->nullable();
            $table->string('no_kk',50)->nullable();
            $table->float('gaji_pokok')->nullable();
            $table->string('nama_pasangan',50)->nullable();	
            $table->string('ktp_pasangan',50)->nullable();
            $table->string('no_rekening',50)->nullable();	
            $table->text('alamat')->nullable();	
            $table->string('no_hp_pemohon',50)->nullable();	
            $table->string('no_sp3k',50)->nullable();	
            $table->date('tanggal_sp3k')->nullable();	
            $table->integer('maks_kredit')->nullable();	
            $table->string('no_bast',50)->nullable();
            $table->date('tanggal_bast')->nullable();	
            $table->date('tanggal_akad')->nullable();	
            $table->integer('harga_rumah')->nullable();	
            $table->integer('uang_muka')->nullable();
            $table->integer('subsidi_uang_muka')->nullable();
            $table->integer('nilai_kpr')->nullable();
            $table->float('suku_bunga_kpr')->nullable();
            $table->integer('tenor')->nullable();
            $table->integer('angsuran_kpr')->nullable();
            $table->integer('nilai_flpp')->nullable();	
            $table->String('nama_pengembang',50)->nullable();
            $table->String('npwp_pengembang',50)->nullable();	
            $table->String('nama_perumahan',50)->nullable();	
            $table->text('alamat_agunan',50)->nullable();
            $table->String('nomor_alamat_agunan',50)->nullable();	
            $table->String('blok_alamat_agunan',50)->nullable();
            $table->String('kabupatenkota_agunan',50)->nullable();
            $table->String('kode_wilayah_agunan',50)->nullable();
            $table->String('kode_pos_agunan',50)->nullable();
            $table->String('luas_tanah',50)->nullable();
            $table->String('luas_bangunan',50)->nullable();
            $table->String('no_slf',50)->nullable();
            $table->date('tanggal_slf',50)->nullable();	
            $table->date('tgl_pencairan_dana_smf')->nullable();
            $table->string('nomor_surat_batch',50)->nullable();
            $table->string('batch',10)->nullable();
            $table->date('tgl_pelunasan')->nullable();
            $table->timestamps();
        });



        Schema::create('app_datanominatif', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kc_induk',50)->nullable();
            $table->string('branch',50)->nullable();
            $table->string('deal_type',50)->nullable();
            $table->string('deal_ref',50)->nullable();
            $table->string('cust_short_name',50)->nullable();
            $table->bigInteger('outstanding')->nullable();
            $table->bigInteger('comitement_amount')->nullable();
            $table->bigInteger('original_plafond')->nullable();
            $table->bigInteger('plafond')->nullable();
            $table->float('int_rate')->nullable();
            $table->bigInteger('int_accrued')->nullable();
            $table->string('ccy',50)->nullable();
            $table->date('contract_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('maturity_date')->nullable();
            $table->integer('tenor')->nullable();
            $table->integer('collect')->nullable();
            $table->integer('ori_colect')->nullable();
            $table->integer('dpd')->nullable();
            $table->integer('pastdue_interest')->nullable();
            $table->bigInteger('pastdue_principal')->nullable();
            $table->string('commitement_ref',50)->nullable();
            $table->string('no_pk',50)->nullable();
            $table->string('sektor_ekonomi',50)->nullable();
            $table->string('jenis_penggunaan',50)->nullable();
            $table->string('kode_dinas',50)->nullable();
            $table->string('lokasi_proyek',50)->nullable();
            $table->string('profession',50)->nullable();
            $table->date('tanggal_awal_tunggak')->nullable();
            $table->string('aoro',50)->nullable();
            $table->string('ltv',50)->nullable();
            $table->date('review_freqency_date')->nullable();
            $table->date('statement_date')->nullable();
            $table->string('program',50)->nullable();  
            $table->timestamps();
        });


        Schema::create('app_master_cabang', function (Blueprint $table) {
            $table->string('kodecabang',8)->primary();
            $table->string('namacabang',50)->nullable();
            $table->string('kodeinduk',50)->nullable();
            $table->string('kodekanwil',50)->nullable();
            $table->string('status',1)->nullable();
            $table->timestamps();
        });

        Schema::create('app_idberkasnik', function (Blueprint $table) {
            $table->string('nik',50)->primary();
            $table->string('id_berkas',50)->nullable();
            $table->timestamps();
        });
        Schema::create('app_angsuran_debitur', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_kanwil',50)->nullable();
            $table->string('kode',50)->nullable();
            $table->string('nik',50)->nullable();
            $table->string('deal_ref',50)->nullable();
            $table->date('tgl_pencairan_dana_smf')->nullable();
            $table->integer('bulan_angsuran')->nullable();
            $table->integer('tahun_angsuran')->nullable();
            $table->bigInteger('nominal_pokok')->nullable();
            $table->bigInteger('tarif_pokok')->nullable();
            $table->bigInteger('sisa_pokok')->nullable();
            $table->timestamps();
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        // Schema::dropIfExists('master_page');
    }

}
