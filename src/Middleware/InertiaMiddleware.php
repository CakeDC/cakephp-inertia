<?php
declare(strict_types=1);

namespace CakeDC\Inertia\Middleware;

use Cake\Http\ServerRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class InertiaMiddleware implements MiddlewareInterface
{
    /**
     * process method
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        \Cake\Log\Log::debug(__METHOD__);

        if (!$request->hasHeader('X-Inertia')) {
            \Cake\Log\Log::debug('continuo');
            return $handler->handle($request);
        }
        if ($request instanceof ServerRequest) {
            \Cake\Log\Log::debug('setup detectors');
            $this->setupDetectors($request);
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
        \Cake\Log\Log::debug(__METHOD__);

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
