@extends('layouts.admin.main')
@section('content')
  <div class="flex p-3 ml-3 mr-3">
    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
      type="button">Opsi / Tindakan <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
      </svg>
    </button>

    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700">
      <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
        <li>
          <a href="{{ route('barang.create') }}"
            class="block px-3 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tambah
            Barang</a>
        </li>
        <li>
          <a href="{{ route('jenis_barang.index') }}"
            class="block px-3 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Jenis
            Barang</a>
        </li>
        <li>
          <a href="#" class="block px-3 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cetak
            Semua QR Code</a>
        </li>
        <li>
          <a href="#" class="block px-3 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cetak
            Semua Barang</a>
        </li>
      </ul>
    </div>
  </div>

  @if ($barang->isEmpty())
    <div class="flex flex-col p-3 ml-3 sm:ml-2">
      <div class="flex items-center p-4 mb-2 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
        role="alert">
        <i class="fa-solid fa-circle-info mr-3"></i>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-bold">Info!</span> Tidak ada data
        </div>
      </div>
    </div>
  @endif

  {{-- card barang  --}}
  <div class="flex-col p-3 ml-3 mr-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
    @foreach ($barang as $b)
      <div
        class="relative max-w-xs bg-white border border-gray-200 rounded shadow-lg dark:bg-gray-800 dark:border-gray-700">
        <a href="">
          <img class="w-56 h-48 object-cover mx-auto " src="{{ asset('storage/uploads/foto_barang/' . $b->foto) }}"
            alt="Image Description" />
          <span
            class="absolute top-3 left-3 bg-tvri_base_color text-white text-xs font-semibold px-2 py-0.5 rounded-full">
            {{ $b->jenisBarang->jenis_barang }}
          </span>
        </a>
        <div class="p-5">
          <div class="flex justify-between items-center">
            <h5 class="text-lg font-extrabold leading-tight text-gray-900 dark:text-white">
              {{ $b->nama_barang }}
            </h5>
            @if ($b->status == 'Tersedia')
              <span
                class="bg-green-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                Tersedia
              </span>
            @else
              <span
                class="bg-red-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                Habis
              </span>
            @endif
          </div>
          <p class="font-normal text-gray-700 dark:text-gray-400">
            <strong>Kode :</strong> {{ $b->uuid }}
          </p>
          <p class="font-normal text-gray-700 dark:text-gray-400">
            <strong>Limit : </strong> {{ $b->limit }}
          </p>
          <p class="font-normal text-gray-700 dark:text-gray-400">
            <strong>Sisa Limit : </strong> {{ $b->sisa_limit }}
          </p>
          <div class="mt-3">
            <a href="{{ route('barang.edit', $b->uuid) }}"
              class="inline-flex text-yellow-700 hover:text-white border border-yellow-700 hover:bg-yellow-800  font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-yellow-500 dark:text-yellow-500 dark:hover:text-white dark:hover:bg-yellow-600 ">
              <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a href="{{ route('barang.show', $b->uuid) }}"
              class="inline-flex text-green-700 hover:text-white border border-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600">
              <i class="fa-solid fa-circle-info"></i>
            </a>
            <button data-modal-target="delete-modal" data-modal-toggle="delete-modal"
              onclick="confirmDelete('{{ route('barang.destroy', ['uuid' => $b->uuid]) }}')"
              class="inline-flex text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600"
              type="button">
              <i class="fa-solid fa-trash"></i>
            </button>
            <a href=""
              class="inline-flex text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600">
              <i class="fa-solid fa-spinner"></i>
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div id="delete-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button type="button"
          class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="delete-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="p-4 md:p-5 text-center">
          <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin menghapus data ?</h3>

          <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
              class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
              Ya
            </button>
            <button data-modal-hide="delete-modal" type="button"
              class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
              Tidak
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    function confirmDelete(url) {
      const form = document.getElementById('deleteForm');
      form.action = url;
    }
  </script>
@endsection
