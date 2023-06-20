<?php
$aspasSimples = 'Hello Word!';
$aspasDuplas = "HelloWord!!";
$nowdoc = <<<'NOWDOC'
NOWDOC;
$heredoc = <<<HEREDOC
            '$aspasSimples'
            HEREDOC;
$heredoc = <<<"HEREDOC"
1
    2
        3
HEREDOC;
echo $aspasSimples . PHP_EOL . $aspasDuplas . PHP_EOL;
echo $nowdoc . PHP_EOL . $heredoc;