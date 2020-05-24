<?php
//注文番号,約定日,建玉番号,通貨ペア,取引,数量,
//決済価格(建単価),換算レート,手数料,実現スワップ,
//実現損益,合計損益
//Order number, trade date, open position number, currency pair, transaction, quantity,
//settlement price (unit price), conversion rate, fee, realized swap, 
//realized profit / loss, total profit / loss

class PriceData{

    /** 注文番号 */
    var $OrderNumber;
    /** 約定日 */
    var $tradeDate;
    /** 建玉番号 */
    var $openPositionNumber;
    /** 通貨ペア */
    var $currencyPair;
    /** 取引 */
    var $transaction;
    /** 数量(ロット) */
    var $quanity;
    /** 決済価格(建単価) */
    var $settlementPrice;
    /** 換算レート */
    var $conversionRate;
    /** 手数料 */
    var $fee;
    /** 実現スワップ */
    var $realizedSwap;
    /** 実現損益 */
    var $realizedProfitAndLoss;
    /** 合計損益 */
    var $totalProfitAndLoss;

    function __construct(
        $OrderNumber,
        $tradeDate,
        $openPositionNumber,
        $currencyPair,
        $transaction,
        $quanity,
        $settlementPrice,
        $conversionRate,
        $fee,
        $realizedSwap,
        $realizedProfitAndLoss,
        $totalProfitAndLoss
    ) {
        $this->OrderNumber = $OrderNumber;
        $this->tradeDate = $tradeDate;
        $this->openPositionNumber = $openPositionNumber;
        $this->currencyPair = $currencyPair;
        $this->transaction = $transaction;
        $this->quanity = $quanity;
        $this->settlementPrice = $settlementPrice;
        $this->conversionRate = $conversionRate;
        $this->fee = $fee;
        $this->realizedSwap = $realizedSwap;
        $this->realizedProfitAndLoss = $realizedProfitAndLoss;
        $this->totalProfitAndLoss = $totalProfitAndLoss;
    }
}