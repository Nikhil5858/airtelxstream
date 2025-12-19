<?php

class ProfileController extends Controller
{
    public function __construct()
    {
        if (empty($_SESSION['user_id'])) {
            $this->redirect('login');
        }
    }

    public function index()
    {
        $userId = $_SESSION['user_id'];

        $user = $this->model('User')->find($userId);
        $watchlist = $this->model('Watchlist')->getUserWatchlist($userId);

        $this->view("Frontend/profile/index", [
            'user'      => $user,
            'watchlist' => $watchlist
        ]);
    }


    public function help()
    {
        $this->view("Frontend/profile/help");
    }

    public function language()
    {
        $this->view("Frontend/profile/language");
    }

    public function logout()
    {
        session_unset();        
        session_destroy();   

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        $this->redirect('home/index');
    }    

    public function addToWatchlist()
    {
        if (empty($_SESSION['user_id'])) {
            http_response_code(401);
            return;
        }

        $movieId = (int)($_POST['movie_id'] ?? 0);
        $userId  = $_SESSION['user_id'];

        if ($movieId <= 0) return;

        $this->model('Watchlist')->add($userId, $movieId);
    }


    public function removeFromWatchlist()
    {
        if (empty($_SESSION['user_id'])) {
            http_response_code(401);
            return;
        }

        $movieId = (int) ($_POST['movie_id'] ?? 0);
        $userId  = $_SESSION['user_id'];

        if ($movieId <= 0) return;

        $this->model('Watchlist')->remove($userId, $movieId);
    }

    
}
