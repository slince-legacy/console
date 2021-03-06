<?php
/**
 * slince console component
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Console\Helper;

use Slince\Console\Question\QuestionInterface;

class QuestionHelper extends Helper
{

    /**
     * 向控制输出问题并验证答案
     * 
     * @param QuestionInterface $question
     * @return Ambigous <mixed, Exception>
     */
    function ask(QuestionInterface $question)
    {
        if ($question->getValidator() == null) {
            return $this->processAsk($question);
        }
        return $this->validateAttempts($question);
    }

    /**
     * 开始处理提问
     * 
     * @param QuestionInterface $question
     * @return mixed|string
     */
    protected function processAsk(QuestionInterface $question)
    {
        $this->io->write($question);
        $answer = $this->io->read();
        if ($answer == '') {
            $answer = $question->getDefault();
        }
        if (($normalizer = $question->getNormalizer()) != null) {
            return call_user_func($normalizer, $answer);
        }
        return $answer;
    }

    /**
     * 多次尝试问问题
     * 
     * @param QuestionInterface $question
     * @return mixed|Exception
     */
    protected function validateAttempts(QuestionInterface $question)
    {
        $exception = null;
        do {
            $answer = $this->processAsk($question);
            try {
                return call_user_func($question->getValidator(), $answer);
            } catch (\Exception $exception) {
                $this->io->writeln($exception->getMessage());
                $this->io->writeln();
            }
            $question->reduceMaxAttempts();
        } while ($question->getMaxAttempts() > 0);
        return $exception;
    }
}