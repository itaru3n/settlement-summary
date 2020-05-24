<?php
require_once dirname(__FILE__).'/../../domain/application/summary/SettlementSummaryOutputData.php';
require_once dirname(__FILE__).'/../../viewmodels/summary/ConsoleViewModel.php';
require_once dirname(__FILE__).'/../../views/summary/ConsoleView.php';

class SettlementSummaryPresenter{

    function output(SettlementSummaryOutputData $outputData){
        $viewModel = new ConsoleViewModel($outputData);
        $view = new ConsoleView();
        $view->showSummary($viewModel);
    }
}
