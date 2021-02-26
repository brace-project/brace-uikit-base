<?php
namespace Brace\UiKit\Base;

function el($element, array $params = []) : void
{
    echo fhtml($element, $params)->render();
}

function txt($unescaped)
{
    echo htmlspecialchars($unescaped);
}