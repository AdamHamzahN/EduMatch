{{-- @dd($room_chat) --}}

@extends('guru.template')
@section('page_name', 'chat')
@section('mid-content')
    <div class="p-1">
        @foreach ($room_chat as $room)
            <a href="/guru/{{ $user_id }}/chat?room_id={{ $room->id }}"
                class="d-flex align-items-center mb-2 text-decoration-none text-dark border p-3">
                <img src="{{ asset('storage/' . ($room->murid->foto->profile ?? 'profile.png')) }}" alt="Foto Profile"
                    class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                <div class="ms-3 flex-grow-1">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0 fw-bold">
                            {{ $room->murid ? $room->murid->nama : 'Data murid tidak ditemukan' }}</h6>
                    </div>
                </div>
            </a>
        @endforeach

        @if ($room_chat->isEmpty())
            <p class="text-center text-muted">Belum ada chat</p>
        @endif
    </div>
@endsection


@section('right-content')
    @if ($room_id == null)
        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 300px;">
            <p class="text-muted">Pilih salah satu room chat untuk memulai percakapan.</p>
        </div>
    @else
        <div class="container" style="height: 95vh;">
            <div class="d-flex flex-column h-100">
                <div class="bg-primary text-white p-3 mb-2 rounded d-flex justify-content-between align-items-center">
                    <div class="fw-semibold">
                        {{ $room->murid ? $room->murid->nama : 'Data murid tidak ditemukan' }}
                    </div>
                    <button class="btn btn-sm btn-light text-primary fw-semibold" data-bs-toggle="modal"
                        data-bs-target="#calendarModal">
                        Tambah Jadwal
                    </button>
                </div>
                <div class="flex-grow-1 bg-white p-3 mb-2">
                    @foreach ($chats as $chat)
                        @if ($chat->user_id == $user_id)
                            <div class="d-flex justify-content-end mb-2">
                                <div class="bg-primary text-white p-2 rounded" style="max-width: 70%;">
                                    {{ $chat->pesan }}
                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-start mb-2">
                                <div class="bg-light p-2 rounded" style="max-width: 70%;">
                                    {{ $chat->pesan }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                @if ($room_status === 'aktif')
                    <form method="POST" action="{{ route('chat.create') }}"
                        class="border bg-white p-3 rounded d-flex align-items-center gap-2">
                        @csrf
                        <input type="text" name="pesan" class="form-control" placeholder="Masukkan pesan" required />
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <input type="hidden" name="room_chat_id" value="{{ $room_id }}">
                        <button type="submit" class="btn btn-primary">></button>
                    </form>
                @else
                    <div class="border bg-white p-3 rounded text-center text-muted">
                        <em>Percakapan telah ditutup</em>
                    </div>
                @endif

            </div>
        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="calendarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="calendarForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal ke Google Calendar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" placeholder="Judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi (opsional)</label>
                        <textarea class="form-control" id="description" rows="2" placeholder="Deskripsi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasi (opsional)</label>
                        <input type="text" class="form-control" id="location" placeholder="Lokasi">
                    </div>
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Waktu</label>
                        <input type="datetime-local" class="form-control" id="start_time" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambahkan ke Calender</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('calendarForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const title = document.getElementById('title').value.trim();
            const description = document.getElementById('description').value.trim();
            const location = document.getElementById('location').value.trim();
            const startInput = document.getElementById('start_time').value;

            if (!title || !startInput) {
                alert('Mohon masukkan judlu dan waktu terlebih dahulu');
                return;
            }

            const start = new Date(startInput);
            const formatDate = date =>
                date.toISOString().replace(/[-:]/g, '').split('.')[0] + 'Z';

            const startStr = formatDate(start);
            const endStr = ''; // tidak dipakai

            let url =
                `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(title)}&dates=${startStr}&details=${encodeURIComponent(description)}&location=${encodeURIComponent(location)}`;

            window.open(url, '_blank');
        });

        Echo.private(`chat.${roomId}`)
            .listen('ChatSent', (e) => {
                document.querySelector('.chat-messages').innerHTML += `
            <div class="d-flex justify-content-start mb-2">
                <div class="bg-light p-2 rounded" style="max-width: 70%;">
                    ${e.pesan}
                </div>
            </div>`;
            });
    </script>

@endsection
