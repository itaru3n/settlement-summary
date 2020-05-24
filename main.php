<?php
require_once dirname(__FILE__) . '/app/controllers/SettlementSummaryController.php';

$controller = new SettlementSummaryController();
$controller->outPutSummary();