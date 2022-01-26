<?php

namespace Dawnstar\Popup\Repositories;

use Dawnstar\Core\Models\Website;
use Dawnstar\Popup\Models\Popup;
use Dawnstar\Popup\Contracts\PopupInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class PopupRepository
 * @package Dawnstar\Popup\Repositories
 */
class PopupRepository implements PopupInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Popup::with('translation')->get();
    }
    /**
     * @return Collection
     */
    public function getByWebsite(Website $website): Collection
    {
        return Popup::where('website_id', $website->id)->with('translation')->get();
    }

    /**
     * @param int $id
     * @return Popup
     */
    public function getById(int $id): Popup
    {
        return Popup::find($id);
    }

    /**
     * @return Popup
     */
    public function store(): Popup
    {
        $data = request()->except(['_token', 'translations', 'languages', 'urls']);

        $data['website_id'] = session('dawnstar.website.id');

        $popup = Popup::create($data);
        $this->syncUrls($popup);

        return $popup;
    }

    /**
     * @param Popup $popup
     * @return Popup
     */
    public function update(Popup $popup): Popup
    {
        $data = request()->except(['_token', '_method', 'translations', 'languages', 'urls']);

        $popup->update($data);
        $this->syncUrls($popup);

        return $popup;
    }

    /**
     * @param Popup $popup
     * @return mixed|void
     */
    public function destroy(Popup $popup)
    {
        $popup->delete();
    }

    /**
     * @param Popup $popup
     * @return mixed|void
     */
    public function syncUrls(Popup $popup)
    {
        $urls = request('urls', []);
        $popup->urls()->sync($urls);
    }
}
