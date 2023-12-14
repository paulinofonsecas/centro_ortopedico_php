<?php

return [
    'resources' => [
        'label' => 'Registo de actividade',
        'plural_label' => 'Registro de actividades',
        'navigation_group' => null,
        'navigation_icon' => 'heroicon-o-shield-check',
        'navigation_sort' => null,
        'navigation_count_badge' => false,
        'resource' => \Rmsramos\Activitylog\Resources\ActivitylogResource::class,
    ],
    'datetime_format' => 'd/m/Y H:i:s',
];
