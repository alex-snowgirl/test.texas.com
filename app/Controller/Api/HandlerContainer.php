<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/31/17
 * Time: 5:25 PM
 */
namespace APP\Controller\Api;

use APP\Model\Offer;
use APP\Model\User;
use APP\Model\Order;
use APP\Model\Offer\Rating;

use CORE\App;

use CORE\Model;
use CORE\Request;
use CORE\Web\Request as WebRequest;

/**
 * Simple API Controller (Not Standard Realization) simplified for the test purposes
 * Very-very simple...
 * This is not REST API
 * @todo REST API...
 * @todo create and implement Cache Service...
 * @todo a lot of...
 *
 * Class HandlerContainer
 * @package APP\Controller\Api
 */
class HandlerContainer extends \CORE\HandlerContainer
{
    public function bindCustom(Request $request)
    {
        /** @var WebRequest $request */

        /**
         *  {id}, {user_id} here - is for common purposes
         *  anyway App should have internal state
         * @todo security layer will compare stored client id and received
         * @todo API auth
         * @todo other API security checkers...
         * @todo a lot of..
         */

        /**
         * For visibility purposes we are using such scheme... instead ow Well-Known Controller design
         * Also we do not use Routes and Router, so... create routes in the next way... for simplicity...
         */

        $request->on('post', 'user', array($this, 'createUser'))
            ->on('get', 'user/{id}', array($this, 'getUser'))
            ->on('get', 'offers-for-catalog-list/{user_id}/page/{page}/per_page/{per_page}', array($this, 'getOffersForCatalogList'))
            ->on('get', 'offers', array($this, 'getOffers'))
            ->on('post', 'order/{user_id}', array($this, 'createOrder'))
            ->on('post', 'rating/offer/{offer_id}/user/{user_id}/mark/{mark}', array($this, 'createOfferRating'));
    }

    public function bindDefault(Request $request)
    {
        /** @var WebRequest $request */

        $request->onUnknown(function (App $app) {
            $app->response->setCode(404);
        });
    }

    /**
     * Simple User Getter
     * @todo validate...
     * @todo error handlers...
     *
     * @param App $app
     */
    public function getUser(App $app)
    {
        $user = User::makeFromRequest($app->request);

        if ($users = Model::read($user, $app->rdbms)) {
            $view = $app->response->getView()
                ->setParam('user', $users[0]);

            $app->response->setCode(200)
                ->setBody($view);
        }
    }

    /**
     * Simple User Creator
     * @todo validate...
     * @todo error handlers......
     * @todo optimize...
     *
     * @param App $app
     */
    public function createUser(App $app)
    {
        $user = User::makeFromRequest($app->request);

        if ($id = Model::create($user, $app->rdbms)) {
            $user = Model::read(new User(array('id' => $id)), $app->rdbms)[0];

            $view = $app->response->getView()
                ->setParam('user', $user);

            $app->response->addHeader('Location: user/' . $id)
                ->setCode(201)
                ->setBody($view);
        }
    }

    /**
     * Simple User Updater
     * @todo validate...
     * @todo error handlers...
     *
     * @param App $app
     */
    public function updateUser(App $app)
    {
        $user = User::makeFromRequest($app->request);

        if (Model::update($user, $app->rdbms)) {
            $user = Model::read(new User(array(
                'id' => $user->id
            )), $app->rdbms)[0];

            $view = $app->response->getView()
                ->setParam('user', $user);

            $app->response->addHeader('Location: user/' . $user->id)
                ->setCode(200)
                ->setBody($view);
        }
    }

    /**
     * Simple Raw Offers Fetcher
     * @todo validate...
     * @todo error handlers...
     *
     * @param App $app
     */
    public function getOffers(App $app)
    {
        $offer = Offer::makeFromRequest($app->request);

        $offers = Offer::read($offer, $app->rdbms);
        $offers = Offer::mapAsKeyToItem($offers);

        $view = $app->response->getView()
            ->setParam('offers', $offers);

        $app->response->setCode(200)
            ->setBody($view);
    }

    /**
     * Simple Catalog List Offers Fetcher
     * @todo validate...
     * @todo error handlers...
     * @todo transfer all logic into models...
     * @todo add support for default sorting and limitation... (no params passed)
     *
     * @param App $app
     */
    public function getOffersForCatalogList(App $app)
    {
        $req = $app->request;
        
        /** @var Offer $offer */
        $offer = Offer::makeFromRequest($req);

        $user = new User(array('id' => $req->user_id));

        $sort = $req->sort_by && $req->sort_dir ? array($req->sort_by => $req->sort_dir) : null;
        $limit = $req->page && $req->per_page ? array($req->page => $req->per_page) : null;

        $offers = Offer::readForCatalogList($offer, $user, $sort, $limit, $app->rdbms);
        $offers = Offer::mapAsKeyToItem($offers);

        $view = $app->response->getView()
            ->setParam('offers', $offers);

        $app->response->setCode(200)
            ->setBody($view);
    }

    /**
     * Simple Order Creator
     * @todo validate...
     * @todo error handlers...
     *
     * @param App $app
     */
    public function createOrder(App $app)
    {
        /** @var Order $order */
        $order = Order::makeFromRequest($app->request);

        $offerIdToQuantity = $app->request->offer_id_to_quantity;

        if ($id = Order::createCustom($order, $offerIdToQuantity, $app->rdbms)) {
            $user = Model::read(new User(array(
                'id' => $order->user_id
            )), $app->rdbms)[0];

            $order = Model::read(new Order(array(
                'id' => $id
            )), $app->rdbms)[0];

            $view = $app->response->getView()
                ->setParam('user', $user)
                ->setParam('offer', $order);

            $app->response->addHeader('Location: order/' . $id)
                ->setCode(201)
                ->setBody($view);
        }
    }

    /**
     * Simple Offer Rating Creator
     * @todo validate...
     * @todo error handlers...
     *
     * @param App $app
     */
    public function createOfferRating(App $app)
    {
        /** @var Rating $rating */
        $rating = Rating::makeFromRequest($app->request);

        if (Rating::create($rating, $app->rdbms)) {
            $offer = Model::read(new Offer(array(
                'id' => $rating->offer_id
            )), $app->rdbms)[0];

            $offerRating = Model::read(new Rating(array(
                'offer_id' => $rating->offer_id,
                'user_id' => $rating->user_id
            )), $app->rdbms)[0];

            $view = $app->response->getView()
                ->setParam('offer', $offer)
                ->setParam('offer-rating', $offerRating);

            $app->response->addHeader('Location: offer-rating/' . $rating->offer_id . '/' . $rating->user_id)
                ->setCode(201)
                ->setBody($view);
        }
    }
}