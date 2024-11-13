@extends('layouts.user.main')

@section('title', 'Peminjaman')

@section('content')
  <!-- new script -->
  <div
  class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
  <div class="flex flex-col items-center pb-1">
    <img class="w-10 h-10 mb-3 rounded-full shadow-lg"
      src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Bonnie image" />
    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Akbar Laksana</h5>
    <span class="text-sm text-gray-500 dark:text-gray-400">199004232022031007</span>
    <span class="text-sm text-gray-500 dark:text-gray-400">Teknisi Siaran</span>
    <span class="text-sm text-gray-500 dark:text-gray-400">085386612234</span>
  </div>
</div>


<!-- Start coding here -->
<div class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg mt-3">
  <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
    <div class="w-full md:w-1/2">
      <form class="flex items-center">
        <label for="simple-search" class="sr-only"></label>
        <div class="relative w-full">
          <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <i class="fa-solid fa-file-lines w-1 h-5 text-gray-500 dark:text-gray-400"></i>
          </div>
          <input type=" text" id="simple-search"
            class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Masukkan Surat Tugas" required="">
        </div>
      </form>
    </div>
    <div
      class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">

      <div class="flex items-center w-full space-x-3 md:w-auto">

        <!-- Datepickers -->
        <div id="date-range-picker" date-rangepicker class="flex items-center">
          <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
              </svg>
            </div>
            <input id="datepicker-range-start" datepicker datepicker-buttons datepicker-autoselect-today
              datepicker-min-date="today" datepicker-max-date="today" name="start" type="text"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Pilih tanggal peminjaman">
          </div>
          <span class="mx-4 text-gray-500">sampai</span>
          <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
              </svg>
            </div>
            <input id="datepicker-range-end" datepicker datepicker-buttons datepicker-autoselect-today
              datepicker-min-date="today" name="end" type="text"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Pilih tanggal peminjaman">
          </div>
        </div>
        <button id="dropdownRadioHelperButton" data-dropdown-toggle="dropdownRadioHelper"
          class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          type="button">Peruntukan<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 4 4 4-4" />
          </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdownRadioHelper"
          class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-60 dark:bg-gray-700 dark:divide-gray-600">
          <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
            aria-labelledby="dropdownRadioHelperButton">
            <li>
              <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <div class="flex items-center h-5">
                  <input id="helper-radio-4" name="helper-radio" type="radio" value=""
                    class="w-4 h-4 text-blue-900 bg-gray-100 border-gray-300 focus:ring-blue-800 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                </div>
                <div class="ms-2 text-sm">
                  <label for="helper-radio-4" class="font-medium text-gray-900 dark:text-gray-300">
                    <div>Individual</div>
                    <p id="helper-radio-text-4" class="text-xs font-normal text-gray-500 dark:text-gray-300">Some
                      helpful instruction goes over here.</p>
                  </label>
                </div>
              </div>
            </li>
            <li>
              <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <div class="flex items-center h-5">
                  <input id="helper-radio-5" name="helper-radio" type="radio" value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                </div>
                <div class="ms-2 text-sm">
                  <label for="helper-radio-5" class="font-medium text-gray-900 dark:text-gray-300">
                    <div>Company</div>
                    <p id="helper-radio-text-5" class="text-xs font-normal text-gray-500 dark:text-gray-300">Some
                      helpful instruction goes over here.</p>
                  </label>
                </div>
              </div>
            </li>
            <li>
              <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <div class="flex items-center h-5">
                  <input id="helper-radio-6" name="helper-radio" type="radio" value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                </div>
                <div class="ms-2 text-sm">
                  <label for="helper-radio-6" class="font-medium text-gray-900 dark:text-gray-300">
                    <div>Non profit</div>
                    <p id="helper-radio-text-6" class="text-xs font-normal text-gray-500 dark:text-gray-300">Some
                      helpful instruction goes over here.</p>
                  </label>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ? --}}
<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
  <!-- Added mt-4 here -->
  <div
    class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
  </div>
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="p-4">
          No
        </th>
        <th scope="col" class="px-6 py-3">
          Nama Barang
        </th>
        <th scope="col" class="px-6 py-3">
          Merk
        </th>
        <th scope="col" class="px-6 py-3">
          No Seri
        </th>
        <th scope="col" class="px-6 py-3">
          Action
        </th>
      </tr>
    </thead>
    <tbody>
        @if(session('borrowed_items'))
          @foreach(session('borrowed_items') as $index => $item)
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" data-item-id="{{ $item['uuid'] }}">
              <td class="w-4 p-4">
                  <div class="flex items-center">
                      <p>{{ $index + 1 }}</p>
                  </div>
              </td>
              <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                  <div class="ps-2">
                      <div class="text-base font-semibold">{{ $item['name'] }}</div>
                  </div>
              </th>
              <td class="px-6 py-4">
                  {{ $item['merk'] }}
              </td>
              <td class="px-6 py-4">
                  <div class="flex items-center">
                      {{ $item['serial_number'] }}
                  </div>
              </td>
              <td class="px-6 py-4">
                  <a href="#" data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-uuid="{{ $item['uuid'] }}" class="text-blue-600 dark:text-blue-500 hover:text-red-600 hover:underline">
                      <i class="fa-regular fa-trash-can fa-lg ml-3"></i>
                  </a>
              </td>
          </tr>
          @endforeach
      @endif
    </tbody>
  </table>
  {{-- Delete Modal Confirmation --}}
  <div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
    <div class="relative p-4 w-full max-w-md">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button type="button"
          class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="popup-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="p-4 md:p-5 text-center flex flex-col items-center">
          <svg class="mx-auto mb-2 text-gray-400 w-6 h-6 dark:text-gray-200" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          <h3 class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
          <input type="hidden" id="modal-uuid">
          <div class="flex justify-center space-x-2 mt-4">
            <button data-modal-hide="popup-modal" type="button" onclick="confirmDelete()"
              class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
              Lanjutkan
            </button>
            <button data-modal-hide="popup-modal" type="button"
              class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Save Modal Confirmation --}}
  <div id="save-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
    <div class="relative p-4 w-full max-w-md">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button type="button"
          class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="save-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="p-4 md:p-5 text-center flex flex-col items-center">
          <svg class="mx-auto mb-2 text-gray-400 w-6 h-6 dark:text-gray-200" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          <h3 class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this
            product?</h3>
          <div class="flex justify-center space-x-2 mt-4">
            <button data-modal-hide="popup-modal" type="button"
              class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
              Yes, I'm sure
            </button>
            <button data-modal-hide="save-modal" type="button"
              class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
              No, cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="flex justify-center space-x-2 mt-4">
  <a href="/opsi">
    <button type="button"
      class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</button>
  </a>
  <button data-modal-target="save-modal" data-modal-toggle="save-modal" type="button"
    class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Simpan</button>
</div>

<!-- Toast Notif -->
<div id="toast-danger"
  class="hidden items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
  role="alert">
  <div
    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path
        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
    </svg>
    <span class="sr-only">Error icon</span>
  </div>
  <div class="ms-3 text-sm font-normal">Item has been deleted.</div>
  <button type="button"
    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
    data-dismiss-target="#toast-danger" aria-label="Close">
    <span class="sr-only">Close</span>
    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
    </svg>
  </button>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modalTriggers = document.querySelectorAll('[data-modal-toggle="popup-modal"]');
    
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const uuid = this.getAttribute('data-uuid');
            document.getElementById('modal-uuid').value = uuid;
        });
    });
  });
  
  function confirmDelete() {
    const uuid = document.getElementById('modal-uuid').value;
    removeItem(uuid); // Panggil fungsi delete dengan UUID
  }

  document.addEventListener('DOMContentLoaded', function() {
    const datepickerInput = document.getElementById('datepicker');

    // Initialize Flowbite's datepicker with minDate
    const datepicker = new Datepicker(datepickerInput, {
      minDate: new Date(), // Disable past dates
      todayHighlight: true // Highlight today's date
    });
  });
  document.addEventListener('DOMContentLoaded', function() {
    let lastScanned = '';
    let lastScannedTimeout;

    document.addEventListener('keydown', function(e) {
        if (['Shift', 'Control', 'Alt'].includes(e.key)) return;

        if (e.key === 'Enter') {
            if (lastScanned) {
                processBarcodeInput(lastScanned);
                lastScanned = '';
                clearTimeout(lastScannedTimeout);
            }
        } else {
            lastScanned += e.key;
            clearTimeout(lastScannedTimeout);
            lastScannedTimeout = setTimeout(() => {
                lastScanned = '';
            }, 100);
        }
    });

    function processBarcodeInput(qrcode) {
        fetch('http://127.0.0.1:8000/user/peminjaman/scan', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({ qrcode })
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              addItemToTable(data.item);
              document.querySelector("#toast-success .text-sm").textContent = data.message; // Set success message
              document.getElementById("toast-success").style.display = "flex"; // Show success toast
              console.log(data.message);
              setTimeout(() => {
                document.getElementById("toast-success").style.display = "none";
            }, 1500); // Hide after 3 seconds
          } else {
            document.querySelector("#toast-warning .text-sm").textContent = data.message; // Set failure message
            document.getElementById("toast-warning").style.display = "flex"; // Show warning toast
            console.log(data.message);
            setTimeout(()=> {
              document.getElementById("toast-warning").style.display = "none";
            }, 1500);
          }
      })
      .catch(error => {
          console.error('Error:', error);
      });
    }

    function addItemToTable(item) {
        const tbody = document.querySelector('table tbody');
        const rowCount = tbody.children.length;

        const tr = document.createElement('tr');
        tr.className = 'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600';
        tr.dataset.itemId = item.uuid;

        tr.innerHTML = `
            <td class="w-4 p-4">
                <div class="flex items-center">
                    <p>${rowCount}</p>
                </div>
            </td>
            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                <div class="ps-2">
                    <div class="text-base font-semibold">${item.name}</div>
                </div>
            </th>
            <td class="px-6 py-4">
                ${item.merk}
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center">
                    ${item.serial_number}
                </div>
            </td>
            <td class="px-6 py-4">
                <a href="#" onclick="removeItem('${item.uuid}')" class="text-blue-600 dark:text-blue-500 hover:text-red-600 hover:underline">
                    <i class="fa-regular fa-trash-can fa-lg ml-3"></i>
                </a>
            </td>
        `;

        tbody.appendChild(tr);
    }
  });

  function removeItem(uuid) {
      fetch(`/user/peminjaman/remove/${uuid}`, {
          method: 'DELETE',
          headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              const tbody = document.querySelector('table tbody');
              const row = tbody.querySelector(`tr[data-item-id="${uuid}"]`);
              if (row) {
                  tbody.removeChild(row); // Hapus baris dari tabel
                  updateRowNumbers(); // Perbarui nomor urut
              }
          }
      })
      .catch(error => {
          console.error('Error:', error);
      });
  }

  function updateRowNumbers() {
      const tbody = document.querySelector('table tbody');
      Array.from(tbody.children).forEach((row, index) => {
          row.querySelector('td:first-child p').textContent = index + 1; // Perbarui nomor urut
      });
  }
</script>
@endsection