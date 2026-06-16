<div class="admin-panel">
    <h4>Управление ролями</h4>
    <div class="table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>login</th>
                    <th>email</th>
                    <th>Права</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?foreach($stmt as $item) {?>
                <tr>
                    <td><?echo $item['id']?></td>
                    <td><?echo $item['login']?></td>
                    <td><?echo $item['email']?></td>
                    <td><?echo $item['group_id']?></td>
                    <td>
                        <form method="POST" onsubmit="return confirm('Удалить пользователя?')">
                            <input type="hidden" name="user_id" value="<?php echo $item['id']; ?>">
                            <button type="submit" name="delete_user" class="delete-btn">
                                <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                            </button>
                        </form>
                    <i class="fa fa-pen-to-square" aria-hidden="true"></i>
                    </td>
                </tr>
                <?}?>
            </tbody>
        </table>
    </div>
</div>