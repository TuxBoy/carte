<?php
namespace App\Trade;

use App\Trade\Controller\Admin\TradeController;
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
        // Admin
        $router->get('/admin/commerces', [TradeController::class, 'index'], 'trade.admin.index');
        $router->get('/admin/commerce/nouveau', [TradeController::class, 'create'], 'trade.admin.create');
        $router->post('/admin/commerce/nouveau', [TradeController::class, 'write']);
        $router->get('/admin/commerce/editer/{id:\d+}', [TradeController::class, 'update'], 'trade.admin.update');
        $router->post('/admin/commerce/editer/{id:\d+}', [TradeController::class, 'write']);
        $router->post('/admin/commerce/delete/{id:\d+}', [TradeController::class, 'delete'], 'trade.admin.delete');

        // Front
        $router->get('/commerces', [\App\Trade\Controller\TradeController::class, 'getTrades'], 'trade.getTrades');
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