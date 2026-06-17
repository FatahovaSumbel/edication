<?php
require_once __DIR__ . '/../core/Controller.php';

class AuthController extends Controller
{
    private function getUserBy($field, $value)
    {
        global $connect;

        $stmt = $connect->prepare("SELECT * FROM user WHERE $field = :value LIMIT 1");
        $stmt->execute(['value' => $value]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->getUserBy('login', $_POST['uname'] ?? '');

            if ($user && password_verify($_POST['pswd'] ?? '', $user['password'])) {
                $_SESSION['user'] = array_intersect_key(
                    $user,
                    array_flip(['id', 'login', 'name', 'surname'])
                );

                header("Location: /");
                exit;
            }

            $message = [
                'status' => 'error',
                'message' => 'Неверный логин или пароль.'
            ];
        }

        $this->render('form-auth', ['message' => $message ?? null, 'title' => 'Авторизация']);
    }

    public function register()
    {
        global $connect;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = trim($_POST['uname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['pswd'] ?? '';
            $id = 4;

            if ($_POST['pswd'] !== $_POST['pwd-confirm']) {
                $message = [
                    'status' => 'error',
                    'message' => 'Пароли не совпадают.'
                ];
            } elseif (
                $this->getUserBy('login', $login) ||
                $this->getUserBy('email', $email)
            ) {
                $message = [
                    'status' => 'error',
                    'message' => 'Логин или Email уже заняты.'
                ];
            } else {
                $stmt = $connect->prepare(
                    "INSERT INTO user (login, email, password, group_id) VALUES (?, ?, ?, ?)"
                );

                $stmt->execute([
                    $login,
                    $email,
                    password_hash($password, PASSWORD_DEFAULT),
                    $id
                ]);

                $message = [
                    'status' => 'success',
                    'message' => 'Регистрация успешна!'
                ];
            }
        }

        $this->render('form-registration', ['message' => $message ?? null, 'title' => 'Регистрация']);
    }

    public function rename()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }

        global $connect;

        $message = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];

            if (isset($_POST['name'])) {
                $stmt = $connect->prepare(
                    "UPDATE user SET name = ?, surname = ? WHERE id = ?"
                );

                $stmt->execute([
                    $_POST['name'],
                    $_POST['surname'],
                    $userId
                ]);

                $_SESSION['user']['name'] = $_POST['name'];
                $_SESSION['user']['surname'] = $_POST['surname'];

                $message = [
                    'status' => 'success',
                    'message' => 'Данные обновлены.'
                ];
            } elseif (isset($_POST['pswd'])) {
                $stmt = $connect->prepare(
                    "UPDATE user SET password = ? WHERE id = ?"
                );

                $stmt->execute([
                    password_hash($_POST['pswd'], PASSWORD_DEFAULT),
                    $userId
                ]);

                $message = [
                    'status' => 'success',
                    'message' => 'Пароль обновлен.'
                ];
            }
        }

        $this->render('form-rename', ['message' => $message, 'title' => 'Смена пароля']);
    }

    public function recovery()
    {
        global $connect;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $user = $this->getUserBy('email', $email);

            if ($user) {
                $token = bin2hex(random_bytes(32));

                $stmt = $connect->prepare(
                    "UPDATE user
                     SET reset_token = ?, reset_expires = ?
                     WHERE id = ?"
                );

                $stmt->execute([
                    $token,
                    date('Y-m-d H:i:s', time() + 3600),
                    $user['id']
                ]);
            }

            $message = [
                'status' => 'success',
                'message' => 'Инструкции отправлены, если email существует.'
            ];
        }

        $this->render('form-recovery', ['message' => $message ?? null, 'title' => 'Смена пароля']);
    }
}