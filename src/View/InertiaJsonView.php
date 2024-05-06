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

namespace CakeDC\Inertia\View;

use Cake\Routing\Router;
use Cake\View\JsonView;
use CakeDC\Inertia\View\Traits\InertiaViewTrait;

/**
 * Returns json response with provided view vars.
 */
class InertiaJsonView extends JsonView
{
    use InertiaViewTrait;
    /**
     * @inheritDoc
     */
    public function render(?string $view = null, $layout = null): string
    {
        $page = [
            'component' => $this->getComponentName(),
            'url' => $this->getCurrentUri(),
            'props' => $this->getProps(),
        ];

        $this->setConfig('serialize', 'page');
        $this->set([
            'page' => $page,
        ]);

        return parent::render($view, $layout);
    }

    /**
     * Returns component name.
     * If passed via controller using `component` key, will use that.
     * Otherwise, will return the combination of controller and action.
     * example Users/Index component for UsersController.php's index action.
     */
    private function getComponentName(): string
    {
        if ($this->get('component') !== null) {
            $component = $this->get('component');

            if (array_key_exists('component',$this->viewVars)){
                unset($this->viewVars['component']);
            }

            return $component;
        }

        return sprintf(
            '%s/%s',
            $this->getRequest()->getParam('controller'),
            ucwords((string)$this->getRequest()->getParam('action'))
        );
    }

}
