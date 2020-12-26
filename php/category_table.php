<?
include 'Utils.php';
echo Utils::renderHeader("./html/top.html", "Таблица категорий")
?>
<table id="table">
    <tr>
        <th>id</th>
        <th>Название категории</th>
    </tr>

    <?
    $db = Utils::getPDO();
    foreach ($db->query("SELECT id, name FROM category;") as $row) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td id='categories_{$row['id']}' ondblclick='update_categories({$row['id']})'>{$row['name']}</td>
            </tr>";
    }
    ?>
    <tr id="add_row">
        <td class="add" id="add" colspan="2" ondblclick="add_category()">Добавить категорию</td>
    </tr>
</table>

<!--<div class="operations">-->
<!--    <form action="handler.php" class="operation" method="post">-->
<!--        <input type="hidden" name="query" value="INSERT INTO category(name) VALUES (:category_name);">-->
<!--        <input type="hidden" name="back" value="category_table.php">-->
<!--        <span>-->
<!--            Добавить категорию-->
<!--            <input type="text" name="category_name" required>-->
<!--            ?-->
<!--            <input type="submit" value="Да">-->
<!--        </span>-->
<!--    </form>-->
<!--    <form action="handler.php" class="operation" method="post">-->
<!--        <input type="hidden" name="query"-->
<!--               value="UPDATE category SET name=:new_category_name WHERE id=:id_category_selector;">-->
<!--        <input type="hidden" name="back" value="category_table.php">-->
<!--        <span>-->
<!--            Поменять название категории с-->
<!--            --><?//
//            echo Utils::renderQueryToSelect("id_category_selector", "name", "category");
//            ?>
<!--            на-->
<!--            <input type="text" name="new_category_name" required>-->
<!--            ?-->
<!--            <input type="submit" value="Да">-->
<!--        </span>-->
<!--    </form>-->
<!--    <form action="handler.php" class="operation" method="post">-->
<!--        <input type="hidden" name="query" value="DELETE FROM category WHERE id=:id_category_selector">-->
<!--        <input type="hidden" name="back" value="category_table.php">-->
<!--        <span>-->
<!--            Удалить категорию-->
<!--                        --><?//
//                        echo Utils::renderQueryToSelect("id_category_selector", "name", "category");
//                        ?>
<!--             ?-->
<!--            <input type="submit" value="Да">-->
<!--        </span>-->
<!--    </form>-->
<!---->
<!--</div>-->
<?
include "./html/bottom.html";
?>
