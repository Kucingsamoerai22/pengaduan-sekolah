<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white tracking-wide">
            🚀 Dashboard Aspirasi Siswa
        </h2>
    </x-slot>

    <style>
        body {
            background: radial-gradient(circle at top, #0f172a, #000) !important;
            color: #fff;
        }

        /* GLASS CARD */
        .glass {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(18px);
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: 0 0 30px rgba(0,0,0,0.6);
            transition: 0.3s;
        }

        .glass:hover {
            transform: translateY(-4px);
        }

        /* INPUT, TEXTAREA, SELECT */
        .glass input,
        .glass textarea,
        .glass select {
            background: #1e293b; 
            border: 1px solid rgba(255,255,255,0.1);
            color: white !important;
            transition: 0.2s;
        }

        .glass select option {
            background: #0f172a;
            color: white;
        }

        .glass input:focus,
        .glass textarea:focus,
        .glass select:focus {
            outline: none;
            border: 1px solid #22c55e;
            box-shadow: 0 0 10px #22c55e55;
        }

        /* BUTTONS */
        .btn-kirim {
            background: linear-gradient(45deg, #22c55e, #16a34a);
            color: white;
            font-weight: bold;
            border-radius: 50px;
            padding: 10px 24px;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-kirim:hover {
            transform: scale(1.07);
            box-shadow: 0 0 15px #22c55e88;
        }

        /* TOMBOL HAPUS */
        .btn-delete {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.4);
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: #ef4444;
            color: white;
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.5);
        }

        /* TABLE */
        table { border-collapse: separate; border-spacing: 0 8px; }
        tbody tr { background: rgba(255,255,255,0.04); transition: 0.3s; }
        tbody tr:hover { background: rgba(255,255,255,0.08); }
        tbody td { padding: 12px; }

        /* STATUS BADGE */
        .badge { padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: bold; }
        .pending { background: #facc15; color: black; }
        .processing { background: #3b82f6; color: white; }
        .done { background: #22c55e; color: black; }

    </style>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="glass p-6 text-center">
                <h1 class="text-2xl font-bold mb-2">🎓 Sistem Aspirasi Digital</h1>
                <p class="text-gray-400 text-sm">Sampaikan keluhan sarana & prasarana dengan cepat dan transparan</p>
            </div>

            @if (session('success'))
                <div class="glass px-4 py-3 text-green-400 mb-4 text-center border border-green-500/30">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="p-6 glass">
                <h2 class="text-lg font-semibold mb-4">📝 Kirim Aspirasi Baru</h2>
                <form method="post" action="{{ route('aspirasi.store') }}" class="space-y-4">
                    @csrf
                    <select name="category_id" class="w-full p-2 rounded-md outline-none" required>
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="location" placeholder="📍 Lokasi (Contoh: Lab Komputer 1)" class="w-full p-2 rounded-md" required>
                    <textarea name="description" rows="4" placeholder="🧾 Detail laporan..." class="w-full p-2 rounded-md" required></textarea>
                    <button type="submit" class="btn-kirim">Kirim Laporan</button>
                </form>
            </div>

            <div class="p-6 glass">
                <h2 class="text-lg font-semibold mb-4">📊 Riwayat Aspirasi</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-gray-400 text-left">
                                <th class="px-4 py-2">Tanggal</th>
                                <th class="px-4 py-2">Kategori</th>
                                <th class="px-4 py-2">Lokasi</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Tanggapan Admin</th>
                                <th class="px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aspirasis as $row)
                                <tr>
                                    <td>{{ $row->created_at->format('d/m/Y') }}</td>
                                    <td class="text-blue-400 font-medium">{{ $row->category->category_name }}</td>
                                    <td>{{ $row->location }}</td>
                                    <td>
                                        <span class="badge 
                                            {{ $row->status == 'pending' ? 'pending' : '' }}
                                            {{ $row->status == 'processing' ? 'processing' : '' }}
                                            {{ $row->status == 'done' ? 'done' : '' }}">
                                            {{ strtoupper($row->status) }}
                                        </span>
                                    </td>
                                    <td class="italic text-gray-400">
                                        {{ $row->feedback->content ?? 'Menunggu tanggapan...' }}
                                    </td>
                                    <td class="text-center">
                                        @if($row->status == 'done')
                                            <form action="{{ route('aspirasi.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat aspirasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-[10px] text-gray-600 uppercase tracking-widest">Locked</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-10 text-gray-500">
                                        <span class="text-3xl block mb-2">😢</span>
                                        Belum ada laporan yang dikirim.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>