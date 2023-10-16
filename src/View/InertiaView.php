<?php
declare(strict_types=1);

namespace CakeDC\Inertia\View;

use Cake\Routing\Router;
use Cake\View\View;

/**
 * Renders view with provided view vars
 */
class InertiaView extends View
{
    public function initialize(): void
    {
        $this->loadHelper('\CakeDC\Inertia\View\Helper\InertiaHelper');
    }

    public function render(?string $view = null, $layout = null): string
    {
        \Cake\Log\Log::debug(__METHOD__);

        $page = [
            'component' => $this->getComponentName(),
            'url' => $this->getCurrentUri(),
            'props' => $this->getProps(),
        ];

        \Cake\Log\Log::debug(var_export($page,true));

        $this->set(compact('page'));

        return parent::render($view);
    }

    /**
     * Get current absolute url.
     */
    private function getCurrentUri(): string
    {
        return Router::url($this->getRequest()->getRequestTarget(), true);
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

            unset($this->viewVars['component']);

            return $component;
        }

        return sprintf(
            '%s/%s',
            $this->getRequest()->getParam('controller'),
            ucwords((string)$this->getRequest()->getParam('action'))
        );
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

        return explode(
            ',',
            $this->getRequest()->getHeader('X-Inertia-Partial-Data')[0]
        );
    }
}
