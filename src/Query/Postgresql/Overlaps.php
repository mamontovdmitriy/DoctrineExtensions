<?php

namespace DoctrineExtensions\Query\Postgresql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class Overlaps extends FunctionNode
{
    public $firstDateStart = null;

    public $firstDateEnd = null;

    public $secondDateStart = null;

    public $secondDateEnd = null;

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->firstDateStart = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->firstDateEnd = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->secondDateStart = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->secondDateEnd = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        return sprintf(
            '(%s, %s) OVERLAPS (%s, %s)',
            $this->firstDateStart->dispatch($sqlWalker),
            $this->firstDateEnd->dispatch($sqlWalker),
            $this->secondDateStart->dispatch($sqlWalker),
            $this->secondDateEnd->dispatch($sqlWalker)
        );
    }
}
