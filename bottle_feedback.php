<?php
require_once 'controllers/FeedbackController.php';

$bottle_id = $_GET['bottle_id'];
$feedbackController = new FeedbackController();
$feedbackList = $feedbackController->getFeedbackByBottle($bottle_id);

echo "<h2>Feedback for Bottle ID: $bottle_id</h2>";
if (count($feedbackList) > 0) {
    foreach ($feedbackList as $feedback) {
        echo "<div>";
        echo "<strong>User:</strong> " . htmlspecialchars($feedback['username']) . "<br>";
        echo "<strong>Rating:</strong> " . htmlspecialchars($feedback['rating']) . "<br>";
        echo "<strong>Comment:</strong> " . nl2br(htmlspecialchars($feedback['comment'])) . "<br>";
        echo "<em>Posted on: " . $feedback['created_at'] . "</em>";
        echo "</div><hr>";
    }
} else {
    echo "No feedback yet for this bottle.";
}
?>
