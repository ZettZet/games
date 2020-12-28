<?
include "./html/top.html";
include "Utils.php";
?>
<h1>Запросы</h1>

<button class="accordion">Игры по цене</button>
<div class="panel">
    <div class="query">
        <pre><code class="sql bigger_font_size">SELECT * FROM games WHERE price BETWEEN ? AND ?;</code></pre>
        <p class="description">Вывести всю информацию по играм, чья цена находится в пределе
        <form action="queries.php" method="post" class="operation">
            <input type="hidden" name="query" value="SELECT * FROM games WHERE price BETWEEN :from AND :to;">
            <div class="statements">
                от
                <input type="number" name="from" min="0" required>
                до
                <input type="number" name="to" min="0" required>

                <input type="submit" value="Выполнить">
            </div>
        </form>
    </div>
</div>

<button class="accordion">Люди по игре</button>
<div class="panel">
    <div class="query">
        <pre><code class="sql bigger_font_size">SELECT * FROM customers JOIN carts c on customers.id = c.customer_id WHERE c.game_id = ?;</code></pre>
        <p class="description">Вывести всю информацию по людям, купившим игру
        <form action="queries.php" method="post" class="operation">
            <input type="hidden" name="query"
                   value="SELECT * FROM customers JOIN carts c on customers.id = c.customer_id WHERE c.game_id = :game_id;">
            <div class="statements">
                <?
                echo Utils::renderQueryToSelect("game_id", "title", "games");
                ?>
                <input type="submit" value="Выполнить">
            </div>
        </form>
    </div>
</div>

<button class="accordion">Игры по жанру</button>
<div class="panel">
    <div class="query">
        <pre><code class="sql bigger_font_size">SELECT * FROM games JOIN game_category gc ON games.id = gc.game_id WHERE category_id = ?;</code></pre>
        <p class="description">Вывести всю информацию по играм с жанром
        <form action="queries.php" method="post" class="operation">
            <input type="hidden" name="query"
                   value="SELECT * FROM games JOIN game_category gc ON games.id = gc.game_id WHERE category_id = :category_id;">
            <div class="statements">
                <?
                echo Utils::renderQueryToSelect("category_id", "name", "category");
                ?>
                <input type="submit" value="Выполнить">
            </div>
        </form>
    </div>
</div>

<button class="accordion">Скидки по датам</button>
<div class="panel">
    <div class="query">
        <pre><code class="sql bigger_font_size">SELECT * FROM discount WHERE ends BETWEEN ? AND ?;</code></pre>
        <p class="description">Вывести всю информацию по скидкам, действоваши
        <form action="queries.php" method="post" class="operation">
            <input type="hidden" name="query"
                   value="SELECT * FROM discount WHERE ends BETWEEN :from AND :to;">
            <div class="statements">
                с
                <input type="date" name="from">
                по
                <input type="date" name="to">
                <input type="submit" value="Выполнить">
            </div>
        </form>
    </div>
</div>

<button class="accordion">Сумма всех продаж</button>
<div class="panel">
    <div class="query">
        <pre><code class="sql bigger_font_size">SELECT SUM(game_price) FROM carts WHERE status='payed';</code></pre>
        <p class="description">Вывести сумму всех продаж
        <form action="queries.php" method="post" class="operation">
            <input type="hidden" name="query"
                   value="SELECT SUM(game_price) FROM carts WHERE status='payed';">
            <div class="statements">
                <input type="submit" value="Выполнить">
            </div>
        </form>
    </div>
</div>

<button class="accordion">Игра в корзине</button>
<div class="panel">
    <div class="query">
        <pre><code class="sql bigger_font_size">SELECT COUNT(*) FROM carts WHERE status='taken' AND game_id = ?;</code></pre>
        <p class="description">Посчитать количество добавлений в корзину игры
        <form action="queries.php" method="post" class="operation">
            <input type="hidden" name="query"
                   value="SELECT COUNT(*) FROM carts WHERE status='taken' AND game_id = :game_id;">
            <div class="statements">
                <?
                echo Utils::renderQueryToSelect("game_id", "title", "games");
                ?>
                <input type="submit" value="Выполнить">
            </div>
        </form>
    </div>
</div>

<button class="accordion">Цена корзины человека</button>
<div class="panel">
    <div class="query">
        <pre><code class="sql bigger_font_size">SELECT SUM(game_price) FROM carts WHERE customer_id = ? AND status = 'taken';</code></pre>
        <p class="description">Посчитать сумму корзины человека
        <form action="queries.php" method="post" class="operation">
            <input type="hidden" name="query"
                   value="SELECT SUM(game_price) FROM carts WHERE customer_id = :customer_id AND status = 'taken';">
            <div class="statements">
                <?
                echo Utils::renderQueryToSelect("customer_id", "email", "customers");
                ?>
                <input type="submit" value="Выполнить">
            </div>
        </form>
    </div>
</div>

<button class="accordion">Сколько человек потратил на игры</button>
<div class="panel">
    <div class="query">
        <pre><code class="sql bigger_font_size">SELECT SUM(game_price) FROM carts JOIN games g ON g.id = carts.game_id WHERE customer_id = ? AND status='payed';</code></pre>
        <p class="description">Посчитать сумму всех средств человека
        <form action="queries.php" method="post" class="operation">
            <input type="hidden" name="query"
                   value="SELECT SUM(game_price) FROM carts JOIN games g ON g.id = carts.game_id WHERE customer_id=:customer_id AND status='payed';">
            <div class="statements">
                <?
                echo Utils::renderQueryToSelect("customer_id", "email", "customers");
                ?>
                <input type="submit" value="Выполнить">
            </div>
        </form>
    </div>
</div>

<button class="accordion">Топ-N покупателей</button>
<div class="panel">
    <div class="query">
        <pre><code class="sql bigger_font_size">SELECT email, SUM(game_price) AS total FROM customers JOIN carts c on customers.id = c.customer_id GROUP BY email ORDER BY total DESC LIMIT ?;</code></pre>
        <p class="description">Вывести топ-N покупателей (потративших больше всего)
        <form action="queries.php" method="post" class="operation">
            <input type="hidden" name="query"
                   value="SELECT email, SUM(game_price) AS total FROM customers JOIN carts c on customers.id = c.customer_id GROUP BY email ORDER BY total DESC LIMIT :limit;">
            <div class="statements">
                <input type="number" min="1" name="limit">
                <input type="submit" value="Выполнить">
            </div>
        </form>
    </div>
</div>

<button class="accordion">Игры по продажам</button>
<div class="panel">
    <div class="query">
        <pre><code class="sql bigger_font_size">SELECT g.title, COUNT(*) AS sells FROM carts JOIN games g ON g.id = carts.game_id WHERE status='payed' GROUP BY game_id ORDER BY sells DESC;</code></pre>
        <p class="description">Вывести самые продаваемые игры
        <form action="queries.php" method="post" class="operation">
            <input type="hidden" name="query"
                   value="select g.title, count(*) as sells from carts join games g on g.id = carts.game_id where status='payed' group by game_id order by sells desc;">
            <div class="statements">
                <input type="submit" value="Выполнить">
            </div>
        </form>
    </div>
</div>

<div class="result">
<?
if (!empty($_POST)) {
    echo Utils::renderSelectQueryToTable($_POST);
}
?>
</div>

<?
include "./html/bottom.html"
?>

