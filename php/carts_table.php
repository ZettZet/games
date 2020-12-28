<?
include "Utils.php";
echo Utils::renderHeader("./html/top.html", "Таблица покупок")
?>
<table>
    <tr>
        <th>id игры</th>
        <th class="foreign_items">Название игры</th>
        <th class="foreign_items">Категории игры</th>
        <th class="foreign_items">email покупателя</th>
        <th>Статус</th>
        <th class="foreign_items">Размер скидки</th>
        <th class="foreign_items">Стоимость без скидки</th>
        <th>Стоимость с учетом скидки</th>
    </tr>

    <?
    $replacer = ['taken' => 'В корзине', 'payed' => 'Оплачено'];
    $db = Utils::getPDO();
    foreach ($db->query("SELECT g.id as id, g.title as title, g.price as price, group_concat(c.name) as name, status, game_price, c2.email as email, d.percent as percent FROM carts AS crt JOIN games g ON g.id = crt.game_id JOIN game_category gc ON g.id = gc.game_id JOIN category c ON c.id = gc.category_id JOIN customers c2 ON c2.id = crt.customer_id LEFT JOIN discount d ON d.id = crt.discount_id group by email, status, price, id, title, percent, game_price;") as $row) {
        $percent = $row['percent'] ?? 0;
        echo "<tr>
            <th>{$row['id']}</th>
            <th class='foreign_items'>{$row['title']}</th>
            <th class='foreign_items'>{$row['name']}</th>
            <th class='foreign_items'>{$row['email']}</th>
            <th>{$replacer[$row['status']]}</th>
            <th class='foreign_items'>{$percent}%</th>
            <th class='foreign_items'>{$row['price']}</th>
            <th>{$row['game_price']}</th>
            </tr>";
    }
    ?>
</table>

<div class="operations">
    <!--    create    -->
    <form action="special_handler.php" class="operation" method="post">
        <input type="hidden" name="query"
               value="INSERT INTO carts(game_id, customer_id, game_price) VALUES (?, ?, (SELECT price FROM games WHERE id=?));">
        <input type="hidden" name="back" value="carts_table.php">
        <span>
            Хотите добавить в корзину игру
            <?
            echo Utils::renderQueryToSelect("game_id", "title", "games");
            ?>
            покупателю с email

            <?
            echo Utils::renderQueryToSelect("customer_id", "email", "customers");
            ?>
            ?
            <input type="submit" value="Да">
        </span>
    </form>
    <!--    update    -->
    <form action="handler.php" class="operation" method="post">
        <input type="hidden" name="query"
               value="update carts as dst, (select g.price * (1 - if(d.percent is null, 0, d.percent / 100)) as discounted_price, carts.id, d.id as disc_id
                      from carts
                               join games g on g.id = carts.game_id
                               join customers c on c.id = carts.customer_id
                               left outer join discount d on curdate() between d.starts and d.ends
                      where customer_id = :customer_id
                        and carts.status = 'taken') as src
set status='payed',
    game_price=src.discounted_price,
    discount_id=src.disc_id
where dst.id = src.id;">
        <input type="hidden" name="back" value="carts_table.php">
        <span>
            Купить игры покупателя с email
            <?
            echo Utils::renderQueryToSelect("customer_id", "email", "customers");
            ?>
            ?
            <?
            $todays_discount = $db->prepare("SELECT percent FROM discount WHERE CURDATE() BETWEEN starts  AND ends;");
            $todays_discount->execute();
            $row = $todays_discount->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                echo "На корзину подействует скидка {$row['percent']}%";
            } else {
                echo "Скидок на сегодня нет.";
            }
            ?>
            <input type="submit" value="Да">
        </span>
    </form>

    <form action="handler.php" class="operation" method="post">
        <input type="hidden" name="query"
               value="DELETE FROM carts WHERE game_id=:game_id AND customer_id=:customer_id AND status!='payed';">
        <input type="hidden" name="back" value="carts_table.php">
        <span>
            Хотите удалить из корзины
            <?
            echo Utils::renderQueryToSelect("customer_id", "email", "customers");
            ?>

            игру
            <?
            echo Utils::renderQueryToSelect("game_id", "title", "games");
            ?>
            ?
            <input type="submit" value="Да">
        </span>
    </form>
</div>

<?
include "./html/bottom.html";
?>