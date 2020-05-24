<?php
require_once dirname(__FILE__).'/../../application/summary/SettlementSummaryInputData.php';
require_once dirname(__FILE__).'/SettlementSettlementDetail.php';

class SettlementDetailRepository{

    const CSV_ORDER_NUMBER = 0;
    const CSV_TRADE_DATE = 1;
    const CSV_OPEN_POSITON_NUMBER = 2;
    const CSV_CURRENCY_PAIR = 3;
    const CSV_TRANSACTION = 4;
    const CSV_QUANITY = 5;
    const CSV_SETTLEMENT_PRICE = 6;
    const CSV_CONVERSION_RATE = 7;
    const CSV_FEE = 8;
    const CSV_REALIZED_SWAP = 9;
    const CSV_REALIZED_PROFIT_AND_LOSS = 10;
    const CSV_TOTAL_PROFIT_AND_LOSS = 11;

    function load(SettlementSummaryInputData $inputData){
        return $this->loadFile($inputData->filePath);
    }

    function loadFile($filePath){
        $temp = file($filePath);
        $loadedTemp = [];
        foreach($temp as $row){
            $loadedTemp[] = explode(',', mb_convert_encoding(rtrim($row), 'utf8', 'sjis'));
        }

        $max = count($loadedTemp);
        $settlementDetails = [];
        for($i=1; $i<$max; $i+=2){
            $settlementPriceData = new PriceData(
                $loadedTemp[$i][self::CSV_ORDER_NUMBER],
                $loadedTemp[$i][self::CSV_TRADE_DATE],
                $loadedTemp[$i][self::CSV_OPEN_POSITON_NUMBER],
                $loadedTemp[$i][self::CSV_CURRENCY_PAIR],
                $loadedTemp[$i][self::CSV_TRANSACTION],
                $loadedTemp[$i][self::CSV_QUANITY],
                $loadedTemp[$i][self::CSV_SETTLEMENT_PRICE],
                $loadedTemp[$i][self::CSV_CONVERSION_RATE],
                $loadedTemp[$i][self::CSV_FEE],
                $loadedTemp[$i][self::CSV_REALIZED_SWAP],
                $loadedTemp[$i][self::CSV_REALIZED_PROFIT_AND_LOSS],
                $loadedTemp[$i][self::CSV_TOTAL_PROFIT_AND_LOSS]
            );
            $buildingPriceData = new PriceData(
                $loadedTemp[$i+1][self::CSV_ORDER_NUMBER],
                $loadedTemp[$i+1][self::CSV_TRADE_DATE],
                $loadedTemp[$i+1][self::CSV_OPEN_POSITON_NUMBER],
                $loadedTemp[$i+1][self::CSV_CURRENCY_PAIR],
                $loadedTemp[$i+1][self::CSV_TRANSACTION],
                $loadedTemp[$i+1][self::CSV_QUANITY],
                $loadedTemp[$i+1][self::CSV_SETTLEMENT_PRICE],
                $loadedTemp[$i+1][self::CSV_CONVERSION_RATE],
                $loadedTemp[$i+1][self::CSV_FEE],
                $loadedTemp[$i+1][self::CSV_REALIZED_SWAP],
                $loadedTemp[$i+1][self::CSV_REALIZED_PROFIT_AND_LOSS],
                $loadedTemp[$i+1][self::CSV_TOTAL_PROFIT_AND_LOSS]
            );
            $settlementDetails[] = new SettlementSettlementDetail(
                $settlementPriceData,
                $buildingPriceData
            );
        }
        return $settlementDetails;
    }
}