@php use Carbon\Carbon; @endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Pengembalian Barang</title>
  <!-- QRCode.js CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

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
  .above-section {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    margin-top: 20px;
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

  table .blm {
    background-color: #e26a2c;
    color: white;
  }

  .btn-group {
    margin-top: 30px;
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
    text-decoration: none;
  }

  .btn:hover {
    transition-duration: 0.5s;
    background-color: #3251ad;
  }

  input {
    outline: none;
    border: none;
    box-sizing: border-box;
    position: relative;
    /* z-index: 1; */
    width: 100%;
  }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>Daftar Barang Kembali</h1>
      <img src="img/assets/esimprod_logo.png" alt="Logo" class="logo">
    </div>
    <div class="above-section">
        <div class="item">
            <h3 style="font-weight: normal;"><strong>No Peminjaman:</strong> {{ $pengembalian->peminjaman->nomor_peminjaman }}</h3>
            <h3 style="font-weight: normal;"><strong>Kode Pengembalian:</strong> {{ $pengembalian->kode_pengembalian }}</h3>
        </div>
        <div class="item">
            <h3><strong>Waktu Peminjaman:</strong> {{ Carbon::parse($pengembalian->peminjaman->tanggal_peminjaman)->format('d F Y') }}</h3>
            <h3><strong>Waktu Pengembalian:</strong>{{ Carbon::parse($pengembalian->tanggal_kembali)->format('d F Y') }}</h3>
        </div>
    </div>


    <div class="info-section">
      <div class="item">
        <p><strong>Peminjam:</strong> {{ $pengembalian->peminjaman->peminjam }} </p>
        <p><strong>NIP:</strong> 199004232022031007</p>
        <p><strong>No HP:</strong> 085386612234</p>
        <p><strong>Jabatan:</strong> Teknisi Siaran</p>
      </div>
      <div class="item">
        <p><strong>Surat Tugas:</strong> {{ $pengembalian->peminjaman->nomor_surat }} </p>
        <p><strong>Peruntukan:</strong> {{$pengembalian->peminjaman->peruntukan->peruntukan }} </p>
        <p><strong>Tgl
            Penggunaan:</strong> {{ Carbon::parse($pengembalian->peminjaman->tanggal_penggunaan)->format('d F Y') }}
        </p>
        <p><strong>Sampai:</strong> {{ Carbon::parse($pengembalian->peminjaman->tanggal_kembali)->format('d F Y') }} </p>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>NO</th>
          <th>Nama Barang</th>
          <th>Merk</th>
          <th>No Seri</th>
          <th>Kondisi</th>
        </tr>
      </thead>
      <tbody>
{{--      Barang Kembali--}}
        @foreach($barangKembali as $key => $item)
        <tr>
          <td>{{ $key + 1 }}</td>
          <td>{{ $item['nama_barang'] }} </td>
          <td>{{ $item['merk'] }}</td>
          <td>{{ $item['nomor_seri'] }}</td>
          <td>{{ $item['kondisi'] }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <p>Barang belum dikembalikan</p>

    <table>
      <thead>
        <tr>
          <th class="blm">NO</th>
          <th class="blm">Nama Barang</th>
          <th class="blm">Merk</th>
          <th class="blm">No Seri</th>
          <th class="blm">Penjelasan</th>
        </tr>
      </thead>
      <tbody>
{{--      Barang Tak Kembali--}}
        @foreach($barangHilang as $key => $item)
        <tr>
          <td>{{ $key + 1 }}</td>
          <td>{{ $item['nama_barang'] }} </td>
          <td>{{ $item['merk'] }}</td>
          <td>{{ $item['nomor_seri'] }}</td>
          <td>
              <input id="pengembalianCode" type="hidden" class="input-field" value="{{ $pengembalian->kode_pengembalian }}">
              <input id="barangCode" type="hidden" class="input-field" value="{{ $item['kode_barang'] }}">
              <input id="barangDesc" type="text" class="input-field" placeholder="Hayoo mana barangnya???" required>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="btn-group">
      <a href="{{ route('user.peminjaman.pdf') }}" type="button" class="btn">Download PDF</a>
      {{--      <button class="btn">Cetak</button>--}}
      <a href="{{ route('user.options') }}" type="button" class="btn">Selesai</a>
      <button id="save-desc" type="button" class="btn">save</button>
    </div>
  </div>
  <!-- Pastikan QRCode.js sudah disertakan sebelum skrip ini -->
  <script>
        document.addEventListener('DOMContentLoaded', function() {
            const saveButton = document.getElementById('save-desc');
            const rows = document.querySelectorAll('tr');
            const lostItemsArray = [];

            rows.forEach(row => {
                const barangCodeInput = row.querySelector('#barangCode');
                const pengembalianCodeInput = row.querySelector('#pengembalianCode');
                const barangDescInput = row.querySelector('#barangDesc');

                if (barangCodeInput && barangDescInput) {
                    barangDescInput.addEventListener('change', function() {
                        // Validate input
                        const itemDescription = this.value.trim();

                        if (!itemDescription) {
                            // Show error if description is empty
                            this.classList.add('is-invalid');
                            return;
                        }

                        // Remove any previous validation errors
                        this.classList.remove('is-invalid');

                        // Create item object
                        const lostItem = {
                            kode_pengembalian : pengembalianCodeInput.value,
                            kode_barang: barangCodeInput.value,
                            deskripsi_barang: itemDescription
                        };

                        // Check if this item is already in the array
                        const existingItemIndex = lostItemsArray.findIndex(
                            item => item.kode_barang === lostItem.kode_barang
                        );

                        if (existingItemIndex !== -1) {
                            // Update existing item
                            lostItemsArray[existingItemIndex] = lostItem;
                        } else {
                            // Add new item
                            lostItemsArray.push(lostItem);
                        }

                        console.log('Data Barang Tak Kembali:', lostItemsArray);
                    });
                }
            });

            saveButton.addEventListener('click', function() {
                // Validate entire array before sending
                if (lostItemsArray.length === 0) {
                    alert('Tidak ada barang hilang yang diinput!');
                    return;
                }

                // Validate each item has a description
                const invalidItems = lostItemsArray.filter(item => !item.deskripsi_barang);
                if (invalidItems.length > 0) {
                    alert('Harap lengkapi deskripsi untuk semua barang!');
                    return;
                }

                // Send to REST API
                fetch('/api/barang-hilang', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        // 'Authorization': 'Bearer ' + yourToken
                    },
                    body: JSON.stringify(lostItemsArray)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal menyimpan barang hilang');
                    }
                    return response.json();
                })
                .then(data => {
                    alert('Berhasil menyimpan barang hilang!');
                    // Optional: Reset input fields
                    rows.forEach(row => {
                        const barangDescInput = row.querySelector('#barangDesc');
                        if (barangDescInput) {
                            barangDescInput.value = '';
                        }
                    });
                    // Clear the array
                    lostItemsArray.length = 0;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan: ' + error.message);
                });
            });
        });
    </script>
</body>

</html>
