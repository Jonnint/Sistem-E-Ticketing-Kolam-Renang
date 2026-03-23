@extends('admin.layouts.app')
@section('title', 'Scan Tiket')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="grid md:grid-cols-2 gap-4">

        {{-- Scanner --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
            <h3 style="font-family:'Sora',sans-serif; font-weight:600; color:#334155; margin-bottom:16px;">Kamera Scanner</h3>

            {{-- Video container --}}
            <div style="position:relative; background:#0f172a; border-radius:14px; overflow:hidden; aspect-ratio:1/1; margin-bottom:12px;">
                <video id="qr-video" style="width:100%; height:100%; object-fit:cover; display:block;" playsinline autoplay muted></video>

                {{-- Viewfinder overlay --}}
                <div id="viewfinder" style="display:none; position:absolute; inset:0; align-items:center; justify-content:center; pointer-events:none;">
                    {{-- Corner brackets --}}
                    <div style="position:relative; width:160px; height:160px;">
                        <div style="position:absolute; top:0; left:0; width:28px; height:28px; border-top:3px solid #38bdf8; border-left:3px solid #38bdf8; border-radius:4px 0 0 0;"></div>
                        <div style="position:absolute; top:0; right:0; width:28px; height:28px; border-top:3px solid #38bdf8; border-right:3px solid #38bdf8; border-radius:0 4px 0 0;"></div>
                        <div style="position:absolute; bottom:0; left:0; width:28px; height:28px; border-bottom:3px solid #38bdf8; border-left:3px solid #38bdf8; border-radius:0 0 0 4px;"></div>
                        <div style="position:absolute; bottom:0; right:0; width:28px; height:28px; border-bottom:3px solid #38bdf8; border-right:3px solid #38bdf8; border-radius:0 0 4px 0;"></div>
                        {{-- Scan line animation --}}
                        <div id="scan-line" style="position:absolute; left:4px; right:4px; height:2px; background:linear-gradient(90deg, transparent, #38bdf8, transparent); top:50%; animation:scanline 2s ease-in-out infinite;"></div>
                    </div>
                </div>

                {{-- Processing overlay --}}
                <div id="scan-overlay" style="display:none; position:absolute; inset:0; background:rgba(0,0,0,0.6); align-items:center; justify-content:center;">
                    <div style="text-align:center; color:white;">
                        <div style="width:32px; height:32px; border:2px solid white; border-top-color:transparent; border-radius:50%; animation:spin 0.8s linear infinite; margin:0 auto 8px;"></div>
                        <p style="font-size:0.8rem;">Memproses...</p>
                    </div>
                </div>

                {{-- Idle placeholder --}}
                <div id="idle-placeholder" style="position:absolute; inset:0; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#475569;">
                    <svg style="width:48px; height:48px; color:#334155; margin-bottom:8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <p style="font-size:0.8rem; color:#94a3b8;">Klik tombol untuk mulai</p>
                </div>
            </div>

            {{-- Status indicator --}}
            <div id="cam-status" style="display:flex; align-items:center; gap:6px; margin-bottom:10px; min-height:20px;">
                <div id="status-dot" style="width:8px; height:8px; border-radius:50%; background:#cbd5e1; flex-shrink:0;"></div>
                <span id="status-text" style="font-size:0.75rem; color:#94a3b8;">Kamera tidak aktif</span>
            </div>

            <button id="start-btn" onclick="startCamera()"
                    style="width:100%; padding:10px; background:linear-gradient(135deg,#0ea5e9,#0369a1); color:white; border:none; border-radius:12px; font-size:0.875rem; font-weight:600; cursor:pointer; transition:opacity 0.2s;"
                    onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                Mulai Kamera
            </button>
            <button id="stop-btn" onclick="stopCamera()"
                    style="display:none; width:100%; padding:10px; background:#f1f5f9; color:#475569; border:none; border-radius:12px; font-size:0.875rem; font-weight:600; cursor:pointer; transition:background 0.2s;"
                    onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                Stop Kamera
            </button>

            {{-- Manual input --}}
            <div style="margin-top:16px; padding-top:16px; border-top:1px solid #f1f5f9;">
                <p style="font-size:0.75rem; color:#94a3b8; margin-bottom:8px;">Atau masukkan kode tiket manual:</p>
                <div style="display:flex; gap:8px;">
                    <input type="text" id="manual-code" placeholder="TKT-XXXXXXXXXX"
                           style="flex:1; border:1px solid #e2e8f0; border-radius:10px; padding:8px 12px; font-size:0.8rem; font-family:monospace; outline:none; transition:border-color 0.2s;"
                           onfocus="this.style.borderColor='#0ea5e9'; this.style.boxShadow='0 0 0 3px rgba(14,165,233,0.1)'"
                           onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'"
                           onkeydown="if(event.key==='Enter') validateManual()">
                    <button onclick="validateManual()"
                            style="padding:8px 16px; background:#0ea5e9; color:white; border:none; border-radius:10px; font-size:0.8rem; font-weight:600; cursor:pointer; white-space:nowrap;"
                            onmouseover="this.style.background='#0369a1'" onmouseout="this.style.background='#0ea5e9'">Cek</button>
                </div>
            </div>
        </div>

        {{-- Result --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
            <h3 style="font-family:'Sora',sans-serif; font-weight:600; color:#334155; margin-bottom:16px;">Hasil Scan</h3>
            <div id="result-area" style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:260px; text-align:center;">
                <div style="width:64px; height:64px; border-radius:50%; background:#f1f5f9; display:flex; align-items:center; justify-content:center; margin-bottom:12px;">
                    <svg style="width:32px; height:32px; color:#cbd5e1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                </div>
                <p style="color:#94a3b8; font-size:0.875rem;">Arahkan kamera ke QR Code tiket</p>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes scanline {
    0%   { top: 10%; opacity: 1; }
    50%  { top: 85%; opacity: 1; }
    100% { top: 10%; opacity: 1; }
}
@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
<script>
let videoStream = null;
let scanLoopId  = null;   // setTimeout id
let isScanning  = false;
let isProcessing = false;
let canvas = document.createElement('canvas');
let ctx    = canvas.getContext('2d');

function setStatus(text, color) {
    document.getElementById('status-dot').style.background  = color;
    document.getElementById('status-text').style.color      = color;
    document.getElementById('status-text').textContent      = text;
}

function startCamera() {
    setStatus('Meminta izin kamera...', '#f59e0b');

    const constraints = {
        video: {
            facingMode: { ideal: 'environment' },
            width:  { ideal: 1280 },
            height: { ideal: 720 },
        }
    };

    navigator.mediaDevices.getUserMedia(constraints)
        .then(stream => {
            videoStream = stream;
            const video = document.getElementById('qr-video');
            video.srcObject = stream;

            video.onloadedmetadata = () => {
                video.play().then(() => {
                    document.getElementById('idle-placeholder').style.display = 'none';
                    document.getElementById('viewfinder').style.display = 'flex';
                    document.getElementById('start-btn').style.display = 'none';
                    document.getElementById('stop-btn').style.display  = 'block';
                    setStatus('Kamera aktif — arahkan ke QR Code', '#10b981');
                    isScanning = true;
                    scheduleScan();
                });
            };
        })
        .catch(err => {
            console.error(err);
            setStatus('Gagal mengakses kamera', '#ef4444');
            alert('Tidak bisa mengakses kamera.\nPastikan:\n1. Izin kamera sudah diberikan\n2. Halaman diakses via HTTPS atau localhost');
        });
}

function stopCamera() {
    isScanning = false;
    if (scanLoopId) clearTimeout(scanLoopId);
    if (videoStream) videoStream.getTracks().forEach(t => t.stop());
    videoStream = null;

    const video = document.getElementById('qr-video');
    video.srcObject = null;

    document.getElementById('idle-placeholder').style.display = 'flex';
    document.getElementById('viewfinder').style.display       = 'none';
    document.getElementById('start-btn').style.display        = 'block';
    document.getElementById('stop-btn').style.display         = 'none';
    setStatus('Kamera tidak aktif', '#cbd5e1');
}

function scheduleScan() {
    // Throttle: scan every 200ms — cukup responsif, tidak overload CPU
    scanLoopId = setTimeout(doScan, 200);
}

function doScan() {
    if (!isScanning || isProcessing) return;

    const video = document.getElementById('qr-video');

    // Pastikan video benar-benar punya data
    if (video.readyState < 2 || video.videoWidth === 0) {
        scheduleScan();
        return;
    }

    canvas.width  = video.videoWidth;
    canvas.height = video.videoHeight;
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const code = jsQR(imageData.data, imageData.width, imageData.height, {
        inversionAttempts: 'dontInvert',
    });

    if (code && code.data) {
        isProcessing = true;
        setStatus('QR terdeteksi! Memvalidasi...', '#0ea5e9');
        validateCode(code.data);
    } else {
        scheduleScan();
    }
}

function validateManual() {
    const code = document.getElementById('manual-code').value.trim();
    if (!code) {
        document.getElementById('manual-code').focus();
        return;
    }
    isProcessing = true;
    validateCode(code);
}

function validateCode(code) {
    // Show processing overlay
    document.getElementById('scan-overlay').style.display = 'flex';

    fetch('{{ route('admin.scan.validate') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ code }),
    })
    .then(r => r.json().then(data => ({ ok: r.ok, data })))
    .then(({ data }) => {
        document.getElementById('scan-overlay').style.display = 'none';
        showResult(data);

        // Resume scan after 3 seconds
        setTimeout(() => {
            isProcessing = false;
            if (isScanning) {
                setStatus('Kamera aktif — arahkan ke QR Code', '#10b981');
                scheduleScan();
            }
        }, 3000);
    })
    .catch(err => {
        console.error(err);
        document.getElementById('scan-overlay').style.display = 'none';
        showResult({ status: 'invalid', message: 'Terjadi kesalahan jaringan.' });
        isProcessing = false;
        if (isScanning) scheduleScan();
    });
}

function showResult(data) {
    const area = document.getElementById('result-area');

    const cfg = {
        valid:   { bg:'#f0fdf4', border:'#86efac', iconBg:'#dcfce7', iconColor:'#16a34a', titleColor:'#15803d' },
        used:    { bg:'#fffbeb', border:'#fcd34d', iconBg:'#fef3c7', iconColor:'#d97706', titleColor:'#b45309' },
        invalid: { bg:'#fef2f2', border:'#fca5a5', iconBg:'#fee2e2', iconColor:'#dc2626', titleColor:'#b91c1c' },
        reverted:{ bg:'#f0f9ff', border:'#7dd3fc', iconBg:'#e0f2fe', iconColor:'#0369a1', titleColor:'#0369a1' },
    };
    const c = cfg[data.status] || cfg.invalid;

    const svgPaths = {
        valid:    'M5 13l4 4L19 7',
        used:     'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
        invalid:  'M6 18L18 6M6 6l12 12',
        reverted: 'M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6',
    };
    const path = svgPaths[data.status] || svgPaths.invalid;

    // Tombol batal hanya muncul jika scan valid (baru saja di-scan)
    const revertBtn = (data.status === 'valid' && data.ticket)
        ? `<button onclick="revertScan('${data.ticket.code}')"
                   style="margin-top:12px;width:100%;padding:8px;background:white;border:1px solid #fca5a5;color:#dc2626;border-radius:10px;font-size:0.8rem;font-weight:600;cursor:pointer;transition:background 0.2s;"
                   onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='white'">
               ↩ Batalkan Scan Ini
           </button>`
        : '';

    let ticketRows = '';
    if (data.ticket) {
        const t = data.ticket;
        const rows = [
            ['Nama',       t.name],
            ['No. Pesanan',`<span style="font-family:monospace;font-size:0.75rem;">${t.order_number}</span>`],
            ['Kunjungan',  t.visit_date],
            ['Sesi',       t.session],
            ['Jumlah',     t.qty + ' orang'],
        ];
        ticketRows = `<div style="width:100%;margin-top:12px;padding-top:12px;border-top:1px solid #e2e8f0;text-align:left;">
            ${rows.map(([k,v]) => `
            <div style="display:flex;justify-content:space-between;align-items:center;padding:4px 0;font-size:0.8rem;">
                <span style="color:#94a3b8;">${k}</span>
                <span style="color:#1e293b;font-weight:500;">${v}</span>
            </div>`).join('')}
        </div>`;
    }

    area.innerHTML = `
    <div style="width:100%;border-radius:14px;border:1px solid ${c.border};background:${c.bg};padding:20px;text-align:center;">
        <div style="width:52px;height:52px;border-radius:50%;background:${c.iconBg};display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
            <svg style="width:26px;height:26px;color:${c.iconColor};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="${path}"/>
            </svg>
        </div>
        <p style="font-weight:700;color:${c.titleColor};font-size:0.95rem;">${data.message}</p>
        ${ticketRows}
        ${revertBtn}
    </div>`;
}

function revertScan(code) {
    if (!confirm('Batalkan scan tiket ini?\nStatus tiket akan kembali ke "belum digunakan".')) return;

    fetch('{{ route('admin.scan.revert') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ code }),
    })
    .then(r => r.json())
    .then(data => {
        showResult(data);
        // Langsung resume scan setelah revert
        isProcessing = false;
        if (isScanning) {
            setStatus('Kamera aktif — arahkan ke QR Code', '#10b981');
            scheduleScan();
        }
    })
    .catch(() => {
        showResult({ status: 'invalid', message: 'Gagal membatalkan scan. Coba lagi.' });
    });
}
</script>
@endpush
