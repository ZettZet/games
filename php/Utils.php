<?php

use JetBrains\PhpStorm\Pure;

class Utils
{
    public static function renderSelectQueryToTable(array $data): string
    {
        $db = Utils::getPDO();
        $stmt = $db->prepare($data['query']);
        unset($data['query']);
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        return $result ? Utils::renderTable($result) : "Запрос вернул пустой результат";
    }

    public static function getPDO(): PDO
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        return new PDO('mysql:host=db;dbname=game_db', 'root', 'my_secret_pw', $options);
    }

    #[Pure] public static function renderTable(array $array): string
    {
        $html = '<table>';

        $html .= '<tr>';
        foreach ($array[0] as $key => $value) {
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
        $html .= '</tr>';

        foreach ($array as $key => $value) {
            $html .= '<tr>';
            foreach ($value as $key2 => $value2) {
                $html .= '<th>' . htmlspecialchars($value2) . '</th>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';
        return $html;
    }

    public static function renderHeader(string $path, string $nameOfTable): string
    {
        ob_start();
        include $path;
        $buffer = ob_get_contents();
        ob_get_clean();

        $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $nameOfTable . '$3', $buffer);
        $buffer .= '<a class="back__link" href="tables_index.php"><i class="left"></i>Таблицы</a><h3>'.$nameOfTable.'</h3>';
        return $buffer;
    }

    public static function renderQueryToSelect(string $selectName, string $additionalParam, string $nameOfTable): string {
        $db = self::getPDO();
        $select = "<select name='{$selectName}' onchange='update(this.value)' id='id' required>";

        foreach ($db->query("SELECT id, {$additionalParam} FROM {$nameOfTable};") as $row) {
            $select .= "<option value='{$row['id']}'>{$row[$additionalParam]}</option>";
        }

        $select .= "</select>";
        return $select;
    }
}