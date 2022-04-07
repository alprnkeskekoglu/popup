<?php

namespace Dawnstar\Popup\Http\Controllers;

use Dawnstar\Core\Models\Url;
use Dawnstar\Popup\Models\Popup;
use Dawnstar\Popup\Http\Requests\PopupRequest;
use Dawnstar\Popup\Repositories\PopupRepository;
use Dawnstar\Popup\Repositories\PopupTranslationRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PopupController extends Controller
{
    protected PopupRepository $popupRepository;
    protected PopupTranslationRepository $popupTranslationRepository;

    public function __construct(PopupRepository $popupRepository, PopupTranslationRepository $popupTranslationRepository)
    {
        $this->popupRepository = $popupRepository;
        $this->popupTranslationRepository = $popupTranslationRepository;
    }

    public function index()
    {
        $popups = $this->popupRepository->getByWebsite(session('dawnstar.website'));

        return view('Popup::index', compact('popups'));
    }

    public function create()
    {
        $urls = $this->getUrls();

        return view('Popup::create', compact('urls'));
    }

    public function store(PopupRequest $request)
    {
        $popup = $this->popupRepository->store();
        $this->popupTranslationRepository->store($popup);

        return redirect()->route('dawnstar.popups.index')->with(['success' => __('Popup::general.success.store')]);
    }

    public function edit(Popup $popup)
    {
        $urls = $this->getUrls();
        $selectedUrls = $popup->urls()->pluck('id')->toArray();
        $activeLanguageIds = $popup->translations()->pluck('status', 'language_id')->toArray();

        return view('Popup::edit', compact('popup', 'urls', 'selectedUrls', 'activeLanguageIds'));
    }

    public function update(Popup $popup, PopupRequest $request)
    {
        $popup = $this->popupRepository->update($popup);
        $this->popupTranslationRepository->update($popup);

        return redirect()->route('dawnstar.popups.index')->with(['success' => __('Popup::general.success.update')]);
    }

    public function destroy(Popup $popup)
    {
        $this->popupRepository->destroy($popup);

        return redirect()->route('dawnstar.popups.index')->with(['success' => __('Popup::general.success.destroy')]);
    }

    public function getUrls()
    {
        return Url::where('website_id', session('dawnstar.website.id'))
            ->whereHas('model')
            ->where('type', 1)
            ->pluck('url', 'id')
            ->toArray();
    }
}
