<?php

namespace App\Exports;

use App\Enums\OpType;
use App\Models\Operation;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OperationExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping
{
    use Exportable;

    public function map($operation): array
    {
        return [
            OpType::getDescription($operation->op_type),
            Carbon::parse($operation->paid_at)->format('d/m/Y'),
            $operation->vehicle,
            $operation->driver,
            $operation->type_expense,
            $operation->motif,
            $operation->amount,
            $operation->beneficiary,
            $operation->description,
        ];
    }

    public function forBox(int $box)
    {
        $this->box = $box;
        return $this;
    }

    public function query()
    {
        return Operation::query()
            ->select('op_type', 'paid_at', 'vehicle', 'driver', 'type_expense', 'motif', 'amount', 'beneficiary', 'description')
            ->where('box_id', $this->box);
    }

    public function headings(): array
    {
        return [
            'TYPE',
            'DATE',
            'VEHICULE',
            'CHAUFFEUR',
            'TYPE DEPENSE',
            'MOTIF',
            'MONTANT',
            'BENEFICIAIRE',
            'DESCRIPTION',
        ];
    }
}
