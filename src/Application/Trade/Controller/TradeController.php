<?php
namespace App\Trade\Controller;

use App\Trade\Entity\Trade;
use App\Trade\Table\TradesTable;
use Core\Builder\Builder;
use Core\Controller\Controller;
use GuzzleHttp\Psr7\ServerRequest;

class TradeController extends Controller
{

    public function index(ServerRequest $request, TradesTable $tradesTable)
    {
        $trades = $tradesTable->find()->all();
        return $this->view->render('@trade/index.twig', compact('trades'));
    }

    public function create(ServerRequest $request, TradesTable $trades)
    {
        if ($request->getMethod() === 'POST') {
            $data = $this->getParams($request, ['name', 'street', 'lat', 'lng']);
            $trade = Builder::create(Trade::class, [$data]);
            $trades->save($trade);
            $this->flash->success('Le commerce a été ajouté avec succès.');
            return $this->redirectTo('/commerce');
        }
        return $this->view->render('@trade/create.twig');
    }

}