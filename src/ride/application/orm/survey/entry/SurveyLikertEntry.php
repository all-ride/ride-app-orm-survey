<?php

namespace ride\application\orm\survey\entry;

use ride\application\orm\entry\SurveyLikertEntry as OrmSurveyLikertEntry;

/**
 * Data container for a survey likert
 */
class SurveyLikertEntry extends OrmSurveyLikertEntry {

    /**
     * Checks if the provided likert scale is compatible with this one
     * @param SurveyLikertEntry $likert
     * @return boolean
     */
    public function isCompatible(SurveyLikertEntry $likert) {
        $answers = array_values($this->getAnswers());
        $likertAnswers = array_values($likert->getAnswers());

        if (count($answers) != count($likertAnswers)) {
            return false;
        }

        foreach ($answers as $index => $answer) {
            if ($answer->getAnswer() != $likertAnswers[$index]->getAnswer()) {
                return false;
            }
        }

        return true;
    }

}
