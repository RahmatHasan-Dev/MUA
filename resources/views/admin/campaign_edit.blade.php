<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Berita | MUA Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" />
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            width: 240px;
            z-index: 600;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%);
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
            background-color: #10b981 !important;
            color: white !important;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #40916c;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #d8f3dc;
            border-radius: 8px;
            box-sizing: border-box;
            transition: 0.3s;
        }
        
        .form-control-x {
            width: 100%/3;
            padding: 12px;
            margin-right: 20px;
            border: 1px solid #d8f3dc;
            border-radius: 8px;
            box-sizing: border-box;
            transition: 0.3s;
        }

        .form-control:focus, .form-control-x:focus {
            border-color: #52b788;
            outline: none;
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.2);
        }

        .btn-save {
            background-color: #2d6a4f;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn-save:hover {
            background-color: #1b4332;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    @include('admin.partials.sidebar')

    <main style="margin-top: 58px">
        <div class="container pt-4">
            <div class="card shadow-0 border">
                <div class="card-header border-bottom py-3">
                    <h5 class="mb-0"><strong><i class="fas fa-edit me-2"></i>Edit Pengguna</strong></h5>
                </div>
                <div class="card-body">
                
                    <form method="POST" action="{{ route('admin.campaign.update', $campaign->id_campaign) }}" 
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="form-group">
                            <label for="judul">Judul Campaign</label>
                            <input id="judul" name="judul" type="text" class="form-control"
                                value="{{ old('judul', $campaign->judul) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input id="deskripsi" name="deskripsi" type="text" class="form-control"
                                value="{{ old('deskripsi', $campaign->deskripsi) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input id="gambar" name="gambar" type="file" class="form-control"
                                value="{{ old('gambar', $campaign->gambar) }}" required>
                                
                            @if ($campaign->gambar)
                                <small>Gambar saat ini:</small><br>
                                <img src="{{ asset('storage/' . $campaign->gambar) }}" width="150">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="target">Target</label>
                            <input id="target" name="target" type="text" class="form-control"
                                value="{{ old('target', $campaign->target) }}" required>
                        </div>
                        <button type="submit" class="btn-save">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script>
        // 1. Handle Flash Messages (Success/Error) dari Controller
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
            });
        @endif

        // 2. Handle Konfirmasi Blokir/Aktifkan dengan SweetAlert2
        document.querySelectorAll('.btn-block-user').forEach(button => {
            button.addEventListener('click', function() {
                let form = this.closest('form');
                let isBlocking = this.querySelector('.fa-ban') !== null; // Cek ikon untuk tentukan aksi
                let actionText = isBlocking ? "Blokir" : "Aktifkan";
                let confirmBtnColor = isBlocking ? '#d33' : '#28a745';

                Swal.fire({
                    title: `Yakin ingin ${actionText} user ini?`,
                    text: isBlocking ? "User tidak akan bisa login, tapi data donasi tetap aman." :
                        "User akan dapat login kembali.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: confirmBtnColor,
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: `Ya, ${actionText}!`,
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>
