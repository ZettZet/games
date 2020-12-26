<?
ob_start();
include "./html/top.html";
$buffer = ob_get_contents();
ob_get_clean();

$title = "Таблица";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
echo $buffer;
?>
<h1>Таблицы</h1>
<?
if (!empty($_POST)) {

    include "Utils.php";
    $db = Utils::getPDO();

    $back = $_POST['back'];
    unset($_POST['back']);

    $check_query = $db->prepare("SELECT COUNT(*) as unique_count FROM carts WHERE customer_id=? AND game_id=?;");
    $check_query->execute([$_POST['customer_id'], $_POST['game_id']]);
    $is_unique = $check_query->fetchAll()[0];

    if(!empty($is_unique) and $is_unique['unique_count']==1){
        echo "<h1>У этого покупателя уже есть эта игра</h1>";
    }
    else {
        $query = $db->prepare($_POST['query']);
        unset($_POST['query']);
        $result = $query->execute([$_POST['game_id'], $_POST['customer_id'], $_POST['game_id']]);

        if ($result) {
            echo "<h1>Успешно</h1>";
        } else {
            echo "<h1>Ошибка</h1>";
        }
    }
    echo "<a class='back_button' href='{$back}'>Назад</a>";
} else {
    echo "<h1>Ошибка</h1>";
}
?>
<?
include "./html/bottom.html";
?>
