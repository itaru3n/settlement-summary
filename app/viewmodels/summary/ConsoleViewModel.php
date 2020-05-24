<?php
require_once dirname(__FILE__).'/../../domain/application/summary/SettlementSummaryOutputData.php';

class ConsoleViewModel{
    
    var $outputData;

    function __construct(SettlementSummaryOutputData $outputData){
        $this->outputData = $outputData;
    }

    function getTradeCount(){
        return $this->outputData->tradeCount;
    }

    function getWinAndloseAndDrawCount(){
        $this->outputData->winAndLoseAndDrawCount;
        $totalCount = $this->getTradeCount();
        $winRate = floor(($this->outputData->winAndLoseAndDrawCount['winCount'] / $totalCount) * 1000) / 10;
        $loseRate = floor(($this->outputData->winAndLoseAndDrawCount['loseCount'] / $totalCount) * 1000) / 10;
        $drawRate = floor(($this->outputData->winAndLoseAndDrawCount['drawCount'] / $totalCount) * 1000) / 10;
        return [
            'winCount' => $this->outputData->winAndLoseAndDrawCount['winCount'],
            'loseCount' => $this->outputData->winAndLoseAndDrawCount['loseCount'],
            'drawCount' => $this->outputData->winAndLoseAndDrawCount['drawCount'],
            'winRate' => $winRate,
            'loseRate' => $loseRate,
            'drawRate' => $drawRate,
        ];
    }

    function getFirstSettlementDate(){
        return $this->outputData->firstSettlementTrade->settlementPriceData->tradeDate;
    }

    function getLastSettlementDate(){
        return $this->outputData->lastSettlementTrade->settlementPriceData->tradeDate;
    }

    function getSumEarnedPIPs(){
        return $this->outputData->sumEarnedPIPs;
    }

    function getAverageEarnedPIPs(){
        return (float)(floor($this->outputData->averageEarnedPIPs*100) / 100);
    }

    function getAverageHoldingPeriod(){
        list($day, $hour, $minites, $sec) = $this->secToPeriod($this->outputData->averageHoldingPeriodSec);
        return $day.'日 '.$hour.'時 '. $minites.'分 '.$sec.'秒';
    }

    function getMaxEarnedPIPsTradeSummary(){
        list($day, $hour, $minites, $sec) = $this->secToPeriod($this->outputData->maxEarnedPIPsTradeSummary['holdingPeriodOfSec']);
        return [
            "buildingDate" => $this->outputData->maxEarnedPIPsTradeSummary['buildingDate'],
            "settlementDate" => $this->outputData->maxEarnedPIPsTradeSummary['settlementDate'],
            "holdingPeriod" => $day.'日 '.$hour.'時 '. $minites.'分 '.$sec.'秒',
            "currencyPair" => $this->outputData->maxEarnedPIPsTradeSummary['currencyPair'],
            "earnedPIPs" => $this->outputData->maxEarnedPIPsTradeSummary['earnedPIPs'],
        ];
    }

    function getMinEarnedPIPsTradeSummary(){
        list($day, $hour, $minites, $sec) = $this->secToPeriod($this->outputData->minEarnedPIPsTradeSummary['holdingPeriodOfSec']);
        return [
            "buildingDate" => $this->outputData->minEarnedPIPsTradeSummary['buildingDate'],
            "settlementDate" => $this->outputData->minEarnedPIPsTradeSummary['settlementDate'],
            "holdingPeriod" => $day.'日 '.$hour.'時 '. $minites.'分 '.$sec.'秒',
            "currencyPair" => $this->outputData->minEarnedPIPsTradeSummary['currencyPair'],
            "earnedPIPs" => $this->outputData->minEarnedPIPsTradeSummary['earnedPIPs'],
        ];
    }

    function getMaxHoldingPeriodOfTradeSummary(){
        list($day, $hour, $minites, $sec) = $this->secToPeriod($this->outputData->maxHoldingPeriodOfTradeSummary['holdingPeriodOfSec']);
        return [
            "buildingDate" => $this->outputData->maxHoldingPeriodOfTradeSummary['buildingDate'],
            "settlementDate" => $this->outputData->maxHoldingPeriodOfTradeSummary['settlementDate'],
            "holdingPeriod" => $day.'日 '.$hour.'時 '. $minites.'分 '.$sec.'秒',
            "currencyPair" => $this->outputData->maxHoldingPeriodOfTradeSummary['currencyPair'],
            "earnedPIPs" => $this->outputData->maxHoldingPeriodOfTradeSummary['earnedPIPs'],
        ];
    }

    function getMinHoldingPeriodOfTradeSummary(){
        list($day, $hour, $minites, $sec) = $this->secToPeriod($this->outputData->minHoldingPeriodOfTradeSummary['holdingPeriodOfSec']);
        return [
            "buildingDate" => $this->outputData->minHoldingPeriodOfTradeSummary['buildingDate'],
            "settlementDate" => $this->outputData->minHoldingPeriodOfTradeSummary['settlementDate'],
            "holdingPeriod" => $day.'日 '.$hour.'時 '. $minites.'分 '.$sec.'秒',
            "currencyPair" => $this->outputData->minHoldingPeriodOfTradeSummary['currencyPair'],
            "earnedPIPs" => $this->outputData->minHoldingPeriodOfTradeSummary['earnedPIPs'],
        ];
    }

    function secToPeriod($srcSec){
        $day = floor($srcSec / (60 * 60 * 24));
        $hour = floor(($srcSec - (60 * 60 * 24 * $day)) / (60 * 60));
        $minites = floor(($srcSec - (60 * 60 * 24 * $day) - (60 * 60 * $hour)) / 60);
        $sec = floor($srcSec - (60 * 60 * 24 * $day) - (60 * 60 * $hour) - (60 * $minites));
        return [$day, $hour, $minites, $sec];
    }
}
