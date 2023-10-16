<?php

declare(strict_types=1);

namespace Inertia\Command;

use Bake\Utility\TableScanner;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Inflector;
use Cake\View\Exception\MissingTemplateException;
use RuntimeException;

class VueControllerCommand extends \Bake\Command\ControllerCommand
{


    /**
     * Assembles and writes a Controller file
     *
     * @param string $controllerName Controller name already pluralized and correctly cased.
     * @param \Cake\Console\Arguments $args The console arguments
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return void
     */
    public function bake(string $controllerName, Arguments $args, ConsoleIo $io): void
    {


        $io->quiet(sprintf('Baking controller class for %s...', $controllerName));

        $actions = [];
        if (!$args->getOption('no-actions') && !$args->getOption('actions')) {
            $actions = ['index', 'view', 'add', 'edit', 'delete'];
        }
        if ($args->getOption('actions')) {
            $actions = array_map('trim', explode(',', $args->getOption('actions')));
            $actions = array_filter($actions);
        }

        $helpers = $this->getHelpers($args);
        $components = $this->getComponents($args);

        $prefix = $this->getPrefix($args);
        if ($prefix) {
            $prefix = '\\' . str_replace('/', '\\', $prefix);
        }

        // Controllers default to importing AppController from `App`
        $baseNamespace = $namespace = Configure::read('App.namespace');
        if ($this->plugin) {
            $namespace = $this->_pluginNamespace($this->plugin);
        }
        // If the plugin has an AppController other plugin controllers
        // should inherit from it.
        if ($this->plugin && class_exists("{$namespace}\Controller\AppController")) {
            $baseNamespace = $namespace;
        }

        $currentModelName = $controllerName;
        $plugin = $this->plugin;
        if ($plugin) {
            $plugin .= '.';
        }

        if ($this->getTableLocator()->exists($plugin . $currentModelName)) {
            $modelObj = $this->getTableLocator()->get($plugin . $currentModelName);
        } else {
            $modelObj = $this->getTableLocator()->get($plugin . $currentModelName, [
                'connectionName' => $this->connection,
            ]);
        }

        $pluralName = $this->_variableName($currentModelName);
        $singularName = $this->_singularName($currentModelName);
        $singularHumanName = $this->_singularHumanName($controllerName);
        $pluralHumanName = $this->_variableName($controllerName);

        $defaultModel = sprintf('%s\Model\Table\%sTable', $namespace, $controllerName);
        if (!class_exists($defaultModel)) {
            $defaultModel = null;
        }
        $entityClassName = $this->_entityName($modelObj->getAlias());

        $data = compact(
            'actions',
            'components',
            'currentModelName',
            'defaultModel',
            'entityClassName',
            'helpers',
            'modelObj',
            'namespace',
            'baseNamespace',
            'plugin',
            'pluralHumanName',
            'pluralName',
            'prefix',
            'singularHumanName',
            'singularName'
        );
        $data['name'] = $controllerName;

        $this->bakeController($controllerName, $data, $args, $io);
        $this->bakeTest($controllerName, $args, $io);
    }

}
