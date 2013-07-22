<?php 

namespace Ws;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class Pusher implements WampServerInterface {

	protected $subscribedTopics = array();

	public function onSubscribe(ConnectionInterface $conn, $topic)
	{
        if (!array_key_exists($topic->getId(), $this->subscribedTopics)) {
            $this->subscribedTopics[$topic->getId()] = $topic;
        }
	}

	public function onPost($entry)
	{
		$entryData = json_decode($entry, true);

        // If the lookup topic object isn't set there is no one to publish to
        if (!array_key_exists($entryData['type'], $this->subscribedTopics)) {
            return;
        }

        $topic = $this->subscribedTopics[$entryData['type']];

        // re-send the data to all the clients subscribed to that category
        $topic->broadcast($entryData);
	}

	public function onUnsubscribe(ConnectionInterface $conn, $topic) {}
	public function onOpen(ConnectionInterface $conn) {}
	public function onClose(ConnectionInterface $conn) {}
	public function onCall(ConnectionInterface $conn, $id, $topic, array $params)
	{
		$conn->callError($id, $topic, 'You are not allowed to make calls')->close();
	}
	public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
		// $conn->close();
	}
	public function onError(ConnectionInterface $conn, \Exception $e) {}
}