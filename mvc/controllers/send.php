<?php

use Core\Helper;

class send
{
  function __construct()
  {
  }
  function SayHi()
  {
    echo "SEND";
    Helper::sendTelegram([]);
  }
}