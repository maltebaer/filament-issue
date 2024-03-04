<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;

class Issue extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.issue';

    public function getExtraBodyAttributes(): array
    {
        return [
            'x-data' => '{}',
            'x-on:close-modal.window' => "alert('Modal closed')",
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('viewInfolist')
                ->modalContent(fn () => view('modal-content'))
                ->modalSubmitAction(false)
                ->modalCancelAction(false),
        ];
    }
}
