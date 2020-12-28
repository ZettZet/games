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
            <td>{$row['id']}</td>
            <td>{$row['percent']}</td>
            <td>{$row['starts']}</td>
            <td>{$row['ends']}</td>
            </tr>";
        }
        ?>
    </table>

    <div class="operations">
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query"
                   value="INSERT INTO discount(percent, starts, ends) VALUES (:new_percent, :new_starts, :new_ends);">
            <input type="hidden" name="back" value="discount_table.php">
            <span>
            Объявить скидку на
            <input type="number" max="100" min="0" name="new_percent" required>%
            c
            <input type="date" id="new_starts" name="starts" onchange="validate_date()" required>
                по
            <input type="date" id="new_ends" name="ends" onchange="validate_date()" required>
            ?
            <input type="submit" id="create" value="Да">
        </span>
        </form>
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query"
                   value="UPDATE discount SET percent=:percent, starts=:starts, ends=:ends WHERE id=:id_discount_selector;">
            <input type="hidden" name="back" value="discount_table.php">
            <span>
            Изменить у скидки с id равным
                                <?
                                echo Utils::renderQueryToSelect("id_discount_selector", "id", "discount");
                                ?>
            размер скидки на
            <input type="number" id="percent" max="100" min="0" name="percent" required>
                дату начала на
            <input type="date" id="starts" name="new_starts" onchange="validate_date()" required>
                и дату конца на
            <input type="date" id="ends" name="new_ends" onchange="validate_date()" required>
            ?
            <input type="submit" value="Да">
        </span>

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
    <script>
    function update(id) {
    let sm = update_values(`${location.protocol}//${host}/api/get_discount.php?id=${id}`);
    console.log(sm);
    return sm;
    }
    </script>
<?
include "./html/bottom.html";
?>