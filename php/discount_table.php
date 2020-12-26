<?
include 'Utils.php';
echo Utils::renderHeader("./html/top.html", "Таблица скидок")
?>
    <table>
        <tr>
            <th>id</th>
            <th>Процент</th>
            <th>Дата начала</th>
            <th>Дата окончания</th>
        </tr>

        <?
        $db = Utils::getPDO();

        foreach ($db->query("SELECT id, percent, starts, ends FROM discount;") as $row) {
            echo "<tr>
            <th>{$row['id']}</th>
            <th>{$row['percent']}</th>
            <th>{$row['starts']}</th>
            <th>{$row['ends']}</th>
            </tr>";
        }
        ?>
    </table>

    <div class="operations">
        <!--    create    -->
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query"
                   value="INSERT INTO discount(percent, starts, ends) VALUES (:percent, :starts, :ends);">
            <input type="hidden" name="back" value="discount_table.php">
            <span>
            Объявить скидку на
            <input type="number" max="100" min="0" name="percent" required>%
            c
            <input type="date" id="starts" name="starts" onchange="validate_date()" required>
                по
            <input type="date" id="ends" name="ends" onchange="validate_date()" required>
            ?
            <input type="submit" id="create" value="Да">
        </span>
        </form>
        <!--    update percent   -->
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query"
                   value="UPDATE discount SET percent=:new_percent WHERE id=:id_discount_selector;">
            <input type="hidden" name="back" value="discount_table.php">
            <span>
            Изменить у скидки с id равным
                                <?
                                echo Utils::renderQueryToSelect("id_discount_selector", "id", "discount");
                                ?>
            размер скидки на
            <input type="number" max="100" min="0" name="new_percent" required>
            ?
            <input type="submit" value="Да">
        </span>
        </form>
        <!-- update dates-->
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query"
                   value="UPDATE discount SET starts=:new_starts, ends=:new_ends WHERE id=:id_discount_selector;">
            <input type="hidden" name="back" value="discount_table.php">
            <span>
            Изменить у скидки с id равным
                <?
                echo Utils::renderQueryToSelect("id_discount_selector", "id", "discount");
                ?>
                дату начала на
            <input type="date" id="starts" name="new_starts" onchange="validate_date()" required>
                и дату конца на
            <input type="date" id="ends" name="new_ends" onchange="validate_date()" required>
            ?
            <input type="submit" id="create" value="Да">
        </span>
        </form>
        <!--    delete    -->
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query" value="DELETE FROM discount WHERE id=:id_discount_selector">
            <input type="hidden" name="back" value="discount_table.php">
            <span>
            Удалить скидку с id равным
                <?
                echo Utils::renderQueryToSelect("id_discount_selector", "id", "discount");
                ?>
             ?
            <input type="submit" value="Да">
        </span>
        </form>

    </div>


<?
include "./html/bottom.html";
?>