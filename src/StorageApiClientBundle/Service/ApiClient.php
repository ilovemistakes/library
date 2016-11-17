<?php

namespace StorageApiClientBundle\Service;

use JMS\Serializer\SerializationContext;

class ApiClient {
    private $client;
    private $serializer;

    public function __construct($client, $serializer) {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    private function query($url, $type, $data = null, $group = null) {
        if(is_null($group)) $group = 'Default';

        $response = $this->client->request($data ? 'POST' : 'GET', $url, $data ? array('body' => $this->serializer->serialize($data, 'json', SerializationContext::create()->setGroups($group))) : array());

        $body = $response->getBody();

        $entity = $this->serializer->deserialize($body, $type, 'json');

        return $entity;
    }

    public function getBooks() {
        return $this->query('book/', 'array<StorageApiClientBundle\Entity\Book>');
    }

    public function getBook($id) {
        return $this->query('book/' . intval($id), 'StorageApiClientBundle\Entity\Book');
    }

    public function getUsers() {
        return $this->query('user/', 'array<StorageApiClientBundle\Entity\User>');
    }

    public function getUser($id) {
        return $this->query('user/' . intval($id), 'StorageApiClientBundle\Entity\User');
    }

    public function newRecord($record) {
        return $this->query('record/', 'StorageApiClientBundle\Entity\Record', $record, 'record');
    }

    public function getReportTopBooks($limit) {
        return $this->query('report/top_books?limit=' . intval($limit), 'array<StorageApiClientBundle\Entity\BookStat>');
    }
}

