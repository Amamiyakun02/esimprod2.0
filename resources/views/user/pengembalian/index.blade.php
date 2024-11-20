@extends('layouts.user.main')

@section('title', 'Peminjaman')

@section('content')

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
            <!-- <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
              viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                clip-rule="evenodd" />
            </svg> -->
            <i class="fa-solid fa-file-lines w-1 h-5 text-gray-500 dark:text-gray-400"></i>
          </div>
          <input type=" text" id="simple-search"
            class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Masukkan Surat Tugas" disabled>
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
              placeholder="Pilih tanggal peminjaman" disabled>
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
              placeholder="Pilih tanggal peminjaman " disabled>
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
          Kondisi
        </th>
      </tr>
    </thead>
    <tbody>
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td class="w-4 p-4">
          <div class="flex items-center">
            <p>1</p>
          </div>
        </td>
        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
          <div class="ps-2">
            <div class="text-base font-semibold">Neil Sims</div>
            <div class="font-normal text-gray-500">neil.sims@flowbite.com</div>
          </div>
        </th>
        <td class="px-6 py-4">
          React Developer
        </td>
        <td class="px-6 py-4">
          <div class="flex items-center">
            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
          </div>
        </td>
        <td class="px-6 py-4">
          <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="dropdownDotsHorizontal"
            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            type="button">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
              viewBox="0 0 16 3">
              <path
                d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
            </svg>
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

{{-- Kondisi dropdown --}}
<div id="dropdownDotsHorizontal"
  class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
  <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
    <li>
      <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sehat</a>
    </li>
    <li>
      <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sakit</a>
    </li>
    <li>
      <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sekarat</a>
    </li>
  </ul>
  <div class="py-2">
    <a href="#"
      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Separated
      link</a>
  </div>
</div>

<div class="flex justify-center space-x-2 mt-4">
  <button type="button"
    class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</button>
  <button type="button"
    class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Simpan</button>
</div>

<!-- Toast Notif -->
<div id="toast-danger"
  class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
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

@endsection
