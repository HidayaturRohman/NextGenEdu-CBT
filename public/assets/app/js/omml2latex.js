/**
 * OMML (Office Math Markup Language) to LaTeX converter & Free-form Word Soal Parser
 * CBT Application
 */

var OmmlToLatex = (function() {

    function cleanMathText(text) {
        if (!text) return "";
        return text
            .replace(/[\u200B-\u200D\uFEFF]/g, '') // Zero-width spaces
            .replace(/×/g, '\\times ')
            .replace(/÷/g, '\\div ')
            .replace(/±/g, '\\pm ')
            .replace(/∓/g, '\\mp ')
            .replace(/·/g, '\\cdot ')
            .replace(/•/g, '\\bullet ')
            .replace(/≤/g, '\\le ')
            .replace(/≥/g, '\\ge ')
            .replace(/≠/g, '\\ne ')
            .replace(/≈/g, '\\approx ')
            .replace(/≡/g, '\\equiv ')
            .replace(/∞/g, '\\infty ')
            .replace(/°/g, '^\\circ ')
            .replace(/∠/g, '\\angle ')
            .replace(/⊥/g, '\\perp ')
            .replace(/△/g, '\\triangle ')
            .replace(/π/g, '\\pi ')
            .replace(/θ/g, '\\theta ')
            .replace(/α/g, '\\alpha ')
            .replace(/β/g, '\\beta ')
            .replace(/γ/g, '\\gamma ')
            .replace(/λ/g, '\\lambda ')
            .replace(/μ/g, '\\mu ')
            .replace(/σ/g, '\\sigma ')
            .replace(/ω/g, '\\omega ')
            .replace(/→/g, '\\to ');
    }

    function nodeToLatex(node) {
        if (!node) return "";
        if (node.nodeType === 3) { // Text node
            return cleanMathText(node.nodeValue || "");
        }
        if (node.nodeType !== 1) return ""; // Only element nodes

        var localName = node.localName || (node.nodeName ? node.nodeName.split(':').pop() : "");

        switch (localName) {
            case "oMathPara":
            case "oMath": {
                var res = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    res += nodeToLatex(node.childNodes[i]);
                }
                return res.trim();
            }
            case "r": { // Math run
                var text = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    var ch = node.childNodes[i];
                    var chName = ch.localName || (ch.nodeName ? ch.nodeName.split(':').pop() : "");
                    if (chName === "t") {
                        text += cleanMathText(ch.textContent || "");
                    }
                }
                return text;
            }
            case "f": { // Fraction \frac{num}{den}
                var num = "", den = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    var ch = node.childNodes[i];
                    var chName = ch.localName || (ch.nodeName ? ch.nodeName.split(':').pop() : "");
                    if (chName === "num") num = nodeToLatex(ch).trim();
                    else if (chName === "den") den = nodeToLatex(ch).trim();
                }
                return "\\frac{" + (num || "") + "}{" + (den || "") + "}";
            }
            case "num":
            case "den":
            case "e": { // Generic element container
                var res = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    res += nodeToLatex(node.childNodes[i]);
                }
                return res;
            }
            case "sSup": { // Superscript e^sup
                var base = "", sup = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    var ch = node.childNodes[i];
                    var chName = ch.localName || (ch.nodeName ? ch.nodeName.split(':').pop() : "");
                    if (chName === "e") base = nodeToLatex(ch).trim();
                    else if (chName === "sup") sup = nodeToLatex(ch).trim();
                }
                return "{" + base + "}^{" + sup + "}";
            }
            case "sSub": { // Subscript e_sub
                var base = "", sub = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    var ch = node.childNodes[i];
                    var chName = ch.localName || (ch.nodeName ? ch.nodeName.split(':').pop() : "");
                    if (chName === "e") base = nodeToLatex(ch).trim();
                    else if (chName === "sub") sub = nodeToLatex(ch).trim();
                }
                return "{" + base + "}_{" + sub + "}";
            }
            case "sSubSup": { // Sub and Super script e_sub^sup
                var base = "", sub = "", sup = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    var ch = node.childNodes[i];
                    var chName = ch.localName || (ch.nodeName ? ch.nodeName.split(':').pop() : "");
                    if (chName === "e") base = nodeToLatex(ch).trim();
                    else if (chName === "sub") sub = nodeToLatex(ch).trim();
                    else if (chName === "sup") sup = nodeToLatex(ch).trim();
                }
                return "{" + base + "}_{" + sub + "}^{" + sup + "}";
            }
            case "rad": { // Radical \sqrt[deg]{e}
                var deg = "", base = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    var ch = node.childNodes[i];
                    var chName = ch.localName || (ch.nodeName ? ch.nodeName.split(':').pop() : "");
                    if (chName === "deg") deg = nodeToLatex(ch).trim();
                    else if (chName === "e") base = nodeToLatex(ch).trim();
                }
                if (deg && deg !== "") {
                    return "\\sqrt[" + deg + "]{" + base + "}";
                }
                return "\\sqrt{" + base + "}";
            }
            case "d": { // Delimiter / Brackets
                var begChr = "(", endChr = ")", sepChr = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    var ch = node.childNodes[i];
                    var chName = ch.localName || (ch.nodeName ? ch.nodeName.split(':').pop() : "");
                    if (chName === "dPr") {
                        for (var j = 0; j < ch.childNodes.length; j++) {
                            var pr = ch.childNodes[j];
                            var prName = pr.localName || (pr.nodeName ? pr.nodeName.split(':').pop() : "");
                            var val = pr.getAttribute("m:val") || pr.getAttribute("val");
                            if (prName === "begChr" && val !== null) begChr = val;
                            if (prName === "endChr" && val !== null) endChr = val;
                            if (prName === "sepChr" && val !== null) sepChr = val;
                        }
                    }
                }
                var content = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    var ch = node.childNodes[i];
                    var chName = ch.localName || (ch.nodeName ? ch.nodeName.split(':').pop() : "");
                    if (chName === "e") {
                        if (content !== "" && sepChr) content += sepChr;
                        content += nodeToLatex(ch);
                    }
                }
                var leftDelim = begChr === "{" ? "\\{" : (begChr === "[" ? "[" : (begChr === "|" ? "|" : (begChr || ".")));
                var rightDelim = endChr === "}" ? "\\}" : (endChr === "]" ? "]" : (endChr === "|" ? "|" : (endChr || ".")));
                return "\\left" + leftDelim + " " + content.trim() + " \\right" + rightDelim;
            }
            case "func": { // Function: fName e
                var fName = "", expr = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    var ch = node.childNodes[i];
                    var chName = ch.localName || (ch.nodeName ? ch.nodeName.split(':').pop() : "");
                    if (chName === "fName") fName = nodeToLatex(ch).trim();
                    else if (chName === "e") expr = nodeToLatex(ch).trim();
                }
                return fName + " " + expr;
            }
            case "nary": { // Integral / Sum / Product
                var op = "\\sum", sub = "", sup = "", expr = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    var ch = node.childNodes[i];
                    var chName = ch.localName || (ch.nodeName ? ch.nodeName.split(':').pop() : "");
                    if (chName === "naryPr") {
                        for (var j = 0; j < ch.childNodes.length; j++) {
                            var pr = ch.childNodes[j];
                            var prName = pr.localName || (pr.nodeName ? pr.nodeName.split(':').pop() : "");
                            if (prName === "chr") {
                                var val = pr.getAttribute("m:val") || pr.getAttribute("val");
                                if (val === "∫") op = "\\int";
                                else if (val === "∑") op = "\\sum";
                                else if (val === "∏") op = "\\prod";
                                else if (val) op = val;
                            }
                        }
                    } else if (chName === "sub") sub = nodeToLatex(ch).trim();
                    else if (chName === "sup") sup = nodeToLatex(ch).trim();
                    else if (chName === "e") expr = nodeToLatex(ch).trim();
                }
                var res = op;
                if (sub) res += "_{" + sub + "}";
                if (sup) res += "^{" + sup + "}";
                return res + " " + expr;
            }
            case "bar": { // Overbar / Underbar
                var pos = "top", expr = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    var ch = node.childNodes[i];
                    var chName = ch.localName || (ch.nodeName ? ch.nodeName.split(':').pop() : "");
                    if (chName === "barPr") {
                        for (var j = 0; j < ch.childNodes.length; j++) {
                            var pr = ch.childNodes[j];
                            if ((pr.localName || pr.nodeName.split(':').pop()) === "pos") {
                                pos = pr.getAttribute("m:val") || pr.getAttribute("val") || "top";
                            }
                        }
                    } else if (chName === "e") expr = nodeToLatex(ch).trim();
                }
                return pos === "bot" ? "\\underline{" + expr + "}" : "\\overline{" + expr + "}";
            }
            case "acc": { // Accent
                var chr = "^", expr = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    var ch = node.childNodes[i];
                    var chName = ch.localName || (ch.nodeName ? ch.nodeName.split(':').pop() : "");
                    if (chName === "accPr") {
                        for (var j = 0; j < ch.childNodes.length; j++) {
                            var pr = ch.childNodes[j];
                            if ((pr.localName || pr.nodeName.split(':').pop()) === "chr") {
                                chr = pr.getAttribute("m:val") || pr.getAttribute("val") || "^";
                            }
                        }
                    } else if (chName === "e") expr = nodeToLatex(ch).trim();
                }
                if (chr === "→") return "\\vec{" + expr + "}";
                if (chr === "¯") return "\\bar{" + expr + "}";
                if (chr === "~") return "\\tilde{" + expr + "}";
                return "\\hat{" + expr + "}";
            }
            case "m": { // Matrix
                var rows = [];
                for (var i = 0; i < node.childNodes.length; i++) {
                    var ch = node.childNodes[i];
                    var chName = ch.localName || (ch.nodeName ? ch.nodeName.split(':').pop() : "");
                    if (chName === "mr") {
                        var cols = [];
                        for (var j = 0; j < ch.childNodes.length; j++) {
                            var colNode = ch.childNodes[j];
                            var colName = colNode.localName || (colNode.nodeName ? colNode.nodeName.split(':').pop() : "");
                            if (colName === "e") cols.push(nodeToLatex(colNode).trim());
                        }
                        rows.push(cols.join(" & "));
                    }
                }
                return "\\begin{matrix} " + rows.join(" \\\\ ") + " \\end{matrix}";
            }
            case "box":
            case "borderBox": {
                var res = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    res += nodeToLatex(node.childNodes[i]);
                }
                return res;
            }
            default: {
                var res = "";
                for (var i = 0; i < node.childNodes.length; i++) {
                    res += nodeToLatex(node.childNodes[i]);
                }
                return res;
            }
        }
    }

    /**
     * Pre-process Word document.xml:
     * Finds all <m:oMathPara> and <m:oMath> elements,
     * converts them into clean LaTeX, and wraps inside <w:r><w:t> \( ... \) </w:t></w:r>
     */
    function preprocessDocumentXml(documentXml) {
        if (!documentXml || (documentXml.indexOf('<m:oMath') === -1 && documentXml.indexOf('oMath') === -1)) {
            return documentXml;
        }

        try {
            var parser = new DOMParser();
            var xmlDoc = parser.parseFromString(documentXml, "text/xml");
            var parseError = xmlDoc.getElementsByTagName("parsererror");
            if (parseError.length > 0) {
                console.warn("XML parsererror while preprocessing OMML math:", parseError[0].textContent);
                return documentXml;
            }

            // Find all top-level math nodes: m:oMathPara or freestanding m:oMath
            // We search for both with and without prefix
            var mathParas = Array.prototype.slice.call(xmlDoc.getElementsByTagName("m:oMathPara"))
                .concat(Array.prototype.slice.call(xmlDoc.getElementsByTagName("oMathPara")));

            mathParas.forEach(function(para) {
                var latex = nodeToLatex(para);
                if (latex && latex.trim() !== "") {
                    latex = cleanLatexFormula(latex);
                    var textRun = createWordTextRun(xmlDoc, " \\( " + latex + " \\) ");
                    para.parentNode.replaceChild(textRun, para);
                }
            });

            var standaloneMaths = Array.prototype.slice.call(xmlDoc.getElementsByTagName("m:oMath"))
                .concat(Array.prototype.slice.call(xmlDoc.getElementsByTagName("oMath")));

            standaloneMaths.forEach(function(math) {
                // If it was already inside an oMathPara that got replaced, its parent will be detached
                if (!math.parentNode) return;

                var latex = nodeToLatex(math);
                if (latex && latex.trim() !== "") {
                    latex = cleanLatexFormula(latex);
                    var textRun = createWordTextRun(xmlDoc, " \\( " + latex + " \\) ");
                    math.parentNode.replaceChild(textRun, math);
                }
            });

            var serializer = new XMLSerializer();
            return serializer.serializeToString(xmlDoc);
        } catch (e) {
            console.error("Error preprocessing OMML to LaTeX:", e);
            return documentXml;
        }
    }

    function cleanLatexFormula(latex) {
        return latex
            .replace(/\s+/g, ' ')
            .replace(/\{\s+/g, '{')
            .replace(/\s+\}/g, '}')
            .trim();
    }

    function createWordTextRun(xmlDoc, text) {
        var wNamespace = "http://schemas.openxmlformats.org/wordprocessingml/2006/main";
        var r = xmlDoc.createElementNS(wNamespace, "w:r");
        var t = xmlDoc.createElementNS(wNamespace, "w:t");
        t.setAttribute("xml:space", "preserve");
        t.textContent = text;
        r.appendChild(t);
        return r;
    }

    /**
     * Smart Free-form Soal Parser
     * Converts a non-table Word HTML document into standard CBT preview tables
     */
    function parseFreeformToCbtTables(htmlString, jenjang) {
        var $temp = $('<div>').html(htmlString);

        // Check if there are tables with question structure
        var $existingTables = $temp.find('table');
        var hasValidCbtTable = false;
        $existingTables.each(function() {
            var trs = $(this).find('tr');
            if (trs.length >= 2) {
                var maxCols = 0;
                trs.each(function() {
                    var cols = $(this).find('td').length;
                    if (cols > maxCols) maxCols = cols;
                });
                if (maxCols >= 4) {
                    hasValidCbtTable = true;
                }
            }
        });

        // If user already used CBT table format, do not alter table structure
        if (hasValidCbtTable) {
            return htmlString;
        }

        // Collect elements: p, li, h1-h6, div
        var nodes = [];
        $temp.children().each(function() {
            var tag = this.tagName.toLowerCase();
            if (tag === 'ol' || tag === 'ul') {
                $(this).children('li').each(function() {
                    nodes.push($(this));
                });
            } else {
                nodes.push($(this));
            }
        });

        var questions = [];
        var currentQ = null;
        var currentJenis = "1"; // Default PG

        // Regular expressions for question number and options
        var qNumRegex = /^(\d+)[\.\)]\s*(.*)$/;
        var optRegex = /^([A-Ea-e])[\.\)]\s*(.*)$/;
        var keyBlockRegex = /^(?:kunci|kunci\s*jawaban|jawaban)\s*[:=]\s*(.*)$/i;

        // Pass 1: Parse questions and options
        nodes.forEach(function($el) {
            var text = $el.text().trim();
            var innerHtml = $el.html().trim();

            if (!text && $el.find('img').length === 0) return;

            // Check for section headers
            var lowerText = text.toLowerCase();
            if (lowerText.includes('pilihan ganda') && !lowerText.includes('kompleks')) {
                currentJenis = "1";
                return;
            } else if (lowerText.includes('kompleks')) {
                currentJenis = "2";
                return;
            } else if (lowerText.includes('menjodohkan')) {
                currentJenis = "3";
                return;
            } else if (lowerText.includes('isian') || lowerText.includes('singkat')) {
                currentJenis = "4";
                return;
            } else if (lowerText.includes('uraian') || lowerText.includes('esai') || lowerText.includes('essai')) {
                currentJenis = "5";
                return;
            }

            // Check for question number: e.g. "1. Operasi...", "1) Operasi..."
            var qMatch = text.match(qNumRegex);
            if (qMatch) {
                var num = parseInt(qMatch[1]);
                var qTextHtml = innerHtml;

                // Clean the number prefix from question HTML
                qTextHtml = qTextHtml.replace(/^\s*(?:<b>|<strong>|<span>|<font[^>]*>)*\s*\d+[\.\)]\s*(?:<\/b>|<\/strong>|<\/span>|<\/font>)*\s*/i, '');

                currentQ = {
                    number: num,
                    jenis: currentJenis,
                    soalHtml: qTextHtml || qMatch[2],
                    opsi: {},
                    kunci: ''
                };
                questions.push(currentQ);
                return;
            }

            // If we are inside a question
            if (currentQ) {
                // Check if this line is an option: "A. ...", "B. ..."
                var optMatch = text.match(optRegex);
                if (optMatch && (currentQ.jenis === "1" || currentQ.jenis === "2")) {
                    var letter = optMatch[1].toUpperCase();
                    var optTextHtml = innerHtml;

                    // Clean the option prefix (A., B., etc.) from option HTML
                    optTextHtml = optTextHtml.replace(/^\s*(?:<b>|<strong>|<span>|<font[^>]*>)*\s*[A-Ea-e][\.\)]\s*(?:<\/b>|<\/strong>|<\/span>|<\/font>)*\s*/i, '');

                    currentQ.opsi[letter] = optTextHtml || optMatch[2];

                    // Check if this option is formatted in bold / strong (often used by teachers as answer key)
                    var isBold = $el.find('b, strong').length > 0 || ($el.attr('style') && $el.attr('style').indexOf('bold') !== -1);
                    if (isBold && !currentQ.kunci) {
                        currentQ.kunci = letter;
                    }
                    return;
                }

                // Check for single question answer key line: "Kunci: A"
                var keyMatch = text.match(keyBlockRegex);
                if (keyMatch) {
                    var kVal = keyMatch[1].trim().toUpperCase();
                    if (['A', 'B', 'C', 'D', 'E'].includes(kVal)) {
                        currentQ.kunci = kVal;
                    } else if (currentQ.jenis === '4' || currentQ.jenis === '5') {
                        currentQ.kunci = keyMatch[1].trim();
                    }
                    return;
                }

                // Otherwise, it's continuation of the question body or an image
                if (Object.keys(currentQ.opsi).length === 0) {
                    currentQ.soalHtml += "<br>" + innerHtml;
                }
            }
        });

        // Pass 2: Check for bottom answer key block (e.g. "KUNCI JAWABAN: 1. A, 2. B, ...")
        nodes.forEach(function($el) {
            var text = $el.text().trim();
            if (text.toLowerCase().indexOf('kunci') !== -1) {
                // Find all pairs like 1.A, 1. A, 1=A, 1:A
                var pairRegex = /(\d+)\s*[\.\:\=\)]\s*([A-Ea-e])/g;
                var match;
                while ((match = pairRegex.exec(text)) !== null) {
                    var n = parseInt(match[1]);
                    var k = match[2].toUpperCase();
                    var targetQ = questions.find(function(q) { return q.number === n; });
                    if (targetQ) {
                        targetQ.kunci = k;
                    }
                }
            }
        });

        if (questions.length === 0) {
            return htmlString; // Fallback
        }

        // Generate Standard CBT Tables
        // Table 1: PG (Jenis 1)
        var pgQuestions = questions.filter(function(q) { return q.jenis === "1"; });
        var isianQuestions = questions.filter(function(q) { return q.jenis === "4"; });
        var esaiQuestions = questions.filter(function(q) { return q.jenis === "5"; });

        var maxOptions = (jenjang === '3') ? ['A', 'B', 'C', 'D', 'E'] : ['A', 'B', 'C', 'D'];
        var outHtml = "";

        if (pgQuestions.length > 0) {
            outHtml += '<table class="table table-bordered w-100 table-soal mb-4">';
            outHtml += '<thead><tr><th>NO</th><th>SOAL</th><th>JENIS</th><th>OPSI</th><th>JAWABAN</th><th>KUNCI</th></tr></thead><tbody>';

            pgQuestions.forEach(function(q) {
                var optKeys = Object.keys(q.opsi);
                var activeOpts = optKeys.length > 0 ? optKeys : maxOptions;
                var rowspan = activeOpts.length;

                activeOpts.forEach(function(optLetter, idx) {
                    outHtml += '<tr class="tr-soal">';
                    if (idx === 0) {
                        outHtml += '<td class="td-soal align-top text-center" rowspan="' + rowspan + '"><b>' + q.number + '</b></td>';
                        outHtml += '<td class="td-soal align-top" rowspan="' + rowspan + '">' + q.soalHtml + '</td>';
                        outHtml += '<td class="td-soal align-top text-center" rowspan="' + rowspan + '">1</td>';
                    }
                    var optContent = q.opsi[optLetter] || '';
                    var isKunci = (q.kunci === optLetter) ? '1' : '';
                    outHtml += '<td class="td-soal text-center fw-bold">' + optLetter + '</td>';
                    outHtml += '<td class="td-soal">' + optContent + '</td>';
                    outHtml += '<td class="td-soal text-center">' + isKunci + '</td>';
                    outHtml += '</tr>';
                });
            });

            outHtml += '</tbody></table>';
        }

        if (isianQuestions.length > 0) {
            outHtml += '<table class="table table-bordered w-100 table-soal mb-4">';
            outHtml += '<thead><tr><th>NO</th><th>SOAL ISIAN SINGKAT</th><th>JENIS</th><th>KUNCI</th></tr></thead><tbody>';

            isianQuestions.forEach(function(q) {
                outHtml += '<tr class="tr-soal">';
                outHtml += '<td class="td-soal align-top text-center"><b>' + q.number + '</b></td>';
                outHtml += '<td class="td-soal align-top">' + q.soalHtml + '</td>';
                outHtml += '<td class="td-soal align-top text-center">4</td>';
                outHtml += '<td class="td-soal">' + (q.kunci || '') + '</td>';
                outHtml += '</tr>';
            });

            outHtml += '</tbody></table>';
        }

        if (esaiQuestions.length > 0) {
            outHtml += '<table class="table table-bordered w-100 table-soal mb-4">';
            outHtml += '<thead><tr><th>NO</th><th>SOAL URAIAN</th><th>JENIS</th><th>KUNCI JAWABAN / RUBRIK</th></tr></thead><tbody>';

            esaiQuestions.forEach(function(q) {
                outHtml += '<tr class="tr-soal">';
                outHtml += '<td class="td-soal align-top text-center"><b>' + q.number + '</b></td>';
                outHtml += '<td class="td-soal align-top">' + q.soalHtml + '</td>';
                outHtml += '<td class="td-soal align-top text-center">5</td>';
                outHtml += '<td class="td-soal">' + (q.kunci || '') + '</td>';
                outHtml += '</tr>';
            });

            outHtml += '</tbody></table>';
        }

        return outHtml;
    }

    /**
     * Trigger KaTeX rendering on preview container
     */
    function renderMath(container) {
        if (!container) return;
        var el = (typeof container === 'string') ? document.querySelector(container) : container;
        if (!el) return;

        if (typeof renderMathInElement === 'function') {
            try {
                renderMathInElement(el, {
                    delimiters: [
                        {left: "$$", right: "$$", display: true},
                        {left: "\\(", right: "\\)", display: false},
                        {left: "$", right: "$", display: false},
                        {left: "\\[", right: "\\]", display: true}
                    ],
                    throwOnError: false
                });
            } catch(e) {
                console.warn("KaTeX renderMathInElement warning:", e);
            }
        }
    }

    /**
     * Prepare LaTeX formulas for Summernote Math editor.
     * Converts \( ... \) or $$ ... $$ into <span class="note-math"> so teachers can click and edit the math formulas.
     */
    function prepareForSummernote(html) {
        if (!html) return html;
        if (typeof katex === 'undefined') return html;

        // Don't re-wrap if already wrapped in note-math
        return html.replace(/\\\(([\s\S]*?)\\\)/g, function(match, latex) {
            var cleanLatex = latex.trim();
            if (!cleanLatex) return match;
            try {
                var rendered = katex.renderToString(cleanLatex, { throwOnError: false, displayMode: false });
                return '<span class="note-math">' + rendered + '<span class="note-latex" style="display: none;">' + cleanLatex + '</span></span>';
            } catch(e) {
                return match;
            }
        }).replace(/\$\$([\s\S]*?)\$\$/g, function(match, latex) {
            var cleanLatex = latex.trim();
            if (!cleanLatex) return match;
            try {
                var rendered = katex.renderToString(cleanLatex, { throwOnError: false, displayMode: true });
                return '<span class="note-math">' + rendered + '<span class="note-latex" style="display: none;">' + cleanLatex + '</span></span>';
            } catch(e) {
                return match;
            }
        });
    }

    return {
        nodeToLatex: nodeToLatex,
        preprocessDocumentXml: preprocessDocumentXml,
        parseFreeformToCbtTables: parseFreeformToCbtTables,
        renderMath: renderMath,
        prepareForSummernote: prepareForSummernote
    };

})();

if (typeof module !== 'undefined' && module.exports) {
    module.exports = OmmlToLatex;
}
