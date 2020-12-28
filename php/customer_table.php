<?
include 'Utils.php';
echo Utils::renderHeader("./html/top.html", "Таблица покупателей")
?>
    <table id="table">
        <tr>
            <th>id</th>
            <th>email</th>
            <th>Пароль</th>
        </tr>

        <?
        $db = Utils::getPDO();

        foreach ($db->query("SELECT id, email, pass FROM customers;") as $row) {
            echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['email']}</td>
            <td>{$row['pass']}</td>
            </tr>";
        }
        ?>
    </table>


    <div class="operations">
        <form action="handler.php" class="operation" method="post">
            <input type="hidden" name="query" value="INSERT INTO customers(email, pass) VALUES (:email, :pass);">
            <input type="hidden" name="back" value="customer_table.php">
            <span>
            Зарегестрировать покупателея по почте
            <lable><input type="email" placeholder="email" pattern="^[a-zA-Z0-9.!#$%&’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" name="email" required></lable>
            c паролем
            <input type="password" placeholder="пароль" id="pass" name="pass" onchange="validate()" required>
                =
            <input type="password" placeholder="повторите пароль" id="confirm_pass" onchange="validate()" required>
            ?
            <input type="submit" id="signup" value="Да">
        </span>
        </form>
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
            <input type="email" placeholder="email" pattern="^[a-zA-Z0-9.!#$%&’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" id="email" name="new_email" required>
            и
                                пароль на
                <input type="password" placeholder="пароль" id="pass" name="new_pass" onchange="validate()" required>
                =
                <input type="password" placeholder="повторите пароль" id="confirm_pass" onchange="validate()" required>
                ?
            <input type="submit" value="Да">
        </span>
        </form>
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


    <script>
        function update(id) {
            return update_values(`http://${host}/api/get_customer.php?id=${id}`);
        }
    </script>

<?
include "./html/bottom.html";
?>