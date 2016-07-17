<?php
function renameFolder()
{
    if (isset($_POST['foldername'], $_POST['folderOld'])) {
        $foldername = iconv('utf-8','windows-1251',$_POST['foldername']);
        if (file_exists($_POST['way'] . '/' . $foldername)) {
            echo "Имя занято!!!";
        } else {
            rename(iconv('utf-8','windows-1251',$_POST['folderOld']), $_POST['way'] . $foldername);
            header("location: {$_POST['ref']}");
        }
    }
}

renameFolder(); ?>
<form action="" method="post">
    <input type="text" name="foldername" placeholder="Новое имя папки" value="<?= $_POST['folder'] ?>">
    <input type="hidden" name="folderOld" value="<?= $_POST['folder'] ?>">
    <input type="hidden" name="ref" value="<?=$_SERVER['HTTP_REFERER']?>">
    <input type="submit" value="Подтвердить">
</form>
