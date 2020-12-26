<?
include 'Utils.php';
echo Utils::renderHeader("./html/top.html", "Таблица игровых категорий")
?>


    <table>
        <tr>
            <th>id игры</th>
            <th class="foreign_items">Название игры</th>
            <th>id категории</th>
            <th class="foreign_items">Название категории</th>
            <th class="foreign_items">Цена</th>
        </tr>
        <?
        $db = Utils::getPDO();

        foreach ($db->query("SELECT g.id as g_id, g.title as g_title, GROUP_CONCAT(c.id) as cat_id, GROUP_CONCAT(c.name) as cat_name, g.price as g_price FROM game_category JOIN category c ON c.id = game_category.category_id JOIN games g ON g.id = game_category.game_id GROUP BY g.title, g.id, g.price;") as $row) {
            echo "<tr>
            <th>{$row['g_id']}</th>
            <th class='foreign_items'>{$row['g_title']}</th>
            <th>{$row['cat_id']}</th>
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
                <?
                echo Utils::renderQueryToSelect("category_id", "name", "category");
                ?>
                игре
                <?
                echo Utils::renderQueryToSelect("game_id", "title", "games");
                ?>
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
                <?
                echo Utils::renderQueryToSelect("id_category_selector", "name", "category");
                ?>
                у игры
                <?
                echo Utils::renderQueryToSelect("id_game_selector", "title", "games");
                ?>
             ?
            <input type="submit" value="Да">
        </span>
        </form>

    </div>
<?
include "./html/bottom.html";
?>