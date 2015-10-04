<?php

namespace ride\application\orm\survey\entry;

use ride\application\orm\entry\SurveyEvaluationEntry as OrmSurveyEvaluationEntry;

/**
 * Data container for a survey evaluation
 */
class SurveyEvaluationEntry extends OrmSurveyEvaluationEntry {

    /**
     * Evaluates the provided entry
     * @param \ride\application\orm\entry\SurveyEvaluationEntry $entry
     * @return SurveyEvaluationResult
     */
    public function evaluate(SurveyEntryEntry $entry) {
        $score = $this->calculateScore($entry);
        $rule = $this->getRuleForScore($score);

        return new SurveyEvaluationResult($score, $rule);
    }

    /**
     * Calculates the score for the provided entry
     * @param \ride\application\orm\survey\entry\SurveyEntryEntry $entry
     * @return integer
     */
    private function calculateScore(SurveyEntryEntry $entry) {
        $score = 0;
        $answers = $entry->getAnswers();

        $questions = $this->getQuestions();
        foreach ($questions as $question) {
            foreach ($answers as $answer) {
                if ($answer->getQuestion()->getId() != $question->getId() || !$answer->getAnswer()) {
                    continue;
                }

                $score += $answer->getAnswer()->getScore();
            }
        }

        return $score;
    }

    /**
     * Gets the rule which matched the provided score
     * @param integer $score
     * @return \ride\application\orm\entry\SurveyEvaluationRuleEntry|null
     */
    private function getRuleForScore($score) {
        $rules = $this->getRules();
        foreach ($rules as $rule) {
            if ($rule->getMinimumScore() <= $score && $score <= $rule->getMaximumScore()) {
                return $rule;
            }
        }

        return null;
    }

}
