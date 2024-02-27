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

namespace CakeDC\Inertia\Exception;

use Cake\Core\Exception\CakeException;

class TemplateNameException extends CakeException
{
    public function __construct($message, $code = 500, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
