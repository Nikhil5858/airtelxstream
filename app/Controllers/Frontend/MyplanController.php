<?php

class MyplanController extends Controller
{
    private Myplan $planModel;

    public function __construct()
    {
        $this->planModel = $this->model('Myplan');
    }

    public function index()
    {
        $plans = $this->planModel->getActivePlans();

        $this->view("Frontend/myplan/index", [
            'plans' => $plans
        ]);
    }

    public function subscribe()
    {
        if (empty($_SESSION['user_id'])) {
            $this->redirect('login');
        }

        $userId = $_SESSION['user_id'];
        $subscriptionId = $_POST['subscription_id'];

        $stmt = Database::getInstance()->getConnection()->prepare("
            INSERT INTO user_subscription
            (user_id, subscription_id, start_date, end_date, status, payment_status, is_autorenew, created_at)
            VALUES
            (:user_id, :subscription_id, CURDATE(),
            DATE_ADD(CURDATE(), INTERVAL 
                (SELECT duration_days FROM subscription WHERE id = :subscription_id) DAY
            ),
            'active', 'paid', 1, NOW())
        ");

        $stmt->execute([
            'user_id' => $userId,
            'subscription_id' => $subscriptionId
        ]);

        $this->redirect('myplan');
    }

}
