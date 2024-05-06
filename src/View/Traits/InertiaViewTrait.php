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

namespace CakeDC\Inertia\View\Traits;

use Cake\Event\EventInterface;
use Cake\Core\InstanceConfigTrait;
use Cake\Datasource\Paging\PaginatedInterface;
use Cake\I18n\Date;
use Cake\Routing\Router;

trait InertiaViewTrait
{
    use InstanceConfigTrait;

    /**
     * Get current absolute url.
     */
    private function getCurrentUri(): string
    {
        return Router::url($this->getRequest()->getRequestTarget(), true);
    }

    /**
     * Returns props array excluding the default variables.
     */
    private function getProps(): array
    {
        $props = [];
        $only = $this->getPartialData();
        $onlyViewVars = ! empty($only) ? $only : array_keys($this->viewVars);
        $passedViewVars = $this->viewVars;

        $this->viewVars = [];

        foreach ($onlyViewVars as $varName) {
            if (! isset($passedViewVars[$varName])) {
                continue;
            }

            $props[$varName] = $passedViewVars[$varName];
        }

        return $props;
    }
    
    /**
     * Returns view variable names from `X-Inertia-Partial-Data` header.
     */
    public function getPartialData(): array
    {
        if (!$this->getRequest()->is('inertia-partial-data')) {
            return [];
        }

        $headerRequest = $this->getRequest()->getHeader('X-Inertia-Partial-Data');
        if (!array_key_exists(0, $headerRequest)){
            return [];
        }

        return explode(
            ',',
            $headerRequest[0]
        );
    }

}
