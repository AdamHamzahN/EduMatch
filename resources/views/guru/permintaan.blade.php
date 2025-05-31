@extends('guru.template')
@section('page_name', 'Permintaan Kerjasama')

@section('mid-content')
    <div class="p-3">
        <h5 class="mb-3">Daftar Permintaan</h5>

        @forelse ($daftar_permintaan as $permintaan)
            <a href="{{ url()->current() }}?permintaan={{ $permintaan->id }}"
                class="d-block border rounded p-3 mb-2 text-decoration-none text-dark">
                <strong>{{ $permintaan->murid->nama }}</strong><br>
                <small class="text-muted">{{ $permintaan->created_at->format('d M Y, H:i') }}</small>
            </a>
        @empty
            <p class="text-muted">Belum ada permintaan kerjasama.</p>
        @endforelse
    </div>
@endsection

@section('right-content')
    <div class="p-4 bg-white shadow rounded mt-5">
        @if ($selected_permintaan)
            <div class="mb-4 text-center">
                <h4 class="fw-bold mb-1">{{ $selected_permintaan->murid->nama }}</h4>
            </div>
            <hr>
            <div class="mb-2">
                <small class="text-uppercase text-muted fw-bold">Status</small>
                <span
                    class="badge bg-{{ $selected_permintaan->status === 'diterima' ? 'success' : ($selected_permintaan->status === 'ditolak' ? 'danger' : 'secondary') }}">
                    {{ ucfirst($selected_permintaan->status) }}
                </span>
            </div>
            <div class="mb-3">
                <small class="text-uppercase text-muted fw-bold">Pesan Permintaan</small>
                <p class="fs-6" style="white-space: pre-line;">{{ $selected_permintaan->pesan }}</p>
            </div>
            <div class="mb-2">
                <small class="text-uppercase text-muted fw-bold">Dibuat Pada</small>
                <p class="mb-0">{{ $selected_permintaan->created_at->format('d M Y, H:i') }}</p>
            </div>

            @if ($selected_permintaan->status !== 'diterima' && $selected_permintaan->status !== 'ditolak')
                <div class="d-flex gap-2 mt-3">
                    <!-- Tombol Terima -->
                    <form method="POST" action="{{ route('request.accepted', $selected_permintaan->id) }}"
                        class="flex-grow-1">
                        @csrf
                        <input type="hidden" name="murid_id" value="{{ $selected_permintaan->murid->id }}">
                        <input type="hidden" name="guru_id" value="{{ $guru_id }}">
                        <button type="submit" class="btn btn-success w-100">Terima</button>
                    </form>

                    <!-- Tombol Tolak -->
                    <form method="POST" action="{{ route('request.rejected', $selected_permintaan->id) }}"
                        class="flex-grow-1">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger w-100">Tolak</button>
                    </form>
                </div>
            @else
                <div class="mt-3">
                    <div class="alert alert-info text-center mb-0">
                        Permintaan ini sudah <strong>{{ ucfirst($selected_permintaan->status) }}</strong>.
                    </div>
                </div>
            @endif
        @else
            <div class="d-flex flex-column justify-content-center align-items-center" style="height: 300px;">
                <p class="text-muted">Pilih salah satu permintaan untuk melihat detail.</p>
            </div>
        @endif
    </div>

@endsection
