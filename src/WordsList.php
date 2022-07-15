<?php

namespace VasArt\NaughtyWords;

class WordsList
{
    /**
     * @var string[]
     */
    private $words;

    /**
     * @param string[] $words
     */
    public function __construct(array $words)
    {
        // Remove empty strings and falsy values, just in case
        $words = array_filter($words);

        $this->words = $words;
    }

    /**
     * Get the list of naughty words as an array.
     *
     * @return string[]
     */
    public function getAll(): array
    {
        return $this->words;
    }

    /**
     * Add an arbitrary word to the words list.
     *
     * @param string $word
     * @return void
     */
    public function add(string $word)
    {
        $this->words[] = $word;
    }

    /**
     * Get the list of naughty words as a PCRE regex.
     *
     * @return string
     */
    public function getAsRegex(): string
    {
        $words = $this->words;

        // Cyrillic characters borrowed from:
        // https://stackoverflow.com/a/52257128/12320578
        $wordChars = '[a-zA-ZЁёА-я]';
        $wordBoundary = "(?:(?<!$wordChars)(?=$wordChars)|(?<=$wordChars)(?!$wordChars))";

        return sprintf(
            "/$wordBoundary(?<word>(?:%s)+)$wordBoundary/",
            implode('|', $words)
        );
    }
}