<?php
namespace MyApp;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class Pusher implements WampServerInterface {
	
	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	protected $subscribedTopics = [];
	
	public function onSubscribe(ConnectionInterface $conn, $topic)
	{
		if ( ! array_key_exists($topic->getId(), $this->subscribedTopics))
		{
			$this->subscribedTopics[$topic->getId()] = $topic;
		}
	}
	
	public function onUnSubscribe(ConnectionInterface $conn, $topic)
	{
		
	}
	
	public function onOpen(ConnectionInterface $conn)
	{
		
	}
	
	public function onClose(ConnectionInterface $conn)
	{
		
	}
	
	public function onCall(ConnectionInterface $conn, $id, $topic, array $params)
	{
		// In this application if the clients send data it's because the user haved awound in the console
		$conn->callError($id, $topic, 'You are not allowed to make calls')->close();
	}
	
	public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
	{
		// In this application if the clients send data it's because the user haved awound in the console
		$conn->close();
	}
	
	public function onError(ConnectionInterface $conn, \Exception $e)
	{
		
	}
	
	// --- free functions
	
	public function onBlogEntry($entry)
	{
		$entryData = json_encode($entry, TRUE);
		
		if ( ! array_key_exists($entryData['cat'], $this->subscribedTopics))
		{
			return;
		}
		
		$topic = $this->subscribedTopics[$entryData['cat']];
		
		$topic->broadcast($entryData);
		
	}
}