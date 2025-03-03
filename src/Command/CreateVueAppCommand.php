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
        $io->out('CreateVueViteAppCommand');

        $initialPath = ROOT . DS . 'vendor' . DS . 'cakedc' . DS . 'cakephp-inertia' . DS;

        $filepath = $initialPath . 'resources' . DS . 'css' . DS . 'app.css';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' . DS . 'css' . DS;
        $filename = $path . 'app.css';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' . DS . 'css' . DS . 'theme.css';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' . DS . 'css' . DS;
        $filename = $path . 'theme.css';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' . DS . 'js' . DS . 'app.js';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' . DS . 'js' . DS;
        $filename = $path . 'app.js';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' . DS . 'js' . DS . 'bootstrap.js';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' . DS . 'js' . DS;
        $filename = $path . 'bootstrap.js';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' . DS . 'js' . DS . 'components' . DS . 'Pages' . DS . 'Dashboard.vue';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' .  DS . 'js' . DS . 'components' . DS . 'Pages' . DS ;
        $filename = $path . 'Dashboard.vue';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' . DS . 'js' . DS . 'components' . DS . 'Layout.vue';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' .  DS . 'js' . DS . 'components' . DS;
        $filename = $path . 'Layout.vue';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' . DS . 'js' . DS . 'components' . DS . 'Theme' . DS . 'Header.vue';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' .  DS . 'js' . DS . 'components' . DS . 'Theme' . DS;
        $filename = $path . 'Header.vue';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' . DS . 'js' . DS . 'components' . DS . 'Theme' . DS . 'Nav.vue';
        $content = file_get_contents($filepath);
        $path = ROOT . DS . 'resources' .  DS . 'js' . DS . 'components' . DS . 'Theme' . DS;
        $filename = $path . 'Nav.vue';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' .  DS . 'package.json';
        $content = file_get_contents($filepath);
        $path = ROOT . DS;
        $filename = $path . 'package.json';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' .  DS . 'postcss.config.js';
        $content = file_get_contents($filepath);
        $path = ROOT . DS;
        $filename = $path . 'postcss.config.js';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' .  DS . 'tailwind.config.js';
        $content = file_get_contents($filepath);
        $path = ROOT . DS;
        $filename = $path . 'tailwind.config.js';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' .  DS . 'vite.config.js';
        $content = file_get_contents($filepath);
        $path = ROOT . DS;
        $filename = $path . 'vite.config.js';
        $io->createFile($filename, $content, false);

        $filepath = $initialPath . 'resources' .  DS . '.env';
        $content = file_get_contents($filepath);
        $path = ROOT . DS;
        $filename = $path . '.env';
        $io->createFile($filename, $content, false);

        return static::CODE_SUCCESS;
    }
}
