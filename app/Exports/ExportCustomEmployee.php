<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\withStrictNullComparison;
use Maatwebsite\Excel\Concerns\shouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withMapping;


class ExportCustomEmployee extends DefaultValueBinder implements FromQuery,WithHeadings, withStrictNullComparison, shouldAutoSize, WithStyles, WithEvents, WithCustomValueBinder, withMapping
{

    use Exportable;


    public function __construct($employees){
        $this->employees = $employees;
    }

    public function query()
    {
        if($this->employees[0] != null && $this->employees[1] != null && $this->employees[2] != null){
        return Employee::whereIn('id' ,$this->employees[0])->whereBetween('startDate',[$this->employees[1], $this->employees[2]]);
        }elseif($this->employees[1] == null && $this->employees[2] == null){
            return Employee::whereIn('id' ,$this->employees[0]);
        }elseif($this->employees[0] == null){
            return Employee::whereBetween('startDate',[$this->employees[1], $this->employees[2]]);
        }
    }

    public function headings(): array
    {
        return [
            ' ID ',
            ' Full Name ',
            ' First Name ',
            ' Last Name ',
            ' Father Name ',
            ' Mother Name ',
            ' Birth And Place ',
            ' National Number ',
            ' Degree ',
            ' Gender ',
            ' Mobile ',
            ' Start Date ',
            ' Address ',
            ' Quit Date ',
            ' Notes ',
            ' Vacation Count ',
            ' Hourly Late ',
            ' Hourly Vacacation',
            ' No Payment Count ',
            ' Health Count ',
            ' Working Years ',
            ' Active ',
        ];
    }

    public function map($emp):array {
        return [
            $emp->id,
            $emp->fullName,
            $emp->firstName,
            $emp->lastName,
            $emp->fatherName,
            $emp->motherName,
            $emp->birthAndPlace,
            $emp->nationalNumber,
            $emp->degree,
            $emp->gender_name,
            $emp->mobile,
            $emp->startDate,
            $emp->address,
            $emp->quitDate,
            $emp->notes,
            $emp->vacationCount,
            $emp->hourlyLate,
            $emp->hourlyVac,
            $emp->noPaymentCount,
            $emp->healthCount,
            $emp->workingYears,
            $emp->is_active_name,
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true],]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:V1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14)->getColor()->setRGB('ffffff');
                $event->sheet->getDelegate()->getStyle($cellRange)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('00a8f3');
            },
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        if (is_string($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        if (checkdate($value)) {
            $cell->setValueExplicit($value, DataType::FORMAT_DATE_YYYYMMDD);

            return true;
        }

        

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

}
