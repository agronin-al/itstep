<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div>
    <form action="" method="post" id="form">
        <?php
        set_time_limit(0);
        $response = curl_get("http://catalog.onliner.by/");
        preg_match_all("|catalog-navigation-list__link-inner\">.*?<a href=\"(.*?)\" title=\"(.*?)\">|ms", $response, $out, PREG_SET_ORDER);

        $cats = [];
        foreach ($out as $item) {
            $cats[$item[2]] = $item[1];
        }
        ksort($cats);

        echo "<select name='cat' onchange='document.getElementById(\"form\").submit()'>\n";
        foreach ($cats as $name => $url) {
            $sel = '';
            if (isset($_POST['cat']) && $url == $_POST['cat'])
                $sel = 'selected';
            echo "<option value='{$url}' {$sel}>{$name}</option>\n";
        }
        echo "</select>\n";
        ?>
    </form>
</div>
<?php
function curl_get($url)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    $buffer = curl_exec($curl);
    curl_close($curl);
    return $buffer;
}

if (isset($_POST['cat'])) {
    $cat = str_replace('http://catalog.onliner.by/', '', $_POST['cat']);
    $items = [];
    $page_next = 1;
    while ($page_next) {
        $url_add = '';
        if (isset($page_current))
            $url_add = "?page={$page_next}";
        $response = curl_get("https://catalog.api.onliner.by/search/{$cat}{$url_add}");
        $json = json_decode($response);
        //print_r($json->page);
        $page_current = $json->page->current;
        $page_last = $json->page->last;
        if ($page_last > $page_current)
            $page_next = $page_current + 1;
        elseif ($page_last == $page_current)
            $page_next = false;

        if (isset($json->products)) foreach ($json->products as $product) {
            $items[] = [
                'name' => $product->full_name,
                'url' => $product->html_url,
                'img' => $product->images->icon,
                'price' => $product->prices->price_max->amount
            ];
        }
    }

    echo "<table>
        <tr>
            <th>Картинка</th>
            <th>Продукт</th>
            <th>Цена</th>
</tr>";
    foreach ($items as $item) {
        echo "<tr>
                <td><img src=\"{$item['img']}\"></td>
                <td><a href='{$item['url']}' target='_blank'>{$item['name']}</a></td>";
        if ($item['price'] > 0) {
            list($rub, $coin) = explode(".", $item['price']);
            echo "<td>от {$rub}<sup>{$coin}</sup></td>";
        } else
            echo "<td>нет</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
</body>
</html>