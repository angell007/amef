<?php

namespace App\Http\Controllers;

use App\Componente;
use App\FallaFuncional;
use App\Funcion;
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

            $parte = Parte::with(
                [
                    'funcionsubsistemas',
                    'funcionsubsistemas.funciones',
                    'funcionsubsistemas.funciones.fallafuncional',
                    'funcionsubsistemas.funciones.fallafuncional.modofalla',
                    'funcionsubsistemas.funciones.fallafuncional.modofalla.causafalla',
                    'funcionsubsistemas.funciones.fallafuncional.modofalla.causafalla.efectofalla',
                    'funcionsubsistemas.funciones.fallafuncional.modofalla.causafalla.efectofalla.actividades'
                ]
            )->find(request()->get('Id'));


            $spreadsheet = IOFactory::load('./operacionales/base.xlsx');
            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->getCell('A11')->setValue($parte->nombre);

            $casillaFuncionSub = 12;

            $countMax1 = 0;
            $countMax2 = 0;
            $countMax3 = 0;
            $countMax4 = 0;
            $countMax5 = 0;
            $countMax6 = 0;
            $countMax7 = 0;


            foreach ($parte->funcionsubsistemas as $funcionsubsistema) {

                $casilla1 = 12 + $countMax3;
                $worksheet->getCell('A' . $casilla1)->setValue($funcionsubsistema->nombre);
                $countMax1 = count($funcionsubsistema->funciones);

                foreach ($funcionsubsistema->funciones as $funcion) {

                    $casilla2 = 12 + $countMax3;
                    $worksheet->getCell('B' . $casilla2)->setValue($funcion->nombre);
                    $countMax2 += count($funcion->fallafuncional);

                    foreach ($funcion->fallafuncional as $ffuncional) {

                        $casilla3 = 12 + $countMax3;
                        $worksheet->getCell('D' . $casilla3)->setValue($ffuncional->nombre);
                        $countMax3 += count($ffuncional->modofalla);

                        foreach ($ffuncional->modofalla as $modo) {
                            $casilla4 = 12 + $countMax4;
                            $worksheet->getCell('E' . $casilla4)->setValue($modo->nombre);
                            $countMax4 += count($modo->causafalla);

                            foreach ($modo->causafalla as $causa) {
                                $casilla5 = 12 + $countMax5;
                                $worksheet->getCell('G' . $casilla5)->setValue($causa->nombre);
                                $countMax5 += count($causa->efectofalla);

                                foreach ($causa->efectofalla as $efecto) {
                                    $casilla6 = 12 + $countMax6;
                                    $worksheet->getCell('H' . $casilla6)->setValue($efecto->nombre);
                                    $countMax6 += count($efecto->actividades);

                                    foreach ($efecto->actividades as $actividades) {
                                        $casilla7 = 12 + $countMax7;
                                        $worksheet->getCell('I' . $casilla7)->setValue($actividades->nombre);
                                        $countMax7 += 1;
                                    }
                                }
                            }
                        }
                    }
                }
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
