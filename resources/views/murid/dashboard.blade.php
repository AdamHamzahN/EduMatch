{{-- @dd($selected_guru, $murid_id) --}}
@extends('murid.template')
@section('page_name', 'Dashboard Murid')

@section('mid-content')
    <form method="GET" action="{{ route('murid.dashboard', ['user_id' => $user_id]) }}" class="mb-3">
        <input type="text" name="search" class="form-control" placeholder="Cari guru..." value="{{ $search ?? '' }}">
    </form>

    @foreach ($daftar_guru as $guru)
        <a href="/murid/{{ $user_id }}/dashboard?detail-guru={{ $guru->id }}"
            class="d-flex align-items-center mb-3 text-decoration-none text-dark border p-2 rounded">
            <img src="{{ asset('storage/' . $guru->foto_profile ?? 'profile.png') }}" class="rounded-circle me-3"
                style="width: 50px; height: 50px; object-fit: cover;" alt="foto">
            <div>
                <h6 class="mb-0 fw-bold">{{ $guru->nama }}</h6>
                <small class="text-muted">{{ Str::limit($guru->keahlian, 50) }}</small>
            </div>
        </a>
    @endforeach

    @if ($daftar_guru->isEmpty())
        <p class="text-center text-muted">Tidak ada guru ditemukan.</p>
    @endif
@endsection

@section('right-content')
    <div class="p-4 bg-white shadow rounded mt-5">
        @if ($selected_guru)
            <div class="text-center mb-3">
                <img src="{{ asset('storage/' . $selected_guru->foto_profile) }}" class="rounded mb-2"
                    style="width: 100px; height: 100px; object-fit: cover;" alt="foto">
                <h5 class="mb-3"><strong>{{ $selected_guru->nama }}</strong></h5>
            </div>
            <div class="mb-4">
                <small class="text-uppercase text-muted fw-bold">Lokasi</small>
                <p class="fs-5 fw-semibold mb-0">{{ $selected_guru->lokasi }}</p>
            </div>

            <div class="mb-4">
                <small class="text-uppercase text-muted fw-bold">Keahlian</small>
                <p class="fs-5 fw-semibold mb-0">{{ $selected_guru->keahlian }}</p>
            </div>

            <div class="mb-4">
                <small class="text-uppercase text-muted fw-bold">Profil Singkat</small>
                <p class="fs-5 fw-semibold" style="white-space: pre-line;">{{ $selected_guru->profile_singkat }}</p>
            </div>
            <div class="mb-4">
                <small class="text-uppercase text-muted fw-bold">Permintaan Kerjasama</small>
                <form action="{{ route('request.create') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <textarea name="pesan" class="form-control" rows="4" placeholder="Tulis pesan permintaan kerjasama..." required></textarea>
                    </div>
                    <input type="hidden" name="guru_id" value="{{ $selected_guru->id }}">
                    <input type="hidden" name="murid_id" value="{{ $murid_id }}">
                    <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
                </form>
            </div>
            @if (session('success'))
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '{{ session('success') }}',
                        timer: 2000,
                        showConfirmButton: false
                    });
                </script>
            @endif
        @else
            <div class="d-flex justify-content-center align-items-center text-muted text-center" style="height: 100%;">
                <p class="m-0">Pilih guru untuk melihat detail.</p>
            </div>
        @endif
    </div>
@endsection
