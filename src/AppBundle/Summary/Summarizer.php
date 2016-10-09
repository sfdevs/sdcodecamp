<?php

namespace AppBundle\Summary;

/**
 * Class Summarizer.
 */
class Summarizer
{
    /**
     * @param $html
     * @param int $paragraphLength
     * @param bool|false $decode
     *
     * @return string
     */
    public function summarize($html, $paragraphLength = 2, $decode = false)
    {
        $bad_chars = array('.', '?', '!', '。');
        $terminalPunctuation = array('。', '.');
        $summaryHtml = str_replace('>', '> ', $html);
        $shortText = '';

        // loop through sentence termination punctuation to make sure this content provides something we can use
        // to summarize
        foreach ($terminalPunctuation as $period) {
            // check to see which type of period is being used
            if (false !== mb_strpos($summaryHtml, $period)) {
                // break on every period
                $tokens = explode($period . ' ', strip_tags($summaryHtml));
                // take the first {x} number of sentences
                $useTokens = array_slice($tokens, 0, $paragraphLength);
                // join the used paragraphs together
                $shortText = trim(implode($period . ' ', $useTokens));
                break;
            }
        }

        // Get the last char and add final punctuation if necessary
        $last_char = substr($shortText, -1, 1);
        if ($shortText && !in_array($last_char, $bad_chars)) {
            $shortText = $shortText . '.';
        }

        $summaryHtml = $shortText;

        if ($decode) {
            $summaryHtml = html_entity_decode($shortText);
        }

        return $summaryHtml;
    }
}
