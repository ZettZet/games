<?
ob_start();
include "./html/top.html";
$buffer = ob_get_contents();
ob_get_clean();

$title = "Таблица игровых категорий";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
echo $buffer;
?>
    <h1>Таблицы</h1>
    <h3>Таблица игровых категорий</h3>


    <table>
        <tr>
            <th>id игры</th>
            <th class="foreign_items">Название игры</th>
            <th>id категории</th>
            <th class="foreign_items">Название категории</th>
            <th class="foreign_items">Цена</th>
        </tr>
        <?
        include "Utils.php";
        $db = Utils::getPDO();

        foreach ($db->query("SELECT g.id as g_id, g.title as g_title, GROUP_CONCAT(c.id) as cat_id, GROUP_CONCAT(c.name) as cat_name, g.price as g_price FROM game_category JOIN category c ON c.id = game_category.category_id JOIN games g ON g.id = game_category.game_id GROUP BY g.title, g.id, g.price;") as $row) {
            echo "<tr>
            <th class='foreign_items'>{$row['g_id']}</th>
            <th class='foreign_items'>{$row['g_title']}</th>
            <th class='foreign_items'>{$row['cat_id']}</th>
            <th class='foreign_items'>{$row['cat_name']}</th>
            <th class='foreign_items'>{$row['g_price']}</th>
            </tr>";
        }
        ?>
    </table>
    <div class="operations">
        <!--    create    -->
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query"
                   value="INSERT INTO game_category(game_id, category_id) VALUES (:game_id, :category_id);">
            <input type="hidden" name="back" value="game_category_table.php">
            <span>
            Добавить категорию
                <select name="category_id" required>
                    <?
            
                    foreach ($db->query("SELECT id, name FROM category;") as $row) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
                игре
                <select name="game_id" required>
                    <?
            
                    foreach ($db->query("SELECT id, title FROM games;") as $row) {
                        echo "<option value='{$row['id']}'>{$row['title']}</option>";
                    }
                    ?>
                </select>
            ?
            <input type="submit" id="create" value="Да">
        </span>
        </form>
        <!--    delete    -->
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query"
                   value="DELETE FROM game_category WHERE game_id=:id_game_selector and category_id=:id_category_selector;">
            <input type="hidden" name="back" value="game_category_table.php">
            <span>
            Убрать категорию
            <select name="id_category_selector" required>
                <?
        
                foreach ($db->query("SELECT id, name FROM category;") as $row) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
                у игры
                <select name="id_game_selector" required>
                <?
        
                foreach ($db->query("SELECT id, title FROM games;") as $row) {
                    echo "<option value='{$row['id']}'>{$row['title']}</option>";
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