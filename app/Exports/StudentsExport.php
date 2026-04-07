<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Student::with(['department', 'programme'])->get();
    }

    public function headings(): array
    {
        return ['Name', 'Department', 'Programme'];
    }

    public function map($student): array
    {
        return [
            $student->name,
            $student->department?->name ?? 'N/A',
            $student->programme?->name ?? 'N/A',
        ];
    }
}