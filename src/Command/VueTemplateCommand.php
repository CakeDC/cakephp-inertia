<?php
declare(strict_types=1);

namespace CakeDC\Inertia\Command;

use Bake\Utility\TableScanner;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Inflector;
use Cake\View\Exception\MissingTemplateException;
use RuntimeException;

class VueTemplateCommand extends \Bake\Command\TemplateCommand
{
    public function execute(Arguments $args, ConsoleIo $io): ?int
    {
        $io->out("\n" . "executing Command vue_template");

        $this->extractCommonProperties($args);
        $name = $args->getArgument('name') ?? '';
        $name = $this->_getName($name);

        if (empty($name)) {
            $io->out('Possible tables to bake view templates for based on your current database:');
            /** @var \Cake\Database\Connection $connection */
            $connection = ConnectionManager::get($this->connection);
            $scanner = new TableScanner($connection);
            foreach ($scanner->listUnskipped() as $table) {
                $io->out('- ' . $this->_camelize($table));
            }

            return static::CODE_SUCCESS;
        }
        $template = $args->getArgument('template');
        $action = $args->getArgument('action');

        $controller = $args->getOption('controller');
        $this->controller($args, $name, $controller);
        $this->model($name);

        if ($template && $action === null) {
            $action = $template;
        }
        if ($template) {
            $this->bake($args, $io, $template, true, $action);

            return static::CODE_SUCCESS;
        }

        $vars = $this->_loadController($io);
        $methods = $this->_methodsToBake();

        foreach ($methods as $method) {
            try {
                $content = $this->getContent($args, $io, $method, $vars);
                $this->bake($args, $io, $method, $content);
            } catch (MissingTemplateException $e) {
                $io->verbose($e->getMessage());
            } catch (RuntimeException $e) {
                $io->error($e->getMessage());
            }
        }

        return static::CODE_SUCCESS;
    }

    /**
     * Assembles and writes bakes the view file.
     *
     * @param \Cake\Console\Arguments $args CLI arguments
     * @param \Cake\Console\ConsoleIo $io Console io
     * @param string $template Template file to use.
     * @param string|true $content Content to write.
     * @param ?string $outputFile The output file to create. If null will use `$template`
     * @return void
     */
    public function bake(
        Arguments $args,
        ConsoleIo $io,
        string $template,
                  $content = '',
        ?string $outputFile = null
    ): void {
        if ($outputFile === null) {
            $outputFile = $template;
        }
        if ($content === true) {
            $content = $this->getContent($args, $io, $template);
        }
        if (empty($content)) {
            // phpcs:ignore Generic.Files.LineLength
            $io->err("<warning>No generated content for '{$template}.{$this->ext}', not generating template.</warning>");

            return;
        }

        $path = $this->getTemplatePath($args);
        $filename = $path . ucfirst(Inflector::underscore($outputFile)) . '.' . 'vue';

        $io->out("\n" . sprintf('Baking `%s` view template file...', $outputFile), 1, ConsoleIo::NORMAL);
        $io->createFile($filename, $content, $this->force);
    }

    /**
     * Get the path base for view templates.
     *
     * @param \Cake\Console\Arguments $args The arguments
     * @param string|null $container Unused.
     * @return string
     */
    public function getTemplatePath(Arguments $args, ?string $container = null): string
    {
        $prefix = $args->getOption('prefix') ?? '';
        $prefix .= DS;
        $path = ROOT . DS . 'resources' . DS . 'js' . DS. 'Components' . DS . $prefix;
        $path .= $this->controllerName . DS;

        return $path;
    }

    /**
     * Builds content from template and variables
     *
     * @param \Cake\Console\Arguments $args The CLI arguments
     * @param \Cake\Console\ConsoleIo $io The console io
     * @param string $action name to generate content to
     * @param array|null $vars passed for use in templates
     * @return string Content from template
     */
    public function getContent(Arguments $args, ConsoleIo $io, string $action, ?array $vars = null): string
    {
        if (!$vars) {
            $vars = $this->_loadController($io);
        }

        if (empty($vars['primaryKey'])) {
            $io->error('Cannot generate views for models with no primary key');
            $this->abort();
        }

        if (in_array($action, $this->excludeHiddenActions)) {
            $vars['fields'] = array_diff($vars['fields'], $vars['hidden']);
        }

        $renderer = $this->createTemplateRenderer()
            ->set('action', $action)
            ->set('plugin', $this->plugin)
            ->set('prefix', $args->getOption('prefix') ?? '')
            ->set($vars);

        $indexColumns = 0;
        if ($action === 'index' && $args->getOption('index-columns') !== null) {
            $indexColumns = $args->getOption('index-columns');
        }
        $renderer->set('indexColumns', $indexColumns);

        return $renderer->generate("Bake.Template/$action");
    }
}
