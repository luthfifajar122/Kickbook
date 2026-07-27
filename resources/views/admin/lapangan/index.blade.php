@extends('layouts.admin')

@section('title','Data Lapangan')

@section('content')

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between items-center mb-6">

    <h2 class="text-2xl font-bold">
        Data Lapangan
    </h2>

    <a href="{{ route('admin.lapangan.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

        + Tambah Lapangan

    </a>

</div>

<div class="bg-white rounded-lg shadow overflow-hidden">

<table class="w-full">

    <thead class="bg-gray-100">

        <tr>

            <th class="p-3">No</th>

            <th class="p-3">Nama</th>

            <th class="p-3">Jenis</th>

            <th class="p-3">Harga/Jam</th>

            <th class="p-3">Status</th>

            <th class="p-3">Aksi</th>

        </tr>

    </thead>

    <tbody>

@if($lapangans->count())

    @foreach($lapangans as $lapangan)

    <tr class="border-t">

        <td class="p-3">
            {{ $loop->iteration }}
        </td>

        <td class="p-3">
            {{ $lapangan->nama }}
        </td>

        <td class="p-3">
            {{ $lapangan->jenis }}
        </td>

        <td class="p-3">
            Rp {{ number_format($lapangan->harga_per_jam,0,',','.') }}
        </td>

        <td class="p-3">
            {{ $lapangan->status }}
        </td>

        <td class="p-3 flex gap-2">

            <a href="{{ route('admin.lapangan.edit', $lapangan->id) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                Edit
            </a>

            <form action="{{ route('admin.lapangan.destroy', $lapangan->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus lapangan ini?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                    Hapus
                </button>
            </form>

        </td>

    </tr>

    @endforeach

@else

<tr>

    <td colspan="6" class="text-center p-5">

        Belum ada data lapangan.

    </td>

</tr>

@endif

    </tbody>

</table>

</div>

@endsection