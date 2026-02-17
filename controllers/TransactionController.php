<?php
require_once(__DIR__ . '/../config/db.php');
require_once(__DIR__ . '/../models/Transaction.php');

class TransactionController {
    private $conn;
    private $transactionModel;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->transactionModel = new Transaction(); // Make sure this matches
    }

    public function createTransaction($buyer_id, $bottle_id, $amount) {
        $transaction = new Transaction($buyer_id, $bottle_id, $amount);
        $query = "INSERT INTO transactions (buyer_id, bottle_id, amount, status) VALUES (:buyer_id, :bottle_id, :amount, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':buyer_id', $transaction->buyer_id);
        $stmt->bindParam(':bottle_id', $transaction->bottle_id);
        $stmt->bindParam(':amount', $transaction->amount);
        $stmt->bindParam(':status', $transaction->status);
        return $stmt->execute();
    }

    public function getTransactionsByUser($user_id) {
        $query = "SELECT * FROM transactions WHERE buyer_id = :buyer_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':buyer_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPurchasesByBuyer($userId) {
        return $this->transactionModel->getPurchasesByBuyer($userId); // Call correct model method
    }

    public function getTransactionsBySeller($userId) {
        return $this->transactionModel->getTransactionsBySeller($userId); // Fixed the error here
    }
}
?>
