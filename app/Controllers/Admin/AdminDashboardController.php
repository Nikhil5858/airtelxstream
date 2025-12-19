<?php
class AdminDashboardController extends Controller
{
    public function __construct()
    {
        Middleware::adminAuth();
    }

    public function index()
    {
        $db = Database::getInstance()->getConnection();

        $stats = [
            'totalMovies' => $db->query("SELECT COUNT(*) FROM movies")->fetchColumn(),
            'totalUsers'  => $db->query("SELECT COUNT(*) FROM users")->fetchColumn(),
            'activeSubs'  => $db->query("SELECT COUNT(*) FROM users WHERE is_subscription_active = 1")->fetchColumn(),
            'totalOtts'   => $db->query("SELECT COUNT(*) FROM ott_providers")->fetchColumn()
        ];

        $recentMovies = $db->query("
            SELECT 
                m.id,
                m.title,
                m.poster_url,
                m.release_year,
                m.created_at,
                o.name AS ott
            FROM movies m
            LEFT JOIN ott_providers o ON o.id = m.ott_id
            ORDER BY m.created_at DESC
            LIMIT 6
        ")->fetchAll(PDO::FETCH_ASSOC);


        $this->view("Admin/dashboard/index", [
            "layout"       => "admin",
            "stats"        => $stats,
            "recentMovies" => $recentMovies
        ]);
    }
}
