<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // =========================
    // Reservations Index
    // =========================
    public function index(Request $request)
    {
        $query = Reservation::where('is_archive', 0);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $totalArchived = Reservation::where('is_archive', 1)->count();

        if ($request->filled('search_id')) {
            $query->where('id', $request->search_id);
        }

        $reservations = $query->latest()->paginate(10);

        $totalReservations = Reservation::count();
        $pending = Reservation::where('status', 'pending')->count();
        $confirmed = Reservation::where('status', 'confirmed')->count();
        $completed = Reservation::where('status', 'completed')->count();

        return view('reservations.index', compact(
            'reservations',
            'totalReservations',
            'pending',
            'confirmed',
            'completed',
            'totalArchived'
        ));
    }


    public function confirmStatus($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'confirmed']);

        return redirect()->back()->with('status', 'تم تأكيد الحجز بنجاح!');
    }

    public function completeStatus($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'completed']);

        return redirect()->back()->with('status', 'تم تسجيل الحجز كمكتمل (تم الحضور)!');
    }



    // =========================
    // Create
    // =========================
    public function create()
    {
        return view('reservations.create');
    }

    // =========================
    // Store
    // =========================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'guests' => 'required|integer|min:1',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'notes' => 'nullable|string',
        ]);

        $validated['status'] = 'pending';
        $validated['is_archive'] = 0;
        $validated['is_delete'] = 0;

        Reservation::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'تم إضافة الحجز بنجاح!'
        ]);
    }

    // =========================
    // Edit
    // =========================
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);

        return view('reservations.edit', compact('reservation'));
    }

    // =========================
    // Update
    // =========================
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'phone'             => 'required|string|max:20',
            'guests'            => 'required|integer|min:1',
            'reservation_date'  => 'required|date',
            'reservation_time'  => 'required',
            'status'            => 'required|in:pending,confirmed,cancelled,completed',
            'notes'             => 'nullable|string',
        ]);

        $reservation->update($validated);

        return redirect()
            ->route('reservations.index')
            ->with('status', 'تم تحديث الحجز بنجاح!');
    }

    // =========================
    // Delete
    // =========================
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()
            ->back()
            ->with('status', 'تم حذف الحجز نهائيًا!');
    }
    // =========================
    // Archive
    // =========================
    public function archive(Request $request)
    {
        $query = Reservation::where('is_archive', 1);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search_id')) {
            $query->where('id', $request->search_id);
        }

        $reservations = $query->latest()->paginate(10);

        $totalArchived = Reservation::where('is_archive', 1)->count();

        return view('reservations.archive', compact('reservations', 'totalArchived'));
    }

    public function moveToArchive($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['is_archive' => 1]);

        return redirect()->route('reservations.index')->with('status', 'تم أرشفة الحجز بنجاح!');
    }


    // =========================
    // Archived
    // =========================
    public function archived()
    {
        $reservations = Reservation::where('is_archive', 1)
            ->where('is_delete', 0)
            ->latest()
            ->paginate(10);

        return view('reservations.archived', compact('reservations'));
    }

    public function restore($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['is_archive' => 0]);

        return redirect()->route('reservations.archive')->with('status', 'تم استعادة الحجز بنجاح!');
    }

}
