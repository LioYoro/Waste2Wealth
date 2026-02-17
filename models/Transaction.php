<?php
require_once(__DIR__ . '/../config/db.php');

class Transaction {
    public $id;
    public $buyer_id;
    public $bottle_id;
    public $amount;
    public $status; // pending, completed
    private $db;

    // Make parameters optional and pass the PDO instance to the constructor
    public function __construct($buyer_id = null, $bottle_id = null, $amount = null, $db = null) {
        $this->buyer_id = $buyer_id;
        $this->bottle_id = $bottle_id;
        $this->amount = $amount;
        $this->status = 'pending';

        // Initialize DB connection using PDO from Database class
        $this->db = $db ? $db : (new Database())->getConnection();  // Use passed PDO or create a new one
    }

    public function getTransactionsBySeller($userId) {
        $query = "SELECT * FROM transactions WHERE seller_id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getPurchasesByBuyer($userId) {
        $sql = "SELECT * FROM transactions WHERE buyer_id = ?";
        $stmt = $this->db->prepare($sql);  // Now $this->db is a PDO instance
        $stmt->bindParam(1, $userId, PDO::PARAM_INT);  // Use bindParam for PDO
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Return as associative array
    }
}

?>