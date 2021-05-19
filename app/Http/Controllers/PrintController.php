<?php

namespace App\Http\Controllers;

use App\Componente;
use App\FuncionSubsistema;
use App\Parte;
use App\Sistema;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PrintController extends Controller
{
    public function print()
    {
        try {

            $parte = Parte::with(['funcionsubsistemas','funcion'])->find(request()->get('Id'));

            $spreadsheet = IOFactory::load('./operacionales/base.xlsx');
            $worksheet = $spreadsheet->getActiveSheet();

            $casillaFuncionSub = 12;
            
            foreach ($parte->funcionsubsistemas as $index => $funcionsubsistema) {


                    $countmodoFalla = 0;
                    $countefectofalla = 0;
                    $countcausafalla = 0;
                    $countfallafuncional = 0;
                    $countactividades = 0;
                    $countmax = 0;

                    $funcionsubsistemax = FuncionSubsistema::with(
                    [
                    'modofalla',
                    'efectofalla',
                    'causafalla',
                    'fallafuncional',
                    'actividades'
                    ]
                    )->find($funcionsubsistema->id);

                    if ($countmax < count($funcionsubsistemax->efectofalla)) {
                        $countmax = count($funcionsubsistemax->efectofalla);
                    }
                    if ($countmax < count($funcionsubsistemax->fallafuncional)) {
                        $countmax = count($funcionsubsistemax->fallafuncional);
                    }
                    if ($countmax < count($funcionsubsistemax->modofalla)) {
                        $countmax = count($funcionsubsistemax->modofalla);
                    }
                    if ($countmax < count($funcionsubsistemax->fallafuncional)) {
                        $countmax = count($funcionsubsistemax->fallafuncional);
                    }
                    if ($countmax < count($funcionsubsistemax->actividades)) {
                        $countmax = count($funcionsubsistemax->actividades);
                    }

                $worksheet->getCell('A' . $casillaFuncionSub)->setValue($funcionsubsistema->nombre);
                $worksheet->getCell('B11')->setValue($parte->nombre);
                $worksheet->getCell('C' . $casillaFuncionSub)->setValue($parte->funcion->nombre);

                if (isset($funcionsubsistemax->fallafuncional)) {
                    foreach ($funcionsubsistemax->fallafuncional as $index => $modo) {
                        $casilla = $casillaFuncionSub + (int)$index;
                        $worksheet->getCell('F' . $casilla)->setValue($modo->nombre);
                    }
                }

                    if (isset($funcionsubsistemax->modofalla)) {
                    foreach ($funcionsubsistemax->modofalla as $index => $modo) {
                        $casilla = $casillaFuncionSub + (int)$index;
                        $worksheet->getCell('H' . $casilla)->setValue($modo->nombre);
                    }
                }

                if (isset($funcionsubsistemax->causafalla)) {
                    foreach ($funcionsubsistemax->causafalla as $index => $modo) {
                        $casilla = $casillaFuncionSub + (int)$index;
                        $worksheet->getCell('J' . $casilla)->setValue($modo->nombre);
                    }
                }

                if (isset($funcionsubsistemax->efectofalla)) {
                    foreach ($funcionsubsistemax->efectofalla as $index => $modo) {
                        $casilla = $casillaFuncionSub + (int)$index;
                        $worksheet->getCell('L' . $casilla)->setValue($modo->nombre);
                    }
                }

                if (isset($funcionsubsistemax->actividades)) {
                    foreach ($funcionsubsistemax->actividades as $index => $modo) {
                        $casilla = $casillaFuncionSub + (int)$index;
                        $worksheet->getCell('N' . $casilla)->setValue($modo->nombre);
                    }
                }

                $casillaFuncionSub = 12 + (int)$index + $countmax ;
                
            }


            

            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save("./operacionales/" . 'autoparte' . ".xls");

            $orden = "./operacionales/" . 'autoparte' . ".xls";
            return response()->download($orden)->deleteFileAfterSend(true);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
