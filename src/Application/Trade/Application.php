<?php
namespace App\Trade;

use App\Trade\Controller\TradeController;
use App\Trade\Entity\Trade;
use App\Trade\Table\TradesTable;
use Cake\ORM\TableRegistry;
use function DI\factory;
use TuxBoy\ApplicationInterface;
use TuxBoy\Router\Router;
use function DI\add;

/**
 * Class Application
 *
 */
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
        $router->post('/commerce/nouveau', [TradeController::class, 'write']);
        $router->get('/commerce/editer/{id:\d+}', [TradeController::class, 'update'], 'trade.update');
        $router->post('/commerce/editer/{id:\d+}', [TradeController::class, 'write']);
        $router->post('/commerce/delete/{id:\d+}', [TradeController::class, 'delete'], 'trade.delete');
    }

    /**
     * Pour ajouter la configuration au container de son application
     *
     * @return array
     */
    public function addConfig(): array
    {
        return [
            'prefix' => 'trade',
            'twig.path' => add([
                'trade' => __DIR__ . '/views/'
            ]),
            'entities' => add([
                Trade::class
            ]),
            TradesTable::class => factory(function () {
                return TableRegistry::get('Trades', ['className' => TradesTable::class]);
            }),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Trades';
    }
}