<?php

namespace App\Livewire\Barcode;

use App\Models\Barcode;
use Livewire\Component;

class LabelPrintout extends Component
{

    public $records;
    public $data;


    public function mount()
    {
        $this->records = session()->get('bulk-print', null);
    }
    public function render()
    {
        return view('livewire.barcode.label-printout', $this->records);
    }
}
