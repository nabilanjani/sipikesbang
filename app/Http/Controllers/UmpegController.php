<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Staf;
use App\Models\Bidang;
use App\Models\Category;
use App\Models\Item;

class UmpegController extends Controller
{

    /**
     * Menampilkan halaman pengajuan inventaris.
     */
    public function index()
    {
        $user = Auth::user();
        $items = Item::with('category')->get();
        $bidang = Bidang::all();
        $staf = Staf::all();
        $transactions = Transaction::all();
        return view('umpeg.dashboard', compact('items', 'bidang', 'staf'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $items = Item::with('category')
            ->where('name', 'like', '%' . $searchTerm . '%')
            ->get();

        $bidang = Bidang::all();
        $staf = Staf::all();

        return view('umpeg.dashboard', [
            'items' => $items,
            'bidang' => $bidang,
            'staf' => $staf,
            'search' => $searchTerm
        ]);
    }


    public function riwayat(Request $request)
    {
        $user = Auth::user();
        $items = Item::with('category')->get();
        $bidang = Bidang::all();
        $staf = Staf::all();
        $categories = Category::all();
        $transactions = Transaction::orderBy('submission_date', 'desc')->get();
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


        return view('umpeg.riwayat', compact('groupedTransactions', 'items', 'bidang', 'staf', 'transactions', 'categories'));
    }

    // Method untuk mengambil detail transaksi
    public function showTransactionDetails($id)
    {
        $user = Auth::user();

        // Ambil transaksi berdasarkan ID
        $transaction = Transaction::with(['item', 'staff'])->findOrFail($id);

        // Kembalikan data transaksi sebagai JSON
        return response()->json($transaction);
    }



    /**
     * Menangani pengajuan inventaris dengan OTP WhatsApp via Wablas.
     */
    public function pengajuan(Request $request)
    {
        //dd($request->all()); // Cek apakah data sampai ke backend
        
        $request->validate([
            'bidang' => 'required|exists:bidang,id',
            'staf' => 'required|exists:staf,id',
            'email' => 'required|email',
            'submission_date' => 'required|date',
            'items' => 'required|json',
            'description' => 'nullable|string', // Pastikan ada
            'status' => 'required|string' // Pastikan ada

        ]);
        //dd("Validasi berhasil!");

        $items = json_decode($request->items, true);
        if (!is_array($items)) {
            return redirect()->back()->withErrors(['items' => 'Format data items tidak valid.']);
        }


        foreach ($items as $itemData) {
            $item = Item::find($itemData['id']);
    
            if (!$item) {
                return redirect()->back()->withErrors(['items' => "Item dengan ID {$itemData['id']} tidak ditemukan."]);
            }
    
            if ($item->quantity < $itemData['quantity']) {
                return redirect()->back()->withErrors(['items' => "Stok tidak mencukupi untuk item: {$item->name}."]);
            }
    
            // Kurangi stok
            $item->quantity -= $itemData['quantity'];
            $item->save();
    
            // Simpan transaksi
            Transaction::create([
                'item_id' => $item->id,
                'category_id' => $item->category_id ?? null,
                'staff_id' => $request->staf,
                'bidang_id' => $request->bidang,
                'quantity' => $itemData['quantity'],
                'email' => $request->email,
                'submission_date' => $request->submission_date,
                'description' => $request->description,
                'status' => 'pending',
            ]);
        }

        session()->flash('success', 'Pengajuan berhasil dibuat!');

        return redirect()->route('umpeg.dashboard');
    }


    public function delete($id)
    {
        // Temukan transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);
    
        // Hapus transaksi
        $transaction->delete();
    
        // Mengalihkan kembali ke halaman sebelumnya dengan flash message
        return redirect()->route('umpeg.riwayat')->with('success', 'Pengajuan berhasil dihapus!');
    }
    

}
