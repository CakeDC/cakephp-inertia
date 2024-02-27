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

namespace CakeDC\Inertia\View\Helper;

use Cake\View\Helper;

/**
 * Inertia helper
 */
class InertiaHelper extends Helper
{
    /**
     * Returns inertia div html
     */
    public function component($pageData, $id = 'app', $class = ''): string
    {
        $encodedPageData = json_encode($pageData);

        if ($encodedPageData === false) {
            $encodedPageData = '';
        }

        return sprintf(
            '<div id="%s" data-page="%s" class="%s"></div>',
            $id,
            h($encodedPageData),
            $class
        );
    }
}
