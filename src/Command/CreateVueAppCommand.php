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

        $initialPath = ROOT . DS . 'vendor' . DS . 'cakedc' . DS . 'cakephp-inertia' . DS;

        $filepath = $initialPath . 'resources' . DS . 'js' . DS . 'app.js';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' . DS . 'js' . DS;
        $filename = $path . 'app.js';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' . DS . 'js' . DS . 'ssr.js';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' . DS . 'js' . DS;
        $filename = $path . 'ssr.js';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' . DS . 'css' . DS . 'app.css';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' . DS . 'css' . DS;
        $filename = $path . 'app.css';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' . DS . 'js' . DS . 'Components' . DS . 'Layout.vue';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' . DS . 'js' . DS . 'Components' . DS;
        $filename = $path . 'Layout.vue';
        $io->createFile($filename, $content, false);

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

        $filepath = $initialPath . 'resources' .  DS . 'webpack.ssr.mix.js';
        $content = file_get_contents($filepath);
        $path = ROOT . DS;
        $filename = $path . 'webpack.ssr.mix.js';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' .  DS . 'webpack.config.js';
        $content = file_get_contents($filepath);
        $path = ROOT . DS;
        $filename = $path . 'webpack.config.js';
        $io->createFile($filename, $content, false);

        return static::CODE_SUCCESS;
    }
}
