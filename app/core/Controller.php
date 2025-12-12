<?php
class Controller
{
    /**
     *
     * @param string $view  Path like "Frontend/home/index" or "Admin/movies/index"
     * @param array  $data  Associative array of variables to be available in view
     * @return void
     */
    protected function view(string $view, array $data = []): void
    {
        // Prepare view file path
        $viewFile = ROOT_PATH . 'app/Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            http_response_code(404);
            echo "<h1>View not found: {$view}</h1>";
            return;
        }

        // Extract Data
        if (!empty($data)) {
            extract($data, EXTR_SKIP);
        }

        // Detect Admin view
        $isAdmin = strpos($view, 'Admin/') === 0;

        // HEADER
        $header = ROOT_PATH . 'app/Views/layouts/' . ($isAdmin ? 'admin_header.php' : 'frontend_header.php');
        if (file_exists($header)) {
            require $header;
        }

        // ADMIN: Include sidebar + navbar (BEFORE VIEW CONTENT)
        if ($isAdmin) {
            $navbar = ROOT_PATH . 'app/Views/admin/includes/navbar.php';
            $sidebar = ROOT_PATH . 'app/Views/admin/includes/sidebar.php';

            if (file_exists($navbar)) require $navbar;
            if (file_exists($sidebar)) require $sidebar;

            echo '<div class="admin-main-content">'; // wrapper start
        }

        // MAIN PAGE VIEW
        require $viewFile;

        // ADMIN: close wrapper div
        if ($isAdmin) {
            echo '</div>';
        }

        // FOOTER
        $footer = ROOT_PATH . 'app/Views/layouts/' . ($isAdmin ? 'admin_footer.php' : 'frontend_footer.php');
        if (file_exists($footer)) {
            require $footer;
        }
    }


    /**
     * Load a model and return its instance.
     *
     * @param string $modelName Class/file name inside app/Models (e.g. "Movie")
     * @return object|null
     */
    protected function model(string $modelName)
    {
        $modelFile = ROOT_PATH . 'app/Models/' . $modelName . '.php';

        if (!file_exists($modelFile)) {
            trigger_error("Model file not found: {$modelFile}", E_USER_WARNING);
            return null;
        }

        require_once $modelFile;

        if (!class_exists($modelName)) {
            trigger_error("Model class not found: {$modelName}", E_USER_WARNING);
            return null;
        }

        return new $modelName();
    }

    /**
     * Helper to redirect with optional flash data (simple)
     *
     * @param string $path Relative path under BASE_URL (e.g. 'admin/movies')
     * @return void
     */
    protected function redirect(string $path): void
    {
        $location = rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
        header("Location: {$location}");
        exit;
    }
}
