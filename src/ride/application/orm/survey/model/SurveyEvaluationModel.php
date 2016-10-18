<?php

namespace ride\application\orm\survey\model;

use ride\application\orm\entry\SurveyEntry;
use ride\application\orm\entry\SurveyEvaluationEntry;

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

    /**
     * Calculates the average score for all evaluations
     * @return array Array with the evaluations and their updated score
     */
    public function calculateAverageScores() {
        $evaluations = $this->find();
        foreach ($evaluations as $evaluation) {
            $this->calculateAverageScore($evaluation);
        }

        return $evaluations;
    }

    /**
     * Calcaultes the average score of the provided evaluation
     * @param \ride\application\orm\entry\SurveyEvaluationEntry $evaluation
     * @return null
     */
    public function calculateAverageScore(SurveyEvaluationEntry $evaluation) {
        $evaluationLogModel = $this->orm->getSurveyEvaluationLogModel();

        $totalScore = 0;
        $numberEntries = 0;

        $page = 1;
        $limit = 1000;

        do {
            $query = $evaluationLogModel->createQuery();
            $query->addCondition('{evaluation} = %1%', $evaluation->getId());
            $query->setLimit($limit, ($page - 1) * $limit);

            $entries = $query->query();
            foreach ($entries as $entry) {
                $numberEntries++;
                $totalScore += $entry->getScore();
            }

            $page++;
        } while ($entries);

        if ($numberEntries) {
            $evaluation->setAverageScore($totalScore / $numberEntries);
        } else {
            $evaluation->setAverageScore(0);
        }

        $this->save($evaluation);
    }

}
