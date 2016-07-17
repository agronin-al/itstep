<?php
function size($way, $val)
{
    if (is_file($way . $val)) {
        echo filesize($way . $val) . ' B';
    }
}