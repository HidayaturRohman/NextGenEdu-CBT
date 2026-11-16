<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<style>
  #table-guru table#users td:nth-child(3),
  #table-guru table#users th:nth-child(3) {
    word-break: break-all !important;
    overflow-wrap: anywhere !important;
    white-space: normal !important;
    max-width: 160px !important;
    min-width: 120px !important;
    text-align: center !important;
  }
  #table-guru table#users td:nth-child(4),
  #table-guru table#users th:nth-child(4) {
    white-space: nowrap !important;
    width: 110px !important;
    min-width: 95px !important;
    text-align: center !important;
  }
</style>
<div class="row">
  <div class="col-sm-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #0d9488 0%, #115e59 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <polyline points="16 11 18 13 22 9"></polyline>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Manajemen akun login pendidik & tenaga kependidikan (PTK), reset kata sandi, dan status akun guru.</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
            <h4 class="card-title d-flex align-items-center">
                <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> <?= isset($subjudul) ? $subjudul : $judul ?>
            </h4>
          </div>
          <div class="card-tools d-flex gap-2">
                        <button type="button" onclick="getDataGuru()" class="shadow-sm btn btn-sm btn-light border">
                            <i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block ms-1">Reload</span>
                        </button>
                        <button type="button" class="shadow-sm btn btn-action btn-success btn-sm" data-action="aktifkan"
                                data-bs-toggle="tooltip" title="Aktifkan">
                            <i class="fa fa-users m-1"></i><span
                                    class="d-none d-sm-inline-block ms-1">Aktifkan Semua</span>
                        </button>
                        <button type="button" class="shadow-sm btn btn-action btn-danger btn-sm" data-action="nonaktifkan"
                                data-bs-toggle="tooltip" title="Nonaktifkan">
                            <i class="fa fa-ban m-1"></i><span
                                    class="d-none d-sm-inline-block ms-1">Nonaktifkan Semua</span>
                        </button>
                    
          </div>
        </div>
                <div class="card-body">
                    <div class="table-responsive" id="table-guru">
                    </div>
                </div>
                <div class="overlay d-none" id="loading">
                    <div class="spinner-grow"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= form_open('', array('id' => 'up')) ?>
<?= form_close(); ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?=base_url()?>/assets/app/js/ajax_request.js" type="text/javascript"></script>
<script type="text/javascript">
    const user_id = '<?= is_array($user) ? ($user['id'] ?? '') : (is_object($user) ? ($user->id ?? '') : '') ?>';
    let table;

    $(document).ready(function() {
        ajaxcsrf();

        $("#users").on("click", ".btn-reset", function() {
            $('#loading').removeClass('d-none');
            let username = $(this).data("username");
            let nama = $(this).data("nama");
            $.ajax({
                url: base_url + "userguru/reset_login?username="+ username,
                type: "GET",
                success: function (response) {
                    $('#loading').addClass('d-none');
                    if (response.msg) {
                        if (response.status) {
                            swal.fire({
                                title: "Sukses",
                                html: "<b>"+nama+ response.msg+"<b>",
                                icon: "success"
                            });
                            getDataGuru()
                        } else {
                            swal.fire({
                                title: "Error",
                                html: "<b>"+nama + response.msg+"<b>",
                                icon: "error"
                            });
                        }
                    }
                },
                error: function(xhr, status, error) {
                    $('#loading').addClass('d-none');
                    console.log(xhr);
                    Swal.fire({
                        title: "Gagal",
                        html: xhr.responseText,
                        icon: "error"
                    });
                }
            });
        });

        $(".btn-action").on("click", function() {
            console.log('click');
            let action = $(this).data("action");
            swal.fire({
                title: action === 'aktifkan' ? "Aktifkan Semua Guru" : "Nonaktifkan Semua Guru",
                text: "",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Lanjutkan"
            }).then(async result => {
                if (result.value) {
                    $('#loading').removeClass('d-none');
                    let formActivate = new FormData($('#up')[0])
                    formActivate.append('is_active', action)
                    await ajaxPost(base_url + "userguru/aktifkansemua", formActivate, function(error, response) {
                        $('#loading').addClass('d-none');
                        if (error) {
                            console.log('error', error.message);
                        } else {
                            console.log('response', response);
                            if (response.status) {
                                updateUser()
                            }
                        }
                    });
                }
            });

        });

        getDataGuru()
    });

    async function updateUser() {
        let formActivate = new FormData($('#up')[0])
        await ajaxPost(base_url + "userguru/update_iduser", formActivate, function (error, response) {
            if (error) {
                console.log('error', error.message);
            } else {
                console.log('response', response);
                if (response.status) {
                    swal.fire({
                        title: response.status ? "Sukses" : "Gagal",
                        html: response.msg,
                        icon: response.status ? "success" : "error"
                    }).then(result => {
                        getDataGuru()
                    });
                }
            }
        });
    }

    function getDataGuru() {
        $('#loading').removeClass('d-none');
        ajaxGet(base_url + 'userguru/data', function(error, response) {
            if (error) {
                console.log('error', error.message);
            } else {
                console.log('response', response);
                populateTable(response)
            }
        });
    }

    function populateTable(data) {
        const tableContainer = document.getElementById("table-guru");
        tableContainer.innerHTML = '';

        const table = document.createElement("table");
        table.id = "users";
        table.className = "w-100 table table-sm table-striped table-bordered table-hover";

        const thead = document.createElement("thead");
        const headerRow = document.createElement("tr");
        const columns = [
            { text: "No.", width: "45px", className: "text-center align-middle" },
            { text: "Nama", width: "auto", className: "align-middle" },
            { text: "Username", width: "130px", className: "text-center align-middle" },
            { text: "Password", width: "110px", className: "text-center align-middle" },
            { text: "Jabatan", width: "160px", className: "text-center align-middle" },
            { text: "Reset Login", width: "95px", className: "text-center align-middle" },
            { text: "Status", width: "140px", className: "text-center align-middle" }
        ];

        columns.forEach(col => {
            const th = document.createElement("th");
            if (col.width !== 'auto') {
                th.style.width = col.width;
                th.style.maxWidth = col.width;
            }
            th.className = col.className;
            th.textContent = col.text;
            headerRow.appendChild(th);
        });
        thead.appendChild(headerRow);
        table.appendChild(thead);

        const tbody = document.createElement("tbody");
        let num = 1;
        data.forEach(guru => {
            const row = document.createElement("tr");
            // nomor
            const cellNum = document.createElement("td");
            cellNum.className = "text-center align-middle";
            cellNum.style.width = "45px";
            cellNum.textContent = num.toString();
            row.appendChild(cellNum);

            // nama
            const cellName = document.createElement("td");
            cellName.className = "align-middle";
            const defaultFoto = '<?= base_url('assets/img/guru.png') ?>';
            let fotoSrc = defaultFoto;
            if (guru.foto && typeof guru.foto === 'string' && guru.foto.trim() !== '' && guru.foto !== 'null' && guru.foto !== 'undefined') {
                fotoSrc = (guru.foto.startsWith('http://') || guru.foto.startsWith('https://'))
                    ? guru.foto
                    : '<?= rtrim(base_url(), "/") ?>/' + guru.foto.replace(/^\/+/, '');
            }
            const nipHtml = guru.nip ? `<div class="text-muted small" style="font-size: 0.78rem;">${guru.jenis_nip || 'NIP'}: ${guru.nip}</div>` : '';
            cellName.innerHTML = `<div class="d-flex align-items-center">
                    <img class="rounded-circle img-thumbnail shadow-sm me-3" src="${fotoSrc}" style="width: 54px; height: 54px; min-width: 54px; min-height: 54px; object-fit: cover;" alt="foto" onerror="this.onerror=null;this.src='${defaultFoto}';">
                    <div>
                        <div class="fw-bold text-primary" style="font-size: 0.95rem;">${guru.nama_guru}</div>
                        ${nipHtml}
                    </div>
                </div>`;
            row.appendChild(cellName);

            // Username
            const cellUsername = document.createElement("td");
            cellUsername.className = "text-center align-middle";
            cellUsername.style.cssText = "word-break: break-all !important; overflow-wrap: anywhere !important; white-space: normal !important; max-width: 160px; min-width: 120px;";
            cellUsername.innerHTML = `<span class="fw-semibold text-break" style="word-break: break-all !important; overflow-wrap: anywhere !important; white-space: normal !important; display: block; line-height: 1.35; font-size: 0.88rem;">${guru.username || '-'}</span>`;
            row.appendChild(cellUsername);

            // password
            const cellPass = document.createElement("td");
            cellPass.className = "text-center align-middle";
            cellPass.style.cssText = "white-space: nowrap !important; width: 110px; min-width: 95px;";
            cellPass.innerHTML = `<code class="text-dark bg-light px-2 py-1 rounded border small" style="white-space: nowrap !important;">${guru.password || '-'}</code>`;
            row.appendChild(cellPass);

            // Jabatan
            const cellLvl = document.createElement("td");
            cellLvl.className = "text-center align-middle";
            cellLvl.style.maxWidth = "160px";
            let jabatanText = guru.level || '';
            if (guru.level && guru.nama_kelas && guru.nama_kelas.trim() !== '') {
                jabatanText += ' ' + guru.nama_kelas;
            }
            if (jabatanText) {
                cellLvl.innerHTML = `<span class="badge bg-soft-info text-info border border-info border-opacity-25 px-2 py-1"><iconify-icon icon="lucide:briefcase" class="me-1"></iconify-icon>${jabatanText}</span>`;
            } else {
                cellLvl.innerHTML = `<span class="badge bg-light text-muted border px-2 py-1">-</span>`;
            }
            row.appendChild(cellLvl);

            // Reset
            const cellReset = document.createElement("td");
            cellReset.className = "text-center align-middle";
            cellReset.style.maxWidth = "95px";
            const resetButton = document.createElement("button");
            resetButton.type = "button";
            const no_reset = guru['reset'] === '0'
            resetButton.className = `btn btn-reset btn-light border btn-sm ${no_reset ? 'btn-disabled' : ''}`;
            resetButton.setAttribute("data-toggle", "tooltip");
            resetButton.setAttribute("title", "Reset Login");
            resetButton.onclick = () => resetLogin(guru.login_id || guru.id || guru.id_user, guru.id_guru, guru.nama_guru, guru.username);
            if (no_reset) {
                resetButton.setAttribute("disabled", "disabled");
            }
            const icon = document.createElement("i");
            icon.className = "fa fa-sync m-1";
            resetButton.appendChild(icon)
            cellReset.appendChild(resetButton);
            row.appendChild(cellReset);

            // Status
            const cellStatus = document.createElement("td");
            cellStatus.className = `text-bold text-center align-middle p-1`;
            cellStatus.style.maxWidth = "140px";
            if (guru.active === "1") {
                cellStatus.innerHTML = '<div class="mb-2"><span class="badge bg-success text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.85rem;"><iconify-icon icon="lucide:check-circle" class="me-1"></iconify-icon>Aktif</span></div>';
            } else {
                cellStatus.innerHTML = '<div class="mb-2"><span class="badge bg-danger text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.85rem;"><iconify-icon icon="lucide:x-circle" class="me-1"></iconify-icon>Nonaktif</span></div>';
            }
            
            const aksiButton = document.createElement("button");
            aksiButton.type = "button";
            aksiButton.className = `btn btn-sm`;
            aksiButton.textContent = guru.active === "1" ? ' Nonaktifkan ' : ' Aktifkan ';
            aksiButton.onclick = () => aktifkan(guru.login_id || guru.id || guru.id_user, guru.id_guru, guru.nama_guru, guru.active === "1" ? 'nonaktifkan' : 'aktifkan');
            aksiButton.setAttribute("data-toggle", "tooltip");
            if (guru.active === "1") {
                aksiButton.setAttribute("title", "Nonaktifkan");
                aksiButton.classList.add('btn-danger');
            } else {
                aksiButton.setAttribute("title", "Aktifkan");
                aksiButton.classList.add('btn-success');
            }
            cellStatus.appendChild(aksiButton);
            row.appendChild(cellStatus);

            tbody.appendChild(row);
            num ++;
        });

        table.appendChild(tbody);
        document.getElementById("table-guru").appendChild(table);

        $("#users").DataTable();
        $('#loading').addClass('d-none');
    }

    function aktifkan(id, id_guru, nama_guru, isActive) {
        console.log(id, id_guru, nama_guru, isActive)
        $('#loading').removeClass('d-none');
        let formActivate = new FormData($('#up')[0])
        formActivate.append('is_active', isActive)
        if (id) formActivate.append('id', id)
        formActivate.append('id_guru', id_guru)
        formActivate.append('nama', nama_guru)
        ajaxPost(base_url + 'userguru/activate', formActivate, function(error, response) {
            $('#loading').addClass('d-none');
            if (error) {
                swal.fire({
                    title: "Error",
                    html: error.message,
                    icon: "error"
                });
            } else {
                console.log('response_e', response);
                if (response.status) {
                    swal.fire({
                        title: "Sukses",
                        text: response.msg,
                        icon: "success"
                    }).then(result => {
                        getDataGuru()
                    });
                } else {
                    let errs = response.msg;
                    if (response.users) {
                        for (const user of response.users) {
                            errs += `<br><b>- ${user.nama_guru}</b>`;
                        }
                    }

                    swal.fire({
                        title: "Error",
                        html: errs,
                        icon: "error"
                    });
                }
            }
        })
    }

    function resetLogin(id, id_guru, nama_guru, username) {
        $('#loading').removeClass('d-none');
        let formActivate = new FormData($('#up')[0])
        formActivate.append('username', username)
        formActivate.append('id', id)
        formActivate.append('id_guru', id_guru)
        formActivate.append('nama', nama_guru)
        ajaxPost(base_url + 'userguru/reset_login', formActivate, function(error, response) {
            $('#loading').addClass('d-none');
            if (error) {
                swal.fire({
                    title: "Error",
                    text: error.message,
                    icon: "error"
                });
            } else {
                console.log('response', response);
                if (response.status) {
                    swal.fire({
                        title: "Sukses",
                        text: response.msg,
                        icon: "success"
                    }).then(result => {
                        getDataGuru()
                    });
                } else {
                    swal.fire({
                        title: "Error",
                        text: response.msg,
                        icon: "error"
                    });
                }
            }
        })
    }
</script>

<?= $this->endSection() ?>

