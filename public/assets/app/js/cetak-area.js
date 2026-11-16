// Create a jquery plugin that prints the given element (Original CI3 logic).
jQuery.fn.print = function(docTitle){
	var strFrameName = ("printer-" + (new Date()).getTime());

	var jFrame = $( "<iframe name='" + strFrameName + "'>" );

	jFrame
		.css( "width", "1px" )
		.css( "height", "1px" )
		.css( "position", "absolute" )
		.css( "left", "-9999px" )
		.appendTo( $( "body:first" ) )
	;

	var objFrame = jFrame[0].contentWindow;
	var objDoc = objFrame.document;

	var jStyleDiv = $( "<div>" ).append(
		$( "link[rel='stylesheet']" ).clone(),
		$( "style" ).clone()
	);

	var defaultPrintCss = "<style>" +
		"@page { size: A4 portrait; margin: 0mm; }" +
		".text-center, td.text-center, th.text-center, table td.text-center, table th.text-center { text-align: center !important; }" +
		".text-right, .text-end, td.text-right, th.text-right { text-align: right !important; }" +
		".text-left, .text-start, td.text-left, th.text-left { text-align: left !important; }" +
		".text-justify, td.text-justify { text-align: justify !important; }" +
		".fw-bold, b, strong { font-weight: bold !important; }" +
		"*, *::before, *::after { font-family: 'Times New Roman', Times, serif !important; }" +
		"table th, table td { white-space: normal !important; font-family: 'Times New Roman', Times, serif !important; }" +
		"@media print { " +
		"  @page { size: A4 portrait; margin: 0mm; }" +
		"  *, *::before, *::after { box-sizing: border-box !important; font-family: 'Times New Roman', Times, serif !important; }" +
		"  html, body { width: 100% !important; min-width: 0 !important; margin: 0 !important; padding: 0 !important; background: #fff !important; font-family: 'Times New Roman', Times, serif !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }" +
		"  body, table, th, td, div, span, p, b, strong, u { font-family: 'Times New Roman', Times, serif !important; }" +
		"  body { min-width: 0 !important; width: 100% !important; }" +
		"  .print-card-wrapper, .border, .my-shadow, .p-4, .p-5, .pt-4, .m-4, .m-2 { border: none !important; box-shadow: none !important; padding: 0 !important; margin: 0 !important; background: transparent !important; }" +
		"  .page-print { width: 100% !important; max-width: 100% !important; min-height: auto !important; height: auto !important; margin: 0 auto !important; padding: 8mm 8mm 6mm 8mm !important; box-sizing: border-box !important; font-family: 'Times New Roman', Times, serif !important; background: #fff !important; }" +
		"  table { width: 100% !important; max-width: 100% !important; table-layout: fixed !important; border-collapse: collapse !important; font-family: 'Times New Roman', Times, serif !important; box-sizing: border-box !important; }" +
		"  thead { display: table-header-group !important; }" +
		"  tfoot { display: table-footer-group !important; }" +
		"  tr { page-break-inside: avoid !important; break-inside: avoid !important; }" +
		"  tbody.group-tgl { page-break-inside: avoid !important; break-inside: avoid !important; }" +
		"  table.tbl-pengawas { width: 100% !important; max-width: 100% !important; table-layout: fixed !important; border-collapse: collapse !important; }" +
		"  table.tbl-pengawas tbody.group-tgl { page-break-inside: avoid !important; break-inside: avoid !important; }" +
		"  table.tbl-pengawas tr { page-break-inside: avoid !important; break-inside: avoid !important; }" +
		"  table.tbl-pengawas th { border: 1px solid black !important; vertical-align: middle !important; height: 28px !important; padding: 4px 3px !important; font-size: 10pt !important; text-align: center !important; font-weight: bold !important; white-space: normal !important; font-family: 'Times New Roman', Times, serif !important; }" +
		"  table.tbl-pengawas td { border: 1px solid black !important; vertical-align: middle !important; padding: 3px 5px !important; font-size: 9.5pt !important; line-height: 1.2 !important; box-sizing: border-box !important; white-space: normal !important; word-wrap: break-word !important; word-break: break-word !important; overflow-wrap: break-word !important; font-family: 'Times New Roman', Times, serif !important; }" +
		"  table.tbl-pengawas .col-hari { width: 18% !important; text-align: center !important; }" +
		"  table.tbl-pengawas .col-sesi { width: 14% !important; text-align: center !important; }" +
		"  table.tbl-pengawas .col-jam { width: 8% !important; text-align: center !important; }" +
		"  table.tbl-pengawas .col-mapel { width: 32% !important; text-align: left !important; padding-left: 6px !important; padding-right: 6px !important; white-space: normal !important; word-wrap: break-word !important; overflow-wrap: break-word !important; }" +
		"  table.tbl-pengawas .col-pengawas { width: 28% !important; text-align: center !important; white-space: normal !important; word-wrap: break-word !important; overflow-wrap: break-word !important; }" +
		"  table.table-absen { width: 100% !important; table-layout: fixed !important; border-collapse: collapse !important; }" +
		"  table.table-absen th, table.table-absen td { border: 1px solid black !important; vertical-align: middle !important; box-sizing: border-box !important; font-family: 'Times New Roman', Times, serif !important; }" +
		"  table.table-absen .col-no { width: 35px !important; text-align: center !important; }" +
		"  table.table-absen .col-nopes { width: 135px !important; text-align: center !important; white-space: nowrap !important; }" +
		"  table.table-absen .col-nama { width: auto !important; text-align: left !important; padding-left: 6px !important; padding-right: 6px !important; }" +
		"  table.table-absen .col-kelas { width: 55px !important; text-align: center !important; }" +
		"  table.table-absen .col-ttd-1 { width: 50px !important; text-align: left !important; border-left: 1px solid black !important; border-right: none !important; border-top: none !important; border-bottom: 1px solid black !important; }" +
		"  table.table-absen .col-ttd-2 { width: 80px !important; text-align: left !important; border-left: none !important; border-right: 1px solid black !important; border-top: none !important; border-bottom: 1px solid black !important; }" +
		"  table.table-absen .col-ket { width: 45px !important; text-align: center !important; }" +
		"  table.table-siswa:not(.table-absen) { width: 100% !important; table-layout: fixed !important; border-collapse: collapse !important; }" +
		"  table.table-siswa:not(.table-absen) th { border: 1px solid black !important; vertical-align: middle !important; box-sizing: border-box !important; font-size: 9.5pt !important; padding: 4px 4px !important; height: 26px !important; background: transparent !important; white-space: normal !important; font-family: 'Times New Roman', Times, serif !important; }" +
		"  table.table-siswa:not(.table-absen) td { border: 1px solid black !important; vertical-align: middle !important; box-sizing: border-box !important; font-size: 9.5pt !important; padding: 2px 5px !important; line-height: 1.15 !important; height: auto !important; white-space: normal !important; word-wrap: break-word !important; overflow-wrap: break-word !important; font-family: 'Times New Roman', Times, serif !important; }" +
		"  table.table-siswa:not(.table-absen) .col-no { width: 5% !important; text-align: center !important; }" +
		"  table.table-siswa:not(.table-absen) .col-nopes { width: 18% !important; text-align: center !important; white-space: nowrap !important; }" +
		"  table.table-siswa:not(.table-absen) .col-nama { width: 41% !important; text-align: left !important; padding-left: 6px !important; padding-right: 6px !important; }" +
		"  table.table-siswa:not(.table-absen) .col-kelas { width: 12% !important; text-align: center !important; }" +
		"  table.table-siswa:not(.table-absen) .col-ruang { width: 11% !important; text-align: center !important; }" +
		"  table.table-siswa:not(.table-absen) .col-sesi { width: 13% !important; text-align: center !important; white-space: normal !important; word-wrap: break-word !important; overflow-wrap: break-word !important; }" +
		"  table.table-berita-info { width: 100% !important; table-layout: fixed !important; border-collapse: collapse !important; font-family: 'Times New Roman', Times, serif !important; }" +
		"  table.table-berita-info td { vertical-align: top !important; white-space: normal !important; font-family: 'Times New Roman', Times, serif !important; }" +
		"  table.table-berita-ttd { width: 100% !important; table-layout: fixed !important; border-collapse: collapse !important; margin-top: 15px !important; font-family: 'Times New Roman', Times, serif !important; }" +
		"  table.table-berita-ttd th, table.table-berita-ttd td { white-space: normal !important; font-family: 'Times New Roman', Times, serif !important; }" +
		"  table.table-info { width: 100% !important; border-collapse: collapse !important; font-family: 'Times New Roman', Times, serif !important; }" +
		"  table.table-info td { white-space: normal !important; font-family: 'Times New Roman', Times, serif !important; }" +
		"  .judul-daftar-hadir, .judul-daftar-hadir div, .judul-dokumen, .judul-dokumen div { font-family: 'Times New Roman', Times, serif !important; font-weight: bold !important; text-align: center !important; }" +
		"  img.kop-img { width: 100% !important; max-width: 100% !important; display: block !important; margin: 0 auto !important; padding: 0 !important; }" +
		"  .rapor-kurmer-sheet { width: 210mm !important; min-height: 297mm !important; height: 297mm !important; max-height: 297mm !important; padding: 1.1cm 1.8cm 1.0cm 1.8cm !important; box-sizing: border-box !important; page-break-after: always !important; break-after: page !important; background: #fff !important; font-family: Arial, Helvetica, sans-serif !important; position: relative !important; overflow: hidden !important; margin: 0 auto !important; }" +
		"  .rapor-kurmer-sheet * { font-family: Arial, Helvetica, sans-serif !important; }" +
		"}" +
		"</style>";

	var isKartu = this.hasClass("kartu-cetak-card") || this.find(".kartu-cetak-card").length > 0;
	if (isKartu) {
		var jStyleDiv = $( "<div>" ).append(
			$( "style" ).clone()
		);

		objDoc.open();
		objDoc.write( "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">" );
		objDoc.write( "<html>" );
		objDoc.write( "<head>" );
		objDoc.write( "<title>" );
		objDoc.write( docTitle || document.title );
		objDoc.write( "</title>" );
		objDoc.write( "</head>" );
		objDoc.write( "<body style='margin:0;padding:0;background:#fff;-webkit-print-color-adjust:exact;print-color-adjust:exact;'>" );
		objDoc.write( jStyleDiv.html() );
		objDoc.write( this.html() );
		objDoc.write( "</body>" );
		objDoc.write( "</html>" );
		objDoc.close();

		function doPrintKartu() {
			try {
				objFrame.focus();
				objFrame.print();
			} catch (e) {
				console.error("Print error:", e);
			}
		}

		var images = objDoc.images;
		if (!images || images.length === 0) {
			setTimeout(doPrintKartu, 250);
		} else {
			var pending = images.length;
			var timer = setTimeout(doPrintKartu, 2000);

			function onImgDone() {
				pending--;
				if (pending <= 0) {
					clearTimeout(timer);
					setTimeout(doPrintKartu, 150);
				}
			}

			for (var i = 0; i < images.length; i++) {
				if (images[i].complete) {
					onImgDone();
				} else {
					images[i].onload = onImgDone;
					images[i].onerror = onImgDone;
				}
			}
		}

		setTimeout(
			function(){
				jFrame.remove();
			},
			(60 * 1000)
		);
		return;
	}

	var isRaporPage = this.hasClass("rapor-page") || this.find(".rapor-page").length > 0;
	var isKurmerSheet = this.hasClass("rapor-kurmer-sheet") || this.find(".rapor-kurmer-sheet").length > 0;
	var isPagePrint = this.hasClass("page-print") || this.find(".page-print").length > 0;
	var isPrintCard = this.hasClass("print-card-wrapper") || this.find(".print-card-wrapper").length > 0;

	if (isRaporPage) {
		var isRaporLandscape = this.hasClass("rapor-page-landscape") || this.find(".rapor-page-landscape").length > 0;
		var pageSize = isRaporLandscape ? "A4 landscape" : "A4 portrait";
		var pageW = isRaporLandscape ? "297mm" : "210mm";
		var pageMinH = isRaporLandscape ? "205mm" : "297mm";
		var pagePad = isRaporLandscape ? "8mm 12mm 10mm 12mm" : "8mm 15mm 16mm 15mm";
		var footerL = isRaporLandscape ? "12mm" : "15mm";
		var footerR = isRaporLandscape ? "12mm" : "15mm";

		defaultPrintCss = "<style>" +
			"@page { size: " + pageSize + "; margin: 0mm; }" +
			".text-center, td.text-center, th.text-center, .rapor-page .text-center, table td.text-center, table th.text-center, .tbl-nilai td.text-center, .tbl-nilai th.text-center { text-align: center !important; }" +
			".text-right, .text-end, td.text-right, th.text-right, .rapor-page .text-right, .rapor-page .text-end { text-align: right !important; }" +
			".text-left, .text-start, td.text-left, th.text-left, .rapor-page .text-left, .rapor-page .text-start { text-align: left !important; }" +
			".text-justify, td.text-justify, .rapor-page .text-justify { text-align: justify !important; }" +
			".fw-bold, b, strong, .rapor-page .fw-bold { font-weight: bold !important; }" +
			"@media print { " +
			"  @page { size: " + pageSize + "; margin: 0mm; }" +
			"  *, *::before, *::after { box-sizing: border-box !important; }" +
			"  html, body { width: " + pageW + " !important; min-width: " + pageW + " !important; margin: 0 auto !important; padding: 0 !important; background: #fff !important; font-family: Arial, Helvetica, sans-serif !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }" +
			"  body { min-width: " + pageW + " !important; width: " + pageW + " !important; }" +
			"  .rapor-page { width: " + pageW + " !important; max-width: " + pageW + " !important; min-width: " + pageW + " !important; min-height: " + pageMinH + " !important; margin: 0 auto !important; padding: " + pagePad + " !important; box-sizing: border-box !important; page-break-after: always !important; break-after: page !important; position: relative !important; background-color: #fff !important; font-family: Arial, Helvetica, sans-serif !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }" +
			"  .rapor-page * { box-sizing: border-box !important; }" +
			"  .rapor-page table { width: 100% !important; max-width: 100% !important; border-collapse: collapse !important; box-sizing: border-box !important; font-family: Arial, Helvetica, sans-serif !important; }" +
			"  .rapor-page th, .rapor-page td { font-family: Arial, Helvetica, sans-serif !important; }" +
			"  .text-center, td.text-center, th.text-center, .rapor-page .text-center, table td.text-center, table th.text-center, .tbl-nilai td.text-center, .tbl-nilai th.text-center { text-align: center !important; }" +
			"  .text-right, .text-end, td.text-right, th.text-right, .rapor-page .text-right, .rapor-page .text-end { text-align: right !important; }" +
			"  .text-left, .text-start, td.text-left, th.text-left, .rapor-page .text-left, .rapor-page .text-start { text-align: left !important; }" +
			"  .text-justify, td.text-justify, .rapor-page .text-justify { text-align: justify !important; }" +
			"  .fw-bold, b, strong, .rapor-page .fw-bold { font-weight: bold !important; }" +
			"  .rapor-page.rapor-page-sampul { padding: 5mm 8mm !important; height: 275mm !important; max-height: 275mm !important; min-height: auto !important; overflow: hidden !important; }" +
			"  .rapor-footer-bottom { position: absolute !important; bottom: 5mm !important; left: " + footerL + " !important; right: " + footerR + " !important; display: flex !important; justify-content: space-between !important; align-items: center !important; font-size: 8pt !important; color: #555 !important; line-height: 1 !important; z-index: 10 !important; }" +
			"}" +
			"</style>";
	}

	var printHtml = "";
	if (this.hasClass("page-print") || this.hasClass("print-card-wrapper") || this.hasClass("rapor-page") || this.hasClass("rapor-kurmer-sheet")) {
		printHtml = this.prop('outerHTML');
	} else if (isRaporPage || isKurmerSheet || isPagePrint || isPrintCard) {
		printHtml = this.html();
	} else {
		printHtml = '<div class="page-print" style="font-family: \'Times New Roman\', serif; width: 100%; max-width: 195mm; margin: 0 auto; box-sizing: border-box; padding: 0 5px;">' + this.html() + '</div>';
	}

	objDoc.open();
	objDoc.write( "<!DOCTYPE html>" );
	objDoc.write( "<html>" );
	objDoc.write( "<head>" );
	objDoc.write( "<title>" + (docTitle || "") + "</title>" );
	objDoc.write( jStyleDiv.html() );
	objDoc.write( defaultPrintCss );
	objDoc.write( "</head>" );
	objDoc.write( "<body style='margin:0;padding:0;background:#fff;'>" );
	objDoc.write( printHtml );
	objDoc.write( "</body>" );
	objDoc.write( "</html>" );
	objDoc.close();

	function doPrint() {
		try {
			objFrame.focus();
			objFrame.print();
		} catch (e) {
			console.error("Print error:", e);
		}
	}

	var images = objDoc.images;
	if (!images || images.length === 0) {
		setTimeout(doPrint, 250);
	} else {
		var pending = images.length;
		var timer = setTimeout(doPrint, 2000);

		function onImgDone() {
			pending--;
			if (pending <= 0) {
				clearTimeout(timer);
				setTimeout(doPrint, 150);
			}
		}

		for (var i = 0; i < images.length; i++) {
			if (images[i].complete) {
				onImgDone();
			} else {
				images[i].onload = onImgDone;
				images[i].onerror = onImgDone;
			}
		}
	}

	setTimeout(
		function(){
			jFrame.remove();
		},
		(60 * 1000)
	);
};
