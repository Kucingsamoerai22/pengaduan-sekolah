<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        if (auth()->user()->role === 'admin') {
            // Admin hanya melihat yang belum diarsipkan (is_archived = false)
            $query = Complaint::with(['category', 'user', 'feedback'])
                ->where('is_archived', false);

            if ($request->has('search')) {
                $query->where(function($q) use ($request) {
                    $q->whereHas('user', function ($u) use ($request) {
                        $u->where('name', 'like', '%'.$request->search.'%');
                    })->orWhere('location', 'like', '%'.$request->search.'%');
                });
            }

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $aspirasis = $query->latest()->get();

            return view('admin.dashboard', compact('aspirasis', 'categories'));
        }

        // Logic Siswa: Hanya melihat miliknya sendiri
        $aspirasis = Complaint::with(['category', 'feedback'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard', compact('categories', 'aspirasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Complaint::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'location' => $request->location,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Aspirasi Anda berhasil terkirim!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,done',
            'feedback' => 'required|string',
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->update([
            'status' => $request->status,
        ]);

        Feedback::updateOrCreate(
            ['complaint_id' => $id],
            [
                'admin_id' => auth()->id(),
                'content' => $request->feedback,
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Status dan tanggapan berhasil diperbarui!');
    }

    /**
     * Fitur Hapus untuk Siswa
     */
    public function destroy($id)
    {
        // Keamanan: Pastikan aspirasi milik user yang login dan sudah berstatus 'done'
        $aspirasi = Complaint::where('user_id', auth()->id())
            ->where('status', 'done')
            ->findOrFail($id);

        $aspirasi->delete();

        return back()->with('success', 'Riwayat aspirasi berhasil dihapus!');
    }

    /**
     * Fitur Arsip untuk Admin (Soft Delete Admin)
     */
    public function archive($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->update(['is_archived' => true]);

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil diarsipkan.');
    }

    public function archivedPage()
    {
        $aspirasis = Complaint::with(['category', 'user', 'feedback'])
            ->where('is_archived', true)
            ->latest()
            ->get();
        
        return view('admin.archived', compact('aspirasis'));
    }

    public function restore($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->update(['is_archived' => false]);

        return redirect()->route('aspirasi.archived')->with('success', 'Laporan berhasil dipulihkan.');
    }
}