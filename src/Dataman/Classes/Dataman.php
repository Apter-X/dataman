<?php
/**
* dataman v1.0
*
* https://github.com/Apter-X/dataman
*
* Dataman is a simple database manager using PDO that simplifies back-end processing and grants with useful tools.
*/
class Dataman extends Verifier
{
    // use View;

    /**
    * @return void 
    */
    public function ping()
    {
        $this->alert("Pong", SUCCESS_COLOR);
    }
}
