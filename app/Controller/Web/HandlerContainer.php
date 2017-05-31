<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/31/17
 * Time: 1:06 AM
 */
namespace APP\Controller\Web;

use CORE\App;
use CORE\Request;

/**
 * Class HandlerContainer
 * @package APP\Controller\Web
 */
class HandlerContainer extends \CORE\HandlerContainer
{
    public function bindCustom(Request $request)
    {
        /** @var \CORE\Web\Request $request */

        $request->on('get', '/', array($this, 'index'));
    }

    public function bindDefault(Request $request)
    {
        /** @var \CORE\Web\Request $request */

        $request->onUnknown(function (App $app) {
            $app->response->setCode(404);
        });
    }

    public function index(App $app)
    {
        /**
         * Simple template engine
         * We do use single template(Web\index.phtml) in our system...
         * ...so for sake of simplicity - we do not have global template (wrapper with header, footer etc...)
         * @todo add global template...
         * @todo make template name as argument...
         */
        $view = $app->response->getView()
            ->setConfigOption('template', join(DIRECTORY_SEPARATOR, array('Web', 'index')))
            ->setParams(array(
                'scriptsCacheCounter' => time(),
                'config' => array(
                    'apiEndpoint' => 'api.php',
                    'defaultBalance' => $app->config->catalog->{'balance.default'}(100),
                    'imagesWebPath' => $app->config->web->{'images.path'}('media/img/offers'),
                    'isCacheOffers' => $app->config->catalog->{'cache.offers'}(true),
                    'ratingStarsCount' => $app->config->catalog->{'rating.stars'}(5),
                    'pagePage' => $app->config->catalog->per_page(5)
                )
            ));

        $app->response->setCode(200)
            ->setBody($view);
    }
}