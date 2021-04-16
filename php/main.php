<?php session_start();
class MyDB
{
    // подключение к БД
    function connect() { 
        // различные значения
        $host = 'localhost';
        $db   = 'Task5b';
        $user = 'user'; // у этого юзера есть привилегии, только на SELECT и INSERT
        $pass = 'k2kp4Xq8JM5vDL5';
        $charset = 'utf8';
        
        // настройки для подключения
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset"; 
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        // объявляю переменные глобальными, чтобы использовать их в других функциях
        global $pdo;
        $pdo = new PDO($dsn, $user, $pass, $opt); // подключение к БД

        // подготовка запроса
        global $stmtPrepared; 
        $stmtPrepared = $pdo->prepare("INSERT INTO `countries` (`ID`, `Country_name`) VALUES (NULL, :value)");
    }

    // вывод таблицы
    function printTable($pdo) {
        $stmt = $pdo->query('SELECT * FROM Countries'); // выполняем запрос, записываем в $stmt

        // выводим результат на сайт по строкам
        while ($row = $stmt->fetch()) {
            echo '<tr><td class="ID">'.$row['ID'].'</td><td class="country">'.$row['Country_name'].'<td></tr>';
        }
    }

    // вставка в БД
    function insertInDB($pdo, $stmtPrepared, $country) {
        $stmtPrepared->execute(array(':value' => $country)); // исполнение подготовленного запроса
    }
}


$db = new MyDB();
$db->connect();
$db->printTable($pdo);

// отправка формы
if (isset($_POST['country'])) {
    // обрабатываем и присваиваем к переменной 
    $country = htmlspecialchars($_POST['country']); 

    // встака в таблицу
    $db->insertInDB($pdo, $stmtPrepared, $country);

    // переход на страницу, чтобы избежать повторной отправки формы
    header("Location: index.html");
    exit;
}
?>