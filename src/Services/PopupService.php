<?php

namespace Dawnstar\Popup\Services;

use Carbon\Carbon;
use Dawnstar\Core\Foundation\Dawnstar;
use Dawnstar\Popup\Models\Popup;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

/**
 * Class PopupService
 * @package Dawnstar\Popup\Services
 */
class PopupService
{
    /**
     * @var Dawnstar|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected Dawnstar $dawnstar;
    /**
     * @var false|string
     */
    protected $date;

    /**
     * PopupService constructor.
     */
    public function __construct()
    {
        $this->dawnstar = dawnstar();
        $this->date = date('Y-m-d');
    }

    /**
     * @return string
     */
    public function init(): string
    {
        $popups = $this->getPopups();

        $html = '';
        foreach ($popups as $popup) {
            if($this->setLimit($popup)) {
                continue;
            }

            $html .= view('PopupWeb::types.' . $popup->type, compact('popup'))->render();
        }

        return $html;
    }

    /**
     * @return Collection
     */
    private function getPopups(): Collection
    {
        $device = $this->getDevice();

        return Popup::where('status', 1)
            ->where('website_id', $this->dawnstar->website->id)
            ->whereHas('translation')
            ->where(function ($q) {
                $q->where('start_date', null)
                    ->orWhere('start_date', '<=', $this->date);
            })
            ->where(function ($q) {
                $q->where('end_date', null)
                    ->orWhere('end_date', '>=', $this->date);
            })
            ->where('devices', 'like', "%{$device}%")
            ->where(function ($q) {
                $q->where('display', 1)
                    ->orWhere(function ($query) {
                        $isHomePage = $this->dawnstar->container->key == 'homepage' ? 1 : 0;
                        $query->where('display', 2)->where(DB::raw(1), $isHomePage);
                    })
                    ->orWhere(function ($query) {
                        $query->where('display', 3)
                            ->whereHas('urls', function ($que) {
                                $que->where('id', $this->dawnstar->url->id);
                            });
                    });
            })
            ->with('urls', 'translation')
            ->orderBy('order')
            ->get();
    }

    /**
     * @return string
     */
    private function getDevice(): string
    {
        $agent = new Agent();
        return $agent->deviceType();
    }

    #region Helpers

    /**
     * @param Popup $popup
     * @return bool
     */
    private function setLimit(Popup $popup): bool
    {
        if($popup->limit == 2) {
            $sessionData = session('_dapo', []);
            if(isset($sessionData[$popup->id])) {
                if($sessionData[$popup->id] >= $popup->limit_count) {
                    return true;
                }
                $sessionData[$popup->id]++;
            } else {
                $sessionData[$popup->id] = 1;
            }
            session(['_dapo' => $sessionData]);

        } elseif($popup->limit == 3) {
            $cookieData = \Cookie::get('_dapo') ? decrypt(\Cookie::get('_dapo')) : [];
            $minutes = 60*24*30;

            if(isset($cookieData[$popup->id])) {
                if($cookieData[$popup->id] >= $popup->limit_count) {
                    return true;
                }
                $cookieData[$popup->id]++;
            } else {
                $cookieData[$popup->id] = 1;
            }

            Cookie::queue(Cookie::make('_dapo', encrypt($cookieData), $minutes));
        }

        return false;
    }
    #endregion
}
