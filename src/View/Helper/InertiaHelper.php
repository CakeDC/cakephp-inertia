<?php
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
            htmlentities($encodedPageData),
            $class
        );
    }
}
