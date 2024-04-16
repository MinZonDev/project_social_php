<?php
require __DIR__.'/vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $db;
    

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        // Thay thế các giá trị bên dưới bằng thông tin kết nối cơ sở dữ liệu thực tế của bạn
        $this->db = new mysqli('chirp-social-minzondev.b.aivencloud.com:28999', 'avnadmin', 'AVNS_hUaIHWb2H3eQt_qspQG', 'chirp_social');
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function onOpen(ConnectionInterface $conn) {

        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $messageData = json_decode($msg, true);
        $receiver = $messageData['receiver'];
        $content = $messageData['content'];

        // Save message to database
        $this->saveMessage($messageData['sender'], $receiver, $content);

        foreach ($this->clients as $client) {
            if ($client !== $from) {
                continue;
            }

            if ($client->resourceId == $receiver) {
                $client->send($msg);
                break;
            }
        }
    }

    protected function saveMessage($senderID, $receiverID, $content) {
        // Insert message into the database
        $stmt = $this->db->prepare("INSERT INTO messages (SenderID, ReceiverID, Content) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $senderID, $receiverID, $content);
        $stmt->execute();
        $stmt->close();
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);
$server->run();
?>
