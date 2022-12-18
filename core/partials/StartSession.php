<?php
namespace Core\Partials;

class StartSession
{
   public static function start() : void
   {
     if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
      } 
   }
}


