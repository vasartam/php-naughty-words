<?php

use PHPUnit\Framework\TestCase;

class NaughtyWordsTest extends TestCase
{
    public function testGetForLanguage()
    {
        $naughtyWordsEn = NaughtyWords::getForLanguage('en');

        $this->assertIsArray($naughtyWordsEn, 'Returned non-array!');
        $this->assertContains('butt', $naughtyWordsEn, 'English words does not contain word \'butt\'!');

        $naughtyWordsRu = NaughtyWords::getForLanguage('ru');

        $this->assertIsArray($naughtyWordsRu);
        $this->assertContains('byk', $naughtyWordsRu, 'Russian words does not contain word \'byk\'!');
    }
}
