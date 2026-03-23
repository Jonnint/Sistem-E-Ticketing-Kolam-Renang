<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #ffffff;
        color: #1a202c;
        font-size: 12px;
        width: 100%;
    }

    /* ── WRAPPER ── */
    .ticket {
        width: 100%;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
    }

    /* ── HEADER ── */
    .header {
        background: #0369a1;
        padding: 20px 24px 18px;
        color: #fff;
    }
    .header-row {
        width: 100%;
        display: table;
        margin-bottom: 14px;
    }
    .header-brand {
        display: table-cell;
        vertical-align: middle;
    }
    .brand-name {
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 0.3px;
        color: #fff;
    }
    .brand-sub {
        font-size: 9px;
        color: rgba(255,255,255,0.75);
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-top: 2px;
    }
    .header-badge {
        display: table-cell;
        vertical-align: middle;
        text-align: right;
    }
    .badge {
        display: inline-block;
        background: rgba(255,255,255,0.20);
        border: 1px solid rgba(255,255,255,0.35);
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #fff;
    }
    .order-num {
        font-size: 20px;
        font-weight: 700;
        color: #fff;
        letter-spacing: 1px;
        margin-bottom: 3px;
    }
    .order-meta {
        font-size: 9px;
        color: rgba(255,255,255,0.75);
    }

    /* ── ZIGZAG ── */
    .zigzag {
        height: 12px;
        background: #fff;
        position: relative;
    }
    .zigzag-top {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 12px;
        background: #0369a1;
    }

    /* ── BODY ── */
    .body {
        padding: 20px 24px 16px;
        background: #fff;
    }
    .body-table {
        width: 100%;
        display: table;
        border-collapse: collapse;
    }
    .col-left {
        display: table-cell;
        width: 58%;
        vertical-align: top;
        padding-right: 16px;
    }
    .col-right {
        display: table-cell;
        width: 42%;
        vertical-align: top;
        border-left: 2px dashed #cbd5e1;
        padding-left: 16px;
        text-align: center;
    }

    .section-label {
        font-size: 8px;
        font-weight: 700;
        color: #94a3b8;
        letter-spacing: 2px;
        text-transform: uppercase;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 5px;
        margin-bottom: 10px;
    }

    .row {
        width: 100%;
        display: table;
        margin-bottom: 7px;
    }
    .lbl {
        display: table-cell;
        width: 40%;
        color: #94a3b8;
        font-size: 10px;
        vertical-align: top;
    }
    .val {
        display: table-cell;
        color: #1e293b;
        font-size: 11px;
        font-weight: 700;
        vertical-align: top;
    }

    .total-box {
        margin-top: 14px;
        background: #f0f9ff;
        border: 1px solid #bae6fd;
        border-radius: 8px;
        padding: 10px 12px;
        display: table;
        width: 100%;
    }
    .total-lbl {
        display: table-cell;
        font-size: 10px;
        font-weight: 700;
        color: #0369a1;
    }
    .total-val {
        display: table-cell;
        text-align: right;
        font-size: 16px;
        font-weight: 700;
        color: #0369a1;
    }

    /* QR side */
    .qr-img {
        width: 130px;
        height: 130px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        margin: 0 auto 8px;
        display: block;
    }
    .ticket-code {
        font-size: 9px;
        font-weight: 700;
        color: #0369a1;
        letter-spacing: 1px;
        word-break: break-all;
        margin-bottom: 4px;
    }
    .scan-hint {
        font-size: 9px;
        color: #94a3b8;
        margin-bottom: 10px;
    }
    .status-pill {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .pill-unused { background: #dcfce7; color: #166534; }
    .pill-used   { background: #fee2e2; color: #991b1b; }

    /* ── FOOTER ── */
    .footer {
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        padding: 10px 24px;
        display: table;
        width: 100%;
    }
    .foot-l {
        display: table-cell;
        font-size: 9px;
        color: #94a3b8;
        vertical-align: middle;
    }
    .foot-r {
        display: table-cell;
        text-align: right;
        font-size: 9px;
        color: #94a3b8;
        vertical-align: middle;
    }
</style>
</head>
<body>

<div class="ticket">

    {{-- HEADER --}}
    <div class="header">
        <div class="header-row">
            <div class="header-brand">
                <div class="brand-name">&#127754; Putri Duyung Waterboom</div>
                <div class="brand-sub">Sawangan &middot; Depok</div>
            </div>
            <div class="header-badge">
                <span class="badge">E-Ticket</span>
            </div>
        </div>
        <div class="order-num">{{ $order->order_number }}</div>
        <div class="order-meta">
            Diterbitkan: {{ $order->created_at->format('d M Y, H:i') }} WIB
            &nbsp;&middot;&nbsp;
            @if($order->status === 'paid') Lunas
            @elseif($order->status === 'pending_cash') Menunggu Bayar di Tempat
            @else {{ ucfirst($order->status) }}
            @endif
        </div>
    </div>

    {{-- BODY --}}
    <div class="body">
        <div class="body-table">

            {{-- LEFT --}}
            <div class="col-left">
                <div class="section-label">Detail Kunjungan</div>

                <div class="row">
                    <div class="lbl">Nama Pemesan</div>
                    <div class="val">{{ $order->name }}</div>
                </div>
                <div class="row">
                    <div class="lbl">No. WhatsApp</div>
                    <div class="val">+62{{ $order->phone }}</div>
                </div>
                <div class="row">
                    <div class="lbl">Tanggal</div>
                    <div class="val">{{ $order->visit_date->format('l, d M Y') }}</div>
                </div>
                <div class="row">
                    <div class="lbl">Sesi</div>
                    <div class="val">{{ $order->session_label }}</div>
                </div>
                <div class="row">
                    <div class="lbl">Jenis Tiket</div>
                    <div class="val" style="text-transform:capitalize">{{ $order->ticket_type }}</div>
                </div>
                <div class="row">
                    <div class="lbl">Dewasa</div>
                    <div class="val">{{ $order->qty_adult }} tiket</div>
                </div>
                <div class="row">
                    <div class="lbl">Anak-anak</div>
                    <div class="val">{{ $order->qty_child }} tiket</div>
                </div>
                <div class="row">
                    <div class="lbl">Metode Bayar</div>
                    <div class="val">{{ $order->payment_method === 'cash' ? 'Bayar di Tempat' : 'Online' }}</div>
                </div>

                <div class="total-box">
                    <div class="total-lbl">Total Pembayaran</div>
                    <div class="total-val">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="col-right">
                <div class="section-label">Tiket Masuk</div>

                @if($ticket)
                <div class="ticket-code" style="font-size:13px; margin-top:20px; word-break:break-all;">{{ $ticket->code }}</div>
                <div class="scan-hint">Tunjukkan kode ini di pintu masuk</div>
                <span class="status-pill {{ $ticket->status === 'used' ? 'pill-used' : 'pill-unused' }}">
                    {{ $ticket->status === 'used' ? 'Sudah Digunakan' : 'Belum Digunakan' }}
                </span>
                @else
                <div style="margin-top:20px; color:#94a3b8; font-size:10px;">
                    QR tersedia setelah<br>pembayaran dikonfirmasi.
                </div>
                @endif
            </div>

        </div>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <div class="foot-l">Jl. Bungsan No. 50, Sawangan, Depok &nbsp;&middot;&nbsp; Buka 08.00 &ndash; 17.00 WIB</div>
        <div class="foot-r">Dicetak: {{ now()->format('d M Y') }}</div>
    </div>

</div>

</body>
</html>
