<?php

namespace App\Http\Livewire\Widgets;

use Filament\Widgets\Widget;

class UsersCount extends Widget
{
    protected static ?int $sort = 1;

    protected int|array|string $columnSpan = 1;

    protected static string $view = 'livewire.widgets.users-count';
}
