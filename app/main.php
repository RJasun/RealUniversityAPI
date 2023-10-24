<?php
require 'vendor/autoload.php';

use App\UserInput;
use GuzzleHttp\Client;

$client = new Client();

$userInput = new UserInput($client);

$userInput->getOutputLayout();
