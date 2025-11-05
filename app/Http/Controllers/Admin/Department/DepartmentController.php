<?php

namespace App\Http\Controllers\Admin\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function create(Request $request)
    {
        // Logic to show the create department form
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'department_name' => 'required|string|max:255',            
        ]);
    }
}
