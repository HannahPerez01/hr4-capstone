<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JobPosition;
use App\Models\CompensationPlan as Model;

class CompensationPlan extends Component
{
    public $jobPositionId = null;
    public $compensationPlan = null;

    public function updatedJobPositionId($value)
    {
        // Fetch compensation plan only when job position changes
        $this->compensationPlan = Model::where('job_position_id', $value)->first();
    }

    public function render()
    {
        return view('livewire.compensation-plan', [
            'positions' => JobPosition::all(), // Fetch job positions
        ]);
    }
}
