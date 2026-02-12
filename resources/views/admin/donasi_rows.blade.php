@forelse($donations as $donasi)
    <tr>
        <td>#{{ $donasi->id_donasi }}</td>
        <td>{{ $donasi->tanggal->format('d M Y') }}</td>
        <td>
            <strong>{{ $donasi->user->nama ?? 'Guest' }}</strong><br>
            <small style="color: #888">{{ $donasi->user->email ?? '-' }}</small>
        </td>
        <td style="text-transform: capitalize;">{{ $donasi->jenis }}</td>
        <td>Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</td>
        <td>
            @if (!empty($donasi->bukti_transfer))
                <a href="{{ asset('storage/' . $donasi->bukti_transfer) }}" target="_blank"
                    style="color: #2d6a4f; text-decoration: underline; font-size: 12px;">Lihat
                    Bukti</a>
            @else
                <span style="color: #999; font-size: 12px;">-</span>
            @endif
        </td>
        <td>
            @if ($donasi->status == 'berhasil')
                <span class="badge badge-success">Berhasil</span>
            @elseif($donasi->status == 'pending')
                <span class="badge" style="background: #fff3cd; color: #856404;">Pending</span>
            @else
                <span class="badge" style="background: #f8d7da; color: #721c24;">Gagal</span>
            @endif
        </td>
        <td>
            <div style="display: flex; gap: 5px;">
                <a href="{{ route('admin.show', $donasi->id_donasi) }}" class="btn-update"
                    style="background: #17a2b8; color: white; text-decoration: none; padding: 5px 8px;"
                    title="Lihat Detail"><i class="bi bi-eye"></i></a>
                <!-- Tombol update status sederhana untuk view search -->
                <form action="{{ route('admin.donasi.status', $donasi->id_donasi) }}" method="POST"
                    style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="berhasil">
                    <button type="submit" class="btn-update" title="Terima Cepat"><i class="bi bi-check"></i></button>
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" style="text-align: center;">Tidak ada data ditemukan.</td>
    </tr>
@endforelse
