@extends('murid.template')
@section('page_name', 'Permintaan Kerjasama')

@section('mid-content')
    <div class="p-3">
        <h5 class="mb-3">Daftar Permintaan</h5>

        @forelse ($daftar_permintaan as $permintaan)
            <a href="{{ url()->current() }}?permintaan={{ $permintaan->id }}"
                class="d-block border rounded p-3 mb-2 text-decoration-none text-dark">
                <strong>{{ $permintaan->guru->nama }}</strong><br>
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
                <h4 class="fw-bold mb-1">{{ $selected_permintaan->guru->nama }}</h4>
                <p class="text-muted mb-0">{{ $selected_permintaan->guru->keahlian }}</p>
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
        @else
            <div class="d-flex flex-column justify-content-center align-items-center" style="height: 300px;">
                <p class="text-muted">Pilih salah satu permintaan untuk melihat detail.</p>
            </div>
        @endif
    </div>

@endsection
