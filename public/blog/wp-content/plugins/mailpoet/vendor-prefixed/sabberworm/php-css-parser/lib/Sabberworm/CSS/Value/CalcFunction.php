<?php

namespace MailPoetVendor\Sabberworm\CSS\Value;

if (!defined('ABSPATH')) exit;


use MailPoetVendor\Sabberworm\CSS\Parsing\ParserState;
use MailPoetVendor\Sabberworm\CSS\Parsing\UnexpectedTokenException;
class CalcFunction extends \MailPoetVendor\Sabberworm\CSS\Value\CSSFunction
{
    const T_OPERAND = 1;
    const T_OPERATOR = 2;
    public static function parse(\MailPoetVendor\Sabberworm\CSS\Parsing\ParserState $oParserState)
    {
        $aOperators = array('+', '-', '*', '/');
        $sFunction = \trim($oParserState->consumeUntil('(', \false, \true));
        $oCalcList = new \MailPoetVendor\Sabberworm\CSS\Value\CalcRuleValueList($oParserState->currentLine());
        $oList = new \MailPoetVendor\Sabberworm\CSS\Value\RuleValueList(',', $oParserState->currentLine());
        $iNestingLevel = 0;
        $iLastComponentType = NULL;
        while (!$oParserState->comes(')') || $iNestingLevel > 0) {
            $oParserState->consumeWhiteSpace();
            if ($oParserState->comes('(')) {
                $iNestingLevel++;
                $oCalcList->addListComponent($oParserState->consume(1));
                continue;
            } else {
                if ($oParserState->comes(')')) {
                    $iNestingLevel--;
                    $oCalcList->addListComponent($oParserState->consume(1));
                    continue;
                }
            }
            if ($iLastComponentType != \MailPoetVendor\Sabberworm\CSS\Value\CalcFunction::T_OPERAND) {
                $oVal = \MailPoetVendor\Sabberworm\CSS\Value\Value::parsePrimitiveValue($oParserState);
                $oCalcList->addListComponent($oVal);
                $iLastComponentType = \MailPoetVendor\Sabberworm\CSS\Value\CalcFunction::T_OPERAND;
            } else {
                if (\in_array($oParserState->peek(), $aOperators)) {
                    if ($oParserState->comes('-') || $oParserState->comes('+')) {
                        if ($oParserState->peek(1, -1) != ' ' || !($oParserState->comes('- ') || $oParserState->comes('+ '))) {
                            throw new \MailPoetVendor\Sabberworm\CSS\Parsing\UnexpectedTokenException(" {$oParserState->peek()} ", $oParserState->peek(1, -1) . $oParserState->peek(2), 'literal', $oParserState->currentLine());
                        }
                    }
                    $oCalcList->addListComponent($oParserState->consume(1));
                    $iLastComponentType = \MailPoetVendor\Sabberworm\CSS\Value\CalcFunction::T_OPERATOR;
                } else {
                    throw new \MailPoetVendor\Sabberworm\CSS\Parsing\UnexpectedTokenException(\sprintf('Next token was expected to be an operand of type %s. Instead "%s" was found.', \implode(', ', $aOperators), $oVal), '', 'custom', $oParserState->currentLine());
                }
            }
        }
        $oList->addListComponent($oCalcList);
        $oParserState->consume(')');
        return new \MailPoetVendor\Sabberworm\CSS\Value\CalcFunction($sFunction, $oList, ',', $oParserState->currentLine());
    }
}
