<?php
require_once dirname(__FILE__) .'/../domain/application/summary/SettlementSummaryInputData.php';
require_once dirname(__FILE__) .'/../domain/application/summary/SettlementSummaryUseCase.php';
date_default_timezone_set('Asia/Tokyo');


class SettlementSummaryController {

    var $filePath;

    function __construct(){
        $this->filePath = './resources/kessai.csv';
    }

    //サマリー
    function outPutSummary(){
        $inputData = new SettlementSummaryInputData($this->filePath);
        $summaryUseCase = new SettlementSummaryUseCase();
        $summaryUseCase->handle($inputData);
    }
}
