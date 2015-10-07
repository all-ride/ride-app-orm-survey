<?php

namespace ride\application\orm\survey\entry;

use ride\application\orm\entry\SurveyEntryEntry as OrmSurveyEntryEntry;

/**
 * Data container for a survey entry
 */
class SurveyEntryEntry extends OrmSurveyEntryEntry {

    /**
     * Gets the hash of this entry
     * @return string
     */
    public function getHash() {
        return substr(md5($this->getId() . '-' . $this->getDateAdded()), 0, 10);
    }

    /**
     * Gets all the answers for the provided question
     * @param integer $questionId Id of the question
     * @return array
     */
    public function getAnswersForQuestion($questionId) {
        $answers = $this->getAnswers();
        foreach ($answers as $answer) {
            if ($answer->getQuestion()->getId() != $questionId) {
                unset($answers[$answer->getId()]);
            }
        }

        return $answers;
    }

}
