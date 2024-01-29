<?php

namespace RezaFikkri\PHPLoginManagement\Core;

class View
{
    public static function render(string $view, array|object $model): void
    {
        extract($model);

        require __DIR__ . '/../View/header.php';
        require __DIR__ . '/../View/' . $view . '.php';
        require __DIR__ . '/../View/footer.php';
    }
}
