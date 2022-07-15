<?php

namespace VasArt\NaughtyWords;

class Validator
{
    /**
     * @var string[]
     */
    private $languages;

    /**
     * @var WordsList[]
     */
    private $wordsLists;

    public function __construct(array $languages)
    {
        $this->languages = $languages;

        foreach ($this->languages as $language) {
            $words = NaughtyWords::getForLanguage($language);

            if (!$words) {
                $words = [];
            }

            $wordsList = new WordsList($words);

            $this->wordsLists[$language] = $wordsList;
        }
    }

    public function hasNaughtyWords(string $text): bool
    {
        $matchResults = [];

        foreach ($this->wordsLists as $language => $wordsList) {
            $regex = $wordsList->getAsRegex();

            $matchResult = preg_match($regex, $text, $matches);

            $matchResults[$language] = (bool)$matchResult;
        }

        // If at least one value is `true`, return `true`
        if (in_array(true, array_values($matchResults), true)) {
            return true;
        }

        // Otherwise, return `false`
        return false;
    }

    public function addWord(string $word, string $language)
    {
        if (!isset($this->wordsLists[$language])) {
            $this->wordsLists[$language] = new WordsList([]);
        }

        $this->wordsLists[$language]->add($word);
    }
}
