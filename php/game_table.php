<?
include 'Utils.php';
echo Utils::renderHeader("./html/top.html", "Таблица игр")
?>

    <table>
        <tr>
            <th>id игры</th>
            <th>Название игры</th>
            <th>Описание</th>
            <th>Цена</th>
        </tr>
        <?
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
                <?
                echo Utils::renderQueryToSelect("id_game_selector", "title", "games");
                ?>
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
                                <?
                                echo Utils::renderQueryToSelect("id_game_selector", "title", "games");
                                ?>
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
                <?
                echo Utils::renderQueryToSelect("id_game_selector", "title", "games");
                ?>
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