<?php
/*
 *  Copyright 2010 - 2024, Cake Development Corporation (https://www.cakedc.com)
 *
 *  Licensed under The MIT License
 *  Redistributions of files must retain the above copyright notice.
 *
 *  @copyright Copyright 2010 - 2024, Cake Development Corporation (https://www.cakedc.com)
 *  @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

declare(strict_types=1);

namespace CakeDC\Inertia\Traits;

use Cake\Event\EventInterface;
use Cake\Core\InstanceConfigTrait;
use Cake\Datasource\Paging\PaginatedInterface;
use Cake\I18n\Date;
use Cake\Routing\Router;

trait InertiaResponseTrait
{
    use InstanceConfigTrait;

    /**
     * Default config for this view.
     *
     * @var array<string, mixed>
     */
    protected array $_defaultConfig = [
        'JsonViewClass' => \CakeDC\Inertia\View\InertiaJsonView::class,
    ];

    public function buildPaginationLinks(PaginatedInterface $paging, string $controller, string $action)
    {
        $pagingParams = $paging->pagingParams();
        $params = [];
        $baseUrl = Router::url(['controller' => $controller, 'action' => $action]);

        if (isset($pagingParams['sort'])) {
            $params[] = 'sort' . '=' . $pagingParams['sort'];
        }
        if (isset($pagingParams['direction'])) {
            $params[] = 'direction' . '=' . $pagingParams['direction'];
        }
        $params = implode('&', $params);

        if ($pagingParams['currentPage'] > 1) {
            $links[] = ['url' => $baseUrl . '?page=1' . $params, 'label' => '<< ' . __('first')];
        }
        if ($pagingParams['hasPrevPage']) {
            $links[] = [
                'url' => $baseUrl . '?page=' . ($pagingParams['currentPage'] - 1) . $params,
                'label' => '< ' . __('previous')];
        }
        for ($i = 1; $i <= $pagingParams['pageCount']; $i++) {
            $links[] = ['url' => $baseUrl . '?page=' . $i . $params, 'label' => $i];
        }
        if ($pagingParams['hasNextPage']) {
            $links[] = [
                'url' => $baseUrl . '?page=' . ($pagingParams['currentPage'] + 1) . $params,
                'label' => __('next') . ' >'];
        }
        if ($pagingParams['currentPage'] < $pagingParams['pageCount']) {
            $links[] = [
                'url' => $baseUrl . '?page=' . $pagingParams['pageCount'] . $params,
                'label' => __('last') . ' >>'];
        }

        return $links;
    }

    /**
     * @inheritDoc
     */
    public function beforeRender(EventInterface $event)
    {
        if ($this->isErrorStatus() || $this->isFailureStatus()) {
            return null;
        }

        //set view class
        $viewClass = \CakeDC\Inertia\View\InertiaView::class;
        if ($this->getRequest()->is('inertia')) {
            $viewClass = $this->getConfig('JsonViewClass');
        }
        $this->viewBuilder()->setClassName($viewClass);

        //set messages
        $session = $this->getRequest()->getSession();
        $flash = [];
        if ($session->check('Flash.flash.0')) {
            $flash = $session->read('Flash.flash.0');
            $flash['element'] = strtolower(str_replace('/', '-', $flash['element']));
            $session->delete('Flash');
        }
        $this->set('flash', $flash);

        //set csrf token
        $this->set('csrfToken', $this->getRequest()->getAttribute('csrfToken'));
    }

    /**
     * Checks if response status code is 404.
     *
     * @return bool
     */
    private function isErrorStatus(): bool
    {
        return $this->getResponse()->getStatusCode() === 404;
    }

    /**
     * Checks if response status code is 500.
     *
     * @return bool
     */
    private function isFailureStatus(): bool
    {
        return $this->getResponse()->getStatusCode() === 500;
    }
}
