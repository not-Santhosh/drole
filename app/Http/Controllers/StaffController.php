<?php

namespace App\Http\Controllers;

use App\Exports\StaffExport;
use App\Http\Requests\AddStaffRequest;
use App\Imports\StaffImport;
use App\Models\Department;
use App\Models\Staff;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Staff::with(['department']))->make(true);
        }
        
        $departments = Department::all();
        return view('staff', compact('departments'));
    }

    public function store(AddStaffRequest $request)
    {
        Staff::create($request->only('name', 'department_id'));
        return response()->json(['message' => 'Staff added successfully']);
    }

    public function export() 
    {
        return Excel::download(new StaffExport, 'staff_' . now()->timestamp . '.xlsx');
    }

    public function import(Request $request) 
    {
        $request->validate(['file' => 'required|mimes:xlsx,csv']);
        Excel::queueImport(new StaffImport, $request->file('file'));
        return response()->json(['message' => 'Import started successfully. You will receive a notification when it is completed.']);
    }
}