<?php

/**
 * Description of C_ControleurGenerique
 *
 * @author btssio
 */
abstract class C_ControleurGenerique {

    protected $vue;

    function setVue($vue) {
        $this->vue = $vue;
    }

}

