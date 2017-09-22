<?php
namespace App\Trade\Table;

use App\Trade\Entity\Trade;
use Cake\ORM\Table;

class TradesTable extends Table
{

    public function initialize(array $config)
    {
        $this->setEntityClass(Trade::class);
    }

}