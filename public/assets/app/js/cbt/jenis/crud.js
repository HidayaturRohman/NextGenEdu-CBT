var table;

$(document).ready(function () {
	ajaxcsrf();

	table = $("#jenis").DataTable({
		initComplete: function () {
			var api = this.api();
			$("#jenis_filter input")
				.off(".DT")
				.on("keyup.DT", function (e) {
					api.search(this.value).draw();
				});
		},
		dom:
			"<'row'<'col-sm-6'l><'col-sm-6'f>>" +
			"<'row'<'toolbar'lfrtip>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-5'i><'col-sm-7'p>>",
		oLanguage: {
			sProcessing: "loading..."
		},
		processing: true,
		serverSide: false,
		ajax: {
			url: base_url + "cbtjenis/data",
			type: "POST"
			//data: csrf
		},
		columns: [
			{
				data: "id_jenis",
				className: "text-center align-middle",
				orderable: false,
				searchable: false
			},
			{
				data: "id_jenis",
				className: "text-center align-middle",
				orderable: false,
				searchable: false
			},
			{
				data: "nama_jenis",
				className: "align-middle",
			},
			{
				data: "kode_jenis",
				className: "text-center align-middle",
			},
			{
				data: "kategori",
				className: "text-center align-middle",
			},
			{
				data: null,
				className: "text-center align-middle",
				orderable: false,
				searchable: false
			}
		],
		columnDefs: [
			{
				targets: 4,
				data: "kategori",
				render: function (data, type, row, meta) {
					var kat = (data || "lainnya").toString().toLowerCase();
					var map = {
						sts: {
							label: "Tengah Semester (STS / PTS)",
							style: "background-color:#e0e7ff;color:#1e40af;border:1px solid #c7d2fe;"
						},
						sas: {
							label: "Akhir Semester (SAS / PAS / PAT)",
							style: "background-color:#dcfce7;color:#166534;border:1px solid #bbf7d0;"
						},
						ph: {
							label: "Penilaian Harian (PH)",
							style: "background-color:#e0f2fe;color:#0369a1;border:1px solid #bae6fd;"
						},
						lainnya: {
							label: "Lainnya (TO / Simulasi)",
							style: "background-color:#f1f5f9;color:#334155;border:1px solid #cbd5e1;"
						}
					};
					var cfg = map[kat] || map.lainnya;
					return `<span class="badge rounded-pill px-3 py-2 fw-semibold" style="${cfg.style}">${cfg.label}</span>`;
				}
			},
			{
				searchable: false,
				targets: 5,
				data: null,
				render: function (data, type, row, meta) {
					var id = String(row.id_jenis ?? "").replace(/"/g, "&quot;");
					var nama = String(row.nama_jenis ?? "").replace(/"/g, "&quot;");
					var kode = String(row.kode_jenis ?? "").replace(/"/g, "&quot;");
					var kategori = String(row.kategori ?? "lainnya").replace(/"/g, "&quot;");
					return `<div class="d-flex justify-content-center gap-2">
									<a class="btn btn-icon btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editJenisModal" data-id="${id}" data-nama="${nama}" data-kode="${kode}" data-kategori="${kategori}" title="Edit"><svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
								</div>`;
				}
			},
			{
				targets: 0,
				data: "id_jenis",
				render: function (data, type, row, meta) {
					return `<div class="text-center align-middle">
									<input name="checked[]" class="check" value="${data}" type="checkbox">
								</div>`;
				}
			}
		],
		order: [[1, "asc"]],
		rowId: function (a) {
			return a;
		},
		rowCallback: function (row, data, iDisplayIndex) {
			var index = iDisplayIndex + 1;
			if (typeof this.fnPagingInfo === 'function') {
				var info = this.fnPagingInfo();
				if (info) {
					index = info.iPage * info.iLength + (iDisplayIndex + 1);
				}
			}
			$("td:eq(1)", row).html(index);
		}
	});

	table
		.buttons()
		.container()
		.appendTo("#jenis_wrapper .col-md-6:eq(1)");

	$("div.toolbar").html(
		'<button id="hapusterpilih" onclick="bulk_delete()" type="button" class="btn btn-danger" data-bs-toggle="tooltip" title="Hapus Terpilh" disabled="disabled">' +
		'<svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>'
		/*
		'<div class="btn-group">' +
		'<button type="button" class="btn btn-default" data-bs-toggle="tooltip" title="Print"><i class="fas fa-print"></i></button>' +
		'<button type="button" class="btn btn-default" data-bs-toggle="tooltip" title="Export As PDF"><i class="fas fa-file-pdf"></i></button>' +
		'<button type="button" class="btn btn-default" data-bs-toggle="tooltip" title="Export As Word"><i class="fa fa-file-word"></i></button>' +
		'<button type="button" class="btn btn-default" data-bs-toggle="tooltip" title="Export As Excel"><i class="fa fa-file-excel"></i></button>' +
		'</div>'
		*/
	);

	$(".select_all").on("click", function () {
		if (this.checked) {
			$(".check").each(function () {
				this.checked = true;
				$(".select_all").prop("checked", true);
				$('#hapusterpilih').removeAttr('disabled');
			});
		} else {
			$(".check").each(function () {
				this.checked = false;
				$(".select_all").prop("checked", false);
				$('#hapusterpilih').attr('disabled','disabled');
			});
		}
	});

	$("#jenis tbody").on("click", "tr .check", function () {
		var check = $("#jenis tbody tr .check").length;
		var checked = $("#jenis tbody tr .check:checked").length;
		if (check === checked) {
			$(".select_all").prop("checked", true);
		} else {
			$(".select_all").prop("checked", false);
		}

		if (checked === 0) {
            $('#hapusterpilih').attr('disabled','disabled');
		} else {
            $('#hapusterpilih').removeAttr('disabled');
		}
	});

	$('#create').on('submit', function (e) {
		e.preventDefault();
		e.stopImmediatePropagation();
		console.log("data:", $(this).serialize());

		$.ajax({
			url: base_url + "cbtjenis/add",
			type: "POST",
			dataType: "JSON",
			data: $(this).serialize(),
			success: function (data) {
				console.log("result", data);
				$('#createJenisModal').modal('hide');
				$('#createJenisModal').on('hidden', function () {
					$(this).data('modal', null);  // destroys modal
				});
				showSuccessToast('Data berhasil disimpan.');
				table.ajax.reload();
			}, error: function (xhr, status, error) {
				$('#createJenisModal').modal('hide');
				$('#createJenisModal').on('hidden', function () {
					$(this).data('modal', null);  // destroys modal
				});
				console.log("error", xhr.responseText);
				showDangerToast('Error');
			}
		});
	});

	$('#editJenisModal').on('show.bs.modal', function (e) {
		var id = $(e.relatedTarget).data('id');
		var nama = $(e.relatedTarget).data('nama');
		var kode = $(e.relatedTarget).data('kode');
		var kategori = $(e.relatedTarget).data('kategori') || 'lainnya';

		$(e.currentTarget).find('input[id="namaEdit"]').val(nama);
		$(e.currentTarget).find('input[id="kodeEdit"]').val(kode);
		$(e.currentTarget).find('select[id="kategoriEdit"]').val(kategori);
		$(e.currentTarget).find('input[id="editIdJenis"]').val(id);

		var attrId = document.getElementById("editIdJenis");
		attrId.setAttribute("name", "id_jenis");

		var attrNama = document.getElementById("namaEdit");
		attrNama.setAttribute("name", "nama_jenis");

		var attrKode = document.getElementById("kodeEdit");
		attrKode.setAttribute("name", "kode_jenis");
	});

	$('#update').on('submit', function (e) {
		e.preventDefault();
		e.stopImmediatePropagation();

		var btn = $('#submit');
		btn.attr('disabled', 'disabled').text('Wait...');

		console.log("data", $(this).serialize());

		$.ajax({
			url: base_url + "cbtjenis/update",
			data: $(this).serialize(),
			method: 'POST',
			dataType: "JSON",
			success: function (data) {
				$('#editJenisModal').modal('hide');
				$('#editJenisModal').on('hidden', function () {
					$(this).data('modal', null);  // destroys modal
				});
				showSuccessToast('Data berhasil diupdate.');
				table.ajax.reload();
			},
			error: function (xhr, status, error) {
				$('#editJenisModal').modal('hide');
				$('#editJenisModal').on('hidden', function () {
					$(this).data('modal', null);  // destroys modal
				});
				showDangerToast("Error");
			}
		});
	});

	$("#bulk").on("submit", function (e) {
		e.preventDefault();
		e.stopImmediatePropagation();

		$.ajax({
			url: $(this).attr("action"),
			data: $(this).serialize(),
			type: "POST",
			success: function (respon) {
				$('#hapusterpilih').addClass('d-none');
				if (respon.status) {
					swal.fire({
						title: "Berhasil",
						text: respon.total + " data berhasil dihapus",
						icon: "success"
					});
				} else {
					swal.fire({
						title: "Gagal",
						text: "Tidak ada data yang dipilih",
						icon: "error"
					});
				}
				reload_ajax();
			},
			error: function () {
				$('#hapusterpilih').addClass('d-none');
				swal.fire({
					title: "Gagal",
					text: "Ada data yang sedang digunakan",
					icon: "error"
				});
			}
		});
	});
});

function bulk_delete() {
	if ($("#jenis tbody tr .check:checked").length == 0) {
		swal.fire({
			title: "Gagal",
			text: "Tidak ada data yang dipilih",
			icon: "error"
		});
	} else {
		swal.fire({
			title: "Anda yakin?",
			text: "Data akan dihapus!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Hapus!"
		}).then(result => {
			if (result.value) {
				$("#bulk").submit();
			}
		});
	}
}

