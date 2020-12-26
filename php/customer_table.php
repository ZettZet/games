<?
include 'Utils.php';
echo Utils::renderHeader("./html/top.html", "Таблица покупателей")
?>
    <table>
        <tr>
            <th>id</th>
            <th>email</th>
            <th>Пароль</th>
        </tr>

        <?
        $db = Utils::getPDO();

        foreach ($db->query("SELECT id, email, pass FROM customers;") as $row) {
            echo "<tr>
            <th>{$row['id']}</th>
            <th>{$row['email']}</th>
            <th>{$row['pass']}</th>
            </tr>";
        }
        ?>
    </table>


    <div class="operations">
        <!--    create    -->
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query" value="INSERT INTO customers(email, pass) VALUES (:email, :pass);">
            <input type="hidden" name="back" value="customer_table.php">
            <span>
            Зарегестрировать покупателея по почте
            <lable><input type="email" pattern="^[a-zA-Z0-9.!#$%&’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" name="email" required></lable>
            c паролем
            <input type="password" id="pass" name="pass" onchange="validate()" required>
                =
            <input type="password" id="confirm_pass" onchange="validate()" required>
            ?
            <input type="submit" id="signup" value="Да">
        </span>
        </form>
        <!--    update email   -->
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query"
                   value="UPDATE customers SET email=:new_email WHERE id=:id_customer_selector;">
            <input type="hidden" name="back" value="customer_table.php">
            <span>
            Изменить у покупателя email с
                <?
                echo Utils::renderQueryToSelect("id_customer_selector", "email", "customers");
                ?>
            на
            <input type="email" pattern="^[a-zA-Z0-9.!#$%&’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" name="new_email" required>
            ?
            <input type="submit" value="Да">
        </span>
        </form>

        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query"
                   value="UPDATE customers SET pass=:new_pass WHERE id=:id_customer_selector;">
            <input type="hidden" name="back" value="customer_table.php">
            <span>
            Изменить у покупателя с email
                <?
                echo Utils::renderQueryToSelect("id_customer_selector", "email", "customers");
                ?>
                пароль на
                <input type="password" id="pass" name="new_pass" onchange="validate()" required>
                =
                <input type="password" id="confirm_pass" onchange="validate()" required>
            ?
            <input type="submit" id="signup" value="Да">
        </span>
        </form>
        <!--    delete    -->
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query" value="DELETE FROM customers WHERE id=:id_customer_selector">
            <input type="hidden" name="back" value="customer_table.php">
            <span>
            Удалить покупателя по email
                <?
                echo Utils::renderQueryToSelect("id_customer_selector", "email", "customers");
                ?>
             ?
            <input type="submit" value="Да">
        </span>
        </form>

    </div>

<?
include "./html/bottom.html";
?>