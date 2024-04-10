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

namespace CakeDC\Inertia\Middleware;

use Cake\Http\ServerRequest;
use Cake\Datasource\Paging\PaginatedInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class InertiaMiddleware implements MiddlewareInterface
{

    public function buildPaginationLinks(PaginatedInterface $paging)
    {
        $pagingParams = $paging->pagingParams();
        $params = [];
        if (isset($pagingParams['sort'])) {
            $params[] = 'sort' . '=' . $pagingParams['sort'];
        }
        if (isset($pagingParams['direction'])) {
            $params[] = 'direction' . '=' . $pagingParams['direction'];
        }
        $params = implode('&', $params);

        if ($pagingParams['currentPage'] > 1) {
            $links[] = ['url' => 'index?page=1' . $params, 'label' => '<< ' . __('first')];
        }
        if ($pagingParams['hasPrevPage']) {
            $links[] = [
                'url' => 'index?page=' . ($pagingParams['currentPage'] - 1) . $params,
                'label' => '< ' . __('previous')];
        }
        for ($i = 1; $i <= $pagingParams['pageCount']; $i++) {
            $links[] = ['url' => 'index?page=' . $i . $params, 'label' => $i];
        }
        if ($pagingParams['hasNextPage']) {
            $links[] = [
                'url' => 'index?page=' . ($pagingParams['currentPage'] + 1) . $params,
                'label' => __('next') . ' >'];
        }
        if ($pagingParams['currentPage'] < $pagingParams['pageCount']) {
            $links[] = [
                'url' => 'index?page=' . $pagingParams['pageCount'] . $params,
                'label' => __('last') . ' >>'];
        }

        return $links;
    }

    /**
     * process method
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request instanceof ServerRequest) {
            $this->setupDetectors($request);
        }

        if (!$request->hasHeader('X-Inertia')) {
            return $handler->handle($request);
        }

        $response = $handler->handle($request);
        if (
            $response->getStatusCode() === 404
            && in_array($request->getMethod(), ['PUT', 'PATCH', 'DELETE'])
        ) {
            $response = $response->withStatus(303);
        }

        return $response
            ->withHeader('Vary', 'Accept')
            ->withHeader('X-Inertia', 'true');
    }

    /**
     * Set detectors in the request to use it throughout the application.
     */
    private function setupDetectors(ServerRequest $request): void
    {
        $request->addDetector('inertia', function ($request) {
            return $request->hasHeader('X-Inertia');
        });

        $request->addDetector('inertia-partial-component', function ($request) {
            return $request->hasHeader('X-Inertia-Partial-Component');
        });

        $request->addDetector('inertia-partial-data', function ($request) {
            return $request->hasHeader('X-Inertia-Partial-Data');
        });
    }
}
