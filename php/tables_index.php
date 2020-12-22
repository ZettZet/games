<?
ob_start();
include "./html/top.html";
$buffer = ob_get_contents();
ob_get_clean();

$title = "Выбор таблицы";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
echo $buffer;
?>
<h1>Таблицы</h1>
<h2>Выберите таблицу для работы</h2>
<a href="category_table.php" class="table__selector">категории</a>
<a href="customer_table.php" class="table__selector">покупатели</a>
<a href="discount_table.php" class="table__selector">скидки</a>
<a href="game_category_table.php" class="table__selector">игровые категории</a>
<a href="game_table.php" class="table__selector">игры</a>
<a href="carts_table.php" class="table__selector">покупки</a>
<?
include "./html/bottom.html"
?>
