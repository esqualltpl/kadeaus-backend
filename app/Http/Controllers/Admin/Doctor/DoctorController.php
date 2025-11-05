<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Qualification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with(['user', 'hospital.user', 'department'])->latest()->get();
        return view('admin.doctor.index', compact('doctors'));
    }

    public function create()
    {
        $hospitals   = Hospital::with('user:id,name')->get();
        $departments = Department::select('id', 'name')->get();
        return view('admin.doctor.add-doctor', compact('hospitals', 'departments'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            // basic info for user
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:50',
            'dob'        => 'nullable|date',
            'gender'     => 'nullable|string|max:10',
            'address'    => 'nullable|string|max:255',
            'city'       => 'nullable|string|max:100',
            'state'      => 'nullable|string|max:100',
            'zipcode'    => 'nullable|string|max:20',

            // doctor relations
            'hospital_id'        => 'required|exists:hospitals,id',
            'department_id'      => 'required|exists:departments,id',
            'speciality_hours'   => 'nullable|string|max:255',
            'working_hours_from' => 'nullable|string|max:50',
            'working_hours_to'   => 'nullable|string|max:50',

            // qualification
            'degree'             => 'nullable|string|max:255',
            'institute'          => 'nullable|string|max:255',
            'start_date'         => 'nullable|date',
            'end_date'           => 'nullable|date|after_or_equal:start_date',
            'total_marks_CGPA'   => 'nullable|string|max:50',
            'achieved_marks_CGPA'=> 'nullable|string|max:50',
            'attachment'         => 'nullable|file|mimes:pdf|max:4096',
        ]);
        // dd('dff');
        DB::transaction(function () use ($validated, $request) {
            // Create or update user
            $user = User::updateOrCreate(
                ['email' => $validated['email']],
                [
                    'name'     => $validated['name'],
                    'email'    => $validated['email'],
                    'phone'    => $validated['phone'] ?? null,
                    'dob'      => $validated['dob'] ?? null,
                    'gender'   => $validated['gender'] ?? null,
                    'address'  => $validated['address'] ?? null,
                    'city'     => $validated['city'] ?? null,
                    'state'    => $validated['state'] ?? null,
                    'zipcode'  => $validated['zipcode'] ?? null,
                    'password' => bcrypt(str()->random(10)),
                ]
            );
            // Doctor creation
            $doctor = Doctor::create([
                'user_id'           => $user->id,
                'hospital_id'       => $validated['hospital_id'],
                'department_id'     => $validated['department_id'],
                'speciality_hours'  => $validated['speciality_hours'] ?? null,
                'working_hours_from'=> $validated['working_hours_from'] ?? null,
                'working_hours_to'  => $validated['working_hours_to'] ?? null,
            ]);
            // dd($doctor);
            // Qualification creation (store PDF base64)
            if ($request->hasFile('attachment')) {
                $pdfFile = $request->file('attachment');
                $pdfData = base64_encode(file_get_contents($pdfFile->getRealPath()));
            } else {
                $pdfData = null;
            }
            // dd($pdfFile);
            if (!empty($validated['degree']) || !empty($validated['institute'])) {
                Qualification::create([
                    'degree'              => $validated['degree'] ?? null,
                    'institute'           => $validated['institute'] ?? null,
                    'start_date'          => $validated['start_date'] ?? null,
                    'end_date'            => $validated['end_date'] ?? null,
                    'total_marks_CGPA'    => $validated['total_marks_CGPA'] ?? null,
                    'achieved_marks_CGPA' => $validated['achieved_marks_CGPA'] ?? null,
                    'attachment'          => $pdfData, // store encoded PDF in DB
                    'hospital_id'         => $validated['hospital_id'],
                    'doctor_id'           => $doctor->id,
                    'user_id'             => $user->id,
                ]);
                // dd('dfa');
            }
        });

        return redirect()->route('admin.doctor')->with('success', 'Doctor created successfully!');
    }

    public function viewDoctor()
    {
        return view('admin.doctor.view-doctor');
    }
}
