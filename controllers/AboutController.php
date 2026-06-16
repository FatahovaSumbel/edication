<?php
require_once __DIR__ . '/../core/Controller.php';

class AboutController extends Controller
{
    public function about()
    {
        global $connect;

        // получаем все данные из таблицы about
        $stmt = $connect->prepare("SELECT * FROM about");
        $stmt->execute();
        $allData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // создаем пустые массивы для каждой секции
        $features = [];
        $targets  = [];
        $team     = [];

        // распределяем данные по массивам в зависимости от колонки 'type'
        foreach ($allData as $item) {
            if ($item['type'] === 'feature') {
                $features[] = $item;
            } elseif ($item['type'] === 'target') {
                $targets[] = $item;
            } elseif ($item['type'] === 'team') {
                $team[] = $item;
            }
        }

        // передаем данные в представление
        $this->render('about', [
            'page_title' => 'О проекте', 
            'features'   => $features,
            'targets'    => $targets,
            'team'       => $team
        ]);
    }
}