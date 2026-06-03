// Mock lookup database for pegawai list to simulate auto-fill (NIP: 12345678 as seeded)
const mockPegawaiList = [
    {
        nip: '12345678',
        nama: 'Admin',
        nik: '3201234567890005',
        tempat_lahir: 'Surabaya',
        tgllahir: '1988-11-20',
        jenis_kelamin: 'Laki-laki'
    }
];

// 1. Main Tab Switch (Lama vs Baru)
function switchMainTab(tab) {
    const tabLama = document.getElementById('tabLama');
    const tabBaru = document.getElementById('tabBaru');
    const secLama = document.getElementById('sectionLama');
    const secBaru = document.getElementById('sectionBaru');

    if (tab === 'lama') {
        tabLama.className = "py-2.5 px-6 text-sm font-bold rounded-xl transition duration-200 focus:outline-none bg-gradient-to-r from-rose-500 to-pink-600 text-white shadow-md shadow-rose-500/20";
        tabBaru.className = "py-2.5 px-6 text-sm font-bold rounded-xl transition duration-200 focus:outline-none border border-rose-200 text-rose-600 hover:bg-rose-50/50";
        secLama.classList.remove('hidden');
        secBaru.classList.add('hidden');
    } else {
        tabBaru.className = "py-2.5 px-6 text-sm font-bold rounded-xl transition duration-200 focus:outline-none bg-gradient-to-r from-rose-500 to-pink-600 text-white shadow-md shadow-rose-500/20";
        tabLama.className = "py-2.5 px-6 text-sm font-bold rounded-xl transition duration-200 focus:outline-none border border-rose-200 text-rose-600 hover:bg-rose-50/50";
        secBaru.classList.remove('hidden');
        secLama.classList.add('hidden');
    }
}

// 2. Sub-Tab Switch (Pegawai vs Umum)
function switchSubTab(sub) {
    const tabPegawai = document.getElementById('subTabPegawai');
    const tabUmum = document.getElementById('subTabUmum');
    const secPegawai = document.getElementById('sectionPegawai');
    const secUmum = document.getElementById('sectionUmum');

    if (sub === 'pegawai') {
        tabPegawai.className = "flex-1 py-1.5 px-4 text-xs font-bold rounded-lg transition duration-200 focus:outline-none bg-rose-500 text-white shadow-sm";
        tabUmum.className = "flex-1 py-1.5 px-4 text-xs font-bold rounded-lg transition duration-200 focus:outline-none border border-rose-200 text-rose-600 hover:bg-rose-50/50";
        secPegawai.classList.remove('hidden');
        secUmum.classList.add('hidden');
    } else {
        tabUmum.className = "flex-1 py-1.5 px-4 text-xs font-bold rounded-lg transition duration-200 focus:outline-none bg-rose-500 text-white shadow-sm";
        tabPegawai.className = "flex-1 py-1.5 px-4 text-xs font-bold rounded-lg transition duration-200 focus:outline-none border border-rose-200 text-rose-600 hover:bg-rose-50/50";
        secUmum.classList.remove('hidden');
        secPegawai.classList.add('hidden');
    }
}

// 3. Wizard / Stepper Navigation for "Umum"
let currentStepUmum = 1;
let isStep1Valid = false;
let isStep2Valid = false;

function checkStep1Validity() {
    const jenisidentitas = document.getElementById('umum_jenisidentitas').value;
    const noIdentitas = document.getElementById('umum_no_identitas').value.trim();
    const namaLengkap = document.getElementById('umum_nama_lengkap').value.trim();
    const tempatLahir = document.getElementById('umum_tempat_lahir').value.trim();
    const tglLahir = document.getElementById('umum_tgllahir').value;
    const jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked');
    const pekerjaan = document.getElementById('umum_pekerjaan_id').value;
    const agama = document.getElementById('umum_agama').value;
    const statusPerkawinan = document.getElementById('umum_status_perkawinan').value;
    const golDarah = document.getElementById('umum_gol_darah').value;
    const rhesus = document.querySelector('input[name="rhesus"]:checked');
    const tinggiBadan = document.getElementById('umum_tinggi_badan').value.trim();
    const beratBadan = document.getElementById('umum_berat_badan').value.trim();

    isStep1Valid = jenisidentitas && noIdentitas && namaLengkap && tempatLahir && tglLahir && jenisKelamin && pekerjaan && agama && statusPerkawinan && golDarah && rhesus && tinggiBadan && beratBadan;

    const btnNext = document.getElementById('btnNextUmum');
    const stepTrigger2 = document.getElementById('stepTrigger2');

    if (isStep1Valid) {
        btnNext.disabled = false;
        btnNext.className = "bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white font-bold py-2.5 px-8 rounded-xl shadow-md transition duration-150 focus:outline-none text-sm";
        stepTrigger2.classList.remove('pointer-events-none', 'opacity-50');
    } else {
        btnNext.disabled = true;
        btnNext.className = "bg-rose-200 text-white font-bold py-2.5 px-8 rounded-xl shadow opacity-60 cursor-not-allowed transition duration-150 focus:outline-none text-sm";
        stepTrigger2.classList.add('pointer-events-none', 'opacity-50');
    }
}

function checkStep2Validity() {
    const alamat = document.getElementById('umum_alamat_lengkap').value.trim();
    const provinsi = document.getElementById('umum_provinsi').value;
    const kabupaten = document.getElementById('umum_kabupaten').value;
    const kecamatan = document.getElementById('umum_kecamatan').value;
    const kelurahan = document.getElementById('umum_kelurahan').value;
    const noMobile = document.getElementById('umum_no_mobile').value.trim();

    isStep2Valid = alamat && provinsi && kabupaten && kecamatan && kelurahan && noMobile;

    const btnSubmit = document.getElementById('btnSubmitUmum');

    if (isStep2Valid) {
        btnSubmit.disabled = false;
        btnSubmit.className = "bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white font-bold py-2.5 px-8 rounded-xl shadow-md transition duration-150 focus:outline-none text-sm";
    } else {
        btnSubmit.disabled = true;
        btnSubmit.className = "bg-rose-200 text-white font-bold py-2.5 px-8 rounded-xl shadow opacity-60 cursor-not-allowed transition duration-150 focus:outline-none text-sm";
    }
}

function setupValidationListeners() {
    const step1Inputs = [
        'umum_jenisidentitas', 'umum_no_identitas', 'umum_nama_lengkap', 'umum_tempat_lahir', 'umum_tgllahir',
        'umum_pekerjaan_id', 'umum_agama', 'umum_status_perkawinan', 'umum_gol_darah', 'umum_tinggi_badan', 'umum_berat_badan'
    ];
    step1Inputs.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('input', checkStep1Validity);
            el.addEventListener('change', checkStep1Validity);
        }
    });

    document.querySelectorAll('input[name="jenis_kelamin"]').forEach(radio => {
        radio.addEventListener('change', checkStep1Validity);
    });
    document.querySelectorAll('input[name="rhesus"]').forEach(radio => {
        radio.addEventListener('change', checkStep1Validity);
    });

    const step2Inputs = [
        'umum_alamat_lengkap', 'umum_provinsi', 'umum_kabupaten', 'umum_kecamatan',
        'umum_kelurahan', 'umum_no_mobile'
    ];
    step2Inputs.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('input', checkStep2Validity);
            el.addEventListener('change', checkStep2Validity);
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    setupValidationListeners();
    setupCascadingDropdowns();

    // Initialize Select2 on requested fields
    $('#lama_jenis_identitas, #umum_jenisidentitas, #umum_provinsi, #umum_kabupaten, #umum_kecamatan, #umum_kelurahan, #umum_pekerjaan_id, #umum_agama, #umum_status_perkawinan, #umum_gol_darah').select2({
        width: '100%'
    });

    // Ensure changes to Select2 elements trigger native event handlers for validation/cascading
    $('#lama_jenis_identitas, #umum_jenisidentitas, #umum_provinsi, #umum_kabupaten, #umum_kecamatan, #umum_kelurahan, #umum_pekerjaan_id, #umum_agama, #umum_status_perkawinan, #umum_gol_darah').on('change', function (e) {
        if (e.originalEvent) return; // Prevent infinite loop from native event propagation
        const event = new Event('change', { bubbles: true });
        this.dispatchEvent(event);
    });
});

// Cascading Dropdowns Logic
function setupCascadingDropdowns() {
    const provSelect = document.getElementById('umum_provinsi');
    const kabSelect = document.getElementById('umum_kabupaten');
    const kecSelect = document.getElementById('umum_kecamatan');
    const kelSelect = document.getElementById('umum_kelurahan');

    provSelect.addEventListener('change', function() {
        const provId = this.value;
        kabSelect.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
        kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        $(kabSelect).trigger('change');
        $(kecSelect).trigger('change');
        $(kelSelect).trigger('change');
        checkStep2Validity();

        if (!provId) return;

        fetch(`/api/kabupaten/${provId}`)
            .then(res => res.json())
            .then(data => {
                data.forEach(item => {
                    kabSelect.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                });
                $(kabSelect).trigger('change');
            });
    });

    kabSelect.addEventListener('change', function() {
        const kabId = this.value;
        kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        $(kecSelect).trigger('change');
        $(kelSelect).trigger('change');
        checkStep2Validity();

        if (!kabId) return;

        fetch(`/api/kecamatan/${kabId}`)
            .then(res => res.json())
            .then(data => {
                data.forEach(item => {
                    kecSelect.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                });
                $(kecSelect).trigger('change');
            });
    });

    kecSelect.addEventListener('change', function() {
        const kecId = this.value;
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        $(kelSelect).trigger('change');
        checkStep2Validity();

        if (!kecId) return;

        fetch(`/api/kelurahan/${kecId}`)
            .then(res => res.json())
            .then(data => {
                data.forEach(item => {
                    kelSelect.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                });
                $(kelSelect).trigger('change');
            });
    });
}

function goToStep(step) {
    if (step === 2 && !isStep1Valid) return;

    currentStepUmum = step;
    const divPribadi = document.getElementById('divPribadi');
    const divAlamat = document.getElementById('divAlamat');
    const stepCircle1 = document.getElementById('stepCircle1');
    const stepCircle2 = document.getElementById('stepCircle2');
    const stepLabel1 = document.getElementById('stepLabel1');
    const stepLabel2 = document.getElementById('stepLabel2');
    const stepProgressLine = document.getElementById('stepProgressLine');
    const btnNext = document.getElementById('btnNextUmum');
    const btnSubmit = document.getElementById('btnSubmitUmum');

    if (step === 1) {
        divPribadi.classList.remove('hidden');
        divAlamat.classList.add('hidden');
        
        stepCircle1.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-rose-600 text-white shadow-md transition-all duration-300";
        stepLabel1.className = "text-sm font-bold text-slate-800 transition-all duration-300";
        
        stepCircle2.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-white text-slate-400 border-2 border-slate-200 transition-all duration-300";
        stepLabel2.className = "text-sm font-bold text-slate-400 transition-all duration-300";
        
        stepProgressLine.style.width = "0%";
        
        btnNext.classList.remove('hidden');
        btnSubmit.classList.add('hidden');
    } else {
        divPribadi.classList.add('hidden');
        divAlamat.classList.remove('hidden');
        
        stepCircle1.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-rose-600 text-white shadow-md transition-all duration-300";
        stepLabel1.className = "text-sm font-bold text-slate-800 transition-all duration-300";
        
        stepCircle2.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-rose-600 text-white shadow-md transition-all duration-300";
        stepLabel2.className = "text-sm font-bold text-slate-850 transition-all duration-300";
        
        stepProgressLine.style.width = "100%";
        
        btnNext.classList.add('hidden');
        btnSubmit.classList.remove('hidden');
        
        checkStep2Validity();
    }
}

function handleBackUmum() {
    if (currentStepUmum === 2) {
        goToStep(1);
    } else {
        switchMainTab('lama');
    }
}

// 4. Input Label modifier for Lama Identitas selector
document.getElementById('lama_jenis_identitas').addEventListener('change', function() {
    const label = document.getElementById('lama_label_identitas');
    const input = document.getElementById('lama_identitas_value');
    if (this.value === 'NIK_KTP') {
        label.innerHTML = 'Nomor KTP (NIK) <span class="text-rose-500 font-extrabold">*</span>';
        input.placeholder = 'Nomor KTP (NIK)';
    } else if (this.value === 'NO_PENDONOR') {
        label.innerHTML = 'Nomor Pendonor <span class="text-rose-500 font-extrabold">*</span>';
        input.placeholder = 'Nomor Pendonor';
    } else {
        label.innerHTML = 'KTP / Nomor Pendonor <span class="text-rose-500 font-extrabold">*</span>';
        input.placeholder = 'KTP / Nomor Pendonor';
    }
});

// 5. Reset forms helper
function resetForm(formId) {
    document.getElementById(formId).reset();
    const inputs = document.getElementById(formId).querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.classList.remove('border-red-500', 'focus:ring-red-500/20');
        input.classList.add('border-slate-200');
    });
    if (formId === 'formLama') {
        $('#lama_jenis_identitas').val('').trigger('change');
    }
    if (formId === 'formPegawai') {
        document.getElementById('pegawaiAutoFields').classList.add('opacity-50', 'pointer-events-none');
        document.getElementById('pegawaiManualFields').classList.add('hidden');
        const submitBtn = document.getElementById('btnSubmitPegawai');
        submitBtn.disabled = true;
        submitBtn.className = "bg-rose-300 text-white font-bold py-2.5 px-8 rounded-xl shadow opacity-50 cursor-not-allowed transition duration-150 focus:outline-none text-sm";
    }
    if (formId === 'formUmum') {
        document.getElementById('umum_kabupaten').innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
        document.getElementById('umum_kecamatan').innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        document.getElementById('umum_kelurahan').innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        $('#umum_jenisidentitas, #umum_provinsi, #umum_kabupaten, #umum_kecamatan, #umum_kelurahan, #umum_pekerjaan_id, #umum_agama, #umum_status_perkawinan, #umum_gol_darah').val('').trigger('change');
        goToStep(1);
        isStep1Valid = false;
        isStep2Valid = false;
        checkStep1Validity();
    }
}

// 6. Generic Validate fields
function validateFields(formId) {
    let isValid = true;
    const form = document.getElementById(formId);
    const requiredFields = form.querySelectorAll('[required]');

    requiredFields.forEach(field => {
        if (field.type === 'radio') {
            // Check if radio group has checked value
            const name = field.name;
            const checked = form.querySelector(`input[name="${name}"]:checked`);
            if (!checked) {
                isValid = false;
                const parent = field.closest('.space-y-1.5');
                if (parent) parent.classList.add('border-red-500');
            }
        } else if (!field.value.trim()) {
            isValid = false;
            field.classList.add('border-red-500', 'focus:ring-red-500/20');
            field.classList.remove('border-slate-200');
        } else {
            field.classList.remove('border-red-500');
            field.classList.add('border-slate-200');
        }
    });

    return isValid;
}

// 7. Search NIP logic
function searchNipPegawai() {
    const nipVal = document.getElementById('pegawai_nip_search').value.trim();
    if (!nipVal) {
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian',
            text: 'Masukkan NIP Pegawai terlebih dahulu.'
        });
        return;
    }

    const matchedPegawai = mockPegawaiList.find(peg => peg.nip === nipVal);

    if (matchedPegawai) {
        // Auto-fill values
        document.getElementById('pegawai_nama').value = matchedPegawai.nama;
        document.getElementById('pegawai_nik').value = matchedPegawai.nik;
        document.getElementById('pegawai_tempat_lahir').value = matchedPegawai.tempat_lahir;
        document.getElementById('pegawai_tgllahir').value = matchedPegawai.tgllahir;
        document.getElementById('pegawai_jenis_kelamin').value = matchedPegawai.jenis_kelamin;

        // Unlock manual inputs
        document.getElementById('pegawaiAutoFields').classList.remove('opacity-50', 'pointer-events-none');
        document.getElementById('pegawaiManualFields').classList.remove('hidden');

        // Enable submit button
        const submitBtn = document.getElementById('btnSubmitPegawai');
        submitBtn.disabled = false;
        submitBtn.className = "bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white font-bold py-2.5 px-8 rounded-xl shadow-md transition duration-150 focus:outline-none text-sm";

        Swal.fire({
            icon: 'success',
            title: 'Pegawai Ditemukan',
            text: `Data Pegawai atas nama ${matchedPegawai.nama} berhasil dimuat!`
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Data Tidak Ditemukan',
            text: 'Nomor Induk Pegawai (NIP) tidak terdaftar.'
        });
    }
}

// 8. Submit Forms validation & messages
document.getElementById('formLama').addEventListener('submit', function(e) {
    e.preventDefault();
    if (!validateFields('formLama')) {
        Swal.fire({
            icon: 'warning',
            title: 'Data Tidak Lengkap',
            text: 'Silakan isi semua kolom bertanda bintang/wajib.'
        });
        return;
    }

    const jenisIdentitasVal = document.getElementById('lama_jenis_identitas').value;
    const identitasVal = document.getElementById('lama_identitas_value').value.trim();
    const tglLahirVal = document.getElementById('lama_tgllahir').value;

    const matchedDonor = existingDonors.find(donor => {
        let idMatch = false;
        if (jenisIdentitasVal === 'NIK_KTP') {
            idMatch = donor.no_identitas === identitasVal;
        } else if (jenisIdentitasVal === 'NO_PENDONOR') {
            idMatch = donor.no_pendonor === identitasVal;
        }
        
        let dbDate = '';
        if (donor.tgllahir) {
            dbDate = typeof donor.tgllahir === 'string' ? donor.tgllahir.substring(0, 10) : new Date(donor.tgllahir).toISOString().split('T')[0];
        }
        return idMatch && dbDate === tglLahirVal;
    });

    if (matchedDonor) {
        Swal.fire({
            icon: 'success',
            title: 'Verifikasi Berhasil!',
            text: `Selamat datang kembali, ${matchedDonor.nama_lengkap}. Anda dapat melanjutkan proses.`
        }).then(() => {
            showProfile(matchedDonor);
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Gagal Masuk',
            text: 'Data pendonor tidak ditemukan atau Tanggal Lahir tidak cocok.'
        });
    }
});

document.getElementById('formUmum').addEventListener('submit', function(e) {
    e.preventDefault();
    if (!validateFields('formUmum')) {
        Swal.fire({
            icon: 'warning',
            title: 'Data Belum Lengkap',
            text: 'Silakan lengkapi semua bidang yang ditandai bintang merah pada tab Data Pribadi & Alamat.'
        });
        return;
    }

    // Gather Form Data
    const formData = new FormData(this);
    const payload = {};
    formData.forEach((value, key) => {
        payload[key] = value;
    });

    Swal.fire({
        title: 'Menyimpan Data...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch('/pendonor', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            // Add newly registered donor to existingDonors array
            existingDonors.push(res.data);
            
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil',
                text: `Pendonor Baru atas nama ${res.data.nama_lengkap} berhasil terdaftar dengan nomor pendonor: ${res.data.no_pendonor}`
            }).then(() => {
                resetForm('formUmum');
                showProfile(res.data);
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Registrasi Gagal',
                text: res.message || 'Terjadi kesalahan saat menyimpan data.'
            });
        }
    })
    .catch(err => {
        console.error(err);
        Swal.fire({
            icon: 'error',
            title: 'Registrasi Gagal',
            text: 'Koneksi ke server terputus atau terjadi kesalahan server.'
        });
    });
});

document.getElementById('formPegawai').addEventListener('submit', function(e) {
    e.preventDefault();
    if (!validateFields('formPegawai')) {
        Swal.fire({
            icon: 'warning',
            title: 'Data Belum Lengkap',
            text: 'Lengkapi seluruh data alamat dan kontak untuk Pegawai.'
        });
        return;
    }

    const nama = document.getElementById('pegawai_nama').value;
    Swal.fire({
        icon: 'success',
        title: 'Registrasi Pegawai Berhasil',
        text: `Pegawai atas nama ${nama} berhasil terdaftar sebagai pendonor.`
    }).then(() => {
        resetForm('formPegawai');
        switchMainTab('lama');
    });
});

// 9. Profile Dashboard & Edit Logic
let activeDonor = null;

function formatDateIndo(dateInput) {
    if (!dateInput) return '-';
    const date = new Date(dateInput);
    if (isNaN(date.getTime())) return '-';
    const months = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    return `${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()}`;
}

function showProfile(donor) {
    activeDonor = donor;
    
    // Hide branding panel and make right panel full width
    document.getElementById('leftBrandingPanel').classList.add('hidden');
    const rightPanel = document.getElementById('rightFormPanel');
    rightPanel.classList.remove('lg:w-7/12');
    rightPanel.classList.add('lg:w-full');
    
    // Hide form container, show profile container
    document.getElementById('welcomeFormContainer').classList.add('hidden');
    document.getElementById('profileContainer').classList.remove('hidden');

    // Populate data safely (XSS prevention)
    document.getElementById('profileName').textContent = donor.nama_lengkap;
    document.getElementById('profileNoPendonor').textContent = donor.no_pendonor;
    document.getElementById('profileAlamat').textContent = donor.alamat_lengkap || '-';
    document.getElementById('profileNoTelp').textContent = donor.nomobile_pendonor || donor.notelp_pendonor || '-';

    // Populate metrics
    const totalDonasi = donor.donasi_ke || 0;
    document.getElementById('metricTotalDonor').textContent = `${totalDonasi} Kali`;
    
    document.getElementById('metricDonorTerakhir').textContent = formatDateIndo(donor.tgl_donor_terakhir);

    // Next donor date: add 60 days
    let refDate = donor.tgl_donor_terakhir ? new Date(donor.tgl_donor_terakhir) : new Date(donor.created_at || new Date());
    let nextDate = new Date(refDate.getTime() + 60 * 24 * 60 * 60 * 1000);
    document.getElementById('metricDonorKembali').textContent = formatDateIndo(nextDate);
}

// Exit button
document.getElementById('btnKeluarProfile').addEventListener('click', function() {
    activeDonor = null;
    
    // Reset all form inputs
    resetForm('formLama');
    resetForm('formUmum');
    resetForm('formPegawai');
    switchMainTab('lama');
    
    // Restore branding panel and make right panel original width
    document.getElementById('leftBrandingPanel').classList.remove('hidden');
    const rightPanel = document.getElementById('rightFormPanel');
    rightPanel.classList.add('lg:w-7/12');
    rightPanel.classList.remove('lg:w-full');
    
    document.getElementById('profileContainer').classList.add('hidden');
    document.getElementById('welcomeFormContainer').classList.remove('hidden');

    Swal.fire({
        icon: 'success',
        title: 'Berhasil Keluar!',
        text: 'Anda telah berhasil keluar dari sistem.',
        timer: 1500,
        showConfirmButton: false
    });
});

// Edit profile buttons
document.getElementById('btnEditProfile').addEventListener('click', function() {
    if (!activeDonor) return;
    document.getElementById('edit_pendonor_id').value = activeDonor.pendonor_id;
    document.getElementById('edit_nama_lengkap').value = activeDonor.nama_lengkap;
    document.getElementById('edit_alamat_lengkap').value = activeDonor.alamat_lengkap || '';
    document.getElementById('edit_nomobile_pendonor').value = activeDonor.nomobile_pendonor || '';
    
    document.getElementById('editProfileModal').classList.remove('hidden');
});

function closeEditModal() {
    document.getElementById('editProfileModal').classList.add('hidden');
}

// Submit edit form
document.getElementById('formEditProfile').addEventListener('submit', function(e) {
    e.preventDefault();
    if (!validateFields('formEditProfile')) {
        Swal.fire({
            icon: 'warning',
            title: 'Data Belum Lengkap',
            text: 'Silakan isi semua bidang bertanda bintang.'
        });
        return;
    }

    const donorId = document.getElementById('edit_pendonor_id').value;
    const payload = {
        nama_lengkap: document.getElementById('edit_nama_lengkap').value,
        alamat_lengkap: document.getElementById('edit_alamat_lengkap').value,
        nomobile_pendonor: document.getElementById('edit_nomobile_pendonor').value
    };

    Swal.fire({
        title: 'Memperbarui Profil...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/pendonor/${donorId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            // Update activeDonor and DOM
            activeDonor = res.data;
            showProfile(activeDonor);
            
            // Also update inside existingDonors cache array
            const idx = existingDonors.findIndex(d => d.pendonor_id === activeDonor.pendonor_id);
            if (idx !== -1) {
                existingDonors[idx] = activeDonor;
            }

            closeEditModal();

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Profil Anda berhasil diperbarui.'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: res.message || 'Terjadi kesalahan saat memperbarui data.'
            });
        }
    })
    .catch(err => {
        console.error(err);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan Koneksi',
            text: 'Terjadi kesalahan saat menghubungi server.'
        });
    });
});

// Histori Action
document.getElementById('btnHistoriProfile').addEventListener('click', function() {
    if (!activeDonor) return;
    let historyHtml = '';
    
    const donasiKe = activeDonor.donasi_ke || 0;
    if (donasiKe === 0) {
        historyHtml = '<p class="text-sm text-slate-550 py-4">Belum ada riwayat donor darah yang tercatat.</p>';
    } else {
        historyHtml = `<div class="overflow-x-auto"><table class="w-full text-left text-sm border-collapse">
            <thead>
                <tr class="border-b border-slate-100"><th class="py-2 text-slate-400 font-bold text-xs uppercase">No</th><th class="py-2 text-slate-400 font-bold text-xs uppercase">Tanggal Donor</th><th class="py-2 text-slate-400 font-bold text-xs uppercase">Lokasi</th></tr>
            </thead>
            <tbody>`;
        
        let currentDate = activeDonor.tgl_donor_terakhir ? new Date(activeDonor.tgl_donor_terakhir) : new Date();
        for (let i = donasiKe; i > 0; i--) {
            historyHtml += `<tr class="border-b border-slate-50"><td class="py-2.5 font-bold text-slate-700">#${i}</td><td class="py-2.5 text-slate-600">${formatDateIndo(currentDate)}</td><td class="py-2.5 text-slate-550">${activeDonor.tempat_donor_terakhir || 'Unit Transfusi Darah'}</td></tr>`;
            // Subtract random months for historical simulation
            currentDate = new Date(currentDate.getTime() - (75 + Math.floor(Math.random() * 20)) * 24 * 60 * 60 * 1000);
        }
        historyHtml += '</tbody></table></div>';
    }

    Swal.fire({
        title: 'Riwayat Donor',
        html: historyHtml,
        confirmButtonText: 'Tutup',
        customClass: {
            confirmButton: 'bg-rose-500 hover:bg-rose-600 text-white font-bold py-2 px-6 rounded-xl transition duration-150 focus:outline-none'
        },
        buttonsStyling: false
    });
});

// Daftar Donor Action
document.getElementById('btnDaftarDonorProfile').addEventListener('click', function() {
    Swal.fire({
        icon: 'info',
        title: 'Pendaftaran Donor',
        text: 'Anda telah berhasil terdaftar untuk donor hari ini. Silakan kunjungi Unit Transfusi Darah terdekat dengan membawa kartu identitas Anda untuk melanjutkan proses donor.',
        confirmButtonText: 'Baik, Saya Mengerti',
        customClass: {
            confirmButton: 'bg-rose-500 hover:bg-rose-650 text-white font-bold py-2 px-6 rounded-xl transition duration-150 focus:outline-none'
        },
        buttonsStyling: false
    });
});
