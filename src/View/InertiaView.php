<?php
declare(strict_types=1);

namespace CakeDC\Inertia\View;

use Cake\Routing\Router;
use Cake\View\Exception\MissingTemplateException;
use Cake\View\View;

/**
 * Renders view with provided view vars
 */
class InertiaView extends View
{
    public function initialize(): void
    {
        $this->loadHelper('Inertia', ['className' => 'CakeDC/Inertia.Inertia']);
    }

    /**
     * Override template path to use /resources/js/Components/ vue templates
     *
     * @param string|null $plugin
     * @param bool $cached
     * @return array|string[]\
     */

    protected function _paths(?string $plugin = null, bool $cached = true): array
    {
        $paths = parent::_paths($plugin, $cached);
        $newPath =  ROOT . '/resources/js/Components/';
        array_unshift($paths, $newPath);

        return $paths;
    }

    protected function _getTemplateFileName(?string $name = null): string
    {
        $templatePath = $subDir = '';

        if ($this->templatePath) {
            $templatePath = $this->templatePath . DIRECTORY_SEPARATOR;
        }
        if ($this->subDir !== '') {
            $subDir = $this->subDir . DIRECTORY_SEPARATOR;
            if ($templatePath != $subDir && substr($templatePath, -strlen($subDir)) === $subDir) {
                $subDir = '';
            }
        }

        if ($name === null) {
            $name = $this->template;
        }

        if (empty($name)) {
            throw new RuntimeException('Template name not provided');
        }

        [$plugin, $name] = $this->pluginSplit($name);
        $name = str_replace('/', DIRECTORY_SEPARATOR, $name);

        if (strpos($name, DIRECTORY_SEPARATOR) === false && $name !== '' && $name[0] !== '.') {
            //add ucfirst to template file name
            $name = $templatePath . $subDir . ucfirst($this->_inflectTemplateFileName($name));
        } elseif (strpos($name, DIRECTORY_SEPARATOR) !== false) {
            if ($name[0] === DIRECTORY_SEPARATOR || $name[1] === ':') {
                $name = trim($name, DIRECTORY_SEPARATOR);
            } elseif (!$plugin || $this->templatePath !== $this->name) {
                $name = $templatePath . $subDir . $name;
            } else {
                $name = $subDir . $name;
            }
        }

        //force template extension is vue
        $name .= '.vue';
        $paths = $this->_paths($plugin);
        foreach ($paths as $path) {
            if (is_file($path . $name)) {
                return $this->_checkFilePath($path . $name, $path);
            }
        }

        throw new MissingTemplateException($name, $paths);
    }

    public function render(?string $view = null, $layout = null): string
    {
        $page = [
            'component' => $this->getComponentName(),
            'url' => $this->getCurrentUri(),
            'props' => $this->getProps(),
        ];

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

        $prefix = $this->getRequest()->getParam('prefix');
        if ($prefix != null){
            return sprintf(
                '%s/%s/%s',
                $prefix,
                $this->getRequest()->getParam('controller'),
                ucwords((string)$this->getRequest()->getParam('action'))
            );

        } else {
            return sprintf(
                '%s/%s',
                $this->getRequest()->getParam('controller'),
                ucwords((string)$this->getRequest()->getParam('action'))
            );
        }
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
