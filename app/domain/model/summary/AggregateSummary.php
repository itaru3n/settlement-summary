<?php
require_once dirname(__FILE__).'/SettlementSettlementDetail.php';

class AggregateSummary {

    //サマリーの期間（決済日で期間をみる）
    //トレード回数
    //勝ち,負け,引き分け,の回数
    //合計獲得PIPs（Earned PIPs）
    //平均獲得PIPs
    //平均保有期間
    //最大獲得PIPs（詳細付き）  建日時,決済日時,保有期間,通貨ペア,トレード,獲得PIPs
    //最低獲得PIPs（詳細付き）
    //最大保有期間（詳細付き）
    //最小保有期間（詳細付き）
    function aggregate(array $setlementDetails){
        $tradeCount = $this->tradeCount($setlementDetails);
        $winAndLoseAndDrawCount = $this->winAndloseAndDrawCount($setlementDetails);
        $sumEarnedPIPs = $this->sumEarnedPIPs($setlementDetails);
        $averageEarnedPIPs = $this->averageEarnedPIPs($sumEarnedPIPs, $tradeCount);
        $maxEarnedPIPsTrade = $this->maxEarnedPIPsTrade($setlementDetails);
        $minEarnedPIPsTrade = $this->minEarnedPIPsTrade($setlementDetails);
        $maxHoldingPeriodOfTrade = $this->maxHoldingPeriodOfTrade($setlementDetails);
        $minHoldingPeriodOfTrade = $this->minHoldingPeriodOfTrade($setlementDetails);
        $averageHoldingPeriodSec = $this->averageHoldingPeriodSec($setlementDetails);
        return [
            'firstSettlementTrade' => $this->firstSettlementTrade($setlementDetails),
            'lastSettlementTrade' => $this->lastSettlementTrade($setlementDetails),
            'tradeCount' => $tradeCount,
            'winAndLoseAndDrawCount' => $winAndLoseAndDrawCount,
            'sumEarnedPIPs' => $sumEarnedPIPs,
            'averageEarnedPIPs' => $averageEarnedPIPs,
            'averageHoldingPeriodSec' => $averageHoldingPeriodSec,
            'maxEarnedPIPsTradeSummary' => $this->tradeSummary($maxEarnedPIPsTrade),
            'minEarnedPIPsTradeSummary' => $this->tradeSummary($minEarnedPIPsTrade),
            'maxHoldingPeriodOfTradeSummary' => $this->tradeSummary($maxHoldingPeriodOfTrade),
            'minHoldingPeriodOfTradeSummary' => $this->tradeSummary($minHoldingPeriodOfTrade),
        ];
    }

    function firstSettlementTrade($setlementDetails){
        $firstDate = null;
        $firstTrade = null;
        foreach($setlementDetails as $trade){
            $date = $trade->settlementPriceData->tradeDate;
            if(is_null($firstDate) || $date < $firstDate){
                $firstDate = $date;
                $firstTrade = $trade;
            }
        }
        return $firstTrade;
    }

    function lastSettlementTrade($setlementDetails){
        $lastDate = null;
        $lastTrade = null;
        foreach($setlementDetails as $trade){
            $date = $trade->settlementPriceData->tradeDate;
            if(is_null($lastDate) || $date > $lastDate){
                $lastDate = $date;
                $lastTrade = $trade;
            }
        }
        return $lastTrade;
    }

    function tradeCount(array $setlementDetails){
        return count($setlementDetails);
    }

    function winAndloseAndDrawCount($setlementDetails){
        $winCount = 0;
        $loseCount = 0;
        $drawCount = 0;
        foreach($setlementDetails as $trade){
            $pips = $trade->earnedPips();
            if($pips > 0){
                $winCount++;
            }
            else if($pips < 0){
                $loseCount++;
            }
            else{
                $drawCount++;
            }
        }
        return [
            'winCount' => $winCount,
            'loseCount' => $loseCount,
            'drawCount' => $drawCount,
        ];
    }

    function sumEarnedPIPs(array $setlementDetails){
        $pips = 0;
        foreach($setlementDetails as $trade){
            $pips += $trade->earnedPips();
        }
        return $pips;
    }

    function averageEarnedPIPs($sumPips, $tradeCount){
        return (float)$sumPips / $tradeCount;
    }

    function averageHoldingPeriodSec($setlementDetails){
        $totalCount = $this->tradeCount($setlementDetails);
        $periodSec = 0;
        foreach($setlementDetails as $trade){
            $periodSec += $trade->holdingPeriodOfSec();
        }
        return (float)$periodSec / $totalCount;
    }

    function maxEarnedPIPsTrade($setlementDetails){
        $maxPips = null;
        $maxTrade = null;
        foreach($setlementDetails as $trade){
            $pips = $trade->earnedPips();
            if(is_null($maxPips) || $pips > $maxPips){
                $maxPips = $pips;
                $maxTrade = $trade;
            }
        }
        return $maxTrade;
    }

    function minEarnedPIPsTrade($setlementDetails){
        $minPips = null;
        $minTrade = null;
        foreach($setlementDetails as $trade){
            $pips = $trade->earnedPips();
            if(is_null($minPips) || $pips < $minPips){
                $minPips = $pips;
                $minTrade = $trade;
            }
        }
        return $minTrade;
    }

    function maxHoldingPeriodOfTrade($setlementDetails){
        $maxPeriod = null;
        $maxTrade = null;
        foreach($setlementDetails as $trade){
            $period = $trade->holdingPeriodOfSec();
            if(is_null($maxPeriod) || $period > $maxPeriod){
                $maxPeriod = $period;
                $maxTrade = $trade;
            }
        }
        return $maxTrade;
    }

    function minHoldingPeriodOfTrade($setlementDetails){
        $minPeriod = null;
        $minTrade = null;
        foreach($setlementDetails as $trade){
            $period = $trade->holdingPeriodOfSec();
            if(is_null($minPeriod) || $period < $minPeriod){
                $minPeriod = $period;
                $minTrade = $trade;
            }
        }
        return $minTrade;
    }

    function tradeSummary($trade){
        //建日時,決済日時,保有期間,通貨ペア,トレード,獲得PIPs
        $buildingDate = $trade->buildingPriceData->tradeDate;
        $settlementDate = $trade->settlementPriceData->tradeDate;
        return [
            'buildingDate' => $buildingDate,
            'settlementDate' => $settlementDate,
            'holdingPeriodOfSec' => $trade->holdingPeriodOfSec(),
            'currencyPair' => $trade->buildingPriceData->currencyPair,
            'earnedPIPs' => $trade->earnedPips(),
        ];
    }
}
