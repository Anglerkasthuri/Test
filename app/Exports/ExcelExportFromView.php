<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\Exportable;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ExcelExportFromView implements FromView
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $fileName;

    public function __construct($query, $headings, $columns, $view = "")
    {
        $this->query = $query;
        $this->headings = $headings;
        $this->columns = $columns;
        $this->view  = ($view) ?? 'exports.excel';
    }

    public function view(): View
    {
        return view($this->view, [
            'headings' => $this->headings,
            'columns' => $this->columns,
            'records' => $this->query->get(),
        ]);
    }

    public function setFileName(string | null $fileName = null)
    {
        $fileName = $fileName ?? Str::of(self::class)->classBasename();
        $this->fileName = Str::of($fileName)
            ->append(' - ')
            ->append('[')
            // ->append(Carbon::now()->format('Y_m_d_H_i_s'))
            ->append(Carbon::now()->setTimezone(Auth::user()->time_zone ?? config('settings.orgTimezone'))->format(config('settings.file_export_format')))
            ->append(']')
            ->append('.xlsx')
            ->__toString();

        return $this;
    }    


    public function styles(Worksheet $sheet)
    {
        // return [];
        return collect(range('A', 'E'))
            ->mapWithKeys(function ($value) {
                return [
                    $value => [
                        'alignment' => [
                            'vertical' => Alignment::VERTICAL_CENTER,
                            'horizontal' => Alignment::HORIZONTAL_LEFT,
                        ],
                    ],
                ];
            })
            ->prepend([
                'font' => ['bold' => true],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
            ], 1)
            ->toArray();
    }

}
