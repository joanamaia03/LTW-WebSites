<?php
    declare(strict_types = 1);

    class Faq {
        public int $id;
        public string $question;
        public string $answer;

    public function __construct(int $id, string $question, string $answer){
        $this->id = $id;
        $this->title = $question;
        $this->body = $answer;
    }
    static function getMaxId(PDO $db): int{
        $stmt=$db->prepare('
            SELECT MAX(id) AS id_max 
            FROM FAQ;
        ');
        $stmt->execute();
        if($Hashtag= $stmt ->fetch()){
            return (int)$Hashtag['id_max'];
        }
    }
    static function getAllFAQ(PDO $db){
        $stmt=$db->prepare('
            SELECT * FROM FAQ
        ');
        $stmt->execute();
        $faq=array();
        while($row=$stmt->fetch()){
            $faq = new Faq($row['id'], $row['question'], $row['answer']);
            $faq[] = $faq;
        }
        return $faq;
    }
    static function createFAQ(PDO $db, int $id, string $question, string $answer){
        $stmt=$db->prepare('
            INSERT INTO FAQ(id, question, answer)
            VALUES(?,?,?);
        ');
        $stmt->execute(array($id,$question,$answer));
    }
    public function getQuestion():string{
        return $this->question;
    }
    public function getAnswer(): string{
        return $this->answer;
    }
    }
?>