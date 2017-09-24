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
     * @Option(placeholder="Latitude", mandatory=true)
     */
    public $lat;

    /**
     * @var string
     *
     * @Option(placeholder="Longitude", mandatory=true)
     */
    public $lng;

    /**
     * @var string
     *
     * @Option(placeholder="Numéro de téléphone", mandatory=false)
     */
    public $phone;

}