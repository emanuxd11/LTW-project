<?php
    declare(strict_types = 1);

    class Faq {
        public int $id;
        public string $title;
        public string $answer;

        function __construct($id, $title, $answer) {
            $this->id = $id;
            $this->title = $title;
            $this->answer = $answer;
        }

        static function submitFaq(PDO $db, $title, $answer) {
            $stmt = $db->prepare('
                INSERT INTO faq (title, answer) VALUES ( ?, ? )
            ');
            $stmt->execute(array($title, $answer));

            $stmt = $db->prepare('
                SELECT id FROM faq 
                WHERE title = ?
            ');
            $stmt->execute(array($title));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['id'];
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
                $faq['answer']
            );
        }
    }
?>