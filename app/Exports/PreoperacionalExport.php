<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PreoperacionalExport implements FromView, WithEvents, ShouldAutoSize
{
    use Exportable;

    public $data;


    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        try{
            // $marca = Marca::find($service->equipo->marca);

            $spreadsheet = IOFactory::load('./operacionales/base.xlsx');
            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->getCell('A12')->setValue('Descripcion');
            $worksheet->getCell('G8:H8')->setValue('aqui');

            // $text = '';
            // foreach (Clausula::where('marca_id', $service->equipo->marca)->get() as $clausuala) {
            //     $text .= $clausuala->descripcion;
            // }


            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save("./operacionales/" . 'autoparte' . ".xls");

            return 'autoparte';
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->getColumnDimension('S')->setAutoSize(false);
                $event->sheet->getColumnDimension('S')->setWidth(50);
                $event->sheet->getColumnDimension('C')->setAutoSize(false);
                $event->sheet->getColumnDimension('C')->setWidth(15);
                $event->sheet->getColumnDimension('I')->setAutoSize(false);
                $event->sheet->getColumnDimension('I')->setWidth(15);
                $event->sheet->getColumnDimension('K')->setAutoSize(false);
                $event->sheet->getColumnDimension('K')->setWidth(15);
                $event->sheet->getColumnDimension('L')->setAutoSize(false);
                $event->sheet->getColumnDimension('L')->setWidth(15);
            }
        ];
    }
}
