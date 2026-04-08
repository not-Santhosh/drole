<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Http\Requests\AddStudentRequest;
use App\Http\Resources\ProgrammeResource;
use App\Imports\StudentsImport;
use App\Models\Department;
use App\Models\Programme;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Student::with(['department', 'programme']))->make(true);
        }
        
        $departments = Department::all();
        return view('student', compact('departments'));
    }

    public function store(AddStudentRequest $request)
    {
        Student::create($request->only('name', 'department_id', 'programme_id'));
        return response()->json(['message' => 'Student added successfully']);
    }

    public function getProgrammes($department_id)
    {
        return response()->json(
            ProgrammeResource::collection(Programme::where('department_id', $department_id)->get())
        );
    }

    public function export() 
    {
        return Excel::download(new StudentsExport, 'students_' . now()->timestamp . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,csv']);
        Excel::import(new StudentsImport, $request->file('file'));
       return response()->json(['message' => 'Import started successfully. kindly reload the page after some time.']);
    }
}
