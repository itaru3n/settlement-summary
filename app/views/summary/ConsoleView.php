<?php
require_once dirname(__FILE__).'/../../viewmodels/summary/ConsoleViewModel.php';

class ConsoleView{
    function showSummary(ConsoleViewModel $viewModel){

        $winAndLoseAndDrawCount = $viewModel->getWinAndLoseAndDrawCount();
        echo "------------\n";
        echo "サマリー\n";
        echo "- 最初の決済日時：".$viewModel->getFirstSettlementDate()."\n";
        echo "- 最後の決済日時：".$viewModel->getLastSettlementDate()."\n";
        echo "- トレード回数　：".$viewModel->getTradeCount()."\n";
        echo "-- 勝ち数（％） ：".$winAndLoseAndDrawCount['winCount']."（".$winAndLoseAndDrawCount['winRate']."％）\n";
        echo "-- 負け数（％） ：".$winAndLoseAndDrawCount['loseCount']."（".$winAndLoseAndDrawCount['loseRate']."％）\n";
        echo "-- 引き分け（％）：".$winAndLoseAndDrawCount['drawCount']."（".$winAndLoseAndDrawCount['drawRate']."％）\n";
        echo "- 合計獲得PIPs　：".$viewModel->getSumEarnedPIPs()."\n";
        echo "- 平均獲得PIPs　：".$viewModel->getAverageEarnedPIPs()."\n";
        echo "- 平均保有期間　：".$viewModel->getAverageHoldingPeriod()."\n";

        $maxEarnedTradeSummary = $viewModel->getMaxEarnedPIPsTradeSummary();
        echo "------------\n";
        echo "最大獲得PIPsトレード\n";
        echo "- 獲得PIPs　　　：".$maxEarnedTradeSummary['earnedPIPs']."\n";
        echo "- エントリー日時：". $maxEarnedTradeSummary['buildingDate']."\n";
        echo "- 決済日時　　　：". $maxEarnedTradeSummary['settlementDate']."\n";
        echo "- 保有期間　　　：". $maxEarnedTradeSummary['holdingPeriod']."\n";
        echo "- 取引通貨　　　：". $maxEarnedTradeSummary['currencyPair']."\n";

        $minEarnedTradeSummary = $viewModel->getMinEarnedPIPsTradeSummary();
        echo "------------\n";
        echo "最低獲得PIPsトレード\n";
        echo "- 獲得PIPs　　　：".$minEarnedTradeSummary['earnedPIPs']."\n";
        echo "- エントリー日時：". $minEarnedTradeSummary['buildingDate']."\n";
        echo "- 決済日時　　　：". $minEarnedTradeSummary['settlementDate']."\n";
        echo "- 保有期間　　　：". $minEarnedTradeSummary['holdingPeriod']."\n";
        echo "- 取引通貨　　　：". $minEarnedTradeSummary['currencyPair']."\n";

        $maxHoldingPeriodOfTrade = $viewModel->getMaxHoldingPeriodOfTradeSummary();
        echo "------------\n";
        echo "最長保有期間トレード\n";
        echo "- 獲得PIPs　　　：".$maxHoldingPeriodOfTrade['earnedPIPs']."\n";
        echo "- エントリー日時：". $maxHoldingPeriodOfTrade['buildingDate']."\n";
        echo "- 決済日時　　　：". $maxHoldingPeriodOfTrade['settlementDate']."\n";
        echo "- 保有期間　　　：". $maxHoldingPeriodOfTrade['holdingPeriod']."\n";
        echo "- 取引通貨　　　：". $maxHoldingPeriodOfTrade['currencyPair']."\n";

        $minHoldingPeriodOfTrade = $viewModel->getMinHoldingPeriodOfTradeSummary();
        echo "------------\n";
        echo "最短有期間トレード\n";
        echo "- 獲得PIPs　　　：".$minHoldingPeriodOfTrade['earnedPIPs']."\n";
        echo "- エントリー日時：". $minHoldingPeriodOfTrade['buildingDate']."\n";
        echo "- 決済日時　　　：". $minHoldingPeriodOfTrade['settlementDate']."\n";
        echo "- 保有期間　　　：". $minHoldingPeriodOfTrade['holdingPeriod']."\n";
        echo "- 取引通貨　　　：". $minHoldingPeriodOfTrade['currencyPair']."\n";
    }
}