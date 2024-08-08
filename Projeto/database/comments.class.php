<?php
    class Comment {
        public int $id;
        public string $text;
        public string $timestamp;
        public int $tipId;

        public function __construct(int $id, string $text, string $timestamp, int $tipId) {
            $this->id = $id;
            $this->text = $text;
            $this->timestamp = $timestamp;
            $this->tipId = $tipId;
        }

        public static function getTipComments(PDO $db, int $tipId): array {
            $stmt = $db->prepare('
                SELECT CommentId, Text, Timestamp, TipId
                FROM Comment
                WHERE TipId = ?
            ');
            $stmt->execute([$tipId]);

            $comments = [];

            while ($comment = $stmt->fetch()) {
                $comments[] = new Comment(
                    $comment['id'],
                    $comment['text'],
                    $comment['timestamp'],
                    $comment['tipId']
                );
            }

            return $comments;
        }

        public static function getQuestionComments(PDO $db, int $questionId): array {
            $stmt = $db->prepare('
                SELECT CommentId, Text, Timestamp, QuestionId
                FROM Comment
                WHERE QuestionId = ?
            ');
            $stmt->execute([$questionId]);

            $comments = [];

            while ($comment = $stmt->fetch()) {
                $comments[] = new Comment(
                    $comment['CommentId'],
                    $comment['Text'],
                    $comment['Timestamp'],
                    $comment['QuestionId']
                );
            }

            return $comments;
        }

        public function save(PDO $db) {
            $stmt = $db->prepare('
                UPDATE Comment SET Text = ?
                WHERE CommentId = ?
            ');
    
            $stmt->execute(array($this->text, $this->id));
        }
    }
?>

<?php function drawComment(int $id, Comment $comment) {
    ?>
    <tr>
      <td><?=$id + 1?></td>
      <td><?=$comment->text?></td>
      <td><?=$comment->timestamp?></td>
    </tr>
    <?php
  }
?>

<?php function drawEditComment(Comment $comment) {
  ?>
  <form action="../actions/action_edit_comment.php" method="post">
    <input type="hidden" name="id" value="<?=$comment->id?>">
    <label>Text:</label>
    <textarea name="text"><?=$comment->text?></textarea>
    <button type="submit">Save</button>
  </form>
  <?php
}
?>
