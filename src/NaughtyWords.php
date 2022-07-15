<?php

namespace VasArt\NaughtyWords;

class NaughtyWords
{
    public static function getForLanguage(string $language)
    {
        return file(
            dirname(__DIR__) . DIRECTORY_SEPARATOR . "{$language}",
            FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
        );
    }
}
