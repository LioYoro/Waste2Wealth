<?php
require_once(__DIR__ . '/../config/db.php'); // Ensure your database connection file is correct

class FeedbackController {
    private $conn;

    public function __construct() {
        // Establish database connection
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Add new feedback
    public function addFeedback($user_id, $bottle_id, $rating, $comment) {
        $query = "INSERT INTO feedback (user_id, bottle_id, rating, comment) VALUES (:user_id, :bottle_id, :rating, :comment)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':bottle_id', $bottle_id, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);

        return $stmt->execute(); // Return true if insertion is successful
    }

    public function getFeedback() {
        return $this->Feedback->getFeedback();
    }

    // Retrieve feedback for a specific bottle
    public function getFeedbackByBottle($bottle_id) {
        $query = "SELECT f.*, u.username FROM feedback f JOIN users u ON f.user_id = u.id WHERE f.bottle_id = :bottle_id ORDER BY f.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bottle_id', $bottle_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all feedback for the bottle
    }

    // Retrieve feedback left by a specific user
    public function getFeedbackByUser($user_id) {
        $query = "SELECT f.*, b.type AS bottle_type FROM feedback f JOIN bottles b ON f.bottle_id = b.id WHERE f.user_id = :user_id ORDER BY f.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all feedback by the user
    }
}
?>
