<?php
require_once ROOT_PATH . 'app/core/Database.php';
require_once ROOT_PATH . 'app/core/Middleware.php';
class Controller
{
    protected function view(string $view, array $data = []): void
    {
        $viewFile = ROOT_PATH . 'app/Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            die("View not found: {$view}");
        }

        extract($data, EXTR_SKIP);

        $layout = $data['layout'] ?? 'frontend';

        // ===== HEADER =====
        if ($layout === 'admin') {
            require ROOT_PATH . 'app/Views/layouts/auth_header.php';
        } elseif ($layout === 'auth') {
            require ROOT_PATH . 'app/Views/layouts/auth_header.php';
        } else {
            require ROOT_PATH . 'app/Views/layouts/frontend_header.php';
        }

        // ===== admin nav only for login admin =====
        
        if ($layout === 'admin') {
            require ROOT_PATH . 'app/Views/Admin/includes/navbar.php';
            require ROOT_PATH . 'app/Views/Admin/includes/sidebar.php';
            echo '<div class="admin-main-content">';
        }

        // ===== view =====
        require $viewFile;

        if ($layout === 'admin') {
            echo '</div>';
        }

        // ===== footer =====
        if ($layout === 'admin') {
            require ROOT_PATH . 'app/Views/layouts/auth_footer.php';
        } elseif ($layout === 'auth') {
            require ROOT_PATH . 'app/Views/layouts/auth_footer.php';
        } else {
            require ROOT_PATH . 'app/Views/layouts/frontend_footer.php';
        }
    }

    protected function model(string $model)
    {
        require_once ROOT_PATH . 'app/Models/' . $model . '.php';
        return new $model();
    }

    protected function redirect(string $path): void
    {
        header("Location: " . BASE_URL . '/' . ltrim($path, '/'));
        exit;
    }
}
