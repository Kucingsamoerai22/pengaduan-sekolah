<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white tracking-wide">
            🛠️ Panel Kontrol Admin
        </h2>
    </x-slot>

    <style>
        body {
            background: radial-gradient(circle at top, #0f172a, #000) !important;
            color: white;
        }

        /* GLASS */
        .glass {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(18px);
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: 0 0 30px rgba(0,0,0,0.6);
        }

        /* INPUT, SELECT, TEXTAREA */
        input, select, textarea {
            background: #1e293b !important; 
            border: 1px solid rgba(255,255,255,0.1);
            color: white !important;
        }

        /* Perbaikan agar opsi dropdown tidak putih polos */
        select option {
            background: #1e293b;
            color: white;
        }

        input::placeholder, textarea::placeholder {
            color: #94a3b8;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border: 1px solid #3b82f6;
            box-shadow: 0 0 8px #3b82f655;
        }

        /* BUTTON */
        .btn {
            background: linear-gradient(45deg, #3b82f6, #2563eb);
            border-radius: 10px;
            padding: 8px;
            font-size: 12px;
            font-weight: bold;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px #3b82f688;
        }

        /* TABLE */
        table { border-collapse: separate; border-spacing: 0 10px; }
        thead { color: #9ca3af; }
        tbody tr { background: rgba(255,255,255,0.04); transition: 0.3s; }
        tbody tr:hover { background: rgba(255,255,255,0.08); }
        td { padding: 12px; }

        .badge { padding: 3px 8px; border-radius: 999px; font-size: 11px; font-weight: bold; }
        .pending { background: #facc15; color: black; }
        .processing { background: #3b82f6; color: white; }
        .done { background: #22c55e; color: black; }
    </style>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="glass p-4 text-green-400 border border-green-500/30">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="glass p-5">
                <form action="{{ route('dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Cari nama / lokasi..." class="p-2 rounded outline-none">
                    <select name="category_id" class="p-2 rounded outline-none">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    <select name="status" class="p-2 rounded outline-none">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                    <button type="submit" class="btn text-white">Filter</button>
                </form>
            </div>

            <div class="glass p-6 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-400">
                            <th class="px-4">Pelapor</th>
                            <th class="px-4">Kategori & Lokasi</th>
                            <th class="px-4">Aspirasi</th>
                            <th class="px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aspirasis as $row)
                            <tr>
                                <td class="px-4">
                                    <div class="font-bold">{{ $row->user->name }}</div>
                                    <div class="text-xs text-gray-400">NIS: {{ $row->user->username }}</div>
                                    <div class="text-xs text-gray-500">{{ $row->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-4">
                                    <div class="text-blue-400 font-semibold">{{ $row->category->category_name }}</div>
                                    <div class="text-xs text-gray-400 italic">{{ $row->location }}</div>
                                </td>
                                <td class="px-4 text-gray-300">{{ $row->description }}</td>
                                <td class="px-4 min-w-[200px]">
                                    <form action="{{ route('aspirasi.update', $row->id) }}" method="POST" class="space-y-2">
                                        @csrf
                                        {{-- Hapus @method('PATCH') jika route di web.php pakai Route::post --}}
                                        
                                        <select name="status" class="w-full text-xs p-2 rounded outline-none">
                                            <option value="pending" {{ $row->status == 'pending' ? 'selected' : '' }}>PENDING</option>
                                            <option value="processing" {{ $row->status == 'processing' ? 'selected' : '' }}>PROCESSING</option>
                                            <option value="done" {{ $row->status == 'done' ? 'selected' : '' }}>DONE</option>
                                        </select>
                                        <textarea name="feedback" rows="2" class="w-full text-xs p-2 rounded outline-none" placeholder="✍️ Tanggapan..." required>{{ $row->feedback->content ?? '' }}</textarea>
                                        <button type="submit" class="btn text-white w-full">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>