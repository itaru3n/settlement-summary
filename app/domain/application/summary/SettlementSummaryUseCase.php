<?php
require_once dirname(__FILE__).'/SettlementSummaryInputData.php';
require_once dirname(__FILE__).'/SettlementSummaryOutputData.php';
require_once dirname(__FILE__).'/../../model/summary/SettlementDetailRepository.php';
require_once dirname(__FILE__).'/../../model/summary/AggregateSummary.php';
require_once dirname(__FILE__).'/../../../presenter/summary/SettlementSummaryPresenter.php';

class SettlementSummaryUseCase {
    
    function handle(SettlementSummaryInputData $inputData) {
        $repository = new SettlementDetailRepository();
        $setlementDetails = $repository->load($inputData);
        $aggregateSummary = new AggregateSummary();
        $summary = $aggregateSummary->aggregate($setlementDetails);
        $outputData = new SettlementSummaryOutputData(
            $summary['firstSettlementTrade'],
            $summary['lastSettlementTrade'],
            $summary['tradeCount'],
            $summary['winAndLoseAndDrawCount'],
            $summary['sumEarnedPIPs'],
            $summary['averageEarnedPIPs'],
            $summary['averageHoldingPeriodSec'],
            $summary['maxEarnedPIPsTradeSummary'],
            $summary['minEarnedPIPsTradeSummary'],
            $summary['maxHoldingPeriodOfTradeSummary'],
            $summary['minHoldingPeriodOfTradeSummary']
        );
        $presenter = new SettlementSummaryPresenter();
        $presenter->output($outputData);
    }
}