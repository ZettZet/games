<?
ob_start();
include "./html/top.html";
$buffer = ob_get_contents();
ob_get_clean();

$title = "Таблица игр";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
echo $buffer;
?>
    <h1>Таблицы</h1>
    <h3>Таблица игр</h3>

    <table>
        <tr>
            <th class="foreign_items">id игры</th>
            <th class="foreign_items">Название игры</th>
            <th class="foreign_items">Описание</th>
            <th class="foreign_items">Цена</th>
        </tr>
        <?
        include "Utils.php";
        $db = Utils::getPDO();

        foreach ($db->query("SELECT id, title, description, price FROM games;") as $row) {
            echo "<tr>
            <th>{$row['id']}</th>
            <th>{$row['title']}</th>
            <th>{$row['description']}</th>
            <th>{$row['price']}</th>
            </tr>";
        }
        ?>
    </table>

    <div class="operations">
        <!--    create    -->
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query"
                   value="INSERT INTO games(title, description, price) VALUES (:title, :description, :price);">
            <input type="hidden" name="back" value="game_table.php">
            <span>
            Добавить игру
            <input type="text" name="title" required>
            с описанием
                <textarea class="text__area" name="description" cols="30" rows="3" required></textarea>
                по цене
            <input type="number" min="0" name="price" required>
            ?
            <input type="submit" value="Да">
        </span>
        </form>

        <!--    update   -->
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query" value="UPDATE games SET title=:new_title WHERE id=:id_game_selector;">
            <input type="hidden" name="back" value="discount_table.php">
            <span>
            Изменить у игры
            <select name="id_game_selector" required>
                <?
        
                foreach ($db->query("SELECT id, title FROM games;") as $row) {
                    echo "<option value='{$row['id']}'>{$row['title']}</option>";
                }
                ?>
            </select>
            название на
            <input type="text" name="new_title" required>
            ?
            <input type="submit" value="Да">
        </span>
        </form>

        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query"
                   value="UPDATE games SET description=:new_description WHERE id=:id_game_selector;">
            <input type="hidden" name="back" value="game_table.php">
            <span>
            Изменить описание игры
            <select name="id_game_selector" required>
                <?
        
                foreach ($db->query("SELECT id, title FROM games;") as $row) {
                    echo "<option value='{$row['id']}'>{$row['title']}</option>";
                }
                ?>
            </select>
                на
                <textarea class="text__area" name="new_description" cols="30" rows="3" required></textarea>
            ?
            <input type="submit" value="Да">
        </span>
        </form>

        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query" value="UPDATE games SET price=:new_price WHERE id=:id_game_selector;">
            <input type="hidden" name="back" value="game_table.php">
            <span>
            Изменить у игры
            <select name="id_game_selector" required>
                <?
        
                foreach ($db->query("SELECT id, title FROM games;") as $row) {
                    echo "<option value='{$row['id']}'>{$row['title']}</option>";
                }
                ?>
            </select>
                цену на
                <input type="number" min="0" name="new_description" required>
            ?
            <input type="submit" value="Да">
        </span>
        </form>

        <!--    delete    -->
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query" value="DELETE FROM games WHERE id=:id_game_selector">
            <input type="hidden" name="back" value="discount_table.php">
            <span>
            Удалить игру
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