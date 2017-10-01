<?php
namespace App\Trade\Controller\Admin;

use App\Trade\Entity\Trade;
use App\Trade\Table\TradesTable;
use Cake\Validation\Validator;
use TuxBoy\Builder\Builder;
use TuxBoy\Controller\Controller;
use GuzzleHttp\Psr7\ServerRequest;
use TuxBoy\Controller\Http;
use TuxBoy\Router\Router;
use TuxBoy\Session\SessionInterface;

class TradeController extends Controller
{

    /**
     * @param TradesTable $tradesTable
     * @return string
     */
    public function index(TradesTable $tradesTable)
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

    public function write(
        ServerRequest $request,
        TradesTable $trades,
        Router $router,
        SessionInterface $session,
        ?int $id = null
    ) {
        if ($request->getMethod() === 'POST') {
            $validator = new Validator;
            $validator->notEmpty(['name', 'lat', 'lng'])->requirePresence('name');
            $errors = $validator->errors($request->getParsedBody());
            if (empty($errors)) {
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
            } else {
                $session->set('errors', $errors);
                $this->flash->error("Les données saisies sont erronées.");
                return $this->redirectTo($request->getUri()->getPath());
            }
        }
        return $this->redirectTo($router->generateUri('trade.admin.index'));
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
        if ($request->getMethod() === Http::POST) {
            $trade = $tradesTable->findOrFail($id);
            $tradesTable->delete($trade);
            $this->flash->success('Le commerce a bien été supprimé.');
        }
        return $this->redirectTo($router->generateUri('trade.admin.index'));
    }

}