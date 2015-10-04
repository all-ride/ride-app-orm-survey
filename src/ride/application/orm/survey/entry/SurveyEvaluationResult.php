<?php

namespace ride\application\orm\survey\entry;

/**
 * Data container for an evaluation result
 */
class SurveyEvaluationResult {

    /**
     * Constructs a new result
     * @param integer $score Total score for the evaluation
     * @param \ride\application\orm\entry\SurveyEvaluationRuleEntry $rule
     * @return null
     */
    public function __construct($score, $rule = null) {
        $this->score = $score;
        $this->rule = $rule;
    }

    /**
     * Gets the total score of the evaluation
     * @return integer
     */
    public function getScore() {
        return $this->score;
    }

    /**
     * Gets the applied rule for the score
     * @return \ride\application\orm\entry\SurveyEvaluationRuleEntry|null
     */
    public function getRule() {
        return $this->rule;
    }

}
