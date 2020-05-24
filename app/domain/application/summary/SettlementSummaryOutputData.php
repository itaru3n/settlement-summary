<?php
class SettlementSummaryOutputData {

    var $firstSettlementTrade;
    var $lastSettlementTrade;
    var $tradeCount;
    var $winAndLoseAndDrawCount;
    var $sumEarnedPIPs;
    var $averageEarnedPIPs;
    var $averageHoldingPeriodSec;
    var $maxEarnedPIPsTradeSummary;
    var $minEarnedPIPsTradeSummary;
    var $maxHoldingPeriodOfTradeSummary;
    var $minHoldingPeriodOfTradeSummary;

    function __construct(
        $firstSettlementTrade,
        $lastSettlementTrade,
        $tradeCount,
        $winAndLoseAndDrawCount,
        $sumEarnedPIPs,
        $averageEarnedPIPs,
        $averageHoldingPeriodSec,
        $maxEarnedPIPsTradeSummary,
        $minEarnedPIPsTradeSummary,
        $maxHoldingPeriodOfTradeSummary,
        $minHoldingPeriodOfTradeSummary
    ){
        $this->firstSettlementTrade = $firstSettlementTrade;
        $this->lastSettlementTrade = $lastSettlementTrade;
        $this->tradeCount = $tradeCount;
        $this->winAndLoseAndDrawCount = $winAndLoseAndDrawCount;
        $this->sumEarnedPIPs = $sumEarnedPIPs;
        $this->averageEarnedPIPs = $averageEarnedPIPs;
        $this->averageHoldingPeriodSec = $averageHoldingPeriodSec;
        $this->maxEarnedPIPsTradeSummary = $maxEarnedPIPsTradeSummary;
        $this->minEarnedPIPsTradeSummary = $minEarnedPIPsTradeSummary;
        $this->maxHoldingPeriodOfTradeSummary = $maxHoldingPeriodOfTradeSummary;
        $this->minHoldingPeriodOfTradeSummary = $minHoldingPeriodOfTradeSummary;
    }
}