<?
require_once __DIR__ . '/../core/Controller.php';

class JournalController extends Controller
{
    public function journal()
    {
        global $connect;

        // mysqli
        // $result = mysqli_query($connect, "SELECT * FROM about");
        // $service = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // PDO
        // $stmt = $connect->prepare("SELECT * FROM staff");
        // $stmt->execute();
        // $workes = $stmt->fetchAll();

        // $stmt = $connect->prepare("SELECT * FROM advantages");
        // $stmt->execute();
        // $advantages = $stmt->fetchAll();

        $this->render('journal', [
            // название страницы отображаемое в браузере
            'title' => 'Журнал',
            // передаём данные выборки из бд
            // 'service'=>$service,
            // 'workes'=>$workes,
            // 'advantages'=>$advantages
        ]);
    }
}