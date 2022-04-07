<?php

namespace Dawnstar\Popup\Repositories;

use Dawnstar\Popup\Contracts\PopupTranslationInterface;
use Dawnstar\Popup\Models\Popup;
use Dawnstar\Popup\Models\PopupTranslation;

/**
 * Class PopupTranslationRepository
 * @package Dawnstar\Popup\Repositories
 */
class PopupTranslationRepository implements PopupTranslationInterface
{
    /**
     * @param Popup $popup
     * @return mixed|void
     */
    public function store(Popup $popup)
    {
        $languages = request('languages');
        $translations = request('translations');

        foreach ($translations as $languageId => $translation) {
            $translation['popup_id'] = $popup->id;
            $translation['language_id'] = $languageId;
            $translation['status'] = $languages[$languageId];

            PopupTranslation::create($translation);
        }
    }

    /**
     * @param Popup $popup
     * @return mixed|void
     */
    public function update(Popup $popup)
    {
        $languages = request('languages');
        $translations = request('translations');

        foreach ($translations as $languageId => $translation) {

            PopupTranslation::updateOrCreate(
                [
                    'popup_id' => $popup->id,
                    'language_id' => $languageId,
                    'status' => $languages[$languageId],
                ],
                $translation
            );
        }
    }
}
