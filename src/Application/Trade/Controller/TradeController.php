<?php
namespace App\Trade\Controller;

use App\Trade\Entity\Trade;
use App\Trade\Table\TradesTable;
use TuxBoy\Builder\Builder;
use TuxBoy\Controller\Controller;
use GuzzleHttp\Psr7\ServerRequest;
use TuxBoy\Router\Router;

class TradeController extends Controller
{

    /**
     * @param ServerRequest $request
     * @param TradesTable $tradesTable
     * @return string
     */
    public function index(ServerRequest $request, TradesTable $tradesTable)
    {
        $trades = $tradesTable->find()->all();
        return $this->view->render('@trade/index.twig', compact('trades'));
    }

    /**
     * @param ServerRequest $request
     * @param TradesTable $trades
     * @param Router $router
     * @return \GuzzleHttp\Psr7\MessageTrait|string
     */
    public function create(ServerRequest $request, TradesTable $trades, Router $router)
    {
        if ($request->getMethod() === 'POST') {
            $data = $this->getParams($request, ['name', 'street', 'lat', 'lng']);
            $trade = Builder::create(Trade::class, [$data]);
            $trades->save($trade);
            $this->flash->success('Le commerce a été ajouté avec succès.');
            return $this->redirectTo($router->generateUri('trade.index'));
        }
        return $this->view->render('@trade/create.twig');
    }

    /**
     * @param int $id
     * @param TradesTable $tradesTable
     * @param ServerRequest $request
     * @param Router $router
     * @return \GuzzleHttp\Psr7\MessageTrait
     */
    public function delete(int $id, TradesTable $tradesTable, ServerRequest $request, Router $router)
    {
        if ($request->getMethod() === 'POST') {
            $trade = $tradesTable->find()->where(['id' => $id])->firstOrFail();
            $tradesTable->delete($trade);
            $this->flash->success('Le commerce a bien été supprimé.');
        }
        return $this->redirectTo($router->generateUri('trade.index'));
    }

}