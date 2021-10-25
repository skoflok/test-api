<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $uuids = $request->input('uuids');
        $uuids = $uuids ? explode(',', $uuids) : [];

        /**
         * [LH REVIEW] 
         * Прямой вывод из БД лучше не возвращать. 
         * Ларавель преобразовывает коллекции в массив, но для поддержки 
         * и читаемости лучше вынести в Illuminate\Http\Resources\Json\ResourceCollection и 
         * Illuminate\Http\Resources\Json\JsonResource. Либо своё представление данных написать. 
         */
        return DB::table('stats')
            ->select(DB::raw('page_uuid, count(page_uuid) as stats'))
            ->where(function ($query) use ($uuids){
                if ( $uuids ) {
                    $query->whereIn('page_uuid', $uuids);
                }
            })
            ->groupBy('page_uuid')
            ->orderBy('stats', 'DESC')
            ->paginate(4);
    }

    public function top(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'day' => 'integer|min:1',
        ]);

        if ($validator->fails()) {
            return response(
                $validator->errors(),
                400
            );
        }

        $day = $request->input('day') ?? '';

        $date = new DateTime(date('Y-m-d'));
        if ( $day ) {
            $date->modify('-' . $day . ' day');
        }

        return DB::table('stats')
            ->select(DB::raw('page_uuid, count(page_uuid) as stats'))
            ->where(function ($query) use ($day, $date){
                if ( $day ) {
                    $query->where('created_at', '>=', $date->format('Y-m-d H:i:s'));
                }
            })
            ->groupBy('page_uuid')
            ->orderBy('stats', 'DESC')
            ->take(3)
            ->get('json');
    }
}
