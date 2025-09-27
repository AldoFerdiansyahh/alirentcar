<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penyewaan #{{ $penyewaan->id }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; color: #333; }
        .page { background: white; width: 21cm; min-height: 29.7cm; padding: 2cm; margin: 1cm auto; border: 1px solid #D1D1D1; box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); }
        .header { text-align: center; border-bottom: 2px solid #eee; padding-bottom: 20px; margin-bottom: 30px; }
        .header img { height: 50px; }
        .header h1 { margin: 10px 0 5px; font-size: 24px; color: #000; }
        .header p { margin: 0; font-size: 14px; color: #555; }
        .details-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px; }
        .details-section h2 { font-size: 16px; border-bottom: 1px solid #eee; padding-bottom: 8px; margin-top: 0; }
        .details-section table { width: 100%; border-collapse: collapse; }
        .details-section th, .details-section td { text-align: left; padding: 8px 0; vertical-align: top; }
        .details-section th { width: 40%; }
        .summary-table { width: 100%; margin-top: 30px; border-top: 2px solid #333; }
        .summary-table td { padding: 15px 0; }
        .summary-table .total { font-size: 20px; font-weight: bold; }
        .footer { text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; font-size: 12px; color: #777; }
        .print-button { display: block; width: 150px; margin: 20px auto; padding: 10px; background-color: #007bff; color: white; text-align: center; text-decoration: none; border-radius: 5px; cursor: pointer; }
        @media print {
            body { background-color: white; }
            .page { margin: 0; border: none; box-shadow: none; width: auto; min-height: auto;}
            .print-button { display: none; }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <h1>Struk Penyewaan Mobil</h1>
            <p>ID Pesanan: #{{ $penyewaan->id }} | Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
        </div>

        <a href="javascript:window.print()" class="print-button">Cetak Halaman Ini</a>

        <div class="details-grid">
            <div class="details-section">
                <h2>Informasi Penyewa</h2>
                <table>
                    <tr><th>Nama Lengkap</th><td>: {{ $penyewaan->nama_lengkap }}</td></tr>
                    <tr><th>No. HP</th><td>: {{ $penyewaan->no_hp }}</td></tr>
                    <tr><th>Alamat</th><td>: {{ $penyewaan->alamat }}</td></tr>
                </table>
            </div>
            <div class="details-section">
                <h2>Informasi Kendaraan</h2>
                <table>
                    <tr><th>Mobil</th><td>: {{ $penyewaan->mobil->nama_mobil ?? 'N/A' }}</td></tr>
                    <tr><th>Merek</th><td>: {{ $penyewaan->mobil->merek ?? 'N/A' }}</td></tr>
                    <tr><th>Tahun</th><td>: {{ $penyewaan->mobil->tahun ?? 'N/A' }}</td></tr>
                    <tr><th>Transmisi</th><td>: {{ $penyewaan->mobil->transmisi ?? 'N/A' }}</td></tr>
                </table>
            </div>
        </div>

        <div class="details-section">
            <h2>Detail Sewa</h2>
            <table>
                <tr><th>Tanggal Mulai Sewa</th><td>: {{ \Carbon\Carbon::parse($penyewaan->tanggal_mulai)->format('l, d F Y') }}</td></tr>
                <tr><th>Tanggal Selesai Sewa</th><td>: {{ \Carbon\Carbon::parse($penyewaan->tanggal_selesai)->format('l, d F Y') }}</td></tr>
                @php
                    $mulai = \Carbon\Carbon::parse($penyewaan->tanggal_mulai);
                    $selesai = \Carbon\Carbon::parse($penyewaan->tanggal_selesai);
                    $durasi = $selesai->diffInDays($mulai) + 1;
                @endphp
                <tr><th>Durasi Sewa</th><td>: {{ $durasi }} hari</td></tr>
                <tr><th>Status</th><td>: <strong>{{ $penyewaan->status }}</strong></td></tr>
            </table>
        </div>

        <table class="summary-table">
            <tr>
                <td>Total Pembayaran</td>
                <td class="total" style="text-align: right;">Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer">
            Terima kasih telah menyewa di Ali Rent Car. <br> Harap simpan struk ini sebagai bukti pembayaran yang sah.
        </div>
    </div>
</body>
</html>