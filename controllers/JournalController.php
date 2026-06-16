<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/helpers/discipline.php';

class JournalController extends Controller
{
    public function journal()
    {
        global $connect;
        
        // Функция для запросов к БД
        function db_select($connect, $table, $column, $where = "", $limit = '') {
            $query = 'SELECT '. $column .' FROM `'. $table .'`';
            if ($where) $query .= ' WHERE '. $where;
            if ($limit) $query .= ' LIMIT '. $limit;
            $query .= ';';
            
            $stmt = $connect->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }
        
        // ОБРАБОТКА AJAX ЗАПРОСА 
        if (isset($_POST['action']) && $_POST['action'] == 'getSelect') {
            $groupId = isset($_POST['group_id']) ? (int)$_POST['group_id'] : 0;
            
            if ($groupId) {
                $discipline = new Discipline($connect);
                $discipline->getList($connect, $groupId);
                echo $discipline->select(0);
            } 
            exit(); 
        }
        
        // фильтрация
        $groupId = isset($_REQUEST['group_id']) ? (int)$_REQUEST['group_id'] : 16;
        $disciplineId = isset($_REQUEST['discipline-choice']) ? (int)$_REQUEST['discipline-choice'] : 7;
        $filter = "group_id = " . $groupId;
        
        // подсчёт студентов
        $res = db_select($connect, "user", "COUNT(id) as count", $filter);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $rowsCount = $row['count'];
    
        // результат выборки из бд
        $columns = db_select($connect, "class", "id, type, date, theme", $filter . ' AND discipline_id=' . $disciplineId);
        $data = db_select($connect, "user", "id, family, name, expel", $filter);
        $res = db_select($connect, "groups", "id, name", "institut_id = 1 AND role_id = 4");
        $res_discipline = db_select($connect, "discipline", "id, name", "institut_id = 1 AND id IN (SELECT discipline_id FROM studies WHERE group_id = ".$groupId.") ORDER BY name");
        
        //отображение статуса пар у студентов
        $visitsRes = db_select($connect, "visit", "class_id, student_id, status", 'student_id IN (SELECT id FROM user WHERE '. $filter .')');
        $visits = array();
        while ($visitRow = $visitsRes->fetch(PDO::FETCH_ASSOC)) {
            $visits[$visitRow['student_id']][$visitRow['class_id']] = $visitRow['status'];
        }

        $this->render('journal', [
            'title' => 'Журнал',
            'columns' => $columns,
            'data' => $data,
            'res' => $res,
            'groupId' => $groupId,
            'disciplineId' => $disciplineId,
            'rowsCount' => $rowsCount,
            'visits' => $visits,
            'res_discipline' => $res_discipline,
            'js' => "system.js, visit.js",
        ]);
    }
}