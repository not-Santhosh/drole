<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Department;
use App\Models\Programme;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, ShouldQueue, WithBatchInserts, WithChunkReading
{
    use SkipsFailures;

    public function model(array $row)
    {
        $dept = Department::where('name', $row['department'])->first();
        $prog = Programme::where('name', $row['programme'])->first();

        return new Student([
            'name'          => $row['name'],
            'department_id' => $dept?->id,
            'programme_id'  => $prog?->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'department' => 'required|exists:departments,name',
            'programme'  => 'required|exists:programmes,name',
        ];
    }

    /**
     * Custom error messages (Optional)
     */
    public function customValidationMessages()
    {
        return [
            'department.exists' => 'The department ":input" was not found in the database.',
            'programme.exists'  => 'The programme ":input" was not found in the database.',
        ];
    }

    public function batchSize(): int { return 1000; }
    
    public function chunkSize(): int { return 1000; }
}