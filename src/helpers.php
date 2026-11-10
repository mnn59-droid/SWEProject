<?php

function e($value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function money($amount): string
{
    return '$' . number_format($amount, 2);
}

?>