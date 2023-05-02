<?php

namespace App\Exports;

use App\Models\EmployeesPosition;
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


class ExportCustomEmployeeInfos extends DefaultValueBinder implements FromQuery,WithHeadings, withStrictNullComparison, shouldAutoSize, WithStyles, WithEvents, WithCustomValueBinder, withMapping
{
    use Exportable;


    public function __construct($employees){
        $this->employees = $employees;
    }

    public function query()
    {

        if($this->employees[0] != null && $this->employees[1] != null && $this->employees[2] != null && $this->employees[3] != null && $this->employees[4] != null && $this->employees[5] != null){
        return EmployeesPosition::with('employees:id,fullName')->with('positions:id,positionName')->with('departments:id,departmentName')->with('centers:id,centerName')
        ->whereIn('employee_id' ,$this->employees[0])->whereIn('position_id' ,$this->employees[5])->whereIn('department_id' ,$this->employees[3])->whereIn('center_id' ,$this->employees[4])
        ->whereBetween('startDate',[$this->employees[1], $this->employees[2]]);
        }if($this->employees[3] != null && $this->employees[0] != null && $this->employees[4] != null && $this->employees[5] != null){
            return EmployeesPosition::with('employees:id,fullName')->with('positions:id,positionName')->with('departments:id,departmentName')->with('centers:id,centerName')
            ->whereIn('employee_id' ,$this->employees[0])->whereIn('position_id' ,$this->employees[5])->whereIn('department_id' ,$this->employees[3])->whereIn('center_id' ,$this->employees[4]);
         }if($this->employees[3] != null && $this->employees[0] == null && $this->employees[4] != null && $this->employees[5] != null){
            return EmployeesPosition::with('employees:id,fullName')->with('positions:id,positionName')->with('departments:id,departmentName')->with('centers:id,centerName')
            ->whereIn('position_id' ,$this->employees[5])->whereIn('department_id' ,$this->employees[3])->whereIn('center_id' ,$this->employees[4]);
        }if($this->employees[0] == null && $this->employees[1] != null && $this->employees[2] != null && $this->employees[3] != null && $this->employees[4] != null && $this->employees[5] != null){
            return EmployeesPosition::with('employees:id,fullName')->with('positions:id,positionName')->with('departments:id,departmentName')->with('centers:id,centerName')
            ->whereIn('position_id' ,$this->employees[5])->whereIn('department_id' ,$this->employees[3])->whereIn('center_id' ,$this->employees[4])->
            whereBetween('startDate',[$this->employees[1], $this->employees[2]]);
        }
    }

    public function headings(): array
    {
        return [
            ' Full Name ',
            ' Position Name ',
            ' Department Name ',
            ' Center Name ',
            ' Start Date ',
            ' End Date ',
        ];
    }

    public function map($empInfo):array {
        return [
        $empInfo->employees->fullName,
        $empInfo->positions->positionName,
        $empInfo->departments->departmentName,
        $empInfo->centers->centerName,
        $empInfo->startDate,
        $empInfo->endDate,
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
                $cellRange = 'A1:F1'; // All headers
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
