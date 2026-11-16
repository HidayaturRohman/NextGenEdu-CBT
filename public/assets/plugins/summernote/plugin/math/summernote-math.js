(function(factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        module.exports = factory(require('jquery'));
    } else {
        factory(window.jQuery);
    }
}(function($) {
    $.extend(true, $.summernote.lang, {
        'en-US': {
            math: {
                dialogTitle: 'Rumus Matematika (LaTeX / KaTeX)',
                tooltip: 'Sisipkan Rumus Matematika',
                pluginTitle: 'Rumus Matematika',
                ok: 'Sisipkan Rumus',
                cancel: 'Batal'
            }
        }
    });

    $.extend($.summernote.options, {
        math: {
            icon: '<b style="font-size: 15px; font-family: serif;">&sum;</b>'
        }
    });

    $.extend($.summernote.plugins, {
        'math': function(context) {
            var self = this;
            var ui = $.summernote.ui;
            var $editor = context.layoutInfo.editor;
            var options = context.options;
            var lang = options.langInfo;

            self.events = {
                'summernote.init': function() {
                    // Double click on existing math node to edit
                    $editor.on('dblclick', '.note-math', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        context.invoke('editor.saveRange');
                        self.show($(this));
                    });
                }
            };

            context.memo('button.math', function() {
                var button = ui.button({
                    contents: options.math.icon,
                    tooltip: lang.math.tooltip,
                    click: function(e) {
                        context.invoke('editor.saveRange');
                        self.show();
                    }
                });
                return button.render();
            });

            self.initialize = function() {
                var palette = [
                    { label: 'a/b', snippet: '\\frac{a}{b}', title: 'Pecahan' },
                    { label: 'x²', snippet: 'x^{2}', title: 'Pangkat' },
                    { label: 'x₁', snippet: 'x_{1}', title: 'Indeks / Subskrip' },
                    { label: '√x', snippet: '\\sqrt{x}', title: 'Akar Kuadrat' },
                    { label: 'ⁿ√x', snippet: '\\sqrt[n]{x}', title: 'Akar Pangkat n' },
                    { label: '±', snippet: '\\pm', title: 'Plus Minus' },
                    { label: '×', snippet: '\\times', title: 'Kali' },
                    { label: '÷', snippet: '\\div', title: 'Bagi' },
                    { label: '·', snippet: '\\cdot', title: 'Titik Kali' },
                    { label: '≤', snippet: '\\le', title: 'Kurang Dari Sama Dengan' },
                    { label: '≥', snippet: '\\ge', title: 'Lebih Dari Sama Dengan' },
                    { label: '≠', snippet: '\\neq', title: 'Tidak Sama Dengan' },
                    { label: '≈', snippet: '\\approx', title: 'Mendekati / Kira-kira' },
                    { label: '°', snippet: '^{\\circ}', title: 'Derajat' },
                    { label: 'π', snippet: '\\pi', title: 'Pi' },
                    { label: 'α', snippet: '\\alpha', title: 'Alpha' },
                    { label: 'β', snippet: '\\beta', title: 'Beta' },
                    { label: 'θ', snippet: '\\theta', title: 'Theta' },
                    { label: '∞', snippet: '\\infty', title: 'Tak Hingga' },
                    { label: '∑', snippet: '\\sum_{i=1}^{n}', title: 'Sigma / Penjumlahan' },
                    { label: '∫', snippet: '\\int', title: 'Integral' },
                    { label: 'lim', snippet: '\\lim_{x \\to 0}', title: 'Limit' },
                    { label: 'log', snippet: '\\log(x)', title: 'Logaritma' },
                    { label: '[Matrix]', snippet: '\\begin{pmatrix} a & b \\\\ c & d \\end{pmatrix}', title: 'Matriks 2x2' }
                ];

                var paletteHtml = '<div class="note-math-palette" style="display: flex; flex-wrap: wrap; gap: 4px; max-height: 110px; overflow-y: auto; padding: 4px; background: #f8fafc; border-radius: 6px; border: 1px solid #e2e8f0;">';
                for (var i = 0; i < palette.length; i++) {
                    paletteHtml += '<button type="button" class="btn btn-sm btn-white note-math-quick-btn" data-snippet="' + palette[i].snippet.replace(/"/g, '&quot;') + '" title="' + palette[i].title + '" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 11.5px; padding: 2px 7px; color: #1e293b; font-weight: 500; cursor: pointer; line-height: 1.4;">' + palette[i].label + '</button>';
                }
                paletteHtml += '</div>';

                var dialogHtml = '' +
                    '<div class="note-modal note-math-modal" tabindex="-1" role="dialog" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; width: 100vw; height: 100vh; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(2px); z-index: 99999; align-items: center; justify-content: center;">' +
                    '  <div class="note-modal-dialog" style="max-width: 580px; width: 95%; margin: auto; animation: noteMathPop 0.18s cubic-bezier(0.16, 1, 0.3, 1);">' +
                    '    <div class="note-modal-content" style="border-radius: 12px; border: none; box-shadow: 0 20px 45px rgba(0,0,0,0.35); overflow: hidden; background: #fff;">' +
                    '      <div class="note-modal-header" style="background: linear-gradient(135deg, #1e40af, #2563eb); color: #fff; padding: 12px 18px; display: flex; align-items: center; justify-content: space-between;">' +
                    '        <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #fff; display: flex; align-items: center; gap: 8px;">' +
                    '          <span style="display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: rgba(255,255,255,0.2); border-radius: 6px; font-size: 13px;">&sum;</span> Rumus Matematika (LaTeX / KaTeX)' +
                    '        </h5>' +
                    '        <button type="button" class="note-math-close" style="background: none; border: none; color: #fff; font-size: 24px; line-height: 1; cursor: pointer; opacity: 0.85; padding: 0 4px;" aria-label="Close">&times;</button>' +
                    '      </div>' +
                    '      <div class="note-modal-body" style="padding: 16px;">' +
                    '        <div class="mb-2">' +
                    '          <label style="font-size: 11.5px; font-weight: 600; color: #475569; margin-bottom: 5px; display: block;">Simbol &amp; Template Cepat (Klik untuk menyisipkan):</label>' +
                    paletteHtml +
                    '        </div>' +
                    '        <div class="form-group mb-2">' +
                    '          <label style="font-size: 11.5px; font-weight: 600; color: #475569; margin-bottom: 4px; display: flex; justify-content: space-between; align-items: center;">' +
                    '            <span>Kode LaTeX:</span>' +
                    '            <span class="text-muted" style="font-size: 11px; font-weight: normal;">Contoh: <code>\\frac{a}{b}</code> atau <code>x^2 + 5</code></span>' +
                    '          </label>' +
                    '          <textarea class="note-latex-input form-control" rows="2" style="font-family: Consolas, monospace; font-size: 13.5px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 8px; width: 100%; box-sizing: border-box; resize: vertical;" placeholder="Tulis atau paste kode LaTeX disini..."></textarea>' +
                    '        </div>' +
                    '        <div class="form-group mb-0">' +
                    '          <label style="font-size: 11.5px; font-weight: 600; color: #475569; margin-bottom: 4px; display: block;">Pratinjau Rumus (Live Preview):</label>' +
                    '          <div class="note-math-preview-container" style="min-height: 55px; background: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 8px; padding: 12px; display: flex; align-items: center; justify-content: center; font-size: 19px; overflow-x: auto; color: #1e293b;">' +
                    '            <span class="note-math-preview-target" style="display: inline-block;"></span>' +
                    '          </div>' +
                    '        </div>' +
                    '      </div>' +
                    '      <div class="note-modal-footer" style="padding: 12px 18px; background: #f8fafc; display: flex; justify-content: flex-end; gap: 8px; border-top: 1px solid #e2e8f0;">' +
                    '        <button type="button" class="btn btn-sm btn-light border note-math-cancel" style="border-radius: 6px; padding: 6px 14px; font-size: 13px;">Batal</button>' +
                    '        <button type="button" class="btn btn-sm btn-primary note-math-save" style="border-radius: 6px; padding: 6px 18px; font-size: 13px; font-weight: 600; background: #2563eb; border: none;">Sisipkan Rumus</button>' +
                    '      </div>' +
                    '    </div>' +
                    '  </div>' +
                    '</div>';

                self.$dialog = $(dialogHtml).appendTo(document.body);

                // Quick buttons click
                self.$dialog.find('.note-math-quick-btn').on('click', function(e) {
                    e.preventDefault();
                    var snippet = $(this).attr('data-snippet');
                    var $input = self.$dialog.find('.note-latex-input');
                    var inputEl = $input[0];
                    var startPos = inputEl.selectionStart || inputEl.value.length;
                    var endPos = inputEl.selectionEnd || inputEl.value.length;
                    var oldVal = inputEl.value;
                    inputEl.value = oldVal.substring(0, startPos) + snippet + oldVal.substring(endPos);
                    var newPos = startPos + snippet.length;
                    inputEl.setSelectionRange(newPos, newPos);
                    $input.focus().trigger('input');
                });

                // Input event for real-time preview
                self.$dialog.find('.note-latex-input').on('input keyup paste change', function() {
                    self.updatePreview($(this).val());
                });

                // Close & Cancel buttons
                self.$dialog.find('.note-math-close, .note-math-cancel').on('click', function(e) {
                    e.preventDefault();
                    self.hide();
                });

                // Escape key
                self.$dialog.on('keydown', function(e) {
                    if (e.keyCode === 27) { // Escape
                        self.hide();
                    }
                });

                // Enter inside textarea (Ctrl+Enter or Enter without Shift to save)
                self.$dialog.find('.note-latex-input').on('keydown', function(e) {
                    if (e.keyCode === 13 && (e.ctrlKey || !e.shiftKey)) {
                        e.preventDefault();
                        self.$dialog.find('.note-math-save').trigger('click');
                    }
                });
            };

            self.updatePreview = function(latex) {
                var $target = self.$dialog.find('.note-math-preview-target');
                var val = $.trim(latex || '');
                if (!val) {
                    $target.html('<span style="font-size: 13px; color: #94a3b8; font-style: italic;">Pratinjau rumus akan muncul disini...</span>');
                    return;
                }
                if (typeof katex !== 'undefined') {
                    try {
                        var html = katex.renderToString(val, { throwOnError: true, displayMode: false });
                        $target.html(html);
                    } catch (err) {
                        // Incomplete formula while typing - show lenient render or subtle indicator
                        try {
                            var relaxedHtml = katex.renderToString(val, { throwOnError: false, displayMode: false });
                            $target.html(relaxedHtml);
                        } catch (e2) {
                            $target.html('<span style="font-size: 12px; color: #ef4444;"><i class="fa fa-exclamation-triangle me-1"></i> Sedang mengetik rumus...</span>');
                        }
                    }
                } else {
                    $target.text(val);
                }
            };

            self.show = function($targetMathNode) {
                var $mathNode = $targetMathNode && $targetMathNode.length > 0 ? $targetMathNode : self.getSelectedMath();
                var $input = self.$dialog.find('.note-latex-input');
                var currentLatex = '';

                if ($mathNode && $mathNode.length > 0) {
                    currentLatex = $mathNode.find('.note-latex').text() || $mathNode.attr('data-latex') || '';
                    if (!currentLatex) {
                        currentLatex = $mathNode.text() || '';
                    }
                }

                $input.val(currentLatex);
                self.updatePreview(currentLatex);

                // Show modal flex centered
                self.$dialog.css('display', 'flex');
                setTimeout(function() {
                    $input.focus();
                    if ($input[0].setSelectionRange) {
                        var len = $input.val().length;
                        $input[0].setSelectionRange(len, len);
                    }
                }, 50);

                // Save button handler
                self.$dialog.find('.note-math-save').off('click').on('click', function(e) {
                    e.preventDefault();
                    var val = $.trim($input.val());
                    if (!val) {
                        $input.focus();
                        return;
                    }

                    // Render with KaTeX
                    var renderedHtml = '';
                    if (typeof katex !== 'undefined') {
                        try {
                            renderedHtml = katex.renderToString(val, { throwOnError: false, displayMode: false });
                        } catch (e) {
                            renderedHtml = val;
                        }
                    } else {
                        renderedHtml = val;
                    }

                    // Build span.note-math
                    var $newMath = $('<span class="note-math" contenteditable="false" style="display: inline-block; vertical-align: middle; padding: 0 2px; cursor: pointer;" title="Klik dua kali untuk mengedit rumus"></span>');
                    $newMath.html(renderedHtml);
                    $('<span class="note-latex" style="display: none;"></span>').text(val).appendTo($newMath);

                    // Restore editor range & focus
                    context.invoke('editor.restoreRange');
                    context.invoke('editor.focus');

                    if ($mathNode && $mathNode.length > 0 && $mathNode.closest('.note-editable').length > 0) {
                        $mathNode.replaceWith($newMath);
                    } else {
                        context.invoke('editor.insertNode', $newMath[0]);
                        // Insert trailing non-breaking space for smooth cursor navigation
                        context.invoke('editor.insertText', ' ');
                    }

                    self.hide();
                });
            };

            self.hide = function() {
                self.$dialog.css('display', 'none');
            };

            self.getSelectedMath = function() {
                var selection = window.getSelection();
                if (selection && selection.rangeCount > 0) {
                    var node = selection.anchorNode;
                    if (node) {
                        var $parentMath = $(node).closest('.note-math');
                        if ($parentMath.length > 0) {
                            return $parentMath;
                        }
                    }
                }
                return null;
            };

            self.destroy = function() {
                if (self.$dialog) {
                    self.$dialog.remove();
                    self.$dialog = null;
                }
            };
        }
    });
}));
