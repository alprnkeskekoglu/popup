<?php

namespace Dawnstar\Popup\Contracts;

use Dawnstar\Popup\Models\Popup;

/**
 * Interface PopupTranslationInterface
 * @package Dawnstar\Popup\Contracts
 */
interface PopupTranslationInterface
{
    /**
     * @param Popup $popup
     * @return mixed
     */
    public function store(Popup $popup);

    /**
     * @param Popup $popup
     * @return mixed
     */
    public function update(Popup $popup);
}
