<?php
declare(strict_types=1);

namespace Inertia\Traits;

use Cake\Event\EventInterface;
use Inertia\View\InertiaView;

trait InertiaResponseTrait
{
    /**
     * @inheritDoc
     */
    public function beforeRender(EventInterface $event)
    {
        \Cake\Log\Log::debug(__METHOD__);

        if ($this->isErrorStatus() || $this->isFailureStatus()) {
            return null;
        }

        //set view class
        $viewClass = 'Inertia';
        if ($this->getRequest()->is('inertia')) {
            $viewClass = 'InertiaJson';
        }
        \Cake\Log\Log::debug("Inertia.{$viewClass}");
        $this->viewBuilder()->setClassName("Inertia.{$viewClass}");
        //$this->viewBuilder()->setClassName("{$viewClass}");

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
        $this->set('token', $this->getRequest()->getAttribute('csrfToken'));
    }

    /**
     * Checks if response status code is 404.
     */
    private function isErrorStatus(): bool
    {
        \Cake\Log\Log::debug(__METHOD__);

        $statusCode = $this->getResponse()->getStatusCode();
        $errorCodes = [404];

        if (in_array($statusCode, $errorCodes)) {
            return true;
        }

        return false;
    }

    /**
     * Checks if response status code is 500.
     */
    private function isFailureStatus(): bool
    {
        \Cake\Log\Log::debug(__METHOD__);

        $statusCode = $this->getResponse()->getStatusCode();
        $failureCodes = [500];

        if (in_array($statusCode, $failureCodes)) {
            return true;
        }

        return false;
    }
}
