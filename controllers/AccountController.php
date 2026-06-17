<?
require_once __DIR__ . '/../core/Controller.php';

// шаблон класса для логики страницы
class AccountController extends Controller
{
    public function index()
    {
        global $connect;


        $this->render('account', [
            'title' => 'Главная',

        ]);
    }
}