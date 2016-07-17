<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<table>
    <tr>
        <td>Имя Файла</td>
        <td>Размер</td>
    </tr>
    <?php
    include 'size.php';
    if (isset($_GET['action']) && $_GET['action'] == 'openFolder' && isset($_GET['folder'])) {
        $way = $_GET['folder'] . '/';
    } else {
        $way = "/";
    }
    foreach (scandir($way) as $val) {
        $valShow = iconv("windows-1251", "utf-8", $val);
        $wayShow = iconv("windows-1251", "utf-8", $way);
        echo "<tr>";
        if (is_dir($way . $val)) {
            echo "<td><a href='?action=openFolder&folder=" . urlencode($way . $val) . "'>$valShow</a></td>";
        } else {
            echo "<td>$valShow</td>";
        }
        echo "<td>";
        size($way, $val);
        echo "</td>";
        if (!is_file($way . $val)) {
            echo "<td><form action='renamefolder.php' method='post'><input type='submit' value='Переименовать папку'>
                <input type='hidden' name='folder' value='{$wayShow}{$valShow}'><input type='hidden' name='way' value='{$wayShow}'></form></td>";
        }
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>
