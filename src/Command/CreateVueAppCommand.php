<?php
declare(strict_types=1);

namespace CakeDC\Inertia\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

class CreateVueAppCommand extends Command
{

    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/4/en/console-commands/commands.html#defining-arguments-and-options
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        $parser->setDescription(
            'Command to create vue app',
        )->addOption('prefix', [
            'boolean' => true,
        ]);

        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io): int
    {
        $io->out('CreateVueAppCommand');

        $prefix = '';
        if (!empty($args->getOption('prefix'))) {
            $prefix = $args->getArgumentAt(0);
        }

        //$initialPath = ROOT . DS .'plugins' . DS . 'Inertia' . DS;
        //$initialPath = ROOT . DS . 'vendor' . DS . 'cakedc' . DS . 'cakephp-inertia-plugin' . DS;
        $initialPath = ROOT . DS . 'vendor' . DS . 'acampanario' . DS . 'cakephp-inertia-plugin' . DS;

        /*
        $filepath = $initialPath . 'resources' . DS . 'sass' . DS . 'app.scss';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' . DS . 'sass' . DS;
        $filename = $path . 'app.scss';
        $io->createFile($filename, $content, false);
        */

        /*
        $filepath = $initialPath . 'resources' . DS . 'sass' . DS . '_variables.scss';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' . DS . 'sass' . DS;
        $filename = $path . '_variables.scss';
        $io->createFile($filename, $content, false);
        */

        /*
        $filepath = $initialPath . 'resources' . DS . 'css' . DS . 'cake.css';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' . DS . 'css' . DS;
        $filename = $path . 'cake.css';
        $io->createFile($filename, $content, false);
        */

        $filepath = $initialPath . 'resources' . DS . 'js' . DS . 'app.js';
        $content = file_get_contents($filepath);
        $content = str_replace('#PREFIX#', $prefix, $content);
        $path = ROOT . DS . 'resources' . DS . 'js' . DS;
        $filename = $path . 'app.js';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' . DS . 'js' . DS . 'Components' . DS . 'Layout.vue';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' . DS . 'js' . DS . 'Components' . DS;
        $filename = $path . 'Layout.vue';
        $io->createFile($filename, $content, false);

        /*
        $filepath = $initialPath . 'resources' . DS . 'js' . DS . 'Components' . DS . 'AppMenu.vue';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' . DS . 'js' . DS . 'Components' . DS;
        $filename = $path . 'AppMenu.vue';
        $io->createFile($filename, $content, false);
        */

        /*
        $filepath = $initialPath . 'resources' . DS . 'js' . DS . 'Components' . DS . 'AppUsersInertia' . DS . 'Dashboard.vue';
        $content = file_get_contents($filepath);
        if ($prefix !== ''){
            $path = ROOT . DS . 'resources' . DS . 'js' . DS . 'Components' . DS . $prefix . DS . 'AppUsersInertia'  . DS;
        } else {
            $path = ROOT . DS . 'resources' . DS . 'js' . DS . 'Components' . DS . 'AppUsersInertia'  . DS;
        }
        $filename = $path . 'Dashboard.vue';
        $io->createFile($filename, $content, false);
        */

        $filepath = $initialPath . 'resources' .  DS . 'package.json';
        $content = file_get_contents($filepath);
        $path = ROOT . DS;
        $filename = $path . 'package.json';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' .  DS . 'webpack.mix.js';
        $content = file_get_contents($filepath);
        $path = ROOT . DS;
        $filename = $path . 'webpack.mix.js';
        $io->createFile($filename, $content, false);

        return static::CODE_SUCCESS;
    }
}
