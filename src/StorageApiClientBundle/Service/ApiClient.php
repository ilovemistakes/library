<?php

namespace StorageApiClientBundle\Service;

class ApiClient {
    private $client;
    private $serializer;

    public function __construct($client, $serializer) {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    private function query($url, $type, $data = null) {
        $response = $this->client->request($data ? 'POST' : 'GET', $url, $data ? array('body' => $this->serializer->serialize($data, 'json')) : array());

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
        return $this->query('record/', 'StorageApiClientBundle\Entity\Record', $record);
    }
}

