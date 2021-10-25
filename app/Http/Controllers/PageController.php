<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Stat;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        /**
         * [LH REVIEW] 
         * 1) А если нет этой странице в модели? Что отдавать? Ларавель многое делает за "спиной", не всегда это удобно. Теряется контроль над логикой.
         * т.е. вначале нужно зайти на ресурс по созданию страницы и после уже на показ страницы.
         * 2) Если мы говорим в доках про uuid, то и валидация должна быть на uuid
         */
        $page = Page::find($uuid);

        Stat::create([
            'page_uuid' => $page->uuid
        ]);

        /**
         * [LH REVIEW] Хотелось бы чуть подробнее в выводе. 
         * Как писал в routes/web.php можно было сделать в АПИ и отдавать json {"success": true, "message":"view increment"} или что-то подобное.
         * 
         */
        return response('', 200);
    }
}
