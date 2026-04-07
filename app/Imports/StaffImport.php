<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StaffImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, ShouldQueue, WithBatchInserts, WithChunkReading
{

    use SkipsFailures;

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Staff([
            'name'           => $row['name'],
            'department_id'  => Department::where('name', $row['department'])->first()?->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'department' => 'required|exists:departments,name',
        ];
    }

    public function batchSize(): int { return 1000; }
    
    public function chunkSize(): int { return 1000; }
}
