@extends('layouts.admin') {{-- Sesuaikan dengan layout utama admin Anda --}}

@section('content')
    <div class="container">
        <h2>Daftar Laporan Komentar</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelapor</th>
                        <th>Isi Komentar</th>
                        <th>Alasan Laporan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $item)
                        <tr>
                            <td>{{ $loop->iteration + ($laporan->currentPage() - 1) * $laporan->perPage() }}</td>
                            <td>
                                {{ $item->pelapor->nama ?? 'User Terhapus' }}
                            </td>
                            <td>
                                {{-- Menampilkan potongan komentar --}}
                                {{ Str::limit($item->komentar->isi ?? 'Komentar telah dihapus', 50) }}
                            </td>
                            <td>{{ $item->alasan }}</td>
                            <td>
                                <span class="badge {{ $item->status == 'pending' ? 'bg-warning' : 'bg-success' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                            <td>
                                {{-- Tombol Aksi (Contoh) --}}
                                @if ($item->status == 'pending')
                                    <form action="{{ route('admin.laporan.reviewed', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-info text-white"
                                            title="Tandai Reviewed"><i class="fa fa-check"></i> Reviewed</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.laporan.delete_comment', $item->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini? Tindakan ini tidak dapat dibatalkan.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Komentar"><i
                                            class="fa fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada laporan komentar saat ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $laporan->links() }}
        </div>
    </div>
@endsection
