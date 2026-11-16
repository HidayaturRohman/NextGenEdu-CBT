var adaJadwalUjian = window.adaJadwalUjian || localStorage.getItem('nextgenCBT.ada_jadwal_ujian');
if (adaJadwalUjian === null || adaJadwalUjian === undefined) {
    adaJadwalUjian = localStorage.getItem('garudaCBT.ada_jadwal_ujian');
}
if (adaJadwalUjian === null || adaJadwalUjian === undefined) {
    adaJadwalUjian = '1';
    localStorage.setItem('nextgenCBT.ada_jadwal_ujian', adaJadwalUjian);
}
window.adaJadwalUjian = adaJadwalUjian;

var timerToken, timerUpdate;
var timerTokenRemaining, timerTokenOnGoing;
var forceGenerate = 0;
var timeOffset;
var isGeneratingToken = false;

$(document).ready(function () {
    // Hanya jalankan polling token di halaman yang memiliki elemen tampilan token (Admin/Guru/Staff)
    if ($('#token-view').length || $('#interval').length || $('#token-input').length) {
        loadTokenFromServer();
    }
});

function loadTokenFromServer() {
    $.ajax({
        url: base_url + "cbttoken/loadtoken",
        type: "GET",
        success: function (response) {
            if (!response || !response.token) return;
            globalToken = response;
            window.globalToken = response;
            if (response.ada_ujian !== undefined) {
                adaJadwalUjian = response.ada_ujian;
                window.adaJadwalUjian = adaJadwalUjian;
                localStorage.setItem('nextgenCBT.ada_jadwal_ujian', adaJadwalUjian);
            }
            localStorage.setItem('nextgenCBT.token', JSON.stringify(response));
            createIntervalToken();
        },
        error: function (xhr, status, error) {
            console.log(xhr);
        }
    });
}

function createIntervalToken() {
    const tokenObj = window.globalToken || (typeof globalToken !== 'undefined' ? globalToken : null);
    if (!tokenObj) return;
    const durasi = Number(tokenObj.jarak) || 15;
    const perdetik = 1000;
    const permenit = 60 * perdetik;
    const perjam = 60 * permenit;
    const t_dur = durasi * (1000 * 60);

    let updatedStr = String(tokenObj.updated || '').replace(/\s+/, 'T');
    let updated = updatedStr ? new Date(updatedStr) : new Date();
    if (isNaN(updated.getTime())) updated = new Date();

    let nowStr = String(tokenObj.now || '').replace(/\s+/, 'T');
    let time_s = nowStr ? new Date(nowStr) : new Date();
    if (isNaN(time_s.getTime())) time_s = new Date();

    let time_c = new Date();
    let diff = time_s - time_c;

    updateViews();

    function updateViews() {
        if (timerToken) {
            clearTimeout(timerToken);
            timerToken = null;
        }
        let now = new Date();
        now.setMilliseconds(now.getMilliseconds() + diff);
        var rem = now.getTime() - updated.getTime();
        const t_remaining = t_dur - rem;

        const viewTimer = $('#interval');
        const inputToken = $('#token-input');
        if (inputToken.length && tokenObj.token) inputToken.val(tokenObj.token);

        const viewToken = $('#token-view');
        if (viewToken.length && tokenObj.token) viewToken.text(tokenObj.token);

        const infoTimer = $('#info-interval');

        if (tokenObj.auto == '1') {
            if (infoTimer.length) infoTimer.removeClass('d-none');
            if (viewTimer.length) viewTimer.removeClass('d-none');
            if (t_remaining < 0) {
                if (viewTimer.length) viewTimer.html('Membuat token...');
                generateToken();
            } else {
                const r_jam = Math.floor(t_remaining / perjam);
                const r_mnt = Math.floor((t_remaining % perjam) / permenit);
                const r_dtk = Math.floor((t_remaining % permenit) / perdetik);

                timerTokenRemaining = zeroPad(r_jam) + ':' + zeroPad(r_mnt) + ':' + zeroPad(r_dtk);
                if (viewTimer.length) viewTimer.html(timerTokenRemaining);
                if (typeof updateQrModalToken === 'function') {
                    updateQrModalToken(tokenObj.token, timerTokenRemaining);
                }
                timerToken = setTimeout(updateViews, 1000);
            }
        } else {
            if (infoTimer.length) infoTimer.addClass('d-none');
            if (viewTimer.length) viewTimer.addClass('d-none');
        }
    }
}

function zeroPad(no) {
    return no < 10 ? '0' + no : no;
}

function generateToken() {
    if (isGeneratingToken) return;
    isGeneratingToken = true;
    if (typeof ajaxcsrf === 'function') ajaxcsrf();
    $.ajax({
        url: base_url + "cbttoken/generatetoken",
        type: "POST",
        data: {
            force: forceGenerate
        },
        success: function (response) {
            isGeneratingToken = false;
            if (!response || !response.token) return;
            console.log('tokenResult', response);
            localStorage.setItem('nextgenCBT.token', JSON.stringify(response));
            globalToken = response;
            window.globalToken = response;
            if (response.ada_ujian !== undefined) {
                adaJadwalUjian = response.ada_ujian;
                window.adaJadwalUjian = adaJadwalUjian;
                localStorage.setItem('nextgenCBT.ada_jadwal_ujian', adaJadwalUjian);
            }
            $('#token-view').text(response.token);
            createIntervalToken();
        },
        error: function (xhr, status, error) {
            isGeneratingToken = false;
            console.log(xhr);
            setTimeout(loadTokenFromServer, 5000);
        }
    });
}