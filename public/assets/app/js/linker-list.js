function getRandomInt(max) {
    return Math.floor(Math.random() * Math.floor(max));
}

;(function ($, window, document, undefined) {
    "use strict";
    const pluginName = "linkerList";
    const defaults = {
        data: {
            kiri: [
                {key: '1', value: '<p>Jawa barat</p>'},
                {key: '2', value: '<p>Sumatera Selatan<p/>'},
            ],
            kanan: [
                {
                    key: 'A',
                    value: '<p>Palembang</p>'
                },
                {
                    key: 'B',
                    value: '<p>Bandung</p>'
                },
            ],
            linked: {
                '1': ['B'],
                '2': ['A'],
                //'3': []
            },
        }
    };
    const colorsLine = [
        "#BDBDBD",
        "#C62828", "#283593", "#00695C", "#9E9D24", "#6A1B9A",
        "#FBC02D", "#F57C00", "#E64A19", "#5D4037", "#37474F",
        "#C62828", "#283593", "#00695C", "#9E9D24", "#6A1B9A",
        "#FBC02D", "#F57C00", "#E64A19", "#5D4037", "#37474F",
    ]
    const colorsBg = [
        "#FFFFFF",
        "#fff7f8", "#e6e9ff", "#d6faff", "#f0ffdc", "#fbecff",
        "#fffbde", "#fff0d6", "#ffe5dc", "#fff5f0", "#effcff",
        "#fff7f8", "#e6e9ff", "#d6faff", "#f0ffdc", "#fbecff",
        "#fffbde", "#fff0d6", "#ffe5dc", "#fff5f0", "#effcff",
    ]
    const templates = {
        kiriContainer: '<div style="width: 42%; min-width: 200px"></div>',
        kananContainer: '<div style="width: 42%; min-width: 200px"></div>',
        canvasContainer: '<div style="width: 16%; min-width: 100px"></div>',
        canvasItem: '<canvas id="canvas" width="10" height="10"></canvas>',
        itemKiri: '<div class="my-2 item-kiri py-1 px-2"></div>',
        itemKanan: '<div class="my-2 item-kanan py-1 px-2"></div>',
        headerContainer: `<div class="row">
        <div class="col-7">
            <div class="row">
                <div class="col mb-2" style="max-width: 130px">
                    <select name="model_opsi" class="form-control" data-id="model-opsi">
                        <option value="1">List</option>
                        <option value="2">Table</option>
                    </select>
                </div>
                <div class="col mb-2" style="max-width: 250px">
                    <select name="type_opsi" class="form-control" data-id="type-opsi">
                        <option value="2">1 baris 1 jawaban</option>
                        <option value="1">1 baris banyak jawaban</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-5 text-right">
            <button class="btn btn-default" data-id=""><i class="fa fa-pencil-alt mr-2"></i>Edit</button>
            <button class="btn btn-default" data-id=""><i class="fa fa-check mr-2"></i>Selesai</button>
        </div>
    </div>`
    };

    function LinkerList(element, options) {
        this.randomId = getRandomInt(1024000000);
        this.listIdPrefix = '-' + this.randomId;
        this.rootId = 'linker-' + this.randomId
        this.element = element;
        this.itemIdPrefix = element.id + "-item-";
        $(this.element).addClass('card shadow-none border');

        this.cardBody = $('<div class="card-body p-2 p-md-3"></div>')
        this.overlay = $('<div class="overlay d-none"></div>')
        $(this.element).append(this.cardBody)
        $(this.element).append(this.overlay)

        this.modelSoal = '1'; // list, tabel
        this.tipeSoal = '2'; // 1 to many, 1 to 1,
        this.maxJawaban = {};
        this.offsetMax = '0' // for warning max jawaban

        // viewMode
        // 1 = disable all (just view)
        // 2 = enable select && disable edit (siswa mode)
        // 3 = enable all (admin/guru mode)
        this.viewMode = '1';

        let datas = {};
        if (options.data) {
            if (options.data.jawaban.length > 0) {
                const ext = $.extend(true, [], options.data.jawaban)
                datas['data'] = convertDefaultToList(ext);
            }
            this.maxJawaban = options.data.max
            this.modelSoal = options.data.model === "0" ? "2" : options.data.model
            this.tipeSoal = options.data.type === "0" ? "2" : options.data.type
            this.viewMode = options.viewMode || '1'
        }
        this.settings = $.extend({}, defaults, datas);
        this.fnc = options.callback
        this.idResult = options.id
        this.onInit = options.onInit
        this.initialize = false

        this.listKiri = []
        this.listKanan = []
        this.linkeds = {}
        this.hasLinks = false
        this.dataResult = {};
        this.dataEditor = {};
        this.storedBoxes = [];
        this.storedLines = [];

        this.viewKiri = null
        this.viewKanan = null
        this.viewCanvas = null

        this.canvas = null;
        this.ctx = null;
        this.startX = 0;
        this.startY = 0;
        this.canvasOffset = 0;
        this.offsetX = 0;
        this.offsetY = 0;
        this.scrollX = 0;
        this.scrollY = 0;
        this.warnaKiri = {}
        this.warnaKanan = {}
        this.clicked = false
        this.idActive = ''
        this.firstY = 0;
        this.canvasWidth = 0;
        this.mouseX = 0;
        this.mouseY = 0;
        this.asyncResize = undefined;

        this.editMode = false;

        this.init();
    }

    $.extend(LinkerList.prototype, {
        init: function () {
            let self = this
            if (self.settings.data) {
                //console.log(self.settings.data)
                self.listKiri = $.extend(true, [], self.settings.data.kiri)
                self.listKanan = $.extend(true, [], self.settings.data.kanan)
                self.linkeds = $.extend(true, {}, self.settings.data.linked)
                delete self.settings.data;
            }

            if (self.viewMode === '3') {
                let header = $('<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 p-2 rounded-3 border bg-light linker-toolbar"></div>');
                let leftControls = $('<div class="d-flex flex-wrap align-items-center gap-2"></div>');
                leftControls.append(
                    '<div class="btn-group btn-group-sm flex-shrink-0" role="group">' +
                    '   <button type="button" class="btn btn-outline-primary ' + (self.modelSoal === '1' ? 'active' : '') + '" data-id="switch-list' + self.listIdPrefix + '" title="Tampilan Garis (List)"><i class="fa fa-bars"></i></button>' +
                    '   <button type="button" class="btn btn-outline-primary ' + (self.modelSoal === '2' ? 'active' : '') + '" data-id="switch-table' + self.listIdPrefix + '" title="Tampilan Tabel"><i class="fa fa-table"></i></button>' +
                    '</div>' +
                    '<select class="form-select form-select-sm w-auto" style="min-width: 175px;" data-id="type-opsi' + self.listIdPrefix + '">' +
                    '   <option value="2">1 baris 1 jawaban</option>' +
                    '   <option value="1">1 baris banyak jawaban</option>' +
                    '</select>'
                );
                let rightControls = $('<div class="d-flex align-items-center gap-2 ms-auto"></div>');
                rightControls.append(
                    '<button type="button" class="btn btn-sm btn-primary px-3" data-id="btn-edit' + self.listIdPrefix + '"><i class="fa fa-pencil-alt me-1"></i>Edit</button>' +
                    '<button type="button" class="btn btn-sm btn-success px-3 d-none" data-id="btn-ok' + self.listIdPrefix + '"><i class="fa fa-check me-1"></i>Selesai</button>'
                );
                header.append(leftControls).append(rightControls);

                $(self.cardBody).append(header)
                $(`select[data-id="type-opsi${self.listIdPrefix}"]`).val(self.tipeSoal)
                self.handleClick()
            }
            if (self.initialize) return
            if (self.modelSoal === '1') self.initList()
            else self.initTable()
        },

        initList: function () {
            let self = this
            self.clicked = false;
            self.idActive = '';
            self.activeSide = '';

            let linkerContainer = $('<div class="d-flex flex-row flex-fill align-items-stretch linker-list position-relative" style="user-select: none; -webkit-user-select: none;"></div>');
            let contKiri = $('<div style="flex: 1 1 42%; min-width: 115px;"></div>');
            contKiri.attr('id', 'list-kiri' + self.listIdPrefix)
            self.listKiri.forEach(function (kr, idx) {
                let div = $('<div></div>');
                div.attr('id', 'item' + kr.key + self.listIdPrefix);
                div.attr('data-key', kr.key);
                div.attr('data-side', 'kiri');
                div.addClass('col my-2 item-kiri py-2 px-2');
                div.css({
                    'background-color': "#FFF",
                    'border': '1px solid #BDBDBD',
                    'border-radius': '8px',
                    'display': 'flex',
                    'flex-direction': 'column',
                    'justify-content': 'center',
                    'transition': 'box-shadow 0.15s ease, border-color 0.15s ease'
                });
                if (self.viewMode !== '1') {
                    div.css({'cursor': 'pointer', 'touch-action': 'none'});
                }
                div.html(self.convertLinkImage(kr.value))
                div.find('p').css({'margin': '0'})
                contKiri.append(div)
            })
            linkerContainer.append(contKiri)
            let contCanvas = $('<div style="flex: 0 0 16%; min-width: 64px; position: relative;"></div>');
            contCanvas.attr('id', 'col-canvas' + self.listIdPrefix)
            let cnvs = $('<canvas style="display: block; width: 100%; pointer-events: none;"></canvas>')
            cnvs.attr('id', 'canvas' + self.listIdPrefix)
            contCanvas.append(cnvs)
            linkerContainer.append(contCanvas)

            let contKanan = $('<div style="flex: 1 1 42%; min-width: 115px;"></div>');
            contKanan.attr('id', 'list-kanan' + self.listIdPrefix)
            self.listKanan.forEach(function (kn, idx) {
                let div = $('<div></div>');
                div.attr('id', 'item' + kn.key + self.listIdPrefix);
                div.attr('data-key', kn.key);
                div.attr('data-side', 'kanan');
                div.addClass('col my-2 item-kanan py-2 px-2');
                div.css({
                    'background-color': "#FFF",
                    'border': '1px solid #BDBDBD',
                    'border-radius': '8px',
                    'display': 'flex',
                    'flex-direction': 'column',
                    'justify-content': 'center',
                    'transition': 'box-shadow 0.15s ease, border-color 0.15s ease'
                });
                if (self.viewMode !== '1') {
                    div.css({'cursor': 'pointer', 'touch-action': 'none'});
                }
                div.html(self.convertLinkImage(kn.value))
                div.find('p').css({'margin': '0'})
                contKanan.append(div)
            })
            linkerContainer.append(contKanan)

            let divResponsive = $('<div class="table-responsive"></div>')
            divResponsive.append(linkerContainer)
            $(self.cardBody).append(divResponsive)

            function clearActiveSelection() {
                self.clicked = false;
                self.idActive = '';
                self.activeSide = '';
                self.createPoints();
            }

            function selectItem(side, key) {
                self.activeSide = side;
                self.idActive = key;
                self.clicked = true;
                self.createPoints();

                const $el = linkerContainer.find(`.item-${side}[data-key="${key}"]`);
                const m = self.getCanvasMetrics();
                const anchorY = self.getItemAnchor($el);
                const colorIdx = side === 'kiri' ? self.getKiriColorIdx(key) : self.getKananColorIdx(key);
                const activeColor = colorsLine[colorIdx];

                if (m && anchorY !== null) {
                    const isLeft = side === 'kiri';
                    const box = {
                        key: key,
                        color: activeColor,
                        rectBoxX: isLeft ? 0 : (self.canvasWidth - 8),
                        rectBoxY: anchorY - 5,
                        lineMove: isLeft ? 8 : (self.canvasWidth - 16),
                        lineTo: isLeft ? 16 : (self.canvasWidth - 8),
                        lineY: anchorY,
                    };
                    self.storedBoxes.push(box);
                    self.startX = isLeft ? 16 : (self.canvasWidth - 16);
                    self.startY = anchorY;
                    self.redraw();
                }

                $el.css({
                    'background-color': colorsBg[colorIdx],
                    'border': '2px solid ' + activeColor,
                    'box-shadow': '0 0 0 3px rgba(59, 130, 246, 0.25)'
                });
            }

            function connectPair(kiriKey, kananKey) {
                if (!kiriKey || !kananKey) return;
                const rowIdx = self.listKiri.findIndex(function (item) {
                    return String(item.key) === String(kiriKey);
                }) + 1;

                if (!self.linkeds[kiriKey]) self.linkeds[kiriKey] = [];
                const alreadyLinked = self.linkeds[kiriKey].includes(kananKey);

                if (alreadyLinked) {
                    // Klik / tarik ulang pasangan yang sudah tersambung untuk melepas garis tersebut
                    self.linkeds[kiriKey] = self.arrayRemove(self.linkeds[kiriKey], kananKey);
                    if (self.linkeds[kiriKey].length === 0) self.warnaKiri[kiriKey] = 0;
                    self.offsetMax = '0';
                } else if (self.tipeSoal === '2') {
                    self.linkeds[kiriKey] = [kananKey];
                    self.offsetMax = '0';
                } else {
                    const max = (self.maxJawaban && self.maxJawaban[rowIdx]) ? parseInt(self.maxJawaban[rowIdx], 10) : 20;
                    if (self.linkeds[kiriKey].length >= max) {
                        self.offsetMax = String(max);
                    } else {
                        self.linkeds[kiriKey].push(kananKey);
                        self.offsetMax = '0';
                    }
                }
                self.clicked = false;
                self.idActive = '';
                self.activeSide = '';
                self.triggerResult();
                self.createPoints();
            }

            function previewConnection(kiriKey, kananKey, hoverSide) {
                const m = self.getCanvasMetrics();
                if (!m) return;
                const $source = linkerContainer.find(`.item-${self.activeSide}[data-key="${self.idActive}"]`);
                const $target = linkerContainer.find(`.item-${hoverSide}[data-key="${hoverSide === 'kiri' ? kiriKey : kananKey}"]`);
                const sourceY = self.getItemAnchor($source);
                const targetY = self.getItemAnchor($target);
                if (sourceY === null || targetY === null) return;

                self.createPoints();
                const isSourceLeft = self.activeSide === 'kiri';
                const cIdx = isSourceLeft ? self.getKiriColorIdx(kiriKey) : self.getKananColorIdx(kananKey);
                const strokeColor = colorsLine[cIdx];

                self.storedBoxes.push({
                    key: self.idActive,
                    color: strokeColor,
                    rectBoxX: isSourceLeft ? 0 : (self.canvasWidth - 8),
                    rectBoxY: sourceY - 5,
                    lineMove: isSourceLeft ? 8 : (self.canvasWidth - 16),
                    lineTo: isSourceLeft ? 16 : (self.canvasWidth - 8),
                    lineY: sourceY,
                });
                self.storedBoxes.push({
                    key: hoverSide === 'kiri' ? kiriKey : kananKey,
                    color: strokeColor,
                    rectBoxX: hoverSide === 'kiri' ? 0 : (self.canvasWidth - 8),
                    rectBoxY: targetY - 5,
                    lineMove: hoverSide === 'kiri' ? 8 : (self.canvasWidth - 16),
                    lineTo: hoverSide === 'kiri' ? 16 : (self.canvasWidth - 8),
                    lineY: targetY,
                });
                self.redraw();

                const x1 = isSourceLeft ? 16 : (self.canvasWidth - 16);
                const x2 = hoverSide === 'kiri' ? 16 : (self.canvasWidth - 16);
                self.ctx.beginPath();
                self.ctx.moveTo(x1, sourceY);
                self.ctx.lineTo(x2, targetY);
                self.ctx.strokeStyle = strokeColor;
                self.ctx.lineWidth = 2;
                self.ctx.lineCap = 'round';
                self.ctx.stroke();

                $source.css({
                    'background-color': colorsBg[cIdx],
                    'border': '2px solid ' + strokeColor,
                    'box-shadow': '0 0 0 3px rgba(59, 130, 246, 0.25)'
                });
                $target.css({
                    'border': '2px dashed ' + strokeColor,
                    'box-shadow': '0 0 0 3px rgba(59, 130, 246, 0.15)'
                });
            }

            if (self.viewMode !== '1') {
                let dragState = null;
                let suppressNextClick = false;
                const dragNs = '.linkerDrag' + self.listIdPrefix;

                function handleItemClick(side, key) {
                    if (!self.clicked || self.idActive === '') {
                        selectItem(side, key);
                    } else if (self.activeSide === side) {
                        if (String(self.idActive) === String(key)) {
                            clearActiveSelection();
                        } else {
                            // Langsung pindah pilihan tanpa membatalkan
                            selectItem(side, key);
                        }
                    } else {
                        const kiriKey = self.activeSide === 'kiri' ? self.idActive : key;
                        const kananKey = self.activeSide === 'kanan' ? self.idActive : key;
                        connectPair(kiriKey, kananKey);
                    }
                }

                linkerContainer.on('click', '.item-kiri, .item-kanan', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    if (suppressNextClick) {
                        suppressNextClick = false;
                        return;
                    }
                    const $card = $(this);
                    const side = $card.attr('data-side');
                    const key = $card.attr('data-key');
                    handleItemClick(side, key);
                });

                linkerContainer.on('mouseenter', '.item-kiri, .item-kanan', function () {
                    if (!self.clicked || self.idActive === '') return;
                    const $card = $(this);
                    const side = $card.attr('data-side');
                    const key = $card.attr('data-key');
                    if (side === self.activeSide) return;
                    const kiriKey = side === 'kiri' ? key : self.idActive;
                    const kananKey = side === 'kanan' ? key : self.idActive;
                    previewConnection(kiriKey, kananKey, side);
                }).on('mouseleave', '.item-kiri, .item-kanan', function () {
                    if (!self.clicked || self.idActive === '') return;
                    const side = $(this).attr('data-side');
                    if (side !== self.activeSide) {
                        selectItem(self.activeSide, self.idActive);
                    }
                });

                // Support rubber-band preview & drag-to-connect (mouse + touch)
                linkerContainer.on('pointerdown', '.item-kiri, .item-kanan', function (e) {
                    if (e.button && e.button !== 0) return;
                    const $card = $(this);
                    dragState = {
                        side: $card.attr('data-side'),
                        key: $card.attr('data-key'),
                        startX: e.clientX,
                        startY: e.clientY,
                        moved: false
                    };
                });

                $(document).off('pointermove' + dragNs + ' pointerup' + dragNs + ' pointercancel' + dragNs);
                $(document).on('pointermove' + dragNs, function (e) {
                    if (!document.body.contains(linkerContainer[0])) {
                        $(document).off(dragNs);
                        return;
                    }
                    if (dragState && !dragState.moved) {
                        const dist = Math.hypot(e.clientX - dragState.startX, e.clientY - dragState.startY);
                        if (dist >= 8) {
                            dragState.moved = true;
                            selectItem(dragState.side, dragState.key);
                        }
                    }
                    if ((dragState && dragState.moved) || (self.clicked && self.idActive !== '')) {
                        const overEl = document.elementFromPoint(e.clientX, e.clientY);
                        const overCard = overEl ? $(overEl).closest('.item-kiri, .item-kanan') : $();
                        if (overCard.length && linkerContainer[0].contains(overCard[0])) {
                            const oSide = overCard.attr('data-side');
                            const oKey = overCard.attr('data-key');
                            if (oSide && oSide !== self.activeSide) {
                                const kiriKey = oSide === 'kiri' ? oKey : self.idActive;
                                const kananKey = oSide === 'kanan' ? oKey : self.idActive;
                                previewConnection(kiriKey, kananKey, oSide);
                                return;
                            }
                        }
                        if (dragState && dragState.moved) {
                            self.handleMouseMove(e);
                        } else if (overEl && linkerContainer[0].contains(overEl)) {
                            self.handleMouseMove(e);
                        }
                    }
                }).on('pointerup' + dragNs + ' pointercancel' + dragNs, function (e) {
                    if (!dragState) return;
                    const wasDrag = dragState.moved;
                    const fromSide = dragState.side;
                    const fromKey = dragState.key;
                    dragState = null;

                    if (wasDrag) {
                        suppressNextClick = true;
                        setTimeout(function () { suppressNextClick = false; }, 120);
                        const dropEl = document.elementFromPoint(e.clientX, e.clientY);
                        const dropCard = dropEl ? $(dropEl).closest('.item-kiri, .item-kanan') : $();
                        if (dropCard.length && linkerContainer[0].contains(dropCard[0])) {
                            const toSide = dropCard.attr('data-side');
                            const toKey = dropCard.attr('data-key');
                            if (toSide && toSide !== fromSide) {
                                const kiriKey = toSide === 'kiri' ? toKey : fromKey;
                                const kananKey = toSide === 'kanan' ? toKey : fromKey;
                                connectPair(kiriKey, kananKey);
                                return;
                            }
                        }
                        clearActiveSelection();
                    }
                });

                self.showDialog(false)
            }
            self.drawLinked()

            // Sinkronkan ulang koordinat canvas saat tinggi kiri/kanan berubah, gambar selesai dimuat, atau container di-resize
            if (typeof ResizeObserver !== 'undefined') {
                const ro = new ResizeObserver(function () {
                    if (self.modelSoal === '1' && !self.editMode) {
                        clearTimeout(self.asyncResize);
                        self.asyncResize = setTimeout(function () {
                            self.drawLinked();
                        }, 16);
                    }
                });
                if (contKiri[0]) ro.observe(contKiri[0]);
                if (contKanan[0]) ro.observe(contKanan[0]);
                if (contCanvas[0]) ro.observe(contCanvas[0]);
            } else if (typeof ResizeSensor !== 'undefined') {
                new ResizeSensor($('#list-kiri' + self.listIdPrefix), function () {
                    if (self.modelSoal === '1' && !self.editMode) self.drawLinked();
                });
                new ResizeSensor($('#list-kanan' + self.listIdPrefix), function () {
                    if (self.modelSoal === '1' && !self.editMode) self.drawLinked();
                });
            }

            linkerContainer.find('img').on('load', function () {
                if (self.modelSoal === '1' && !self.editMode) self.drawLinked();
            });

            $(window).off('resize.linker' + self.listIdPrefix).on('resize.linker' + self.listIdPrefix, function () {
                if (!document.body.contains(linkerContainer[0])) {
                    $(window).off('resize.linker' + self.listIdPrefix);
                    return;
                }
                if (self.modelSoal === '1' && !self.editMode) self.drawLinked();
            });

            // Re-draw setelah browser menyelesaikan layouting/font
            setTimeout(function () {
                if (self.modelSoal === '1' && !self.editMode && document.body.contains(linkerContainer[0])) {
                    self.drawLinked();
                }
            }, 60);

            self.triggerResult()
            if (!self.initialize) {
                self.initialize = true
            }
        },

        initTable: function () {
            let self = this
            let dataTable = convertListToTable(self.listKiri, self.listKanan, self.linkeds)
            let table = $('<table id="table-jodohkan' + self.listIdPrefix + '" class="table table-sm table-bordered linker-list"></table>');
            let trs = '';

            $.each(dataTable, function (k, v) {
                if (k === 0) {
                    trs += '<tr class="bg-gray-light">';
                    $.each(v, function (key, val) {
                        if (key === 0) {
                            trs += '<th class="text-bold text-center align-middle">PERNYATAAN</th>';
                        } else {
                            trs += '<th class="kolom align-middle text-center">' + self.convertLinkImage(val) + '</th>';
                        }
                    });
                    trs += '</tr>';
                } else {
                    trs += '<tr>';
                    $.each(v, function (t, i) {
                        if (t === 0) {
                            trs += '<td class="baris align-middle px-2">' + self.convertLinkImage(i) + '</td>';
                        } else {
                            const selected = i === '1';
                            const checked = selected ? ' checked' : '';
                            const type = self.tipeSoal !== '2' ? 'checkbox' : 'radio';
                            trs += '<td class="align-middle text-center">';
                            if (self.viewMode === '1') {
                                trs += selected ? '✔' : ''
                            } else {
                                const mx = self.maxJawaban && self.maxJawaban[k] ? self.maxJawaban[k] : '20'
                                trs += '<input class="check' + self.listIdPrefix + '" type="' + type +
                                    '" data-max="' + mx + '" name="check' + k +
                                    '" style="height: 20px; width: 20px"' + checked + '>';
                            }
                            trs += '</td>';
                        }
                    });
                    trs += '</tr>';
                }
            });
            table.append($(trs))

            let divResponsive =$('<div class="table-responsive"></div>')
            divResponsive.append(table)

            $(self.cardBody).append(divResponsive)

            if (self.viewMode !== '1') {
                $('.check' + self.listIdPrefix).click(function (e) {
                    var row = $(e.target).closest('tr');
                    var isChecked = $(row).find("input:checked");
                    var max = $(this).data('max');
                    if (isChecked.length > max) {
                        $(this).prop('checked', !$(this).prop('checked'));
                        self.offsetMax = max
                    } else {
                        self.offsetMax = '0'
                    }
                    self.triggerResult()
                })
            }
            self.showDialog(false)

            self.triggerResult()
            if (!self.initialize) {
                self.initialize = true
            }

        },

        initEdit: function () {
            let self = this
            let linkerContainer = $('<div class="d-flex flex-row flex-fill editor-list justify-content-between"></div>');

            let contKiri = $(templates.kiriContainer)
            contKiri.attr('data-id', 'editor-kiri' + self.listIdPrefix)
            let lastKeyKiri = 0
            //console.log('kiri', self.dataEditor)
            self.dataEditor.kiri.forEach(function (kr, idx) {
                lastKeyKiri = idx + 1
                let div = $('<div></div>');
                div.attr('data-id', 'item' + kr.key + self.listIdPrefix);
                div.addClass('col my-2 item-kiri py-1 px-2');
                let edittext = $('<textarea data-id="' + kr.key + '" class="kiri summernote-editor' + self.listIdPrefix + '">' + self.convertLinkImage(kr.value) + '</textarea>');
                div.append(edittext)
                contKiri.append(div)
            })
            contKiri.append($('<button type="button" class="btn btn-sm btn-outline-primary hapus mt-1" data-id="tambah-kiri' + self.listIdPrefix + '"><i class="fa fa-plus me-1"></i>Tambah Baris</button>'))
            linkerContainer.append(contKiri)

            let contKanan = $(templates.kananContainer)
            contKanan.attr('data-id', 'editor-kanan' + self.listIdPrefix)
            let lastKeyKanan = 0
            self.dataEditor.kanan.forEach(function (kn, idx) {
                lastKeyKanan = idx
                let div = $('<div></div>');
                div.attr('data-id', 'item' + kn.key + self.listIdPrefix);
                div.addClass('col my-2 item-kanan py-1 px-2');
                let edittext = $('<textarea data-id="' + kn.key + '" class="kanan summernote-editor' + self.listIdPrefix + '">' + self.convertLinkImage(kn.value) + '</textarea>');
                div.append(edittext)
                contKanan.append(div)
            })
            contKanan.append($('<button type="button" class="btn btn-sm btn-outline-primary hapus mt-1" data-id="tambah-kanan' + self.listIdPrefix + '"><i class="fa fa-plus me-1"></i>Tambah Kolom</button>'))
            linkerContainer.append(contKanan)
            let editorResponsive = $('<div class="table-responsive"></div>');
            editorResponsive.append(linkerContainer);
            $(self.cardBody).append(editorResponsive)

            initSummernote()
            let btnAddKiri = $(`button[data-id="tambah-kiri${self.listIdPrefix}"]`);
            let btnAddKanan = $(`button[data-id="tambah-kanan${self.listIdPrefix}"]`);

            btnAddKiri.click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                lastKeyKiri += 1
                let div = $('<div></div>');
                div.attr('data-id', 'item' + lastKeyKiri + self.listIdPrefix);
                div.addClass('col my-2 item-kiri py-1 px-2');
                let edittext = $('<textarea data-id="' + lastKeyKiri + '" class="kiri summernote-editor' + self.listIdPrefix + '"></textarea>');
                div.append(edittext)

                div.insertBefore(btnAddKiri);
                initSummernote()
            })

            const alpha = Array.from(Array(26)).map((e, i) => i + 65);
            const alphabet = alpha.map((x) => String.fromCharCode(x));
            btnAddKanan.click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                lastKeyKanan += 1
                let div = $('<div></div>');
                div.attr('data-id', 'item' + alphabet[lastKeyKanan] + self.listIdPrefix);
                div.addClass('col my-2 item-kanan py-1 px-2');
                let edittext = $('<textarea data-id="' + alphabet[lastKeyKanan] + '" class="kanan summernote-editor' + self.listIdPrefix + '"></textarea>');
                div.append(edittext)
                div.insertBefore(btnAddKanan);
                initSummernote()
            })
            self.showDialog(false)

            function initSummernote() {
                let HelloButton = function (context) {
                    let ui = $.summernote.ui;
                    let button = ui.button({
                        contents: '<i class="card-tools fa fa-times"/>',
                        tooltip: 'Hapus',
                        click: function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            e.stopImmediatePropagation();
                            const key = $(this).closest('.col')
                            const data = {
                                element: key,
                                item: $(key).hasClass('item-kiri') ? 'baris' : 'kolom',
                                id: key.attr('data-id')
                            }
                            self.showDialog(true, false, data)
                        }
                    });
                    return button.render();
                };

                $('.summernote-editor' + self.listIdPrefix).summernote({
                    placeholder: 'Tulis Jawaban disini',
                    tabsize: 2,
                    minHeight: 50,
                    toolbar: [
                        ['font', ['bold', 'italic', 'underline']],
                        ['color', ['color']],
                        ['insert', ['picture', 'math']],
                        ['view', ['codeview']],
                        ['delete', ['hapus']]
                    ],
                    buttons: {
                        hapus: HelloButton
                    },
                });
            }
        },

        getKiriColorIdx: function (key) {
            const idx = this.listKiri.findIndex(function (o) {
                return String(o.key) === String(key);
            });
            const safeIdx = idx >= 0 ? idx : 0;
            return (safeIdx % (colorsLine.length - 1)) + 1;
        },

        getKananColorIdx: function (key) {
            const idx = this.listKanan.findIndex(function (o) {
                return String(o.key) === String(key);
            });
            const safeIdx = idx >= 0 ? idx : 0;
            return (safeIdx % (colorsLine.length - 1)) + 1;
        },

        getCanvasMetrics: function () {
            if (!this.canvas) return null;
            const rect = this.canvas.getBoundingClientRect();
            if (!rect.width || !rect.height) return null;
            return {
                rect: rect,
                scaleX: this.canvas.width / rect.width,
                scaleY: this.canvas.height / rect.height
            };
        },

        getItemAnchor: function ($el) {
            const m = this.getCanvasMetrics();
            if (!m || !$el || !$el.length) return null;
            const r = $el[0].getBoundingClientRect();
            const centerClientY = r.top + (r.height / 2);
            return (centerClientY - m.rect.top) * m.scaleY;
        },

        createPoints: function () {
            let self = this
            self.storedBoxes = [];
            self.storedLines = [];
            self.warnaKiri = {};
            self.warnaKanan = {};

            if (!self.canvas || !self.ctx) {
                self.applyColor();
                return;
            }

            // Hitung jumlah garis yang masuk ke tiap item kanan agar titik masuk tidak menumpuk di satu koordinat
            const incomingCounts = {};
            const incomingCursor = {};
            self.listKiri.forEach(function (kr) {
                const linked = self.linkeds[kr.key];
                if (Array.isArray(linked)) {
                    linked.forEach(function (ln) {
                        if (ln && ln.length) {
                            incomingCounts[ln] = (incomingCounts[ln] || 0) + 1;
                        }
                    });
                }
            });

            self.listKiri.forEach(function (kr, idx) {
                const div = $('#item' + kr.key + self.listIdPrefix);
                const kiriY = self.getItemAnchor(div);
                if (kiriY === null) return;

                const colorIdx = self.getKiriColorIdx(kr.key);
                const strokeColor = colorsLine[colorIdx];
                const linked = self.linkeds[kr.key];

                if (Array.isArray(linked) && linked.length > 0) {
                    const box = {
                        key: kr.key,
                        color: strokeColor,
                        rectBoxX: 0,
                        rectBoxY: kiriY - 5,
                        lineMove: 8,
                        lineTo: 16,
                        lineY: kiriY,
                    };
                    self.storedBoxes.push(box);

                    const pointKiriX = 16;
                    linked.forEach(function (ln) {
                        if (ln && ln.length) {
                            const div2 = $('#item' + ln + self.listIdPrefix);
                            const baseKananY = self.getItemAnchor(div2);
                            if (baseKananY === null) return;

                            const totalIn = incomingCounts[ln] || 1;
                            const curIdx = incomingCursor[ln] || 0;
                            incomingCursor[ln] = curIdx + 1;
                            const spread = totalIn > 1 ? Math.min(8, Math.max(4, Math.floor((div2[0].getBoundingClientRect().height * 0.45) / totalIn))) : 0;
                            const kananY = baseKananY + ((curIdx - (totalIn - 1) / 2) * spread);

                            const box2 = {
                                key: ln,
                                color: strokeColor,
                                rectBoxX: self.canvasWidth - 8,
                                rectBoxY: kananY - 5,
                                lineMove: self.canvasWidth - 16,
                                lineTo: self.canvasWidth - 8,
                                lineY: kananY,
                            };
                            self.storedBoxes.push(box2);

                            const stoke = {
                                key: kr.key + '' + ln,
                                color: strokeColor,
                                lineMoveX: pointKiriX,
                                lineMoveY: kiriY,
                                lineToX: self.canvasWidth - 16,
                                lineToY: kananY
                            };
                            self.storedLines.push(stoke);
                        }
                    });

                    self.warnaKiri[kr.key] = colorIdx;
                    linked.forEach(function (v) {
                        if (!self.warnaKanan[v]) self.warnaKanan[v] = [];
                        self.warnaKanan[v].push(colorIdx);
                    });
                }
            });

            self.applyColor()
            self.redraw()
        },

        drawLinked: function () {
            let self = this

            const tKiri = $("#list-kiri" + self.listIdPrefix);
            const hKiri = tKiri.length ? (tKiri[0].scrollHeight || tKiri.outerHeight() || 0) : 0;
            const tKanan = $("#list-kanan" + self.listIdPrefix);
            const hKanan = tKanan.length ? (tKanan[0].scrollHeight || tKanan.outerHeight() || 0) : 0;

            const canv = $("#col-canvas" + self.listIdPrefix);
            const selCanvas = $("#canvas" + self.listIdPrefix);
            if (canv.length && selCanvas.length) {
                const w = Math.max(60, Math.round(canv[0].clientWidth || canv.outerWidth() || 100));
                const h = Math.max(60, Math.round(Math.max(hKiri, hKanan)));
                self.canvasWidth = w;
                self.canvas = selCanvas[0];
                self.ctx = self.canvas.getContext("2d");
                selCanvas.attr("width", w);
                selCanvas.attr("height", h);
                selCanvas.css({
                    'display': 'block',
                    'width': w + 'px',
                    'height': h + 'px'
                });

                const rect = self.canvas.getBoundingClientRect();
                self.offsetX = rect.left;
                self.offsetY = rect.top;

                self.createPoints()
            }
        },

        handleClick: function () {
            let self = this
            let typeOpsi = $(`select[data-id="type-opsi${self.listIdPrefix}"]`);
            let btnEdit = $(`button[data-id="btn-edit${self.listIdPrefix}"]`);
            let btnOk = $(`button[data-id="btn-ok${self.listIdPrefix}"]`);
            let switchList = $(`button[data-id="switch-list${self.listIdPrefix}"]`);
            let switchTable = $(`button[data-id="switch-table${self.listIdPrefix}"]`);

            switchList.click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                //self.triggerResult()
                const converted = convertDefaultToList(self.getResult())
                self.listKiri = converted.kiri
                self.listKanan = converted.kanan
                self.linkeds = converted.linked

                self.modelSoal = '1';
                switchList.toggleClass('active', self.modelSoal === '1')
                switchTable.toggleClass('active', self.modelSoal === '2')
                if ($(self.cardBody).children().length > 1) {
                    $(self.cardBody).children()[1].remove()
                }

                self.initList()
            })

            switchTable.click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                self.modelSoal = '2';
                //self.triggerResult()

                switchList.toggleClass('active', self.modelSoal === '1')
                switchTable.toggleClass('active', self.modelSoal === '2')
                if ($(self.cardBody).children().length > 1) {
                    $(self.cardBody).children()[1].remove()
                }
                self.initTable()
            })

            btnEdit.click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                self.showDialog(true, true)
                setTimeout(function () {
                    self.editMode = true
                    btnEdit.addClass('d-none')
                    btnOk.removeClass('d-none')
                    switchList.attr('disabled', 'disabled')
                    switchTable.attr('disabled', 'disabled')
                    typeOpsi.attr('disabled', 'disabled')
                    const res = self.getResult();
                    const converted = convertDefaultToList(res)
                    self.dataEditor['kiri'] = converted.kiri
                    self.dataEditor['kanan'] = converted.kanan
                    //self.linkeds = converted.linked
                    if ($(self.cardBody).children().length > 1) {
                        $(self.cardBody).children()[1].remove()
                    }
                    self.initEdit()
                }, 200)
            })

            btnOk.click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                self.showDialog(true, true)
                setTimeout(function () {
                    self.saveEditor()
                    self.editMode = false
                    btnEdit.removeClass('d-none')
                    btnOk.addClass('d-none')
                    switchList.removeAttr('disabled')
                    switchTable.removeAttr('disabled')
                    typeOpsi.removeAttr('disabled')
                    if ($(self.cardBody).children().length > 1) {
                        $(self.cardBody).children()[1].remove()
                    }
                    if (self.modelSoal === '1') self.initList()
                    else self.initTable()
                }, 200)
            })

            typeOpsi.on('change', function () {
                if (self.modelSoal === '2') {
                    if ($(this).val() === '2') {
                        $('.check' + self.listIdPrefix).attr('type', 'radio');
                    } else {
                        $('.check' + self.listIdPrefix).attr('type', 'checkbox');
                    }
                }
                self.tipeSoal = $(this).val()
                self.triggerResult()
            });
        },

        applyColor: function () {
            let self = this
            self.listKiri.forEach(function (kr) {
                const cIdx = self.warnaKiri[kr.key];
                const css = cIdx ? {
                    'background-color': colorsBg[cIdx],
                    'border': '1px solid ' + colorsLine[cIdx],
                    'box-shadow': 'none'
                } : {
                    'background-color': colorsBg[0],
                    'border': '1px solid ' + colorsLine[0],
                    'box-shadow': 'none'
                };
                $(`#item${kr.key + self.listIdPrefix}`).css(css);
            });
            self.listKanan.forEach(function (kn, idx) {
                let css;
                if (self.warnaKanan[kn.key] && self.warnaKanan[kn.key].length > 0) {
                    let colors = self.warnaKanan[kn.key];
                    let grad = 'to right';
                    const percent = 100 / colors.length;
                    let postLine = colors[colors.length - 1];
                    $.each(colors, function (i, c) {
                        postLine = c
                        grad += ', ' + colorsBg[c] + ' ' + percent * i + '%, ' + colorsBg[c] + ' ' + percent * (i + 1) + '%';
                    });
                    css = {
                        'background-color': colorsBg[postLine],
                        'background-image': 'linear-gradient(' + grad + ')',
                        'border': '1px solid ' + colorsLine[postLine],
                        'box-shadow': 'none'
                    }
                } else {
                    css = {
                        'background-color': colorsBg[0],
                        'background-image': 'linear-gradient(' + colorsBg[0] + ',' + colorsBg[0] + ')',
                        'border': '1px solid ' + colorsLine[0],
                        'box-shadow': 'none'
                    }
                }
                $(`#item${kn.key + self.listIdPrefix}`).css(css)
            })
        },

        redraw: function () {
            let self = this
            self.ctx.clearRect(0, 0, self.canvas.width, self.canvas.height);
            if (self.storedLines.length === 0 && self.storedBoxes.length === 0) {
                return;
            }

            self.storedBoxes.forEach(function (box) {
                self.ctx.beginPath();
                self.ctx.rect(box.rectBoxX, box.rectBoxY, 8, 10);
                self.ctx.fillStyle = box.color;
                self.ctx.fill();

                self.ctx.beginPath();
                self.ctx.moveTo(box.lineMove, box.lineY);
                self.ctx.lineTo(box.lineTo, box.lineY);
                self.ctx.lineWidth = 2;
                self.ctx.strokeStyle = box.color;
                self.ctx.stroke();
            })

            self.storedLines.forEach(function (line) {
                self.ctx.beginPath();
                self.ctx.moveTo(line.lineMoveX, line.lineMoveY);
                self.ctx.lineTo(line.lineToX, line.lineToY);
                self.ctx.strokeStyle = line.color;
                self.ctx.lineWidth = 2;
                self.ctx.lineCap = 'round';
                self.ctx.stroke();
            })
        },

        handleMouseMove: function (e) {
            let self = this
            if (!self.clicked || !self.canvas || !self.ctx) {
                return;
            }
            const m = self.getCanvasMetrics();
            if (!m) return;
            self.redraw()

            self.mouseX = (e.clientX - m.rect.left) * m.scaleX;
            self.mouseY = (e.clientY - m.rect.top) * m.scaleY;

            const cIdx = self.activeSide === 'kanan' ? self.getKananColorIdx(self.idActive) : self.getKiriColorIdx(self.idActive);
            self.ctx.beginPath();
            self.ctx.moveTo(self.startX, self.startY);
            self.ctx.lineTo(self.mouseX, self.mouseY);
            self.ctx.strokeStyle = colorsLine[cIdx];
            self.ctx.lineWidth = 2;
            self.ctx.lineCap = 'round';
            self.ctx.stroke()
        },

        arrayRemove: function (arr, value) {
            return arr.filter(function (it) {
                return it !== value;
            });
        },

        getResult: function () {
            let self = this
            //console.log('modelSoal', self.modelSoal)
            if (self.modelSoal === '2') {
                let arrEmpty = []
                let res = $(`#table-jodohkan${self.listIdPrefix} tr`).get().map(function (row) {
                    var $tables = [];
                    $(row).find('th').get().map(function (cell) {
                        const klm = $(cell).html();
                        $tables.push(klm);
                    });

                    let ar = []
                    $(row).find('td').get().map(function (cell) {
                        if ($(cell).children('input').length > 0) {
                            const val = $(cell).find('input').prop("checked") === true ? "1" : "0"
                            $tables.push(val);
                            if (val === "1") ar.push(val)
                        } else {
                            $tables.push($(cell).html())
                        }
                    });
                    arrEmpty.push(ar.length > 0 ? 1 : 0)
                    return $tables
                })
                arrEmpty.shift()
                //console.log('links1', arrEmpty)
                self.hasLinks = arrEmpty.includes(1)
                return res;
            } else {
                let arrEmpty = []
                $.each(self.linkeds, function( key, value ) {
                    if (key) {
                        arrEmpty.push(value.length > 0 ? 1 : 0)
                    }
                });
                //console.log('links2', arrEmpty)
                self.hasLinks = arrEmpty.includes(1)
                return convertListToTable(self.listKiri, self.listKanan, self.linkeds)
            }
        },

        getKeyLinked: function () {
            let self = this
            let links;
            if (self.modelSoal === '2') {
                const converted = convertDefaultToList(self.getResult())
                links = converted.linked
            } else {
                links = self.linkeds
            }
            return links
        },

        saveEditor: function () {
            let self = this
            const $summernotes = $('.summernote-editor' + self.listIdPrefix)

            let kiri = []
            let kanan = []
            $.each($summernotes, function (idx, summ) {
                const key = $(this).data('id')
                const val = $(this).summernote('code')
                let obj = {}
                obj['key'] = key + ''
                obj['value'] = val
                if ($(this).hasClass('kiri')) {
                    kiri.push(obj)
                } else {
                    kanan.push(obj)
                }
            })
            const validKiri = new Set(kiri.map(function (o) { return String(o.key); }));
            const validKanan = new Set(kanan.map(function (o) { return String(o.key); }));
            const preservedLinks = {};
            Object.keys(self.linkeds || {}).forEach(function (k) {
                if (validKiri.has(String(k)) && Array.isArray(self.linkeds[k])) {
                    preservedLinks[k] = self.linkeds[k].filter(function (v) {
                        return validKanan.has(String(v));
                    });
                }
            });
            self.listKiri = kiri
            self.listKanan = kanan
            self.linkeds = preservedLinks
            self.warnaKanan = {}
            self.warnaKiri = {}
        },

        showDialog: function (show, loading, data) {
            let self = this
            self.overlay.html('')
            if (!show) {
                self.overlay.addClass('d-none')
            } else {
                let content;
                let idHapus = '0'
                let item;
                if (loading) {
                    content = $('<div class="spinner-grow"></div>')
                } else {
                    const id = data.id
                    item = data.item
                    idHapus = id.split('-')[0].replace('item', '')
                    content = '<div class="card border card' + self.listIdPrefix + '">' +
                        '<div class="card-body">Hapus ' + item + ' ' + idHapus + '?</div>' +
                        '<div class="card-footer"><button class="btn text-info btn-cancel">Batal</button><button class="btn btn-outline-danger btn-hapus">Hapus</button></div>' +
                        '</div>'
                }
                self.overlay.append(content)
                self.overlay.removeClass('d-none')

                $('.card' + self.listIdPrefix + ' .btn-cancel').click(function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    self.overlay.html('')
                    self.overlay.addClass('d-none')
                })

                $('.card' + self.listIdPrefix + ' .btn-hapus').click(function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    data.element.remove()
                    self.overlay.html('')
                    self.overlay.addClass('d-none')
                })
            }
        },

        triggerResult: function () {
            let self = this
            if (self.fnc) {
                self.dataResult['type'] = self.tipeSoal
                self.dataResult['model'] = self.modelSoal
                self.dataResult['links'] = self.getKeyLinked()
                self.dataResult['jawaban'] = self.getResult()
                self.fnc(
                    self.idResult,
                    self.dataResult,
                    self.hasLinks,
                    self.offsetMax
                )
            }
        },

        convertLinkImage: function (value) {
            const konten = $('<div>').append($.parseHTML(value));

            konten.find('img').each(function () {
                $(this).removeAttr('alt');
                $(this).css({ 'max-width': '150px' });

                const curSrc = $(this).attr('src');

                // Skip jika gambar base64 atau bukan dari folder uploads
                if (!curSrc || curSrc.includes('base64') || !curSrc.includes('uploads')) return;

                const pathUpload = 'uploads';
                const forReplace = curSrc.split(pathUpload);
                $(this).attr('src', base_url + pathUpload + forReplace[1]);
            });

            return konten.html().trim() || value;
        }
    });

    $.fn[pluginName] = function (options) {
        return this.each(function () {
            const rndm = getRandomInt(1024000000)
            const plugin = "plugin_" + pluginName + rndm
            if (!$.data(this, plugin)) {
                $.data(this, plugin, new LinkerList(this, options));
            }
        });
    };

})(jQuery, window, document);

function convertDefaultToList(array) {
    const alpha = Array.from(Array(26)).map((e, i) => i + 65);
    const alphabet = alpha.map((x) => String.fromCharCode(x));
    let posAlpha = 0;

    var kanan = array.shift();
    let listKiri = []
    $.each(array, function (i, v) {
        const s = v.shift()
        let objKiri = {}
        objKiri['key'] = (i + 1) + ''
        objKiri['value'] = s
        listKiri.push(objKiri)
    });
    kanan.shift();
    let listKanan = []
    $.each(kanan, function (i, v) {
        let objKanan = {}
        objKanan['key'] = alphabet[posAlpha]
        objKanan['value'] = v
        listKanan.push(objKanan)
        posAlpha++;
    });

    let objLink = {}
    $.each(array, function (n, arv) {
        if (!objLink['' + listKiri[n].key]) objLink[listKiri[n].key] = []
        $.each(arv, function (t, v) {
            if (v === '1') {
                objLink['' + listKiri[n].key].push(listKanan[t].key)
            }
        });
    });
    var item = {};
    item['kiri'] = listKiri
    item['kanan'] = listKanan
    item['linked'] = objLink;
    return item;
}

function convertListToTable(kiri, kanan, linked) {
    var listkanan = $.extend(true, [], kanan);
    var listkiri = $.extend(true, [], kiri);

    var arrayres = [];

    $.each(listkiri, function (ind, val) {
        var vv = [];
        for (let i = 0; i < listkanan.length; i++) {
            var sv = '0';
            if (linked[val.key] && linked[val.key].length > 0) {
                sv = linked[val.key].includes(listkanan[i].key) ? '1' : '0'
            }
            vv.push(sv);
        }

        vv.unshift(val.value);
        arrayres.push(vv);
    });
    let arrkanan = ['#']
    $.each(listkanan, function (i, v) {
        arrkanan.push(v.value)
    })
    arrayres.unshift(arrkanan);
    return arrayres
}

