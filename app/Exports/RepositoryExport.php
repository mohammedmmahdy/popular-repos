<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class RepositoryExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    use Exportable;

    protected $repositories;

    public function __construct($repositories)
    {
        $this->repositories = $repositories;
    }

    public function collection()
    {
        // dd($this->repositories);
        return $this->repositories;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Owner',
            'Language',
            'Forks',
            'Created at',
        ];
    }

    public function map($repository): array
    {
        return [
            $repository['name'],
            $repository['owner']['login'],
            $repository['language'],
            $repository['forks_count'],
            $repository['created_at'],
        ];
    }

    public function styles($sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
