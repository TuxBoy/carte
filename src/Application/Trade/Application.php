<?php
namespace App\Trade;

use App\Trade\Controller\TradeController;
use App\Trade\Entity\Trade;
use App\Trade\Table\TradesTable;
use Cake\ORM\TableRegistry;
use Core\ApplicationInterface;
use Core\Router\Router;
use function DI\add;

class Application implements ApplicationInterface
{
    /**
     * Définie les routes de l'application.
     *
     * @param Router $router
     */
    public function getRoutes(Router $router): void
    {
        $router->get('/commerces', [TradeController::class, 'index'], 'trade.index');
        $router->get('/commerce/nouveau', [TradeController::class, 'create'], 'trade.create');
        $router->post('/commerce/nouveau', [TradeController::class, 'create']);
    }

    /**
     * Pour ajouter la configuration au container de son application
     *
     * @return array
     */
    public function addConfig(): array
    {
        return [
            'twig.path' => add([
                'trade' => __DIR__ . '/views/'
            ]),
            'entities' => add([
                Trade::class
            ]),
            TradesTable::class => function () {
                return TableRegistry::get('Trades', ['className' => TradesTable::class]);
            }
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Trade';
    }
}