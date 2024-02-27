<?php
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
