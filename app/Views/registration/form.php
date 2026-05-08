<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">🎓 Postgraduate Application Form</h4>
                    <small class="text-white-50">Master (S2) & Doctoral (S3) Program</small>
                </div>
                
                <div class="card-body">
                    <?php if(session('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach(session('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>

                    <div class="alert alert-info mb-4">
                        <h5 class="alert-heading mb-2">New Student Registration - Master (S2) and Doctoral (S3) Programs</h5>
                        <ul class="mb-3">
                            <li>Please review the form fields and prepare the required data before filling them out.</li>
                            <li>Prepare a note to record the Virtual Account (VA) number used for payment via BNI Bank.</li>
                        </ul>
                        <strong>Payment Instructions:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Pay via ATM / Internet Banking / Mobile Banking, etc. Use format: <strong>882901 + VA number</strong>.</li>
                            <li>Refer to the BNI Virtual Account Payment Guide.</li>
                        </ul>
                    </div>

                    <?= form_open_multipart('/registration/submit', ['id' => 'registrationForm']) ?>
                    
                    
                    <!-- Progress Steps -->
                    <div class="progress mb-4" style="height: 5px;">
                        <div class="progress-bar" role="progressbar" style="width: 25%" id="progressBar"></div>
                    </div>

                    <!-- Section 1: Personal Information -->
                    <fieldset id="step1">
                        <legend class="h5 border-bottom pb-2">👤 Personal Information</legend>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="full_name" class="form-control" 
                                       value="<?= old('full_name') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address *</label>
                                <input type="email" name="email" class="form-control" 
                                       value="<?= old('email') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" name="phone" class="form-control" 
                                       placeholder="+62..." value="<?= old('phone') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Emergency Contact Name *</label>
                                <input type="text" name="emergency_contact_name" class="form-control" 
                                       value="<?= old('emergency_contact_name') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Emergency Contact Phone *</label>
                                <input type="tel" name="emergency_contact_phone" class="form-control" 
                                       placeholder="+62..." value="<?= old('emergency_contact_phone') ?>" required>
                                <small class="text-muted">For contact when you're unavailable</small>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Place of Birth *</label>
                                <input type="text" name="place_of_birth" class="form-control" 
                                       value="<?= old('place_of_birth') ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Date of Birth *</label>
                                <input type="date" name="date_of_birth" class="form-control" 
                                       value="<?= old('date_of_birth') ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gender *</label>
                                <select name="gender" class="form-select" required>
                                    <option value="">Select...</option>
                                    <option value="male" <?= old('gender')=='male'?'selected':'' ?>>Male</option>
                                    <option value="female" <?= old('gender')=='female'?'selected':'' ?>>Female</option>
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Height (cm)</label>
                                <input type="number" name="height" class="form-control" 
                                       value="<?= old('height') ?>" min="100" max="250">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Blood Type</label>
                                <select name="blood_type" class="form-select">
                                    <option value="">Select...</option>
                                    <?php foreach(['A','B','AB','O'] as $bt): ?>
                                        <option value="<?= $bt ?>" <?= old('blood_type')==$bt?'selected':'' ?>><?= $bt ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ID Number (KTP/Passport) *</label>
                                <input type="text" name="id_number" class="form-control" 
                                       value="<?= old('id_number') ?>" required>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Section 2: Address -->
                    <fieldset id="step2" class="d-none">
                        <legend class="h5 border-bottom pb-2">📍 Address Information</legend>
                        
                        <div class="mb-3">
                            <label class="form-label">Home Address *</label>
                            <textarea name="home_address" class="form-control" rows="3" required><?= old('home_address') ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Mailing Address *</label>
                            <textarea name="mailing_address" class="form-control" rows="3" required><?= old('mailing_address') ?></textarea>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sameAddress">
                                <label class="form-check-label" for="sameAddress">Same as home address</label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Country *</label>
                                <select name="country" class="form-select select2" required>
                                    <option value="">Select Country...</option>
                                    <?php foreach($countries as $country): ?>
                                        <option value="<?= $country ?>" <?= (old('country') ?? 'Indonesia') == $country ? 'selected' : '' ?>>
                                            <?= $country ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Section 3: Academic -->
                    <fieldset id="step3" class="d-none">
                        <legend class="h5 border-bottom pb-2">🎓 Academic Information</legend>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Program Level *</label>
                                <select name="program_level" class="form-select" id="programLevel" required>
                                    <option value="">Select...</option>
                                    <option value="master" <?= old('program_level')=='master'?'selected':'' ?>>Master (S2)</option>
                                    <option value="doctoral" <?= old('program_level')=='doctoral'?'selected':'' ?>>Doctoral (S3)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Study Program *</label>
                                <select name="study_program" class="form-select" id="studyProgram" required>
                                    <option value="">Select Program Level first</option>
                                </select>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Available Class Days *</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php foreach($days as $day): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="available_days[]" 
                                                   value="<?= $day ?>" id="day<?= $day ?>"
                                                   <?= in_array($day, old('available_days', [])) ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="day<?= $day ?>"><?= $day ?></label>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Last University *</label>
                                <input type="text" name="last_university" class="form-control" 
                                       value="<?= old('last_university') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">TOEFL/TOAFL Score</label>
                                <input type="number" name="toefl_toafl_score" class="form-control" 
                                       value="<?= old('toefl_toafl_score') ?>" step="0.01" min="0" max="677"
                                       placeholder="e.g., 550.00">
                            </div>
                        </div>
                    </fieldset>

                    <!-- Section 4: Documents -->
                    <fieldset id="step4" class="d-none">
                        <legend class="h5 border-bottom pb-2">📁 Document Upload</legend>
                        
                        <div class="alert alert-info">
                            <strong>📋 Requirements:</strong>
                            <ul class="mb-0 mt-2 small">
                                <li>
                                    <strong>Master's (S2):</strong>
                                    <ul>
                                        <li>Scanned copy of latest diploma / degree certificate</li>
                                        <li>Scanned copy of academic transcript</li>
                                        <li>Scanned passport photo</li>
                                        <li>Scanned ID card / passport</li>
                                        <li>Scanned family card</li>
                                        <li>Scanned academic achievement certificate (if any, only the best one)</li>
                                        <li>Scanned study program accreditation certificate (minimum grade B)</li>
                                        <li>Scanned master's recommendation form</li>
                                        <li>The recommendation form for Master's Degree (S2) applicants must be signed by at least a person holding a Doctoral degree, <a href="https://aplikasi.radenintan.ac.id/nyetrum/file_pasca/FORM_REKOMENDASI_S2.rtf">Sample Form</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>Doctoral (S3):</strong>
                                    <ul>
                                        <li>Scanned copy of latest diploma / degree certificate</li>
                                        <li>Scanned copy of academic transcript</li>
                                        <li>Research proposal document</li>
                                        <li>Scanned passport photo</li>
                                        <li>Scanned ID card / passport</li>
                                        <li>Scanned family card</li>
                                        <li>Scanned academic achievement certificate (if any, only the best one)</li>
                                        <li>Scanned study program accreditation certificate (minimum grade B)</li>
                                        <li>Scanned recommendation forms 1 & 2 for doctoral program</li>
                                        <li>The recommendation forms for Doctoral Degree (S3) applicants must be signed by at least two people holding a Doctoral degree, <a href="https://aplikasi.radenintan.ac.id/nyetrum/file_pasca/FORM_REKOMENDASI_S3.rtf">Sample Form</a></li>
                                    </ul>
                                </li>
                                <li>All files must be compressed into <strong>one ZIP/RAR file</strong></li>
                                <li>File extension: <code>.jpg</code> or <code>.jpeg</code> for images</li>
                                <li>Maximum file size: <strong>19 MB</strong></li>
                            </ul>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Compressed Document File *</label>
                            <input type="file" name="documents" class="form-control" 
                                   accept=".zip,.rar" required>
                            <div class="form-text">Maximum 19MB. ZIP or RAR format only.</div>
                            <div id="fileInfo" class="small text-muted mt-1"></div>
                        </div>
                        
                        <!-- Additional fields for occupation & marital status -->
                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <label class="form-label">Occupation</label>
                                <select name="occupation" class="form-select">
                                    <option value="">Select...</option>
                                    <?php foreach(['Unemployed','Civil Servant','Military/Police','Entrepreneur','Private Employee','Honorary Worker'] as $occ): ?>
                                        <option value="<?= $occ ?>" <?= old('occupation')==$occ?'selected':'' ?>><?= $occ ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Marital Status</label>
                                <select name="marital_status" class="form-select">
                                    <option value="">Select...</option>
                                    <?php foreach(['single'=>'Single','married'=>'Married','widowed'=>'Widowed','divorced'=>'Divorced'] as $val=>$label): ?>
                                        <option value="<?= $val ?>" <?= old('marital_status')==$val?'selected':'' ?>><?= $label ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Navigation Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" id="prevBtn" disabled>← Previous</button>
                        <div>
                            <button type="button" class="btn btn-primary" id="nextBtn">Next →</button>
                            <button type="submit" class="btn btn-success d-none" id="submitBtn">✓ Submit Application</button>
                        </div>
                    </div>
                    
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for multi-step form -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const steps = ['step1','step2','step3','step4'];
    let currentStep = 0;
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    const progressBar = document.getElementById('progressBar');
    
    function showStep(step) {
        steps.forEach((s,i) => document.getElementById(s).classList.toggle('d-none', i!==step));
        prevBtn.disabled = step === 0;
        if(step === steps.length - 1) {
            nextBtn.classList.add('d-none');
            submitBtn.classList.remove('d-none');
        } else {
            nextBtn.classList.remove('d-none');
            submitBtn.classList.add('d-none');
        }
        progressBar.style.width = `${((step+1)/steps.length)*100}%`;
    }
    
    nextBtn.addEventListener('click', () => {
        // Basic validation for current step
        const currentFields = document.querySelectorAll(`#${steps[currentStep]} [required]`);
        let valid = true;
        currentFields.forEach(field => {
            if(!field.value.trim()) {
                field.classList.add('is-invalid');
                valid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        if(valid && currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });
    
    prevBtn.addEventListener('click', () => {
        if(currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });
    
    // Same address checkbox
    document.getElementById('sameAddress').addEventListener('change', function() {
        document.querySelector('textarea[name="mailing_address"]').disabled = this.checked;
        if(this.checked) {
            document.querySelector('textarea[name="mailing_address"]').value = 
                document.querySelector('textarea[name="home_address"]').value;
        }
    });
    
    const selectedProgram = <?= json_encode(old('study_program')) ?>;
    const selectedProgramLevel = <?= json_encode(old('program_level')) ?>;

    function updateStudyPrograms(level, selectedValue = null) {
        const programs = <?= json_encode($study_programs) ?>;
        const select = document.getElementById('studyProgram');
        select.innerHTML = '<option value="">Select Study Program...</option>';
        if (programs[level]) {
            programs[level].forEach(prog => {
                const opt = document.createElement('option');
                opt.value = prog;
                opt.textContent = prog;
                if (selectedValue && selectedValue === prog) {
                    opt.selected = true;
                }
                select.appendChild(opt);
            });
        }
    }

    // Program level change updates study programs
    document.getElementById('programLevel').addEventListener('change', function() {
        updateStudyPrograms(this.value);
    });

    if (selectedProgramLevel) {
        document.getElementById('programLevel').value = selectedProgramLevel;
        updateStudyPrograms(selectedProgramLevel, selectedProgram);
    }
    
    // File size validation
    document.querySelector('input[name="documents"]').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if(file) {
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);
            document.getElementById('fileInfo').textContent = 
                `Selected: ${file.name} (${sizeMB} MB)`;
            if(file.size > 19 * 1024 * 1024) {
                alert('File size exceeds 19MB limit!');
                this.value = '';
                document.getElementById('fileInfo').textContent = '';
            }
        }
    });
    
    showStep(0);
});
</script>

<?= $this->endSection() ?>
