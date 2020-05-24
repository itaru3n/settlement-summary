<?php
require_once dirname(__FILE__).'/PriceData.php';

//決済明細
class SettlementSEttlementDetail {

    var $settlementPriceData;
    var $buildingPriceData;

    function __construct(PriceData $settlementPriceData, PriceData $buildingPriceData){
        $this->settlementPriceData = $settlementPriceData;
        $this->buildingPriceData = $buildingPriceData;
    }

    function isBuyTrade(){
        return $this->buildingPriceData->transaction === '新規買';
    }

    function earnedPips(){
        $pips = 0;
        if($this->isBuyTrade()){
            $pips += ($this->settlementPriceData->settlementPrice * 1000 - $this->buildingPriceData->settlementPrice * 1000) / 1000;
        }
        else {
            $pips += ($this->buildingPriceData->settlementPrice * 1000 - $this->settlementPriceData->settlementPrice * 1000) / 1000;
        }
        return $pips * 100;
    }

    function holdingPeriodOfSec(){
        $buildingDate = $this->buildingPriceData->tradeDate;
        $settlementDate = $this->settlementPriceData->tradeDate;
        return (int)strtotime($settlementDate) - (int)strtotime($buildingDate);
    }
}
