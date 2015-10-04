<?php

namespace ride\application\orm\survey\model;

use ride\application\orm\entry\SurveyEntry;

use ride\library\orm\model\GenericModel;

/**
 * Model for the survey evaluations
 */
class SurveyEvaluationModel extends GenericModel {

    /**
     * Find all the evaluations for the provided survey
     * @param \ride\application\orm\entry\SurveyEntry $survey
     * @param string $locale
     * @return array
     */
    public function findBySurvey(SurveyEntry $survey, $locale = null) {
        $questionIds = array_keys($survey->getQuestions());

        $query = $this->createQuery($locale);
        $query->addCondition('{questions.id} IN %1%', $questionIds);

        return $query->query();
    }

}
