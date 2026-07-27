@extends('layouts.admin')

@section('title', 'Data Jadwal')

@section('content')

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Data Jadwal</h2>
    <a href="{{ route('admin.jadwal.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        + Tambah Jadwal
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3">No</th>
                <th class="p-3">Lapangan</th>
                <th class="p-3">Hari</th>
                <th class="p-3">Jam Mulai</th>
                <th class="p-3">Jam Selesai</th>
                <th class="p-3">Status</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($jadwals->count())
                @foreach($jadwals as $jadwal)
                    <tr class="border-t">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3">{{ $jadwal->lapangan->nama }}</td>
                        <td class="p-3">{{ $jadwal->hari }}</td>
                        <td class="p-3">{{ $jadwal->jam_mulai }}</td>
                        <td class="p-3">{{ $jadwal->jam_selesai }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-sm {{ $jadwal->status == 'Tersedia' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $jadwal->status }}
                            </span>
                        </td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                Edit
                            </a>
                            <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
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
                    <td colspan="7" class="text-center p-5">Belum ada data jadwal.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

@endsection
