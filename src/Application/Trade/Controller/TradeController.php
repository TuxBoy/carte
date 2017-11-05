<?php
namespace App\Trade\Controller;

use App\Trade\Table\TradesTable;
use TuxBoy\Controller\Controller;

class TradeController extends Controller
{

    public function getTrades(TradesTable $table)
    {
        $trades = $table->find()->all();
        return json_encode($trades);
    }

}