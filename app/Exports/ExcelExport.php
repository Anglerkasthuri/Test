<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithProperties;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ExcelExport implements FromQuery, Responsable, ShouldAutoSize, WithHeadings, WithStyles
{
    use Exportable;

    protected $queryBuilderInstace;
    protected array $headings;
    protected array $exportRows;
    protected $fileName;

    /**
     * Set the Query Builder instance
     *
     * @param Illuminate\Database\Query\Builder $queryBuilderInstace
     *
     * @return $this
     */
    public function setQueryBuilder($queryBuilderInstace)
    {
        $this->setFileName();
        $this->queryBuilderInstace = $queryBuilderInstace;
        return $this;
    }


    /**
     * Set the Query Builder instance
     *
     * @param Illuminate\Database\Query\Builder $queryBuilderInstace
     *
     * @return $this
     */
    public function setColumns($exportRows)
    {
        $this->exportRows = $exportRows;
        return $this;
    }

    /**
     * Set the Query Builder instance
     *
     * @param Illuminate\Database\Query\Builder $queryBuilderInstace
     *
     * @return $this
     */
    public function setHeadings($headings)
    {
        $this->headings = $headings;
        return $this;
    }

    /**
     * Set the File Name for Export
     *
     * @param string|null $fileName
     *
     * @return $this
     */
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
     

    public function headings(): array
    {
        return $this->headings;
    }

    /**
     * @return Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return $this->queryBuilderInstace;
    }

    public function prepareRows($rows)
    {
        return $rows->transform(function ($modelInstance) {
            // return [
            //     'title' => $modelInstance->title,
            //     'code' => $modelInstance->code,
            //     'master_category.title' => $modelInstance?->master_category?->title,
            // ];
            return collect($this->exportRows)
                    ->mapWithKeys(function ($item) use ($modelInstance) {
                        return [$item => data_get($modelInstance, $item)];
                    })->toArray();

        });
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
