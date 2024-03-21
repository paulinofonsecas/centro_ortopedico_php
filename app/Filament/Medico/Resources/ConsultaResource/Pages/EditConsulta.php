<?php

namespace App\Filament\Medico\Resources\ConsultaResource\Pages;

use App\Filament\Medico\Resources\ConsultaResource;
use App\Models\Consulta;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditConsulta extends EditRecord
{
    protected static string $resource = ConsultaResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $consulta = Consulta::find($record->id);
        $sintomas = $consulta->sintomas;

        $sintoma1 = $sintomas[0] ?? null;
        $sintoma2 = $sintomas[1] ?? null;
        $sintoma3 = $sintomas[2] ?? null;

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
            'estado_consulta_id' => $data['estado_consulta_id'],
            'observacao' => $data['observacao'],
        ]);

        return $consulta;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $consulta = Consulta::find($data['id']);
        $sintomas = $consulta->sintomas;

        $sintoma1 = $sintomas[0] ?? null;
        $sintoma2 = $sintomas[1] ?? null;
        $sintoma3 = $sintomas[2] ?? null;

        $saida = [
            'paciente_id' => $consulta->paciente_id,
            'medico_id' => $consulta->medico_id,
            'data_consulta' => $consulta->data_consulta,
            'estado_consulta_id' => $consulta->estado_consulta_id,
            'observacao' => $consulta->observacao,
        ];

        if (!empty($sintoma1)) $saida['sintoma1'] = $sintoma1->sintoma;
        if (!empty($sintoma2)) $saida['sintoma2'] = $sintoma2->sintoma;
        if (!empty($sintoma3)) $saida['sintoma3'] = $sintoma3->sintoma;

        if (!empty($sintoma1->gravidade)) $saida['gravidade1'] = $sintoma1->gravidade->id;
        if (!empty($sintoma2->gravidade)) $saida['gravidade2'] = $sintoma2->gravidade->id;
        if (!empty($sintoma3->gravidade)) $saida['gravidade3'] = $sintoma3->gravidade->id;

        return $saida;
    }

}
