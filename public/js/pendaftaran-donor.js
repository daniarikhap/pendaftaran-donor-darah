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
    localStorage.setItem('pendaftaran_donor_mainTab', tab);
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
    localStorage.setItem('pendaftaran_donor_subTab', sub);
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

    // Initialize Flatpickr for Birthday fields with Month/Year dropdowns
    const birthdayConfig = {
        dateFormat: "d-m-Y",
        altInput: false,
        allowInput: true,
        monthSelectorType: 'dropdown',
        yearSelectorType: 'dropdown',
        maxDate: "today",
        locale: {
            firstDayOfWeek: 1
        }
    };

    flatpickr("#lama_tgllahir", birthdayConfig);
    flatpickr("#umum_tgllahir", birthdayConfig);

    // Initialize Select2 on requested fields
    $('.select2-pegawai, #lama_jenis_identitas, #umum_jenisidentitas, #umum_provinsi, #umum_kabupaten, #umum_kecamatan, #umum_kelurahan, #umum_pekerjaan_id, #umum_agama, #umum_status_perkawinan, #umum_gol_darah').select2({
        width: '100%'
    });

    // Ensure changes to Select2 elements trigger native event handlers for validation/cascading
    $('.select2-pegawai, #lama_jenis_identitas, #umum_jenisidentitas, #umum_provinsi, #umum_kabupaten, #umum_kecamatan, #umum_kelurahan, #umum_pekerjaan_id, #umum_agama, #umum_status_perkawinan, #umum_gol_darah').on('change', function (e) {
        if (e.originalEvent) return; // Prevent infinite loop from native event propagation
        const event = new Event('change', { bubbles: true });
        this.dispatchEvent(event);
    });

    // Restore state from localStorage
    restoreState();
});

function restoreState() {
    const savedDonor = localStorage.getItem('pendaftaran_donor_activeDonor');
    if (savedDonor) {
        try {
            let donor = JSON.parse(savedDonor);
            
            // CRITICAL: Refresh donor data from fresh existingDonors (from database) on page reload
            if (typeof existingDonors !== 'undefined' && existingDonors.length > 0) {
                const donorId = donor.pendonor_id || donor.id;
                const freshDonor = existingDonors.find(d => (d.pendonor_id || d.id) === donorId);
                if (freshDonor) {
                    donor = freshDonor;
                    // Update localStorage with fresh data for future use
                    localStorage.setItem('pendaftaran_donor_activeDonor', JSON.stringify(donor));
                }
            }

            showProfile(donor);
            
            // Check if we were in history view
            const currentView = localStorage.getItem('pendaftaran_donor_view');
            if (currentView === 'history') {
                showHistoryView();
            }

            // Check if we were in pendaftaran view
            const isPendaftaran = localStorage.getItem('pendaftaran_donor_isPendaftaran');
            if (isPendaftaran === 'true') {
                document.getElementById('btnDaftarDonorProfile').click();
            }
            return; 
        } catch (e) {
            console.error('Failed to parse saved donor', e);
        }
    }

    const mainTab = localStorage.getItem('pendaftaran_donor_mainTab');
    if (mainTab) {
        switchMainTab(mainTab);
    }

    const subTab = localStorage.getItem('pendaftaran_donor_subTab');
    if (subTab) {
        switchSubTab(subTab);
    }

    const stepUmum = localStorage.getItem('pendaftaran_donor_stepUmum');
    if (stepUmum && mainTab === 'baru' && subTab === 'umum') {
        // We might need to check validity if we want to restore step 2 directly
        // but for now let's just go to step if possible
        if (parseInt(stepUmum) === 2) {
            // Check if step 1 is valid before going to step 2
            checkStep1Validity();
            if (isStep1Valid) {
                goToStep(2);
            } else {
                goToStep(1);
            }
        } else {
            goToStep(1);
        }
    }
}

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

    localStorage.setItem('pendaftaran_donor_stepUmum', step);
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
        $('.select2-pegawai').val('').trigger('change').prop('disabled', false);
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
function openVerifyPegawaiModal() {
    const nipVal = document.getElementById('pegawai_nip_search').value.trim();
    document.getElementById('verify_nomorindukpegawai').value = nipVal;
    document.getElementById('verify_password').value = '';
    document.getElementById('verifyPegawaiModal').classList.remove('hidden');
}

function closeVerifyPegawaiModal() {
    document.getElementById('verifyPegawaiModal').classList.add('hidden');
}

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
    openVerifyPegawaiModal();
}

// Verification Form listener
document.addEventListener('DOMContentLoaded', function() {
    const formVerify = document.getElementById('formVerifyPegawai');
    if (formVerify) {
        formVerify.addEventListener('submit', function(e) {
            e.preventDefault();
            const nipVal = document.getElementById('verify_nomorindukpegawai').value.trim();
            const passVal = document.getElementById('verify_password').value;

            if (!nipVal || !passVal) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Harap isi NIP dan Password.'
                });
                return;
            }

            Swal.fire({
                title: 'Memverifikasi...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('/api/verify-pegawai', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    nomorindukpegawai: nipVal,
                    password: passVal
                })
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    const data = res.data;
                    // Autofill values in formPegawai
                    document.getElementById('pegawai_nama').value = data.nama;
                    document.getElementById('pegawai_nik').value = data.nik;
                    document.getElementById('pegawai_tempat_lahir').value = data.tempat_lahir;
                    document.getElementById('pegawai_tgllahir').value = data.tgllahir;

                    // Helper to toggle between dynamic input and readonly display
                    const toggleField = (id, value, isRadio = false) => {
                        try {
                            const input = document.getElementById(id);
                            const container = document.getElementById(id + '_container');
                            
                            if (value && value !== '-' && value !== '') {
                                // Data exists, disable field but keep visible
                                if (isRadio && container) {
                                    container.classList.add('pointer-events-none', 'opacity-70');
                                } else if (input) {
                                    input.disabled = true;
                                    input.classList.add('bg-slate-100', 'text-slate-500', 'cursor-not-allowed');
                                    if ($(input).hasClass('select2-hidden-accessible')) {
                                        $(input).val(value).trigger('change');
                                    } else {
                                        input.value = value;
                                    }
                                }
                            } else {
                                // Data empty, show dynamic input
                                if (isRadio && container) {
                                    container.classList.remove('pointer-events-none', 'opacity-70');
                                } else if (input) {
                                    input.disabled = false;
                                    input.classList.remove('bg-slate-100', 'text-slate-500', 'cursor-not-allowed');
                                    if ($(input).hasClass('select2-hidden-accessible')) {
                                        $(input).val('').trigger('change');
                                    } else {
                                        input.value = '';
                                    }
                                }
                            }
                        } catch (e) {
                            console.warn(`Error toggling field ${id}:`, e);
                        }
                    };

                    // Toggle fields based on data availability
                    toggleField('pegawai_view_jk', data.jenis_kelamin, true);
                    toggleField('pegawai_view_agama', data.agama);
                    toggleField('pegawai_view_statusperkawinan', data.statusperkawinan);
                    toggleField('pegawai_view_gol_darah', data.gol_darah);
                    toggleField('pegawai_view_rhesus', data.rhesus, true);

                    // If radio data exists, check the radio button
                    if (data.jenis_kelamin) {
                        const radio = document.querySelector(`input[name="jenis_kelamin_pegawai"][value="${data.jenis_kelamin}"]`);
                        if (radio) radio.checked = true;
                    }
                    if (data.rhesus) {
                        const radio = document.querySelector(`input[name="rhesus_pegawai"][value="${data.rhesus}"]`);
                        if (radio) radio.checked = true;
                    }

                    // Helper to safely set value
                    const setSafeValue = (id, val) => {
                        const el = document.getElementById(id);
                        if (el) el.value = val || '';
                    };

                    // Autofill hidden inputs (always update hidden inputs for form submission)
                    setSafeValue('pegawai_pegawai_id', data.pegawai_id);
                    setSafeValue('pegawai_pekerjaan_id', data.pekerjaan_id);
                    setSafeValue('pegawai_agama', data.agama);
                    setSafeValue('pegawai_statusperkawinan', data.statusperkawinan);
                    setSafeValue('pegawai_gol_darah', data.gol_darah);
                    setSafeValue('pegawai_rhesus', data.rhesus);
                    setSafeValue('pegawai_jenis_kelamin', data.jenis_kelamin);
                    setSafeValue('pegawai_propinsi_id', data.provinsi_id);

                    // Event listeners for dynamic fields to update hidden inputs when user changes them manually
                    if (!data.jenis_kelamin) {
                        document.querySelectorAll('input[name="jenis_kelamin_pegawai"]').forEach(radio => {
                            radio.addEventListener('change', (e) => {
                                setSafeValue('pegawai_jenis_kelamin', e.target.value);
                            });
                        });
                    }
                    if (!data.agama) {
                        const el = document.getElementById('pegawai_view_agama');
                        if (el) el.addEventListener('change', (e) => setSafeValue('pegawai_agama', e.target.value));
                    }
                    if (!data.statusperkawinan) {
                        const el = document.getElementById('pegawai_view_statusperkawinan');
                        if (el) el.addEventListener('change', (e) => setSafeValue('pegawai_statusperkawinan', e.target.value));
                    }
                    if (!data.gol_darah) {
                        const el = document.getElementById('pegawai_view_gol_darah');
                        if (el) el.addEventListener('change', (e) => setSafeValue('pegawai_gol_darah', e.target.value));
                    }
                    if (!data.rhesus) {
                        document.querySelectorAll('input[name="rhesus_pegawai"]').forEach(radio => {
                            radio.addEventListener('change', (e) => {
                                setSafeValue('pegawai_rhesus', e.target.value);
                            });
                        });
                    }

                    setSafeValue('pegawai_kabupaten_id', data.kabupaten_id);
                    setSafeValue('pegawai_kecamatan_id', data.kecamatan_id);
                    setSafeValue('pegawai_kelurahan_id', data.kelurahan_id);

                    // Autofill height & weight if available in employee record, otherwise let user input
                    const tinggiInput = document.getElementById('peg_tinggi_badan');
                    if (data.tinggibadan) {
                        tinggiInput.value = data.tinggibadan;
                        tinggiInput.readOnly = true;
                        tinggiInput.className = "block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed";
                    } else {
                        tinggiInput.value = '';
                        tinggiInput.readOnly = false;
                        tinggiInput.className = "block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150";
                    }

                    const beratInput = document.getElementById('peg_berat_badan');
                    if (data.beratbadan) {
                        beratInput.value = data.beratbadan;
                        beratInput.readOnly = true;
                        beratInput.className = "block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed";
                    } else {
                        beratInput.value = '';
                        beratInput.readOnly = false;
                        beratInput.className = "block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150";
                    }

                    // Autofill address & phone from employee record, otherwise let user input
                    const alamatInput = document.getElementById('peg_alamat_lengkap');
                    if (data.alamat_lengkap) {
                        alamatInput.value = data.alamat_lengkap;
                        alamatInput.readOnly = true;
                        alamatInput.className = "block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed";
                    } else {
                        alamatInput.value = '';
                        alamatInput.readOnly = false;
                        alamatInput.className = "block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150";
                    }

                    const mobileInput = document.getElementById('peg_no_mobile');
                    if (data.no_mobile) {
                        mobileInput.value = data.no_mobile;
                        mobileInput.readOnly = true;
                        mobileInput.className = "block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed";
                    } else {
                        mobileInput.value = '';
                        mobileInput.readOnly = false;
                        mobileInput.className = "block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150";
                    }

                    // Unlock manual fields
                    document.getElementById('pegawaiAutoFields').classList.remove('opacity-50', 'pointer-events-none');
                    document.getElementById('pegawaiManualFields').classList.remove('hidden');

                    // Enable submit button
                    const submitBtn = document.getElementById('btnSubmitPegawai');
                    submitBtn.disabled = false;
                    submitBtn.className = "bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white font-bold py-2.5 px-8 rounded-xl shadow-md transition duration-150 focus:outline-none text-sm";

                    closeVerifyPegawaiModal();

                    Swal.fire({
                        icon: 'success',
                        title: 'Verifikasi Berhasil',
                        text: `Data pegawai atas nama ${data.nama} berhasil dimuat!`
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Verifikasi Gagal',
                        text: res.message || 'NIP atau password salah.'
                    });
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Verifikasi Gagal',
                    text: 'Terjadi kesalahan saat verifikasi.'
                });
            });
        });
    }
});

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
    const tglLahirVal = document.getElementById('lama_tgllahir').value; // d-m-Y

    const matchedDonors = existingDonors.filter(donor => {
        let idMatch = false;
        if (jenisIdentitasVal === 'NIK_KTP') {
            idMatch = donor.no_identitas === identitasVal;
        } else if (jenisIdentitasVal === 'NO_PENDONOR') {
            idMatch = donor.no_pendonor === identitasVal;
        }
        
        let dbDate = '';
        if (donor.tgllahir) {
            // Handle YYYY-MM-DD string format directly to avoid timezone shifts
            const dateStr = typeof donor.tgllahir === 'string' ? donor.tgllahir.substring(0, 10) : new Date(donor.tgllahir).toISOString().split('T')[0];
            const parts = dateStr.split('-'); // [YYYY, MM, DD]
            if (parts.length === 3) {
                dbDate = `${parts[2]}-${parts[1]}-${parts[0]}`; // d-m-Y
            }
        }
        return idMatch && dbDate === tglLahirVal;
    });

    const matchedDonor = matchedDonors.length > 0 
        ? matchedDonors.sort((a, b) => (b.pendonor_id || b.id || 0) - (a.pendonor_id || a.id || 0))[0]
        : null;

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
    .then(res => {
        if (!res.ok) {
            return res.text().then(text => { throw new Error(text) });
        }
        return res.json();
    })
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
            existingDonors.push(res.data);

            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil',
                text: `Pendonor Baru (Pegawai) atas nama ${res.data.nama_lengkap} berhasil terdaftar dengan nomor pendonor: ${res.data.no_pendonor}`
            }).then(() => {
                resetForm('formPegawai');
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
    localStorage.setItem('pendaftaran_donor_activeDonor', JSON.stringify(donor));
    
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

    // Populate Blood Type & Rhesus (New)
    const bloodBadge = document.getElementById('bloodBadge');
    const profileGolDarah = document.getElementById('profileGolDarah');
    const profileRhesus = document.getElementById('profileRhesus');

    if (donor.gol_darah) {
        bloodBadge.classList.remove('hidden');
        bloodBadge.classList.add('flex');
        profileGolDarah.textContent = donor.gol_darah;
        
        let rhesusText = '';
         if (donor.rhesus === 'POS' || donor.rhesus === 'Positif') rhesusText = '+';
         else if (donor.rhesus === 'NEG' || donor.rhesus === 'Negatif') rhesusText = '-';
         else rhesusText = donor.rhesus || '';
        
        profileRhesus.textContent = rhesusText;
    } else {
        bloodBadge.classList.add('hidden');
        bloodBadge.classList.remove('flex');
    }

    // Populate metrics
    const totalDonasi = donor.total_donor_diterima || 0;
    document.getElementById('metricTotalDonor').textContent = `${totalDonasi} Kali`;
    
    document.getElementById('metricDonorTerakhir').textContent = formatDateIndo(donor.tgl_donor_terakhir);

    // Next donor date: add 56 days
    if (donor.tgl_donor_terakhir) {
        let refDate = new Date(donor.tgl_donor_terakhir);
        let nextDate = new Date(refDate.getTime() + 56 * 24 * 60 * 60 * 1000);
        document.getElementById('metricDonorKembali').textContent = formatDateIndo(nextDate);
    } else {
        document.getElementById('metricDonorKembali').textContent = '-';
    }
}

// Exit button
document.getElementById('btnKeluarProfile').addEventListener('click', function() {
    activeDonor = null;
    localStorage.removeItem('pendaftaran_donor_activeDonor');
    localStorage.removeItem('pendaftaran_donor_mainTab');
    localStorage.removeItem('pendaftaran_donor_subTab');
    localStorage.removeItem('pendaftaran_donor_stepUmum');
    localStorage.removeItem('pendaftaran_donor_isPendaftaran');
    localStorage.removeItem('pendaftaran_donor_view');
    
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
    document.getElementById('historyContainer').classList.add('hidden');
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
    document.getElementById('edit_gol_darah').value = activeDonor.gol_darah || '';
    
    // Normalisasi value rhesus untuk select modal
    let rhesusVal = activeDonor.rhesus || '';
    if (rhesusVal === 'POS') rhesusVal = 'Positif';
    if (rhesusVal === 'NEG') rhesusVal = 'Negatif';
    document.getElementById('edit_rhesus').value = rhesusVal;
    
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
    if (!donorId) {
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'ID Pendonor tidak ditemukan. Silakan muat ulang halaman.'
        });
        return;
    }

    const payload = {
        nama_lengkap: document.getElementById('edit_nama_lengkap').value,
        alamat_lengkap: document.getElementById('edit_alamat_lengkap').value,
        nomobile_pendonor: document.getElementById('edit_nomobile_pendonor').value,
        gol_darah: document.getElementById('edit_gol_darah').value,
        rhesus: document.getElementById('edit_rhesus').value
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
    .then(res => {
        if (!res.ok) {
            return res.text().then(text => {
                console.error('Server error response:', text);
                throw new Error('Server returned ' + res.status);
            });
        }
        return res.json();
    })
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
        
        let errorMsg = 'Terjadi kesalahan saat menghubungi server.';
        try {
            // Try to parse JSON from error message if it's a stringified JSON
            const parsed = JSON.parse(err.message);
            if (parsed.message) errorMsg = parsed.message;
        } catch(e) {
            // If not JSON, use the error message itself if it's simple
            if (err.message && err.message.length < 100) errorMsg = err.message;
        }

        Swal.fire({
            icon: 'error',
            title: 'Kesalahan Simpan',
            text: errorMsg
        });
    });
});

// Histori Action
document.getElementById('btnHistoriProfile').addEventListener('click', function() {
    if (!activeDonor) return;
    showHistoryView();
});

// Back from History to Profile
document.getElementById('btnBackHistory').addEventListener('click', function() {
    showProfileView();
});

function showHistoryView() {
    localStorage.setItem('pendaftaran_donor_view', 'history');
    document.getElementById('profileContainer').classList.add('hidden');
    document.getElementById('historyContainer').classList.remove('hidden');
    
    // Initialize DataTables if not already done
    if (!$.fn.DataTable.isDataTable('#historyTable')) {
        $('#historyTable').DataTable({
            "pageLength": 10,
            "ordering": false,
            "info": false,
            "language": {
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Selanjutnya"
                },
                "emptyTable": "Tidak ada data pada rentang tanggal ini."
            },
            "columnDefs": [
                {
                    "targets": 0, // Kolom NO
                    "className": "text-center py-4 px-4 text-sm font-bold text-slate-400"
                }
            ],
            "columns": [
                { "data": null },
                { "data": "waktu_pendaftaran", "className": "py-4 px-4 text-sm text-slate-700 font-medium" },
                { "data": "no_formulir", "className": "py-4 px-4 text-sm text-slate-700 font-medium" },
                { "data": "ruangan_nama", "className": "py-4 px-4 text-sm text-slate-700 font-medium" },
                { "data": "status_donor", "className": "py-4 px-4 text-sm text-slate-700 font-medium" },
                { "data": "status", "className": "py-4 px-4 text-sm text-slate-700 font-medium text-center" }
            ],
            "createdRow": function(row, data, dataIndex) {
                // Auto-increment Number
                $('td:eq(0)', row).html(dataIndex + 1);
                
                // Format Date: 06-06-2026
                if (data.waktu_pendaftaran) {
                    const date = new Date(data.waktu_pendaftaran);
                    const day = String(date.getDate()).padStart(2, '0');
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const year = date.getFullYear();
                    $('td:eq(1)', row).html(`${day}-${month}-${year}`);
                }

                // Status Badge Styling
                const status = data.status;
                const isBatal = data.bataldonordarah === 1 || data.bataldonordarah === true;
                
                let badgeClass = '';
                let statusText = status;

                if (isBatal) {
                    badgeClass = 'bg-rose-100 text-rose-600 border-rose-200';
                    statusText = 'Dibatalkan';
                } else if (status === 'Proses') {
                    badgeClass = 'bg-blue-100 text-blue-600 border-blue-200';
                } else if (status === 'Ditolak') {
                    badgeClass = 'bg-rose-100 text-rose-600 border-rose-200';
                } else if (status === 'Diterima') {
                    badgeClass = 'bg-emerald-100 text-emerald-600 border-emerald-200';
                }

                if (badgeClass) {
                    $('td:eq(5)', row).html(`<span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border ${badgeClass}">${statusText}</span>`);
                }

                // Status Donor Styling
                const statusDonor = isBatal ? 'Dibatalkan' : data.status_donor;
                if (isBatal) {
                    $('td:eq(4)', row).html(`<span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest border bg-rose-50 text-rose-600 border-rose-100">${statusDonor}</span>`);
                } else if (statusDonor === 'ANTRIAN') {
                    $('td:eq(4)', row).html(`<span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest border bg-slate-100 text-slate-900 border-slate-200">${statusDonor}</span>`);
                } else if (statusDonor === 'SELEKSI') {
                    $('td:eq(4)', row).html(`<span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest border bg-amber-50 text-amber-600 border-amber-100">${statusDonor}</span>`);
                }
                $('td:eq(4)', row).addClass('text-center');

            }
        });
    }

    // Initialize Flatpickr if not already done
    if (!document.getElementById('dateRangePicker')._flatpickr) {
        const now = new Date();
        const firstDay = new Date(now.getFullYear(), now.getMonth(), 1);
        const lastDay = new Date(now.getFullYear(), now.getMonth() + 1, 0);

        flatpickr("#dateRangePicker", {
            mode: "range",
            dateFormat: "d-m-Y",
            defaultDate: [firstDay, lastDay],
            locale: {
                rangeSeparator: " ~ "
            }
        });
    }

    // Automatically load data when history view is shown
    loadHistoryData();
}

function loadHistoryData() {
    if (!activeDonor) return;

    const dateRange = document.getElementById('dateRangePicker').value;
    if (!dateRange || !dateRange.includes(' ~ ')) return;

    const [startStr, endStr] = dateRange.split(' ~ ');
    
    // Convert d-m-Y to Y-m-d for backend
    const startParts = startStr.split('-');
    const endParts = endStr.split('-');
    const startDate = `${startParts[2]}-${startParts[1]}-${startParts[0]}`;
    const endDate = `${endParts[2]}-${endParts[1]}-${endParts[0]}`;

    const pendonorId = activeDonor.pendonor_id || activeDonor.id;

    const table = $('#historyTable').DataTable();
    table.clear().draw();

    fetch(`/api/riwayat-donor?pendonor_id=${pendonorId}&start_date=${startDate}&end_date=${endDate}`)
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                const formattedData = res.data.map(item => ({
                    waktu_pendaftaran: item.waktu_pendaftaran,
                    no_formulir: item.no_formulir,
                    ruangan_nama: item.ruangan_rekruitmen ? item.ruangan_rekruitmen.ruangan_nama : '-',
                    status_donor: item.status === 'Proses' ? 'ANTRIAN' : 'SELEKSI',
                    status: item.status,
                    bataldonordarah: item.bataldonordarah
                }));
                table.rows.add(formattedData).draw();
            }
        })
        .catch(err => {
            console.error('Error loading history:', err);
        });
}

// Event listener for "Tampilkan" button
document.addEventListener('DOMContentLoaded', function() {
    const btnTampilkan = document.getElementById('btnTampilkanRiwayat');
    if (btnTampilkan) {
        btnTampilkan.addEventListener('click', function() {
            loadHistoryData();
        });
    }
});

function showProfileView() {
    localStorage.removeItem('pendaftaran_donor_view');
    document.getElementById('historyContainer').classList.add('hidden');
    document.getElementById('profileContainer').classList.remove('hidden');
}

// Daftar Donor Action
document.getElementById('btnDaftarDonorProfile').addEventListener('click', function() {
    if (!activeDonor) return;

    // 0. Check for existing active registration (status 'Proses' and not cancelled)
    if (activeDonor.has_active_registration) {
        Swal.fire({
            icon: 'info',
            title: 'Pendaftaran Aktif',
            text: 'Anda sudah pernah daftar donor, tunggu data Anda diproses terlebih dahulu.',
            confirmButtonText: 'Mengerti',
            customClass: {
                confirmButton: 'bg-rose-500 hover:bg-rose-600 text-white font-bold py-2.5 px-6 rounded-xl transition duration-150 focus:outline-none'
            },
            buttonsStyling: false
        });
        return;
    }

    // 1. Check for 56-day gap if they have donated before
    if (activeDonor.tgl_donor_terakhir) {
        const lastDonorDate = new Date(activeDonor.tgl_donor_terakhir);
        const today = new Date();
        
        // Calculate difference in days
        const diffTime = today - lastDonorDate;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        if (diffDays < 56) {
            const nextDate = new Date(lastDonorDate.getTime() + 56 * 24 * 60 * 60 * 1000);
            Swal.fire({
                icon: 'error',
                title: 'Belum Bisa Donor',
                text: `Maaf, Anda baru bisa melakukan donor kembali pada tanggal ${formatDateIndo(nextDate)} (jeda 56 hari).`,
                confirmButtonText: 'Mengerti',
                customClass: {
                    confirmButton: 'bg-rose-500 hover:bg-rose-600 text-white font-bold py-2.5 px-6 rounded-xl transition duration-150 focus:outline-none'
                },
                buttonsStyling: false
            });
            return;
        }
    }

    // 2. Check if Blood Type and Rhesus are filled
    if (!activeDonor.gol_darah || !activeDonor.rhesus) {
        Swal.fire({
            icon: 'warning',
            title: 'Data Tidak Lengkap',
            text: 'Silakan isi data Golongan Darah dan Rhesus terlebih dahulu melalui menu Edit Profil.',
            confirmButtonText: 'Siap',
            customClass: {
                confirmButton: 'bg-rose-500 hover:bg-rose-600 text-white font-bold py-2.5 px-6 rounded-xl transition duration-150 focus:outline-none'
            },
            buttonsStyling: false
        });
        return;
    }
    
    // Clear previous form data
    const formPendaftaran = document.getElementById('formPendaftaranDonor');
    formPendaftaran.reset();
    
    // Reset Select2 locations
    $('#pendaftaran_lokasi').val(null).trigger('change');
    
    // Reset Radio buttons (Questionnaire) manually just in case
    formPendaftaran.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.checked = false;
    });

    localStorage.setItem('pendaftaran_donor_isPendaftaran', 'true');
    document.getElementById('mainContentCard').classList.add('hidden');
    document.getElementById('pendaftaranContainer').classList.remove('hidden');
    
    // Set pendonor_id in the form
    const pendonorId = activeDonor.pendonor_id || activeDonor.id;
    document.getElementById('pendaftaran_pendonor_id').value = pendonorId;
    
    // Pre-fill height and weight if available
    const heightInput = document.querySelector('input[name="tinggibadan_cm"]');
    const weightInput = document.querySelector('input[name="beratbadan_kg"]');
    if (heightInput) heightInput.value = activeDonor.tinggibadan_cm || activeDonor.tinggibadan || '';
    if (weightInput) weightInput.value = activeDonor.beratbadan_kg || activeDonor.beratbadan || '';

    // Initialize Select2 if not already done
    $('.select2-location').select2({
        placeholder: "Pilih Lokasi",
        allowClear: true,
        width: '100%'
    });

    // Initialize or Reset Flatpickr for Pendaftaran Date
    const tglInput = document.getElementById('pendaftaran_tgl');
    if (tglInput._flatpickr) {
        tglInput._flatpickr.setDate(new Date());
    } else {
        flatpickr("#pendaftaran_tgl", {
            dateFormat: "d-m-Y",
            defaultDate: new Date(),
            locale: {
                firstDayOfWeek: 1
            }
        });
    }
});

// Back to Profile Action
document.getElementById('btnBackToProfile').addEventListener('click', function() {
    localStorage.removeItem('pendaftaran_donor_isPendaftaran');
    document.getElementById('pendaftaranContainer').classList.add('hidden');
    document.getElementById('mainContentCard').classList.remove('hidden');
});

// Handle Pendaftaran Form Submission
document.getElementById('formPendaftaranDonor').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Validate that all questionnaire questions are answered
    const totalQuestions = document.querySelectorAll('#formPendaftaranDonor table tbody tr').length;
    const answeredQuestions = new Set();
    document.querySelectorAll('#formPendaftaranDonor input[type="radio"]:checked').forEach(radio => {
        answeredQuestions.add(radio.name);
    });

    if (answeredQuestions.size < totalQuestions) {
        Swal.fire({
            icon: 'warning',
            title: 'Kuesioner Belum Lengkap',
            text: 'Harap jawab semua pertanyaan kuesioner sebelum mendaftar.'
        });
        return;
    }

    // Basic validation for other fields
    const tgl = document.getElementById('pendaftaran_tgl').value;
    const tinggi = document.querySelector('input[name="tinggibadan_cm"]').value;
    const berat = document.querySelector('input[name="beratbadan_kg"]').value;
    const lokasi = document.getElementById('pendaftaran_lokasi').value;

    if (!tgl || !tinggi || !berat || !lokasi) {
        Swal.fire({
            icon: 'warning',
            title: 'Data Belum Lengkap',
            text: 'Harap isi Tanggal, Tinggi Badan, Berat Badan, dan Lokasi Donor.'
        });
        return;
    }

    const formData = new FormData(this);
    const payload = {
        pendonor_id: formData.get('pendonor_id'),
        tgl_pendaftaran: formData.get('tgl_pendaftaran'),
        tinggibadan_cm: formData.get('tinggibadan_cm'),
        beratbadan_kg: formData.get('beratbadan_kg'),
        ruangan_id: formData.get('ruangan_id'),
        jawaban: {}
    };

    // Correctly map radio buttons for "jawaban[id]"
    formData.forEach((value, key) => {
        if (key.startsWith('jawaban[')) {
            const id = key.match(/\[(\d+)\]/)[1];
            payload.jawaban[id] = value;
        }
    });

    Swal.fire({
        title: 'Memproses Pendaftaran...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch('/daftar-donor', {
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
            Swal.fire({
                icon: 'success',
                title: 'Pendaftaran Berhasil',
                text: res.message || 'Data pendaftaran donor Anda telah disimpan. Silakan lanjutkan proses di lokasi donor.',
                confirmButtonText: 'Selesai',
                customClass: {
                    confirmButton: 'bg-rose-500 hover:bg-rose-600 text-white font-bold py-2.5 px-6 rounded-xl transition duration-150 focus:outline-none'
                },
                buttonsStyling: false
            }).then(() => {
                localStorage.removeItem('pendaftaran_donor_isPendaftaran');
                document.getElementById('btnBackToProfile').click();
                
                // Refresh profile with fresh data from server
                if (res.pendonor) {
                    activeDonor = res.pendonor;
                    localStorage.setItem('pendaftaran_donor_activeDonor', JSON.stringify(activeDonor));
                    showProfile(activeDonor);
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Pendaftaran Gagal',
                text: res.message || 'Terjadi kesalahan saat menyimpan data pendaftaran.'
            });
        }
    })
    .catch(err => {
        console.error(err);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan Server',
            text: 'Gagal terhubung ke server. Silakan coba lagi nanti.'
        });
    });
});
