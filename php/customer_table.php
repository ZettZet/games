<?
ob_start();
include "./html/top.html";
$buffer = ob_get_contents();
ob_get_clean();

$title = "Таблица покупателей";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
echo $buffer;
?>
    <h1>Таблицы</h1>
    <h3>Таблица покупателей</h3>
    <table>
        <tr>
            <th>id</th>
            <th>email</th>
            <th>Пароль</th>
        </tr>

        <?
        include "Utils.php";
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
            <select name="id_customer_selector" required>
                <?
        
                foreach ($db->query("SELECT id, email FROM customers;") as $row) {
                    echo "<option value='{$row['id']}'>{$row['email']}</option>";
                }
                ?>
            </select>
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
            <select name="id_customer_selector" required>
                <?
        
                foreach ($db->query("SELECT id, email FROM customers;") as $row) {
                    echo "<option value='{$row['id']}'>{$row['email']}</option>";
                }
                ?>
            </select>
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
            Удалить покупателя с id равным
            <select name="id_customer_selector" required>
                <?
        
                foreach ($db->query("SELECT id FROM customers;") as $row) {
                    echo "<option value='{$row['id']}'>{$row['id']}</option>";
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