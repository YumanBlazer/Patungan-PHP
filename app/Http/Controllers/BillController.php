<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\BillParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $bills = $user->bills()
            ->with(['participants', 'items'])
            ->latest()
            ->paginate(10);

        return view('bills.index', compact('bills'));
    }

    public function create()
    {
        return view('bills.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_amount' => 'required|numeric|min:0',
            'bill_date' => 'required|date',
            'category' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $bill = Bill::create([
                'title' => $request->title,
                'description' => $request->description,
                'total_amount' => $request->total_amount,
                'currency' => 'IDR',
                'bill_date' => $request->bill_date,
                'created_by' => Auth::id(),
                'category' => $request->category,
                'status' => 'draft',
                'split_method' => 'equal',
            ]);

            // Add creator as participant
            BillParticipant::create([
                'bill_id' => $bill->id,
                'user_id' => Auth::id(),
                'status' => 'accepted',
                'joined_at' => now(),
            ]);

            DB::commit();

            return redirect()->route('bills.show', $bill)
                ->with('success', 'Bill berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->withErrors(['error' => 'Gagal membuat bill: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function show(Bill $bill)
    {
        $bill->load(['creator', 'participants.user', 'items', 'settlements']);
        
        return view('bills.show', compact('bill'));
    }

    public function edit(Bill $bill)
    {
        // Check if user is creator
        if ($bill->created_by !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('bills.edit', compact('bill'));
    }

    public function update(Request $request, Bill $bill)
    {
        // Check if user is creator
        if ($bill->created_by !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_amount' => 'required|numeric|min:0',
            'bill_date' => 'required|date',
            'category' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $bill->update([
                'title' => $request->title,
                'description' => $request->description,
                'total_amount' => $request->total_amount,
                'bill_date' => $request->bill_date,
                'category' => $request->category,
            ]);

            return redirect()->route('bills.show', $bill)
                ->with('success', 'Bill berhasil diupdate!');

        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Gagal mengupdate bill: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy(Bill $bill)
    {
        // Check if user is creator
        if ($bill->created_by !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        try {
            $bill->delete();
            
            return redirect()->route('bills.index')
                ->with('success', 'Bill berhasil dihapus!');

        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Gagal menghapus bill: ' . $e->getMessage()]);
        }
    }

    public function join(Request $request, Bill $bill)
    {
        $user = Auth::user();

        // Check if already participant
        $existingParticipant = BillParticipant::where([
            'bill_id' => $bill->id,
            'user_id' => $user->id,
        ])->first();

        if ($existingParticipant) {
            return back()->withErrors(['error' => 'Anda sudah menjadi peserta bill ini.']);
        }

        try {
            BillParticipant::create([
                'bill_id' => $bill->id,
                'user_id' => $user->id,
                'status' => 'accepted',
                'joined_at' => now(),
            ]);

            return back()->with('success', 'Berhasil bergabung dengan bill!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal bergabung: ' . $e->getMessage()]);
        }
    }

    public function leave(Request $request, Bill $bill)
    {
        $user = Auth::user();

        // Can't leave if creator
        if ($bill->created_by === $user->id) {
            return back()->withErrors(['error' => 'Creator tidak bisa meninggalkan bill.']);
        }

        try {
            BillParticipant::where([
                'bill_id' => $bill->id,
                'user_id' => $user->id,
            ])->delete();

            return redirect()->route('bills.index')
                ->with('success', 'Berhasil meninggalkan bill!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal meninggalkan bill: ' . $e->getMessage()]);
        }
    }

    public function settle(Request $request, Bill $bill)
    {
        // Implementation untuk settle bill
        // Akan diimplementasikan nanti
        return back()->with('info', 'Fitur settle bill akan segera tersedia.');
    }
}
