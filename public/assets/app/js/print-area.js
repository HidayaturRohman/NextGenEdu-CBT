// Enhanced jQuery.print plugin (HTML5 standard, stylesheet support, zero-margin, image-ready)
jQuery.fn.print = function(docTitle){
	var strFrameName = ("printer-" + (new Date()).getTime());

	var jFrame = $( "<iframe name='" + strFrameName + "' id='" + strFrameName + "'>" );

	jFrame
		.css( "width", "210mm" )
		.css( "height", "297mm" )
		.css( "position", "fixed" )
		.css( "top", "-9999px" )
		.css( "left", "-9999px" )
		.css( "border", "none" )
		.appendTo( $( "body:first" ) )
	;

	var objFrame = jFrame[0].contentWindow;
	var objDoc = objFrame.document;

	var linksHtml = '';
	$('link[rel="stylesheet"]').each(function() {
		var href = $(this).attr('href');
		if (href) {
			linksHtml += '<link rel="stylesheet" href="' + href + '">\n';
		}
	});

	var styleHtml = '';
	$('style').each(function() {
		styleHtml += '<style>' + $(this).html() + '</style>\n';
	});

	objDoc.open();
	objDoc.write( "<!DOCTYPE html>" );
	objDoc.write( "<html>" );
	objDoc.write( "<head>" );
	objDoc.write( "<meta charset='utf-8'>" );
	objDoc.write( "<title>" + (docTitle || document.title) + "</title>" );
	objDoc.write( linksHtml );
	objDoc.write( styleHtml );
	objDoc.write( "<style>\n" +
		"@page { size: A4 portrait; margin: 0; }\n" +
		"html, body { width: 210mm !important; margin: 0 !important; padding: 0 !important; background: #fff !important; font-family: Arial, Helvetica, sans-serif !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }\n" +
		".rapor-page { box-shadow: none !important; margin: 0 auto !important; width: 210mm !important; max-width: 210mm !important; min-width: 210mm !important; height: 296mm !important; max-height: 296.5mm !important; min-height: 280mm !important; padding: 3.5mm 15mm 6mm 15mm !important; box-sizing: border-box !important; position: relative !important; overflow: hidden !important; page-break-after: always !important; break-after: page !important; page-break-inside: avoid !important; break-inside: avoid !important; background-color: #ffffff !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }\n" +
		".rapor-page:last-child { page-break-after: auto !important; break-after: auto !important; }\n" +
		".rapor-footer-bottom { bottom: 2mm !important; left: 15mm !important; right: 15mm !important; font-size: 8pt !important; }\n" +
		".rapor-page .tbl-header-kop { margin-bottom: 0 !important; }\n" +
		".rapor-page .tbl-header-kop td { padding: 0 4px !important; }\n" +
		".rapor-page .tbl-header-kop img { max-height: 70px !important; }\n" +
		".rapor-page .line-divider { margin: 2px 0 3px 0 !important; }\n" +
		".rapor-page .tbl-info td { padding: 2.5px 5px !important; line-height: 1.3 !important; font-size: 9.5pt !important; }\n" +
		".rapor-page .tbl-nilai th { padding: 5px 6px !important; font-size: 10pt !important; }\n" +
		".rapor-page .tbl-nilai td { padding: 3.5px 6px !important; font-size: 9.5pt !important; }\n" +
		"</style>\n" );
	objDoc.write( "</head>" );
	objDoc.write( "<body>" );
	objDoc.write( this.html() );
	objDoc.write( "</body>" );
	objDoc.write( "</html>" );
	objDoc.close();

	var triggerPrint = function() {
		try {
			objFrame.focus();
			objFrame.print();
		} catch (e) {
			console.error("Print error:", e);
		}
	};

	var images = objDoc.images;
	if (!images || images.length === 0) {
		setTimeout(triggerPrint, 200);
	} else {
		var total = images.length;
		var loaded = 0;
		var fallbackTimer = setTimeout(triggerPrint, 800);

		for (var i = 0; i < total; i++) {
			if (images[i].complete) {
				loaded++;
				if (loaded === total) {
					clearTimeout(fallbackTimer);
					setTimeout(triggerPrint, 150);
				}
			} else {
				images[i].onload = images[i].onerror = function() {
					loaded++;
					if (loaded === total) {
						clearTimeout(fallbackTimer);
						setTimeout(triggerPrint, 150);
					}
				};
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
