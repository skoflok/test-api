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
        $page = Page::find($uuid);

        Stat::create([
            'page_uuid' => $page->uuid
        ]);

        return response('', 200);
    }
}
