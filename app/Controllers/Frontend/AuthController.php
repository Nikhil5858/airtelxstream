<?php
require_once ROOT_PATH . 'app/helpers/OtpHelper.php';
require_once ROOT_PATH . 'app/services/Mailer.php';
class AuthController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = $this->model('User');
    }

    // SEND OTP
    public function sendOtp()
    {
        $email = trim($_POST['email'] ?? '');
        $name  = trim($_POST['name'] ?? '');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => false, 'msg' => 'Invalid email']);
            return;
        }

        $user = $this->user->findOrCreateByEmail($email, $name);

        $otp     = OtpHelper::generate();
        $expires = OtpHelper::expiresAt();

        $this->user->saveOtp($user['id'], $otp, $expires);

        if (!Mailer::sendOtp($user['email'], $otp)) {
            echo json_encode(['status' => false, 'msg' => 'OTP send failed']);
            return;
        }

        $_SESSION['otp_user'] = $user['id'];

        echo json_encode(['status' => true]);
    }


    public function verifyOtp()
    {
        $otp    = trim($_POST['otp'] ?? '');
        $userId = $_SESSION['otp_user'] ?? null;

        if (!$userId) {
            echo json_encode(['status' => false]);
            return;
        }

        if ($this->user->verifyOtp($userId, $otp)) {
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_id'] = $userId;
            unset($_SESSION['otp_user']);

            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false, 'msg' => 'Invalid OTP']);
        }
    }
}
