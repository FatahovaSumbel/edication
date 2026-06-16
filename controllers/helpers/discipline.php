<?
class Discipline {
    private $list;
    
    function __construct($db) {
        $id = $_REQUEST['group_id'] ?? 10;
        $this->list = $this->getList($db, $id);
    }
    
    function getList($db, $id) {
        $list = [];
        
        $where = "institut_id = 1 AND id IN (SELECT discipline_id FROM studies WHERE group_id = ". $id .")";
        
        $res = db_select($db, "discipline", "id, name", $where);
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }
        
        return $list;
    }
    
    function getSelect($groupId) {
        global $connect;
        $this->getList($connect, $groupId);
        return $this->select(0);
    }

    function select($id = 0) {
        $html = '';
        $flag = !$id;
        
        foreach ($this->list as $element) {
            if ($id > 0 && $id == $element['id']) $flag = true;
            $selected = $flag ? 'selected': '';
            
            $html .= '<option value="'. $element['id'] .'" '. $selected .'>'. $element['name'] . '</option>';
            $flag = false;
        }
        
        return $html;
    }
}

