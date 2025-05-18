<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\Bidang;
use App\Models\Staf;

class AdminController extends Controller
{
    
    // Menampilkan halaman kelola inventaris
    public function index()
    {
        $user = Auth::user();
        $items = Item::with('category')->get();
        $categories = Category::all();

        return view('admin.kelola', compact('items', 'categories'));
    }

    // Fungsi untuk melakukan pencarian
    public function search(Request $request)
    {
        $search = $request->input('search');

        $items = Item::with('category')
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        $categories = Category::all();

        return view('admin.kelola', compact('items', 'categories', 'search'));
    }


    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $items = Item::with('category')->get();
        $categories = Category::all();
        $transactions = Transaction::orderBy('submission_date', 'desc')->get();
        $bidang = Bidang::all();
        $staf = Staf::all();

        // Query dasar untuk mengambil data transaksi
        $query = Transaction::query();

        // Filter berdasarkan Bidang
        if ($request->has('bidang') && $request->bidang != '') {
            $query->where('bidang_id', $request->bidang);
        }

        // Filter berdasarkan Durasi
        if ($request->has('duration') && $request->duration != '') {
            $date = now();
            switch ($request->duration) {
                case 'this week':
                    $query->whereBetween('submission_date', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'this month':
                    $query->whereMonth('submission_date', now()->month);
                    break;
                case 'last 3 months':
                    $query->whereBetween('submission_date', [now()->subMonths(3), now()]);
                    break;
                case 'last 6 months':
                    $query->whereBetween('submission_date', [now()->subMonths(6), now()]);
                    break;
                case 'this year':
                    $query->whereYear('submission_date', now()->year);
                    break;
            }
        }

        // Ambil data transaksi yang telah difilter
        $transactions = $query->get();

        // Mengelompokkan transaksi
        $groupedTransactions = $transactions->groupBy(function($item) {
            return $item->submission_date . '-' . $item->email;
        });

        return view('admin.dashboard', compact('items', 'categories', 'transactions', 'bidang', 'staf'));
    }

    // Menyimpan data inventaris baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'condition' => 'required|in:baik,rusak,hilang',
            'procurement_date' => 'required|date',
            'price' => 'required|numeric|min:0',
        ]);

        // Simpan data ke database dan tangani potensi kesalahan
        try {
            Item::create($validated);
            return redirect()->back()->with('success', 'Inventaris berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan inventaris. Silakan coba lagi.');
        }
    }
    public function show($id)
    {
        $user = Auth::user();
        $item = Item::findOrFail($id);
        return view('admin.detail', compact('item'));
    }
    public function edit($id)
    {
        $user = Auth::user();
        $item = Item::findOrFail($id);
        $categories = Category::all(); // Jika ada kategori
        return view('admin.edit', compact('item', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'quantity' => 'required|numeric',
            'condition' => 'required|string|max:100',
            'procurement_date' => 'required|date',
            'price' => 'required|numeric',
        ]);

        $item = Item::findOrFail($id);
        $item->update($validated);

        return redirect()->back()->with('success', 'Item berhasil diperbarui!');
    }


    public function filter(Request $request)
    {
        $categoryId = $request->input('category_id');
        $categories = Category::all();
        $items = Item::when($categoryId, function($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->get();

        return view('admin.kelola', compact('items', 'categories'));
    }


    // Menghapus item
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.kelola')->with('success', 'Item berhasil dihapus.');
    }

    public function pending($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'Pending';
        $transaction->save();

        return redirect()->route('admin.dashboard')->with('success', 'Persetujuan berhasil dibatalkan.');
    }

    // Di Controller AdminController
    public function approve($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return redirect()->route('admin.dashboard')->with('error', 'Transaksi tidak ditemukan');
        }

        // Lakukan perubahan pada status transaksi
        $transaction->status = 'Approved';
        $transaction->save();

        // Kirimkan flash message
        return redirect()->route('admin.dashboard')->with('success', 'Transaksi berhasil disetujui');
    }

    public function generatePDF(Request $request)
    {
        // Ambil parameter filter
        $bidangId = $request->input('bidang');
        $duration = $request->input('duration');

        $transactions = Transaction::query();

        // Filter berdasarkan bidang
        if ($bidangId) {
            $transactions->where('bidang_id', $bidangId);
        }

        // Filter berdasarkan durasi
        if ($duration) {
            $date = Carbon::now();

            switch ($duration) {
                case 'this week':
                    $transactions->whereBetween('submission_date', [
                        $date->startOfWeek()->toDateString(),
                        $date->endOfWeek()->toDateString()
                    ]);
                    break;
                case 'this month':
                    $transactions->whereMonth('submission_date', $date->month)
                                ->whereYear('submission_date', $date->year);
                    break;
                case 'last 3 months':
                    $transactions->where('submission_date', '>=', $date->subMonths(3)->startOfMonth()->toDateString());
                    break;
                case 'last 6 months':
                    $transactions->where('submission_date', '>=', $date->subMonths(6)->startOfMonth()->toDateString());
                    break;
                case 'this year':
                    $transactions->whereYear('submission_date', $date->year);
                    break;
            }
        }

        // Ambil data transaksi yang sudah difilter
        $transactions = $transactions->get();

        // Group transaksi berdasarkan bidang dan bulan
        $groupedTransactions = $transactions->groupBy(function ($item) {
            return $item->submission_date . '-' . $item->email;
        });

        // Generate PDF menggunakan domPDF
        $pdf = PDF::loadView('admin.pdf', compact('groupedTransactions'));
        return $pdf->download('pengajuan_inventaris.pdf');
    }

}
