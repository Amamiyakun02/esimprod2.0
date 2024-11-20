<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  >
  <title>Daftar Barang Pinjam</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      width: 93%;
      margin: auto;
      padding: 10px;
    }

    .header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      /* Pushes h1 and logo to opposite ends */
      /* border-bottom: 2px solid #dd3333;
            padding-bottom: 10px; */
    }

    h1 {
      margin: 0;
      /* font-size: 24px; */
    }

    /* Style for the logo */
    .logo {
      width: 100px;
      /* Adjust the width as needed */
      height: auto;
    }

    .info-section {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      margin-top: 20px;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table th,
    table td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
    }

    table th {
      background-color: #3251ad;
      color: white;
    }

    .btn-group {
      margin-top: 20px;
      text-align: center;
    }

    .btn {
      background-color: #1e3164;
      border: none;
      color: white;
      padding: 10px 20px;
      margin: 5px;
      cursor: pointer;
      border-radius: 5px;
    }

    .btn:hover {
      transition-duration: 0.5s;
      background-color: #3251ad;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Header section with h1 and logo aligned -->
    <div class="header">
      <h1>Daftar Barang Pinjam</h1>
      <img
        src="img/assets/esimprod_logo.png"
        alt="Logo"
        class="logo"
      >
    </div>

    <h3 style="font-weight: normal;"><strong>No Peminjaman:</strong> 2023-10-0007</h3>
    <p><strong>Waktu Peminjaman:</strong> 10 Oktober 2023, 19:23 WITA</p>

    <div class="info-section">
      <div class="item">
        <p><strong>Peminjam:</strong> {{ $peminjaman->peminjam }}</p>
        <p><strong>NIP:</strong> 199004232022031007</p>
        <p><strong>No HP:</strong> 085386612234</p>
        <p><strong>Jabatan:</strong> Teknisi Siaran</p>
      </div>
      <div class="item">
        <p><strong>Surat Tugas:</strong> {{ $peminjaman->nomor_surat }}</p>
        <p><strong>Peruntukan:</strong> {{ $peminjaman->peruntukan->peruntukan }}</p>
        <p><strong>Tgl Penggunaan:</strong> {{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d F Y') }}</p>
        <p><strong>Sampai:</strong> {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d F Y') }}</p>
      </div>
      <div class="item">
        <p><strong>Code:</strong> {{ $peminjaman->kode_peminjaman }}</p>
        <p><strong>QR Pengembalian:</strong></p>
        <img
          src="img/assets/qr-code-placeholder.svg"
          alt="QR Code"
          style="width: 85px; height: 85px;"
        >
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>NO</th>
          <th>Nama Barang</th>
          <th>Merk</th>
          <th>No Seri</th>
          <th>Checklist</th>
        </tr>
      </thead>
      <tbody>
      @foreach($barang as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item['nama_barang'] }}</td>
            <td>{{ $item['merk'] }}</td>
            <td>{{ $item['nomor_seri'] }}</td>
            <td></td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="btn-group">
      <a href="{{ route('user.peminjaman.pdf') }}" class="btn">Download PDF</a>
{{--      <button class="btn">Cetak</button>--}}
      <a href="{{ route('options') }}" class="btn">Selesai</a>
    </div>
  </div>
</body>

</html>
