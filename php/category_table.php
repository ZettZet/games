<?
ob_start();
include "./html/top.html";
$buffer = ob_get_contents();
ob_get_clean();

$title = "Таблица категорий";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
echo $buffer;
?>
<h1>Таблицы</h1>
<h3>Таблица категорий</h3>
<table>
    <tr>
        <th>id</th>
        <th>Название категории</th>
    </tr>

    <?
    include "Utils.php";
    $db = Utils::getPDO();
    foreach ($db->query("SELECT id, name FROM category;") as $row) {
        echo "<tr>
            <th>{$row['id']}</th>
            <th>{$row['name']}</th>
            </tr>";
    }
    ?>
</table>

<div class="operations">
    <!--    create    -->
    <form action="handler.php" class="operation" method="post">
        <input type="hidden" name="query" value="INSERT INTO category(name) VALUES (:category_name);">
        <input type="hidden" name="back" value="category_table.php">
        <span>
            Добавить категорию
            <input type="text" name="category_name" required>
            ?
            <input type="submit" value="Да">
        </span>
    </form>
    <!--    update    -->
    <form action="handler.php" class="operation" method="post">
        <input type="hidden" name="query"
               value="UPDATE category SET name=:new_category_name WHERE id=:id_category_selector;">
        <input type="hidden" name="back" value="category_table.php">
        <span>
            Поменять название категории с
            <select name="id_category_selector" required>
                <?
                foreach ($db->query("SELECT id, name FROM category;") as $row) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
            на
            <input type="text" name="new_category_name" required>
            ?
            <input type="submit" value="Да">
        </span>
    </form>
    <!--    delete    -->
    <form action="handler.php" class="operation" method="post">
        <input type="hidden" name="query" value="DELETE FROM category WHERE id=:id_category_selector">
        <input type="hidden" name="back" value="category_table.php">
        <span>
            Удалить категорию
            <select name="id_category_selector" required>
                <?
                foreach ($db->query("SELECT id, name FROM category;") as $row) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
             ?
            <input type="submit" value="Да">
        </span>
    </form>

</div>
<?
include "./html/bottom.html";
?>
