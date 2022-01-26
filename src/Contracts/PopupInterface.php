<?php

namespace Dawnstar\Popup\Contracts;

use Dawnstar\Core\Models\Website;
use Dawnstar\Popup\Models\Popup;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface PopupInterface
 * @package Dawnstar\Popup\Repositories
 */
interface PopupInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param Website $website
     * @return Collection
     */
    public function getByWebsite(Website $website): Collection;

    /**
     * @param int $id
     * @return Popup
     */
    public function getById(int $id): Popup;

    /**
     * @return Popup
     */
    public function store(): Popup;

    /**
     * @param Popup $popup
     * @return Popup
     */
    public function update(Popup $popup): Popup;

    /**
     * @param Popup $popup
     * @return mixed
     */
    public function destroy(Popup $popup);

    /**
     * @param Popup $popup
     * @return mixed
     */
    public function syncUrls(Popup $popup);
}
