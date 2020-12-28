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
            <td>{$row['name']}</td>
            </tr>";
    }
    ?>
</table>

<div class="operations">
    <form action="handler.php" class="operation" method="post">
        <input type="hidden" name="query" value="INSERT INTO category(name) VALUES (:category_name);">
        <input type="hidden" name="back" value="category_table.php">
        <span>
            Добавить категорию
            <input type="text" placeholder="имя категории" name="category_name" required>
            ?
            <input type="submit" value="Да">
        </span>
    </form>
    <form action="handler.php" class="operation" method="post">
        <input type="hidden" name="query"
               value="UPDATE category SET name=:name WHERE id=:id_category_selector;">
        <input type="hidden" name="back" value="category_table.php">
        <span>
            Поменять название категории с
            <?
            echo Utils::renderQueryToSelect("id_category_selector", "name", "category");
            ?>
            на
            <input type="text" placeholder="имя категории" id="name" name="name" required>
            ?
            <input type="submit" value="Да">
        </span>
    </form>
    <form action="handler.php" class="operation" method="post">
        <input type="hidden" name="query" value="DELETE FROM category WHERE id=:id_category_selector">
        <input type="hidden" name="back" value="category_table.php">
        <span>
            Удалить категорию
                        <?
                        echo Utils::renderQueryToSelect("id_category_selector", "name", "category");
                        ?>
             ?
            <input type="submit" value="Да">
        </span>
    </form>
</div>

<script>
    function update(id) {
        return update_values(`${location.protocol}//${host}/api/get_category_name.php?id=${id}`);
    }
</script>
<?
include "./html/bottom.html";
?>
