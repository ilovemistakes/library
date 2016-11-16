<?php

namespace StorageApiBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiExceptionSubscriber implements EventSubscriberInterface {
    private $debug;

    public function __construct($debug) {
        $this->debug = $debug;
    }

    public function onKernelException(GetResponseForExceptionEvent $event) {
        $e = $event->getException();

        if(strpos($event->getRequest()->getPathInfo(), '/api') !== 0) {
            return;
        }

        $code = 500;
        if($e instanceof HttpException) {
            $code = $e->getStatusCode();
        }

        if($code == 500 && $this->debug) {
            return;
        }

        $response = new JsonResponse(
            array(
                'code' => $code,
                'message' => $e->getMessage()
            ), $code);

        $response->headers->set('Content-Type', 'application/problem+json');

        $event->setResponse($response);
    }

    public static function getSubscribedEvents() {
        return array(
            KernelEvents::EXCEPTION => 'onKernelException',
        );
    }
}
