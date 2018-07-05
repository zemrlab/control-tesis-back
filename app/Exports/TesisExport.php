<?php

namespace App\Exports;
 
use App\Tesis;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
 
class TesisExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Tesis::all();
    }
 
    public function headings(): array
    {
        return [
            'id',
            'Código de alumno',
            'Asesor',
            'Fecha de inscripción',
            'Título de tesis',
            'Número de inscripción'
        ];
    }
 
}