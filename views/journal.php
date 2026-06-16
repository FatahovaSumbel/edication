<div class="indent">
    <h4>Групповые проекты</h4>
    
    <form class="div-flame">
        <div class="div-flame">
            <h6>Группа:</h6>
            <select id="group_select" name="group_id">
            <?while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $selected = ($row['id'] == $groupId) ? 'selected': '';
                ?>
                <option value="<?=$row['id']?>" <?echo $selected?>> <?echo $row['name'];?> </option>
            <?}?>
            </select>
        </div>
    
        <div class="div-flame">
            <h6>Дисциплина:</h6>
            <select name="discipline-choice" id="discipline-choice">
            <?while ($row = $res_discipline->fetch(PDO::FETCH_ASSOC)) {
                $selected = ($row['id'] == $disciplineId) ? 'selected': '';?>
                <option value="<?=$row['id']?>" <?echo $selected?>> <?echo $row['name'];?> </option>
            <?}?>
            </select>
        </div>
    
        <button class='click'>Показать</button>
    </form>
    
    <div class="div-flame">
        <h6>Количество студентов:</h6>
        <h4><?=$rowsCount?></h4>
    </div>
    
    <h4>Статус выполнения:</h4>
    
    <table class="simple-table">
        <tr>
            <td><h6>Обозначение</h6></td>
            <td><p class='flame-green flame-padding'></p></td>
            <td><p class='late flame-padding'></p></td>
            <td><p class='ill flame-padding'></p></td>
            <td><p class='flame-red flame-padding'></p></td>
            <td><p class='flame-white flame-padding'></p></td>
        </tr>
    
        <tr class='border-top'>
            <td><h6 class='white-text flame-padding lection'>Лекции</h6></td>
            <td><h6>Был</h6></td>
            <td><h6>Опоздал</h6></td>
            <td><h6>Отсутсвовал по болезни</h6></td>
            <td><h6>Перевод</h6></td>
            <td><h6>Отсутствовал</h6></td>
        </tr>
    
        <tr>
            <td><h6 class='white-text flame-padding practice'>Лабораторные</h6></td>
            <td><h6>Сдано</h6></td>
            <td><h6>0,6 баллов доделать</h6></td>
            <td><h6>0,3 баллов переделать</h6></td>
            <td><h6>Перевод</h6></td>
            <td><h6>Отсутствовал</h6></td>
        </tr>
    </table>
    <h4 class='text-center'>Журнал посещаемости</h4>
    <div class="table-wrapper scroll-horizontal">
        <table class="visit_table">
            <tr>
                <td class="fix" style="height: 90px; min-width: 170px;"></td>
                <?
                $columnsList = array();
                while ($column = $columns->fetch(PDO::FETCH_ASSOC)) {
                    $element = array(
                        'id' => $column['id'],
                        'type' => $column['type'],
                        'date' => $column['date'],
                        'theme' => $column['theme'],
                    );
                    $columnsList[] = $element;
                    if ($column['type'] == 'lection') {
                        $lectionList[] = $element;
                    } else {
                        $practiceList[] = $element;
                    }
                }
    
                foreach ($columnsList as $key => $column) {?>
                    <td class="<?=$column['type']?>">
                        <?if ($column['theme']) {?>
                            <p class="vertical"><?=$column['theme'];?></p>
                        <?} else {?>
                            <p class="vertical"><?=$column['type'];?> <?=$column['date'];?></p>
                        <?}?>
                    </td><?
                }
                ?>
            </tr>
            <?
            while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
            ?><tr data-eid="<?=$row['id'];?>"><?
                $stud_status = '';
                if ($row['expel'] == 1) $stud_status = 'danger';
                if ($row['expel'] == 2) $stud_status = 'expel';
                echo '<td class="fix" class="'.$stud_status.'">' . $row['family'] .' '. $row['name'] . '</td>';
                foreach ($columnsList as $key => $column) {
                    $status = $stud_status ? $stud_status . ' ': '';
                    if ($visits[$row['id']][$column['id']]) $status = $visits[$row['id']][$column['id']];
                    ?><td class="visit_link <?=$status;?>" data-eid="<?=$column['id'];?>"></td><?
                }
            ?></tr><?
            }
        ?></table>
    </div>
</div>