<?php
declare(strict_types=1);

namespace CakeDC\Inertia\Traits;

use Cake\Event\EventInterface;
use Cake\Core\InstanceConfigTrait;

trait InertiaResponseTrait
{
    use InstanceConfigTrait;

    /**
     * Default config for this view.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [
        'JsonViewClass' => \CakeDC\Inertia\View\InertiaJsonView::class,
    ];

    /**
     * @inheritDoc
     */
    public function beforeRender(EventInterface $event)
    {
        if ($this->isErrorStatus() || $this->isFailureStatus()) {
            return null;
        }

        //set view class
        $viewClass = \CakeDC\Inertia\View\InertiaView::class;
        if ($this->getRequest()->is('inertia')) {
            $viewClass = $this->getConfig('JsonViewClass');
        }
        $this->viewBuilder()->setClassName($viewClass);

        //set messages
        $session = $this->getRequest()->getSession();
        $flash = [];
        if ($session->check('Flash.flash.0')) {
            $flash = $session->read('Flash.flash.0');
            $flash['element'] = strtolower(str_replace('/', '-', $flash['element']));
            $session->delete('Flash');
        }
        $this->set('flash', $flash);

        //set csrf token
        $this->set('csrfToken', $this->getRequest()->getAttribute('csrfToken'));
    }

    /**
     * Checks if response status code is 404.
     *
     * @return bool
     */
    private function isErrorStatus(): bool
    {
        return $this->getResponse()->getStatusCode() === 404;
    }

    /**
     * Checks if response status code is 500.
     *
     * @return bool
     */
    private function isFailureStatus(): bool
    {
        return $this->getResponse()->getStatusCode() === 500;
    }
}
