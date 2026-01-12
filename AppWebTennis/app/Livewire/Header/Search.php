<?php

namespace App\Livewire\Header;

use App\Models\Variante;
use Livewire\Component;

class Search extends Component
{
    public bool $isOpen = false;
    public string $search = '';

    // TODO: Implementar la logica de busqueda
    public function getResultsProperty()
    {
        if (strlen($this->search) < 2) {
            return collect();
        }

        return Variante::where('sku', 'like', '%' . $this->search . '%')
            ->orWhereHas('producto.marca', function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%');
            })
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.header.search');
    }
}
