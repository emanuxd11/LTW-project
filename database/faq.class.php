<?php
    declare(strict_types = 1);

    class Faq {
        public int $id;
        public string $title;
        public string $description;
        public string $answer;

        function __construct($id, $title, $description, $answer) {
            $this->id = $id;
            $this->title = $title;
            $this->description = $description;
            $this->answer = $answer;
        }

        static function submitFaq(PDO $db, $title, $description, $answer) {
            $stmt = $db->prepare('
                INSERT INTO faq (title, description, answer) VALUES ( ?, ?, ? )
            ');
            $stmt->execute(array($title, $description, $answer));
        }

        static function getAllFaqIds(PDO $db) {
            $stmt = $db->prepare('
                SELECT id 
                FROM faq
            ');
            $stmt->execute();

            $id_array = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_array[] = $row['id'];
            }

            return $id_array;
        }

        static function getFaqById(PDO $db, int $id) : Faq {
            $stmt = $db->prepare('
                SELECT * 
                FROM faq 
                WHERE id = ?
            ');

            $stmt->execute(array($id));
            $faq = $stmt->fetch();

            return new faq (
                $faq['id'],
                $faq['title'],
                $faq['description'],
                $faq['answer']
            );
        }
    }
?>