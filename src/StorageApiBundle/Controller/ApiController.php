<?php

namespace StorageApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\Serializer\SerializationContext;

class ApiController extends Controller {
    protected function serialize($data, $group = null) {
        $context = SerializationContext::create();

        if(!is_null($group)) {
            $context->setGroups(array($group));
        }

        return $this->get('jms_serializer')->serialize($data, 'json', $context);
    }

    protected function unserialize($data, $class) {
        return $this->get('jms_serializer')->deserialize($data, $class, 'json');
    }
}

