<?php
namespace App\Trade\Entity;

use TuxBoy\Annotation\Option;
use TuxBoy\Annotation\Set;
use TuxBoy\Entity;
use TuxBoy\Tools\HasName;

/**
 * Class Trade
 *
 * @Set(tableName="trades")
 */
class Trade extends Entity
{
    use HasName;

    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     *
     * @Option(placeholder="Rue")
     */
    public $street;

    /**
     * @var string
     *
     * @Option(placeholder="Latitude")
     */
    public $lat;

    /**
     * @var string
     *
     * @Option(placeholder="Longitude")
     */
    public $lng;

    /**
     * @var string
     *
     * @Option(placeholder="Numéro de téléphone")
     */
    public $phone;

}