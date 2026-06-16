<?php
require_once __DIR__ . '/../core/Controller.php';

class LibraryController extends Controller {
    
    // все категории (библиотека)
    public function index() {
        global $connect;
        $libraries = $connect->query("SELECT * FROM library")->fetchAll(PDO::FETCH_ASSOC);
        $this->render('library', ['libraries' => $libraries]);
    }

    // темы конкретной категории 
    public function topic($id) {
        global $connect;
        // ищем темы, где library_id совпадает с ID категории
        $stmt = $connect->prepare("SELECT * FROM topic WHERE library_id = ?");
        $stmt->execute([$id]);
        $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $this->render('topic', ['topics' => $topics]);
    }

    // страница учебника 
    public function page($id) {
        global $connect;

        // достаем информацию о теме (чтобы получить заголовок "Учебники по...")
        $stmtTopic = $connect->prepare("SELECT * FROM topic WHERE id = ?");
        $stmtTopic->execute([$id]);
        $topicInfo = $stmtTopic->fetch(PDO::FETCH_ASSOC);

        // достаем список уроков для этой темы (как и было)
        $stmtPages = $connect->prepare("SELECT * FROM page WHERE topic_id = ?");
        $stmtPages->execute([$id]);
        $pages = $stmtPages->fetchAll(PDO::FETCH_ASSOC);

        // передаем в render и уроки ($pages), и инфо о теме ($topicInfo)
        $this->render('page', [
            'pages' => $pages,
            'topic' => $topicInfo 
        ]);
    }

    // текст конкретного урока
    public function lesson($id) {
        global $connect;

        // 1. получаем текущий урок
        $stmt = $connect->prepare("SELECT * FROM lesson WHERE id = ?");
        $stmt->execute([$id]);
        $lessonData = $stmt->fetch(PDO::FETCH_ASSOC);

        $page_id = $lessonData['page_id']; 

        // 2. ищем ID предыдущего урока (максимальный ID, который меньше текущего в этом учебнике)
        $stmtPrev = $connect->prepare("SELECT id FROM lesson WHERE page_id = ? AND id < ? ORDER BY id DESC LIMIT 1");
        $stmtPrev->execute([$page_id, $id]);
        $prevLesson = $stmtPrev->fetch();

        // 3. ищем ID следующего урока (минимальный ID, который больше текущего в этом учебнике)
        $stmtNext = $connect->prepare("SELECT id FROM lesson WHERE page_id = ? AND id > ? ORDER BY id ASC LIMIT 1");
        $stmtNext->execute([$page_id, $id]);
        $nextLesson = $stmtNext->fetch();

        // передаем все данные в представление
        $this->render('lesson', [
            'lesson'  => $lessonData,
            'prev_id' => ($prevLesson) ? $prevLesson['id'] : null,
            'next_id' => ($nextLesson) ? $nextLesson['id'] : null
        ]);
    }
}