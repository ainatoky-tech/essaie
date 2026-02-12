<?php
use Flight;
use app\controllers\EchangeController;

Flight::route('/',[EchangeController::class,'index']);
Flight::route('/Takalo',[EchangeController::class,'index']);


