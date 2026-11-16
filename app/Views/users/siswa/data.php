<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="row">
  <div class="col-sm-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Pengaturan kredensial akun login peserta didik, reset kata sandi, dan status keaktifan akun siswa.</p>
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
                    <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length">
                                    <label>Show
                                        <select id="users_length" aria-controls="users" class="form-select form-select-sm form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_filter">
                                    <button id="btn-clear" type="button" class="btn btn-sm btn-light m-0" data-bs-toggle="tooltip" title="hapus pencarian" disabled="disabled">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <label>
                                        <input id="input-search" type="search" class="form-control form-control-sm" placeholder="" aria-controls="users">
                                    </label>
                                    <button id="btn-search" type="button" class="btn btn-sm btn-light" data-bs-toggle="tooltip" title="Cari" onclick="applySearch()" disabled="disabled">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mb-3">
                        <?= form_open('', array('id' => 'bulk')); ?>
                        <table id="users" class="w-100 table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 40px">No.</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th class="text-center">Reset Login</th>
                                <th class="text-center">Status/Aksi</th>
                            </tr>
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
                        <?= form_close() ?>
                    </div>
                    <div class="col-12">
                        <div class="float-start" id="total-entri"></div>
                        <nav aria-label="Page navigation" class="float-end">
                            <ul class="pagination" id="pagination"></ul>
                        </nav>
                    </div>
                </div>
                <div class="overlay d-none" id="loading">
                    <div class="spinner-grow"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= form_open('', array('id' => 'pager')); ?>
<input type="hidden" id="pager-page" name="page" value="1">
<input type="hidden" id="pager-limit" name="limit" value="10">
<?= form_close() ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?=base_url()?>/assets/app/js/jquery.twbsPagination.js" type="text/javascript"></script>
<script type="text/javascript">
    let currentPage = 1;
    let perPage = 10;
    let $pagination, defaultOpts, query;

    $(document).ready(async function () {
        ajaxcsrf();

        $pagination = $('#pagination');
        defaultOpts = {
            visiblePages: 5,
            initiateStartPageClick: false,
            onPageClick: function (event, page) {
                console.info(page + ' (from options)');
                currentPage = page;
                loadSiswa();
            }
        };
        $pagination.twbsPagination(defaultOpts);

        $('#users_length').change(function () {
            $('#pager-limit').val($(this).val());
            perPage = $(this).val();
            currentPage = 1;
            loadSiswa();
        });

        $('#input-search').on('change keyup', function () {
            var val = $(this).val();
            query = val === "" ? null : val;
            $('#btn-clear').attr('disabled', query == null)
            $('#btn-search').attr('disabled', query == null)
        });

        $('#btn-clear').on('click', function () {
            query = null;
            currentPage = 1;
            $(this).attr('disabled', query == null);
            $('#btn-search').attr('disabled', query == null);
            loadSiswa();
        });

        $("#users").on("click", ".btn-aktif", async function () {
            let id = $(this).data("id");
            let nama = encodeURIComponent($(this).data("nama"));
            $('#loading').removeClass('d-none');

            let formActivate = new FormData($('#pager')[0])
            formActivate.append('is_active', 'aktifkan')
            formActivate.append('id_siswa', id)
            formActivate.append('nama', nama)
            const data = await ajaxPost('usersiswa/activate', formActivate)
            console.log("response:", data);
            if (data.status) {
                swal.fire({
                    title: "Sukses",
                    text: data.msg,
                    icon: "success"
                }).then(result => {
                    loadSiswa();
                });
            } else {
                swal.fire({
                    title: "Error",
                    text: data.msg,
                    icon: "error"
                });
            }
        });

        $("#users").on("click", ".btn-nonaktif", async function () {
            let id = $(this).data("id");
            let username = $(this).data("username");
            let nama = encodeURIComponent($(this).data("nama"));
            $('#loading').removeClass('d-none');

            let formActivate = new FormData($('#pager')[0])
            formActivate.append('is_active', 'nonaktifkan')
            formActivate.append('id_siswa', id)
            formActivate.append('username', username)
            formActivate.append('nama', nama)
            const data = await ajaxPost('usersiswa/activate', formActivate)
            console.log("response:", data);
            if (data.status) {
                swal.fire({
                    title: "Sukses",
                    text: data.msg,
                    icon: "success"
                }).then(result => {
                    loadSiswa();
                });
            } else {
                swal.fire({
                    title: "Error",
                    html: data.msg,
                    icon: "error"
                });
            }
        });

        $("#users").on("click", ".btn-reset", async function () {
            let username = $(this).data("username");
            let id = $(this).data("id");
            let nama = encodeURIComponent($(this).data("nama"));
            $('#loading').removeClass('d-none');

            let formActivate = new FormData($('#pager')[0])
            formActivate.append('id_siswa', id)
            formActivate.append('username', username)
            formActivate.append('nama', nama)
            const response = await ajaxPost('usersiswa/reset_login', formActivate)
            if (response.status) {
                swal.fire({
                    title: "Sukses",
                    html: "<b>" + decodeURIComponent(response.msg) + "<b>",
                    icon: "success"
                }).then(result => {
                    loadSiswa();
                });
            } else {
                swal.fire({
                    title: "Error",
                    html: "<b>" + decodeURIComponent(response.msg) + "<b>",
                    icon: "error"
                });
            }
            $('#loading').addClass('d-none');
        });

        $(".btn-action").on("click", function () {
            let action = $(this).data("action");

            swal.fire({
                title: action === 'aktifkan' ? "Aktifan semua siswa" : "Nonaktifkan semua siswa",
                text: "",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Lanjutkan"
            }).then(async result => {
                if (result.value) {
                    $('#loading').removeClass('d-none');
                    swal.fire({
                        title: action === 'aktifkan' ? "Mengaktifkan semua siswa" : "Menonaktifkan semua siswa",
                        text: "Silahkan tunggu....",
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        onOpen: () => {
                            swal.showLoading();
                        }
                    });

                    let formActivate = new FormData($('#pager')[0])
                    formActivate.append('is_active', action)

                    const response = await ajaxPost("usersiswa/aktifkansemua", formActivate)
                    console.log("result", response);
                    if (response.status) {
                        swal.fire({
                            title: response.status ? "Sukses" : "Gagal",
                            html: response.msg,
                            icon: response.status ? "success" : "error"
                        }).then(result => {
                            loadSiswa();
                        });
                    }
                    $('#loading').addClass('d-none');
                }
            });
        });

        await loadSiswa();

    });

    async function loadSiswa() {
        $('#pager-page').val(currentPage);
        $('#loading').removeClass('d-none');

        let dataPost = new FormData($('#pager')[0])
        if (query != null) dataPost.append('search', query)

        const data = await ajaxPost('usersiswa/list', dataPost)
        if (data.pages > 0) {
            $pagination.removeClass('d-none');
            $pagination.twbsPagination('destroy');
            $pagination.twbsPagination($.extend({}, defaultOpts, {
                startPage: currentPage,
                totalPages: data.pages,
            }));
        }
        previewData(data);

        $('#loading').addClass('d-none');
        $('#input-search').val(data.search);
    }

    function previewData(data) {
        console.log(data);
        $('#input-search').val(data.search);
        var html = '';
        if (data.lists.length > 0) {
            $.each(data.lists, function (idx, siswa) {
                const kls = siswa.nama_kelas != null ? siswa.nama_kelas : '';
                
                // Perjelas tombol status
                const badgeStatus = siswa.status == 1 ? 
                    '<div class="mb-2"><span class="badge bg-success text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.85rem;"><iconify-icon icon="lucide:check-circle" class="me-1 align-middle"></iconify-icon>Aktif</span></div>' : 
                    '<div class="mb-2"><span class="badge bg-danger text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.85rem;"><iconify-icon icon="lucide:x-circle" class="me-1 align-middle"></iconify-icon>Nonaktif</span></div>';
                
                const aksiButton = siswa.status == 1 ? 
                    `<button type="button" class="btn btn-danger btn-sm btn-nonaktif" data-id="${siswa.id_siswa}" data-nama="${siswa.nama}" data-username="${siswa.username}">Nonaktifkan</button>` : 
                    `<button type="button" class="btn btn-success btn-sm btn-aktif" data-id="${siswa.id_siswa}" data-nama="${siswa.nama}">Aktifkan</button>`;
                
                // Sembunyikan password hash
                const pwdHidden = `<span class="badge bg-light text-secondary border"><i class="fas fa-lock me-1"></i> Terenkripsi</span>`;

                html += `<tr>
                <td class="text-center align-middle">
                    <input type="hidden" name="ids[]" value="${siswa.id_siswa}">
                    ${Number((perPage * (currentPage - 1)) + (idx + 1))}</td>
                <td class="align-middle">${siswa.nis}</td>
                <td>
                    <div class="media d-flex h-100">
                        <img class="avatar img-circle justify-content-center align-self-center" src="${base_url+siswa.foto}" width="40" height="40" alt="User Image" onerror="this.src='${base_url}assets/img/siswa_sm.png'">
                        <div class="media-body ms-2 justify-content-center align-self-center">${siswa.nama}</div>
                    </div>
                </td>
                <td class="align-middle">${kls}</td>
                <td class="align-middle text-break" style="word-break: break-all !important; overflow-wrap: anywhere !important; white-space: normal !important; max-width: 150px;">${siswa.username}</td>
                <td class="align-middle text-center">${pwdHidden}</td>
                <td class="text-center align-middle">
                    <button type="button" class="btn btn-warning btn-sm btn-reset" data-id="${siswa.id_siswa}" data-username="${siswa.username}" data-nama="${siswa.nama}" data-bs-toggle="tooltip" title="Reset Login"><i class="fa fa-sync text-white"></i></button>
                </td>
                <td class="text-center align-middle" style="width: 120px;">
                    ${badgeStatus}
                    ${aksiButton}
                </td>
                </tr>`;
            });
            let loaded = data.lists.length;
            let to = (currentPage * perPage) - perPage;
            $('#total-entri').html(`${to + 1} ~ ${to + loaded} dari ${data.total} entri`);
        } else {
            $('#total-entri').html(`0 ~ 0 dari 0 entri`);
            html += '<tr><td colspan="8" class="text-center align-middle">Tidak ada data siswa</td><tr>';
        }

        $('#table-body').html(html);
    }

    function applySearch() {
        query = $('#input-search').val();
        currentPage = 1;
        loadSiswa();
    }

    async function ajaxPost(url, formData) {
        return new Promise((resolve, reject) => {
            setTimeout(function () {
                $.ajax({
                    url: base_url + url,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (respon) {
                        resolve(respon);
                    },
                    error: function (xhr, status, error) {
                        $('#loading').addClass('d-none');
                        console.log(xhr);
                        Swal.fire({
                            title: "Gagal",
                            html: xhr.responseText,
                            icon: "error"
                        });
                        reject(error);
                    }
                });
            }, 500)
        });
    }
</script>

<?= $this->endSection() ?>

