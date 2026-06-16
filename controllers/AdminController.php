<?
require_once __DIR__ . '/../core/Controller.php';

// шаблон класса для логики страницы
class AdminController extends Controller
{
    public function index()
    {
        global $connect;

        $stmt = $connect->prepare('SELECT id, login, email, group_id FROM user');
        $stmt->execute();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
            $user_id = $_POST['user_id'];
    
            $sql = "DELETE FROM user WHERE id = :id";
            $stmt1 = $connect->prepare($sql);
            $stmt1->execute([':id' => $user_id]);
            header("Location: /admin");
            exit();
        }

        $this->render('admin', [
            'title' => 'Настройки сайта',
            'stmt' => $stmt,
        ]);
    }
}