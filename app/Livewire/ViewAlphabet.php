<?php

namespace App\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewAlphabet extends Component implements HasForms, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithInfolists;

    public array $letters;

    public array $removedLetters = ['A'];

    public function mount()
    {
        $this->letters['letters'] = range('A', 'Z');
    }

    #[On('letter-removed')]
    public function removeLetter(string $letter)
    {
        $this->removedLetters[] = $letter;
    }

    public function alphabetInfolist(Infolist $infolist): Infolist
    {
        $filteredLetters['letters'] = array_diff($this->letters['letters'], $this->removedLetters);

        return $infolist
            ->state($filteredLetters)
            ->schema([
                RepeatableEntry::make('letters')
                    ->schema([
                        TextEntry::make(''),
                        Actions::make([
                            Action::make('removeLetter')
                                ->action(function ($component) {
                                    $letter = $component
                                        ->getContainer()
                                        ->getParentComponent()
                                        ->getState();

                                    $this->dispatch('letter-removed', letter: $letter);
                                })
                        ])
                    ])
            ]);
    }
}
