<?php

namespace App\Livewire;

use App\Models\SalesCommission;
use App\Actions\SendMessageToAIAction;
use Livewire\Component;

class Dashboard extends Component
{

    public $config;
    public string $question;
    public array $dataset;

    public function render()
    {
        return view('livewire.dashboard');
    }

    protected $rules = [
        'question' => 'required|min:10'
    ];

    public function generateReport() {
        $this->validate();
        $dashboardDetails = $this->buildPrompt();
        $response = SendMessageToAIAction::execute($dashboardDetails);
        $this->prepareDataSet();
        return $this->buildConfig($response);
    }

    private function buildPrompt(){
        $fields = implode(',',SalesCommission::getColumns());
        return "Considering the list of fields ($fields), generate a Vega-Lite v5 JSON configuration (without a data field and with a description) that meets the following request: {$this->question}. Answer:";
    }

    private function prepareDataSet(){
        $this->dataset = ["values" => SalesCommission::inRandomOrder()->limit(100)->get()->toArray()];
    }

    private function buildConfig($response){
        $response = str_replace("\n", "", $response);
        $response = preg_replace('/^```json|```$/', '', $response);
        $this->config = json_decode($response, true);
        return $this->config;
    }
}
