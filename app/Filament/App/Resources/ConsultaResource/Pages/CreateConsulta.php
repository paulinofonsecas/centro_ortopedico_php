<?php

namespace App\Filament\App\Resources\ConsultaResource\Pages;

use App\Filament\App\Resources\ConsultaResource;
use App\Filament\Medico\Resources\ConsultaResource as ResourcesConsultaResource;
use App\Models\Consulta;
use App\Models\Medico;
use App\Models\RConsultaSintoma;
use App\Models\Sintoma;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateConsulta extends CreateRecord
{
    protected static string $resource = ConsultaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('Novo paciente')
                ->url('/app/pacientes/create'),
        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        $sintoma1 = null;
        $sintoma2 = null;
        $sintoma3 = null;

        if ($data['sintoma1']) {
            $sintoma1 = Sintoma::create([
                'sintoma' => $data['sintoma1'],
                'gravidade_id' => $data['gravidade1'],
            ]);
        }
        if ($data['sintoma2']) {
            $sintoma2 = Sintoma::create([
                'sintoma' => $data['sintoma2'],
                'gravidade_id' => $data['gravidade2'],
            ]);
        }
        if ($data['sintoma3']) {
            $sintoma3 = Sintoma::create([
                'sintoma' => $data['sintoma3'],
                'gravidade_id' => $data['gravidade3'],
            ]);
        }

        $consulta = Consulta::create([
            'paciente_id' => $data['paciente_id'],
            'medico_id' => $data['medico_id'],
            'data_consulta' => $data['data_consulta'],
            'observacao' => $data['observacao'] ?? '',
        ]);

        if ($sintoma1) {
            RConsultaSintoma::create([
                'consulta_id' => $consulta->id,
                'sintoma_id' => $sintoma1->id,
            ]);
        }
        if ($sintoma2) {
            RConsultaSintoma::create([
                'consulta_id' => $consulta->id,
                'sintoma_id' => $sintoma2->id,
            ]);
        }
        if ($sintoma3) {
            RConsultaSintoma::create([
                'consulta_id' => $consulta->id,
                'sintoma_id' => $sintoma3->id,
            ]);
        }

        $medico = Medico::find($data['medico_id'])->funcionario->user;
        $user = auth()->user();

        Notification::make()
            ->title('Usuario ' . $user->name . ' criou uma consulta para o médico ' . $medico->name)
            ->body('Consulta marcada para a data ' . $data['data_consulta'])
            ->icon('heroicon-o-document-text')
            ->color('success')
            ->actions([
                Action::make('Ver')
                    ->button()
                    ->url(config('app.url') . '/medico/consultas/' . $consulta->id, shouldOpenInNewTab: true),
                Action::make('fechar')
                    ->color('gray'),
            ])
            ->sendToDatabase([$medico]);

        return $consulta;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $data;
    }
}
