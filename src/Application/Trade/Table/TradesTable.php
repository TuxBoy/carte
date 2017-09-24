<?php
namespace App\Trade\Table;

use App\Trade\Entity\Trade;
use Cake\ORM\Table;

class TradesTable extends Table
{

    /**
     * @param array $config
     */
    public function initialize(array $config)
    {
        $this->setEntityClass(Trade::class);
    }

    /**
     * Récupère une donnée se elle existe, sinon ça renvoie un exception.
     *
     * @param int $id
     * @return array|\Cake\Datasource\EntityInterface
     */
    public function findOrFail(int $id)
    {
        return $this->find()->where(['id' => $id])->firstOrFail();
    }

}