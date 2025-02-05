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

    public function generateReport($provider, $model) {
        dump($provider);
        dd($model);
        $this->validate();
        $dashboardDetails = $this->buildPrompt();
        $response = SendMessageToAIAction::execute($dashboardDetails);
        $this->buildConfig($response);
        $this->prepareDataSet();
        return $this->config;
    }

    private function buildPrompt(){
        $fields = implode(',',SalesCommission::getColumns());
        return "Considerando a lista de campos ($fields), gere uma configuração json do Vega-lite v5 (sem campo de dados e com descrição) que atenda o seguinte pedido {$this->question}. Resposta:";
    }

    private function buildConfig($response){
        $response = str_replace("\n", "", $response);
        $response = preg_replace('/^```json|```$/', '', $response);
        $this->config = json_decode($response, true);
    }

    private function prepareDataSet(){
        $this->dataset = ["values" => SalesCommission::inRandomOrder()->limit(100)->get()->toArray()];
    }
}
