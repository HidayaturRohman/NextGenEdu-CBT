<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hidayatur Rohman
 * Date: 07/07/20
 * Time: 17:20
 */
?>

<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
              <div class="me-3 flex-shrink-0">
                <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff;">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                    <path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                  </svg>
                </div>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                    <?= $judul ?>
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Manajemen pengumuman sekolah, informasi akademik, dan pesan siaran ke seluruh siswa & guru.</p>
              </div>
            </div>
        </div>
      </div>
    </div>

    <!-- 2 Column Section: Running Text & Tulis Pengumuman -->
    <div class="row g-4 mb-4 align-items-stretch">
        <?php if ($is_admin) : ?>
            <div class="col-12 col-lg-5">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-bottom">
                        <div class="card-title mb-0 d-flex align-items-center">
                            <iconify-icon icon="lucide:rss" class="text-primary me-2" style="font-size: 1.3rem;"></iconify-icon>
                            <span class="fw-bold" style="font-size: 1.1rem; color: #232D42;">Running Text</span>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <div class="alert alert-info py-2 px-3 small d-flex align-items-center mb-3" role="alert">
                                <i class="fas fa-info-circle me-2 fs-5"></i>
                                <span>RUNNING TEXT akan muncul bergantian di bagian bawah layar siswa.</span>
                            </div>

                            <table id="tb-text" class="table mb-3 table-bordered table-striped table-hover" style="table-layout: fixed; width: 100%;">
                                <tbody>
                                <?php
                                for ($i = 0; $i < 5; $i++) :
                                    $text = isset($running_text[$i]) ? $running_text[$i]->text : '';
                                    ?>
                                    <tr>
                                        <td width="42" class="text-center align-middle bg-light fw-bold text-muted"><?= $i + 1 ?></td>
                                        <td class="p-0 align-middle bg-white">
                                            <div class="editable form-control border-0 rounded-0 w-100 p-2" style="min-height: 42px; box-shadow: none; outline: none; word-break: break-word; white-space: normal; overflow-wrap: anywhere; font-size: 0.88rem;"><?= $text ?></div>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                        <?= form_open('', array('id' => 'formrunningtext', 'class' => 'mt-2 text-end')) ?>
                        <button type="submit" class="btn btn-primary shadow-sm"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg><span class="d-none d-sm-inline-block ms-1">Simpan Running Text</span></button>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-12 <?= $is_admin ? 'col-lg-7' : 'col-12' ?>">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <div class="card-title mb-0 d-flex align-items-center">
                        <iconify-icon icon="lucide:send" class="text-primary me-2" style="font-size: 1.3rem;"></iconify-icon>
                        <span class="fw-bold" style="font-size: 1.1rem; color: #232D42;">Tulis Info / Pengumuman</span>
                    </div>
                </div>
                <div class="card-body text-dark">
                    <?= form_open('', array('id' => 'formpengumuman')) ?>
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-2 col-form-label fw-bold">Kepada:</label>
                        <div class="col-sm-10">
                            <select id="opsi-kepada" name="kepada[]" class="select2 form-control" multiple="multiple" required>
                                <option value='guru'>Semua Guru</option>
                                <option value='siswa'>Semua Siswa</option>
                                <?php foreach ($kelas as $key => $value) : ?>
                                    <option class="opsi-kelas" value="<?= $key ?>"><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea class="w-100" id="text-pengumuman" name="text" required></textarea>
                    </div>

                    <?php if ($is_admin): ?>
                        <input type="hidden" name="dari" value="0">
                    <?php else: ?>
                        <input type="hidden" name="dari" value="<?= isset($guru) && $guru ? $guru->id_guru : 0 ?>">
                    <?php endif; ?>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary shadow-sm"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg><span class="d-none d-sm-inline-block ms-1">Simpan Pengumuman</span></button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Feed Daftar Pengumuman -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <div class="card-title mb-0 d-flex align-items-center">
                        <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        <span class="fw-bold" style="font-size: 1.1rem; color: #232D42;"><?= $subjudul ?></span>
                    </div>
                </div>
                <div class="card-body">
                            <?php
                            foreach ($pengumumans as $pengumuman) : ?>
                                <div class="card border mb-3 shadow-sm">
                                    <div class="card-body" id="parent<?= $pengumuman->id_post ?>">
                                        <div class="d-flex align-items-center mb-3">
                                            <?php if ($pengumuman->dari == '0') : ?>
                                                <div class="d-flex align-items-center justify-content-center bg-success text-white rounded-circle shadow-sm me-3" style="width: 50px; height: 50px; font-size: 24px;">A</div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-bold">Admin</span>
                                                    <br/>
                                                    <span class="text-muted small"><?= buat_tanggal(date('D, d M Y H:i', strtotime($pengumuman->tanggal ?? ''))) ?></span>
                                                </div>
                                            <?php else: ?>
                                                <img class="rounded-circle me-3 shadow-sm"
                                                     src="<?= file_exists($pengumuman->foto ?? '') ? base_url() . $pengumuman->foto : base_url('assets/img/siswa.png') ?>"
                                                     width="50" height="50" style="object-fit: cover;"/>
                                                <div class="flex-grow-1">
                                                    <span class="fw-bold"><?= $pengumuman->nama_guru ?? 'Guru' ?></span>
                                                    <br/>
                                                    <span class="text-muted small"><?= buat_tanggal(date('D, d M Y H:i', strtotime($pengumuman->tanggal ?? ''))) ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="mt-2">
                                            <?= $pengumuman->text ?>
                                        </div>
                                        <div class="text-muted">
                                            <button type="button" class="btn btn-light border btn-sm me-2 btn-toggle"
                                                    data-id="<?= $pengumuman->id_post ?>" data-bs-toggle="modal"
                                                    data-bs-target="#komentarModal"><i class="fas fa-reply me-1"></i> Tulis
                                                komentar
                                            </button>
                                            <button type="button" id="trigger<?= $pengumuman->id_post ?>"
                                                    class="btn btn-light border btn-sm me-2 action-collapse"
                                                    data-bs-toggle="collapse" aria-expanded="true"
                                                    aria-controls="collapse-<?= $pengumuman->id_post ?>"
                                                    href="#collapse-<?= $pengumuman->id_post ?>">
                                                <i class="fa fa-commenting-o me-1"></i><?= $pengumuman->jml ?> komentar
                                            </button>
                                            <button type="button" class="btn btn-light border btn-sm"
                                                    onclick="hapusPost(<?= $pengumuman->id_post ?>)"
                                                    data-id="<?= $pengumuman->id_post ?>">
                                                <i class="fa fa-trash me-1"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                    <div id="collapse-<?= $pengumuman->id_post ?>" class="p-2 collapse toggle-comment"
                                         data-id="<?= $pengumuman->id_post ?>"
                                         data-parent="#parent<?= $pengumuman->id_post ?>">
                                        <hr class="m-0">
                                        <div id="konten<?= $pengumuman->id_post ?>" class="p-4">
                                        </div>
                                        <div id="loading<?= $pengumuman->id_post ?>" class="text-center d-none">
                                            <div class="spinner-grow"></div>
                                        </div>
                                        <?php if ($pengumuman->jml == '0') : ?>
                                            <div class="text-center">Tidak ada komentar</div>
                                            <div id="loadmore<?= $pengumuman->id_post ?>"
                                                 onclick="getComments(<?= $pengumuman->id_post ?>)"
                                                 class="text-center mt-4 loadmore">
                                                <div class="btn btn-light border">Muat komentar lainnya ...</div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="komentarModal" tabindex="-1" role="dialog" aria-labelledby="komentarLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="komentarLabel">Tulis Komentar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center">
                    <img class="img-fluid rounded-circle me-3 shadow-sm" src="<?= base_url('assets/img/siswa.png') ?>" alt="Alt Text" width="40" height="40">
                    <div class="flex-grow-1">
                        <?= form_open('create', array('id' => 'komentar')) ?>
                        <input type="hidden" id="id-post" name="id_post" value="">
                        <div class="input-group">
                            <input type="text" name="text" placeholder="Tulis komentar ..."
                                   class="form-control" required>
                            <button type="submit" class="btn btn-success shadow-sm">Komentari</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="balasanModal" tabindex="-1" role="dialog" aria-labelledby="balasanLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="balasanLabel">Tulis Balasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center">
                    <img class="img-fluid rounded-circle me-3 shadow-sm" src="<?= base_url('assets/img/siswa.png') ?>" alt="Alt Text" width="40" height="40">
                    <div class="flex-grow-1">
                        <?= form_open('create', array('id' => 'balasan')) ?>
                        <input type="hidden" id="id-comment" name="id_comment" value="">
                        <div class="input-group">
                            <input type="text" name="text" placeholder="Tulis balasan ...."
                                   class="form-control" required>
                            <button type="submit" class="btn btn-success shadow-sm">Balas</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var guru = '<?=isset($guru) ? $guru->id_guru : ""?>';

    function createTime(d) {
        var date = new Date(d);

        var jam = date.getHours();
        var menit = date.getMinutes();
        var sJam;
        var sMenit;

        if (jam < 10) sJam = '0' + jam;
        else sJam = '' + jam;

        if (menit < 10) sMenit = '0' + menit;
        else sMenit = '' + menit;

        var hari = daysdifference(d);
        var time;

        if (hari === 0) {
            time = sJam + ':' + sMenit;
        } else if (hari === 1) {
            time = 'kemarin ' + sJam + ':' + sMenit;
        } else {
            time = jQuery.timeago(d) + ', ' + sJam + ':' + sMenit;
        }
        return time;
    }

    function daysdifference(last) {
        var startDay = new Date(last);
        var endDay = new Date();

        var millisBetween = startDay.getTime() - endDay.getTime();
        var days = millisBetween / (1000 * 3600 * 24);

        return Math.round(Math.abs(days));
    }

    function addComments(id, comments, append) {
        if (!comments) return;
        if (!Array.isArray(comments)) comments = [comments];
        var comm = '';
        $.each(comments, function (i, v) {
            var dari = v.dari_group === '1' ? 'Admin' : (v.dari_group === '2' ? v.nama_guru : v.nama_siswa);
            var foto = v.dari_group === '2' ? (v.foto != null ? base_url + v.foto : base_url + 'assets/img/siswa.png') :
                (v.foto_siswa != null ? base_url + v.foto_siswa : base_url + 'assets/img/siswa.png');
            var avatar = v.dari == '0' ? '<div class="btn-circle-sm btn-success shadow-sm media-left pt-1" style="width: 43px; height: 40px">A</div>' : '<img class="img-circle border" src="' + foto + '" alt="Img" width="40px" height="40px">';
            comm += '<div class="media mt-1" id="parent-reply' + v.id_comment + '">'
                + avatar +
                '    <div class="w-100 ms-2">' +
                '        <div class="media-body border ps-3 bg-light" style="border-radius: 20px">' +
                '            <span class="text-xs text-muted"><b>' + dari + '</b></span>' +
                '            <div class="comment-text pb-1">' + v.text + '</div>' +
                '        </div>' +
                '        <div class="ms-2">' +
                '            <span class="btn-sm me-2 text-muted">' + createTime(v.tanggal) + '</span>' +
                '            <span id="trigger-reply' + v.id_comment + '" class="btn btn-sm me-2 text-muted action-collapse" data-bs-toggle="collapse" aria-expanded="true"' +
                '                              aria-controls="collapse-reply' + v.id_comment + '"' +
                '                              href="#collapse-reply' + v.id_comment + '"><b>' + v.jml + ' balasan</b></span>' +
                '            <span class="btn btn-sm me-2 text-muted btn-toggle-reply"' +
                '                  data-id="' + v.id_comment + '" data-bs-toggle="modal" data-bs-target="#balasanModal">' +
                '                <i class="fas fa-reply"></i> <b>Balas</b></span>' +
                '<span class="btn btn-sm text-muted" onclick="hapusKomentar(' + v.id_comment + ')" data-id="' + v.id_comment + '"><i class="fa fa-trash me-1"></i> Hapus</span>' +
                '</div>' +
                '<div id="collapse-reply' + v.id_comment + '" class="p-2 collapse toggle-reply" data-id="' + v.id_comment + '" data-parent="#parent-reply' + v.id_comment + '">';
            if (v.jml != '0') {
                comm += '<div id="konten-reply' + v.id_comment + '"></div>' +
                    '<div id="loadmore-reply' + v.id_comment + '" onclick="getReplies(' + v.id_comment + ')" class="text-center mb-3 loadmore-reply">' +
                    '       <div class="btn btn-light border">Muat balasan lainnya ...</div>' +
                    '</div>';
            }
            comm += '    <div id="loading-reply' + v.id_comment + '" class="text-center d-none">' +
                '        <div class="spinner-grow"></div>' +
                '    </div>' +
                '</div>' +
                '    </div>' +
                '</div>';
        });

        if (append) {
            $(`#konten${id}`).append(comm);
        } else {
            $(`#konten${id}`).prepend(comm);
        }

        $('.toggle-reply').on('shown.bs.collapse', function (e) {
            var konten = $(this);
            var id = konten.data('id');
            var list = $(this).find('.media').length;
            if (list === 0) $(`#loadmore-reply${id}`).click();
        });
    }

    function addReplies(id, replies, append) {
        if (!replies) return;
        if (!Array.isArray(replies)) replies = [replies];
        console.log('replies', replies);
        var repl = '';
        $.each(replies, function (i, v) {
            var sudahAda = $(`.media${v.id_reply}`).length;
            if (!sudahAda) {
                var dari = v.dari_group == '1' ? 'Admin' : (v.dari_group == '2' ? v.nama_guru : v.nama_siswa);
                var foto = v.dari_group == '2' ? (v.foto != null ? base_url + v.foto : base_url + 'assets/img/siswa.png') :
                    (v.foto_siswa != null ? base_url + v.foto_siswa : base_url + 'assets/img/siswa.png');
                var avatar = v.dari == '0' ? '<div class="btn-circle-sm btn-success shadow-sm media-left pt-1 me-2" style="width: 37px">A</div>' : '<img class="img-circle me-2 border" src="' + foto + '" alt="Img" width="35px" height="35px">';
                repl +=
                    '<div class="media mt-1 media' + v.id_reply + '">'
                    + avatar +
                    '    <div class="w-100">' +
                    '        <div class="media-body border ps-3" style="border-radius: 17px; background-color: #dee2e6">' +
                    '            <span class="text-xs text-muted"><b>' + dari + '</b></span>' +
                    '            <div class="comment-text">' + v.text +
                    '            </div>' +
                    '        </div>' +
                    '        <div class="ms-2">' +
                    '            <small class="btn-sm me-2 text-muted">' + createTime(v.tanggal) + '</small>' +
                    '            <span class="btn btn-sm text-muted" onclick="hapusReply(' + v.id_reply + ')" data-id="' + v.id_reply + '">' +
                    '                <i class="fa fa-trash me-1"></i> Hapus' +
                    '            </span>' +
                    '        </div>' +
                    '    </div>' +
                    '</div>';
            }
        });

        if (append) {
            $(`#konten-reply${id}`).append(repl);
        } else {
            $(`#konten-reply${id}`).prepend(repl);
        }
        console.log('added', 'reply' + id);
    }

    function getComments(id) {
        //console.log("url", base_url + "pengumuman/getcomment/" + id + "/" + page);
        $(`#loading${id}`).removeClass('d-none');
        $(`#loadmore${id}`).addClass('d-none');
        var $count = $(`#loadmore${id}`), page = $count.data('count');
        if (!page) page = 0;

        setTimeout(function () {
            $.ajax({
                url: base_url + "pengumuman/getcomment/" + id + "/" + page,
                type: "GET",
                success: function (response) {
                    //console.log('page', page);
                    console.log("result", response);
                    page += 1;
                    currentPage = page;
                    $count.data('count', page);

                    if (response.length === 5) {
                        $(`#loadmore${id}`).removeClass('d-none');
                    }
                    $(`#loading${id}`).addClass('d-none');
                    addComments(id, response, true)
                }, error: function (xhr, status, error) {
                    console.log("error", xhr.responseText);
                }
            });
        }, 500);
    }

    function getReplies(id) {
        $(`#loading-reply${id}`).removeClass('d-none');
        $(`#loadmore-reply${id}`).addClass('d-none');
        var $count = $(`#loadmore-reply${id}`), page = $count.data('count');
        if (!page) page = 0;

        setTimeout(function () {
            $.ajax({
                url: base_url + "pengumuman/getreplies/" + id + "/" + page,
                type: "GET",
                success: function (response) {
                    //console.log('page', page);
                    console.log("result", response);
                    page += 1;
                    currentPage = page;
                    $count.data('count', page);

                    //n >= start && n <= end
                    if (response.length === 5) {
                        $(`#loadmore-reply${id}`).removeClass('d-none');
                    }
                    $(`#loading-reply${id}`).addClass('d-none');
                    addReplies(id, response, true)
                }, error: function (xhr, status, error) {
                    console.log("error", xhr.responseText);
                }
            });
        }, 500);
    }

    function hapusPost(idPost) {
        swal.fire({
            title: "Hapus Pengumuman",
            text: "Pengumuman ini akan dihapus",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "HAPUS"
        }).then(result => {
            if (result.value) {
                swal.fire({
                    text: "Silahkan tunggu....",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });
                $.ajax({
                    url: base_url + "pengumuman/hapuspost/" + idPost,
                    type: "GET",
                    success: function (data) {
                        console.log("result", data);
                        if (data) {
                            swal.fire({
                                title: "Sukses",
                                text: "Pengumuman dihapus",
                                icon: "success",
                                showCancelButton: false,
                            }).then(result => {
                                if (result.value) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            swal.fire({
                                title: "ERROR",
                                text: "Pengumuman tidak dihapus",
                                icon: "error",
                                showCancelButton: false,
                            });
                        }
                    }, error: function (xhr, status, error) {
                        console.log("error", xhr.responseText);
                        const err = JSON.parse(xhr.responseText)
                        swal.fire({
                            title: "Error",
                            text: err.Message,
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    function hapusKomentar(idKomentar) {
        swal.fire({
            title: "Hapus Komentar",
            text: "Komentar ini akan dihapus",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "HAPUS"
        }).then(result => {
            if (result.value) {
                swal.fire({
                    text: "Silahkan tunggu....",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });
                $.ajax({
                    url: base_url + "pengumuman/hapuskomentar/" + idKomentar,
                    type: "GET",
                    success: function (data) {
                        console.log("result", data);
                        if (data) {
                            swal.fire({
                                title: "Sukses",
                                text: "Komentar dihapus",
                                icon: "success",
                                showCancelButton: false,
                            }).then(result => {
                                if (result.value) {
                                }
                            });
                        } else {
                            swal.fire({
                                title: "ERROR",
                                text: "Komentar tidak dihapus",
                                icon: "error",
                                showCancelButton: false,
                            });
                        }
                    }, error: function (xhr, status, error) {
                        console.log("error", xhr.responseText);
                        const err = JSON.parse(xhr.responseText)
                        swal.fire({
                            title: "Error",
                            text: err.Message,
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    function hapusReply(idReply) {
        swal.fire({
            title: "Hapus Balasan",
            text: "Balasan ini akan dihapus",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "HAPUS"
        }).then(result => {
            if (result.value) {
                swal.fire({
                    text: "Silahkan tunggu....",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });
                $.ajax({
                    url: base_url + "pengumuman/hapusbalasan/" + idReply,
                    type: "GET",
                    success: function (data) {
                        console.log("result", data);
                        if (data) {
                            swal.fire({
                                title: "Sukses",
                                text: "Balasan dihapus",
                                icon: "success",
                                showCancelButton: false,
                            }).then(result => {
                                if (result.value) {
                                }
                            });
                        } else {
                            swal.fire({
                                title: "ERROR",
                                text: "Balasan tidak dihapus",
                                icon: "error",
                                showCancelButton: false,
                            });
                        }
                    }, error: function (xhr, status, error) {
                        console.log("error", xhr.responseText);
                        const err = JSON.parse(xhr.responseText)
                        swal.fire({
                            title: "Error",
                            text: err.Message,
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    /*
    function loadListText() {
        $.ajax({
            url: base_url + "pengumuman/getrunningtext",
            type: "GET",
            success: function (response) {
                console.log('page', response);
                createListText(response);
            }, error: function (xhr, status, error) {
                console.log("error", xhr.responseText);
            }
        });
    }
    */

    function createListText(data) {
        var html = '<table class="table w-100">';
        if (data.running_text.length > 0) {
            $.each(data.running_text, function (i, v) {
                html += '<tr> ' +
                    '<td>' + v.text + '</td>' +
                    '<td>' +
                    '<button class="btn btn-light border btn-circle-micro" data-id="' + v.id_text + '" onclick="edit(this)"><i class="fa fa-pencil"></i></button>' +
                    '<button class="btn btn-light border btn-circle-micro" data-id="' + v.id_text + '" onclick="hapusText(this)"><i class="fa fa-trash"></i></button>' +
                    '</td> ' +
                    '</tr>';
            });
        }
        html += '</table>';
        $('#list-text').html(html);
    }

    function hapusText(e) {
        var id = $(e).data('id');
        console.log(id);

        $.ajax({
            url: base_url + "pengumuman/hapusrunningtext/" + id,
            type: "GET",
            success: function (response) {
                console.log('page', response);
                if (!response) {
                    showDangerToast('Tidak bisa menghapus')
                } else {
                    loadListText()
                }
            }, error: function (xhr, status, error) {
                console.log("error", xhr.responseText);
                showDangerToast('Tidak bisa menghapus')
            }
        });
    }

    $(document).ready(function () {
        $('.editable').attr('contentEditable', true);
        console.log('guru', guru);
        $('.select2').select2({width: '100%', });

        $('#text-pengumuman').summernote({
            placeholder: 'Tulis Pengumuman',
            tabsize: 2,
            minHeight: 100,
        });

        $('.toggle-comment').on('shown.bs.collapse', function (e) {
            var konten = $(this);
            var id = konten.data('id');
            var list = $(this).find('.media').length;
            if (list === 0) $(`#loadmore${id}`).click();
        });

        $('#formpengumuman').submit('click', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            console.log("data:", $(this).serialize());

            swal.fire({
                text: "Silahkan tunggu....",
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: () => {
                    swal.showLoading();
                }
            });
            $.ajax({
                url: base_url + "pengumuman/save",
                type: "POST",
                dataType: "JSON",
                data: $(this).serialize(),
                success: function (data) {
                    console.log("result", data);
                    if (data) {
                        swal.fire({
                            title: "Sukses",
                            text: "Pengumuman berhasil disimpan",
                            icon: "success",
                            showCancelButton: false,
                        }).then(result => {
                            if (result.value) {
                                window.location.href = base_url + 'pengumuman';
                            }
                        });
                    } else {
                        swal.fire({
                            title: "ERROR",
                            text: "Pengumuman Tidak Tersimpan",
                            icon: "error",
                            showCancelButton: false,
                        });
                    }
                }, error: function (xhr, status, error) {
                    console.log("error", xhr.responseText);
                    const err = JSON.parse(xhr.responseText)
                    swal.fire({
                        title: "Error",
                        text: err.Message,
                        icon: "error"
                    });
                }
            });
        });

        $('#komentarModal').on('show.bs.modal', function (e) {
            var id = $(e.relatedTarget).data('id');
            $("#id-post").val(id);

            var isVisible = $(`#collapse-${id}`).hasClass('show');
            if (!isVisible) {
                $(`#trigger${id}`).click();
            }
        });

        $('#balasanModal').on('show.bs.modal', function (e) {
            var id = $(e.relatedTarget).data('id');
            $("#id-comment").val(id);

            var isVisible = $(`#collapse-reply${id}`).hasClass('show');
            if (!isVisible) {
                $(`#trigger-reply${id}`).click();
            }
        });

        $('#komentar').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            console.log("data", $(this).serialize());
            var id = $(this).find('input[name=id_post]').val();

            $.ajax({
                url: base_url + "pengumuman/savekomentar",
                data: $(this).serialize(),
                method: 'POST',
                dataType: "JSON",
                success: function (response) {
                    console.log("result", response);
                    $('#komentarModal').modal('hide');
                    $('#komentarModal').on('hidden', function () {
                        $(this).data('modal', null);
                    });
                    addComments(id, response, false)
                    //window.location.href = base_url + 'pengumuman';
                },
                error: function (xhr, status, error) {
                    $('#komentarModal').modal('hide');
                    $('#komentarModal').on('hidden', function () {
                        $(this).data('modal', null);
                    });
                    showDangerToast('Error, komentar tidak terkirim');
                }
            });
        });

        $('#balasan').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            console.log("data", $(this).serialize());
            var id = $(this).find('input[name=id_comment]').val();

            $.ajax({
                url: base_url + "pengumuman/savebalasan",
                data: $(this).serialize(),
                method: 'POST',
                dataType: "JSON",
                success: function (response) {
                    console.log("result", response);
                    $('#balasanModal').modal('hide');
                    $('#balasanModal').on('hidden', function () {
                        $(this).data('modal', null);
                    });
                    //window.location.href = base_url + 'pengumuman';
                    addReplies(id, response, false)
                },
                error: function (xhr, status, error) {
                    $('#balasanModal').modal('hide');
                    $('#balasanModal').on('hidden', function () {
                        $(this).data('modal', null);
                    });
                    showDangerToast('Error, balasan tidak terkirim');
                }
            });
        });

        $('#formrunningtext').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var no = 1;
            var jsonObj = [];
            const $rows = $('#tb-text').find('tr');
            $rows.each((i, row) => {
                var id_text = no;
                const text = $(row).find('.editable').text();

                let item = {};
                item ["id_text"] = no;
                item ["text"] = text;
                jsonObj.push(item);
                no++;
            });

            var dataPost = $(this).serialize() + "&text=" + JSON.stringify(jsonObj);
            console.log(dataPost);

            $.ajax({
                url: base_url + "pengumuman/saverunningtext",
                type: "POST",
                data: dataPost,
                success: function (response) {
                    console.log('updates', response);
                    if (response && (response.status === true || response.success === true || (Array.isArray(response.status) && response.status[0]))) {
                        showSuccessToast('Running text berhasil disimpan');
                        setTimeout(function () {
                            window.location.reload();
                        }, 800);
                    } else {
                        showDangerToast(response && response.message ? response.message : 'Tidak bisa menyimpan');
                    }
                }, error: function (xhr, status, error) {
                    console.log("error", xhr.responseText);
                    showDangerToast('Error, Tidak bisa menyimpan')
                }
            });
        });

    })
</script>
<?= $this->endSection() ?>

