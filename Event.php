<?php

namespace Smoya\Component\Omniata;

interface Event
{
    /**
     * @return string
     */
    public function getType();

    /**
     * @return array
     */
    public function getParameters();
}
