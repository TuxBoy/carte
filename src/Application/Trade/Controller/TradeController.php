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
     * @return \GuzzleHttp\Psr7\MessageTrait|string
     */
    public function create()
    {
        $trade = Builder::create(Trade::class);
        return $this->view->render('@trade/create.twig', compact('trade'));
    }

    public function write(ServerRequest $request, TradesTable $trades, Router $router, ?int $id = null)
    {
        if ($request->getMethod() === 'POST') {
            if (is_null($id)) {
                $trade = Builder::create(Trade::class, [$request->getParsedBody()]);
            } else {
                $trade = $trades->findOrFail($id);
                $trades->patchEntity($trade, $request->getParsedBody());
            }
            if ($trades->save($trade)) {
                $this->flash->success('Le commerce a été ajouté avec succès.');
            } else {
                $this->flash->error("Les données saisies sont erronées.");
            }
        }
        return $this->redirectTo($router->generateUri('trade.index'));
    }

    /**
     * @param int $id
     * @param TradesTable $tradesTable
     * @return string
     */
    public function update(int $id, TradesTable $tradesTable)
    {
        $trade = $tradesTable->findOrFail($id);
        return $this->view->render('@trade/update.twig', compact('trade'));
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
            $trade = $tradesTable->findOrFail($id);
            $tradesTable->delete($trade);
            $this->flash->success('Le commerce a bien été supprimé.');
        }
        return $this->redirectTo($router->generateUri('trade.index'));
    }

}