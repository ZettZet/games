<?
ob_start();
include "./html/top.html";
$buffer = ob_get_contents();
ob_get_clean();

$title = "Главная";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
echo $buffer;
?>

    <h1>Добро пожаловать</h1>
<div class="index description">
    <p>Онлайн магазин компьютерных игр. Продажа только зарегистрированным пользователям. Для регистрации достаточно почты, пароля. На каждого пользователя приходится свой список игр, которые он хотел бы купить. На один аккаунт может быть привязан только уникальный набор игр. У каждой игры может быть несколько категорий.
    <p>Возможна система скидок. По датам они не накладываются друг на друга и применяются в момент совершения оплты для всей корзины. Для большей отчетности, требуется хранить все оплаты по тем ценам, по которым они были совершены.
</div>
<?
include "./html/bottom.html"
?>