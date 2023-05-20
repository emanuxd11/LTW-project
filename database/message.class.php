<?php
  declare(strict_types = 1);

  class Message {
    public int $id;
    public string $text;
    public string $date;
    public int $ticket_id;
    public int $sender_id;
    public string $sender_username;

    public function __construct(PDO $db, int $id, string $text, string $date, int $ticket_id, int $sender_id) {
      $this->id = $id;
      $this->text = $text;
      $this->date = $date;
      $this->ticket_id = $ticket_id;
      $this->sender_id = $sender_id;
      $this->sender_username = Message::getSenderUsername($db, $id);
    }

    static function storeMessage(PDO $db, string $text, int $ticket_id, int $sender_id) {
      $stmt = $db->prepare('
        INSERT INTO messages (text, ticket_id, sender_id) VALUES ( ?, ?, ? )
      ');
      $stmt->execute(array($text, $ticket_id, $sender_id));

      return true;
    }

    static function getMessages(PDO $db, int $ticket_id) {
      $stmt = $db->prepare('
        SELECT id, text, post_date, ticket_id, sender_id 
        FROM messages 
        WHERE ticket_id = ?;
      ');
      
      $stmt->execute(array($ticket_id));
      $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
      $message_objects = [];
      foreach ($messages as $message) {
        $message_object = new Message(
          $db,
          $message['id'],
          $message['text'],
          $message['post_date'],
          $message['ticket_id'],
          $message['sender_id']
        );
        $message_objects[] = $message_object;
      }
      
      return $message_objects; 
    }

    private function getSenderUsername(PDO $db) {
      $stmt = $db->prepare('
        SELECT username 
        FROM user 
        WHERE id = ?;
      ');
      $stmt->execute(array($this->sender_id));
    
      $sender_username = $stmt->fetch(PDO::FETCH_ASSOC);
      
      return $sender_username['username'];
    }
  }
?>