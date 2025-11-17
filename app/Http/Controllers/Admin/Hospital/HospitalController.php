<?php

namespace App\Http\Controllers\Admin\Hospital;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\User;

class HospitalController extends Controller
{
   public function index()
    {
        // Pull hospitals with linked user and appointment count
        $hospitals = Hospital::query()
            ->with(['user:id,name,email,phone'])      // eager-load basics
            // ->withCount('appointments')               // requires appointments() relation
            ->latest('id')
            ->get(['id','hospital_id','user_id','specialities']);

        return view('admin.hospital.index', compact('hospitals'));
    }

    public function create()
    {
        return view('admin.hospital.add-hospital');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // user fields (ALL basic info saved in users)
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email','max:255'],
            'phone'    => ['nullable','string','max:50'],
            'address'  => ['nullable','string','max:500'],
            'city'     => ['nullable','string','max:100'],
            'state'    => ['nullable','string','max:100'],
            'zipcode'  => ['nullable','string','max:20'],

            // hospital
            'specialities' => ['required','string','max:500'],

            // departments (optional)
            'departments'   => ['nullable','array'],
            'departments.*' => ['nullable','string','max:255'],
        ]);

        DB::transaction(function () use ($data) {
            // Upsert basic info into users
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name'     => $data['name'],
                    'email'    => $data['email'],
                    'phone'    => $data['phone'] ?? null,
                    'address'  => $data['address'] ?? null,
                    'city'     => $data['city'] ?? null,
                    'state'    => $data['state'] ?? null,
                    'zipcode'  => $data['zipcode'] ?? null,
                    'password' => bcrypt(str()->random(16)), // if required in schema
                ]
            );

            // Generate a unique PID like PID-01 in a concurrency-safe way
            $nextPid = $this->nextHospitalPid();

            // Create hospital with the generated PID
            $hospital = Hospital::create([
                'hospital_id'  => $nextPid,
                'user_id'      => $user->id,
                'specialities' => $data['specialities'],
            ]);

            // Departments (optional)
            $deps = collect($data['departments'] ?? [])
                ->filter(fn ($d) => filled($d))
                ->map(fn ($d) => ['name' => $d])
                ->values()
                ->all();

            if (!empty($deps)) {
                $hospital->department()->createMany($deps);
            }
        });

        return redirect()->route('admin.hospital')->with('success', 'Record saved successfully.');
    }

    public function view($id)
    {
        $hospital = Hospital::with('user')->findOrFail($id);
        return view('admin.hospital.hospital-detail', compact('hospital'));
    }

    public function edit($id)
    {
        // dd($id);
        $hospital = Hospital::with('department')->find($id);
        // dd($hospital);
        return view('admin.hospital.edit-hospital', compact('hospital'));
    }

    public function update(Request $request, $id)
    {
        
        $data = $request->validate([
            // user fields
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email','max:255'],
            'phone'    => ['nullable','string','max:50'],
            'address'  => ['nullable','string','max:500'],
            'city'     => ['nullable','string','max:100'],
            'state'    => ['nullable','string','max:100'],
            'zipcode'  => ['nullable','string','max:20'],

            // hospital
            'specialities' => ['required','string','max:500'],
        ]);

        DB::transaction(function () use ($data, $id) {
            $hospital = Hospital::findOrFail($id);
            $user = $hospital->user;

            // Update user info
            $user->update([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'phone'    => $data['phone'] ?? null,
                'address'  => $data['address'] ?? null,
                'city'     => $data['city'] ?? null,
                'state'    => $data['state'] ?? null,
                'zipcode'  => $data['zipcode'] ?? null,
            ]);

            // Update hospital info
            $hospital->update([
                'specialities' => $data['specialities'],
            ]);
        });

        return redirect()->route('admin.hospital')->with('success', 'Record updated successfully.');
    }

    public function destroy($hospital_id)
    {
        $hospital = Hospital::where('hospital_id', $hospital_id)->firstOrFail();
        $hospital->delete();

        return response()->json(['success' => true, 'message' => 'Hospital deleted successfully']);
    }

    protected function nextHospitalPid(): string
    {
        $last = Hospital::query()
            ->whereNotNull('hospital_id')
            ->lockForUpdate()
            ->orderByDesc('id')
            ->value('hospital_id'); 

        $nextNumber = 1;
        if ($last && preg_match('/^PID-(\d+)$/', $last, $m)) {
            $nextNumber = (int)$m[1] + 1;
        }

        // Pad to at least 2 digits; change to 3 if you prefer.
        return 'PID-' . str_pad((string)$nextNumber, 2, '0', STR_PAD_LEFT);
    }
}
