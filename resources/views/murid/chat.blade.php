{{-- @dd($room_chat,$room_id) --}}

@extends('murid.template')
@section('page_name', 'chat')
@section('mid-content')
    <div class="p-1">
        @foreach ($room_chat as $room)
            <a href="/guru/{{ $user_id }}/chat?room_id={{ $room->id }}"
                class="d-flex align-items-center mb-2 text-decoration-none text-dark border p-3">
                <img src="{{ asset('storage/' . ($room->guru->foto->profile ?? 'profile.png')) }}" alt="Foto Profile"
                    class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                <div class="ms-3 flex-grow-1">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0 fw-bold">
                            {{ $room->guru->nama }}</h6>
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
        <div class="container" style="height: 95vh;">
            <div class="d-flex flex-column justify-content-center align-items-center" style="height: 300px;">
                <p class="text-muted">Pilih salah satu room chat untuk memulai percakapan.</p>
            </div>
        </div>
    @else
        <div class="container" style="height: 95vh;">
            <div class="d-flex flex-column h-100">
                <div class="bg-primary text-white p-3 mb-2 rounded d-flex justify-content-between align-items-center">
                    <div class="fw-semibold">
                        {{ $room->murid ? $room->guru->nama : 'Data murid tidak ditemukan' }}
                    </div>
                    @if ($room_status === 'aktif')
                        <a href="/room-chat/{{ $room_id }}/selesai"
                            class="btn btn-sm btn-success text-white fw-semibold">
                            Selesai
                        </a>
                    @endif
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
@endsection
