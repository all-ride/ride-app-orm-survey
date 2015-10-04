<?php

namespace ride\application\orm\survey\entry;

use ride\application\orm\entry\SurveyQuestionEntry as OrmSurveyQuestionEntry;

/**
 * Data container for a survey question
 */
class SurveyQuestionEntry extends OrmSurveyQuestionEntry {

    /**
     * Gets the likert scale of the first question
     * @return \ride\application\orm\entry\SurveyLikertEntry|null
     */
    public function getLikert() {
        $answers = $this->getAnswers();
        if (!$answers) {
            return null;
        }

        $firstAnswer = reset($answers);

        return $firstAnswer->getLikert();
    }

}
