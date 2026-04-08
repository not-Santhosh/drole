<?php

namespace App\Exports;

use App\Models\Staff;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StaffExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Staff::with(['department'])->get();
    }

    public function headings(): array
    {
        return ['Name', 'Department'];
    }

    public function map($staff): array
    {
        return [
            $staff->name,
            $staff->department?->name ?? 'N/A',
        ];
    }
}