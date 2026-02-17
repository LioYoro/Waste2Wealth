<?php
session_start();
require_once 'controllers/FeedbackController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $bottle_id = $_POST['bottle_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $feedbackController = new FeedbackController();
    if ($feedbackController->addFeedback($user_id, $bottle_id, $rating, $comment)) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Failed to submit feedback.";
    }
}
?>
<form method="POST">
    <input type="hidden" name="bottle_id" value="<?= $_GET['bottle_id'] ?>">
    <label for="rating">Rating:</label>
    <input type="number" name="rating" min="1" max="5" required><br>
    <textarea name="comment" placeholder="Your feedback..." required></textarea><br>
    <button type="submit">Submit Feedback</button>
</form>
