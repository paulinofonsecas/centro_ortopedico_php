<?php

namespace App\Filament\App\Resources\ConsultaResource\Pages;

use App\Filament\App\Resources\ConsultaResource;
use App\Models\Consulta;
use App\Models\Sintoma;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditConsulta extends EditRecord
{
    protected static string $resource = ConsultaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $consulta = Consulta::find($record->id);
        $sintomas = $consulta->sintomas;

        $sintoma1 = $sintomas[0];
        $sintoma2 = $sintomas[1];
        $sintoma3 = $sintomas[2];

        if ($sintoma1 && $data['sintoma1']) {
            $sintoma1->update([
                'sintoma' => $data['sintoma1'],
                'gravidade_id' => $data['gravidade1'],
            ]);
        }
        if ($sintoma2 && $data['sintoma2']) {
            $sintoma2->update([
                'sintoma' => $data['sintoma2'],
                'gravidade_id' => $data['gravidade2'],
            ]);
        }
        if ($sintoma3 && $data['sintoma3']) {
            $sintoma3->update([
                'sintoma' => $data['sintoma3'],
                'gravidade_id' => $data['gravidade3'],
            ]);
        }

        $consulta->update([
            'paciente_id' => $data['paciente_id'],
            'medico_id' => $data['medico_id'],
            'data_consulta' => $data['data_consulta'],
            'observacao' => $data['observacao'],
        ]);

        return $consulta;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $consulta = Consulta::find($data['id']);
        $sintomas = $consulta->sintomas;

        $sintoma1 = $sintomas[0];
        $sintoma2 = $sintomas[1];
        $sintoma3 = $sintomas[2];

        return [
            'paciente_id' => $consulta->paciente_id,
            'medico_id' => $consulta->medico_id,
            'data_consulta' => $consulta->data_consulta,
            'observacao' => $consulta->observacao,
            'sintoma1' => $sintoma1->sintoma,
            'sintoma2' => $sintoma2->sintoma,
            'sintoma3' => $sintoma3->sintoma,
            'gravidade1' => $sintoma1->gravidade->id,
            'gravidade2' => $sintoma2->gravidade->id,
            'gravidade3' => $sintoma3->gravidade->id,
        ];
    }

}
