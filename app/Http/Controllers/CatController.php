<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parentid, Request $request)
    {
        $cats = Cat::whereParent($parentid)->orderBy('id', 'DESC')->paginate(10, ['*'], 'page', $request->page);
        return response($cats);
    }

    public function maincat()
    {
        return ["data" => [

            ["title" => "دستمال", "id" => 1],
            ["title" => "مواد شوینده", "id" => 2],
            ["title" => "شامپو", "id" => 3],
            ["title" => "نوار بهداشتی", "id" => 4],
            ["title" => "خمیر دندان", "id" => 5]


        ]];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function load(Request $request)
     {
        return ["data" => [

            ["title" => "دستمال", "id" => 1],
            ["title" => "مواد شوینده", "id" => 2],
            ["title" => "شامپو", "id" => 3],
            ["title" => "نوار بهداشتی", "id" => 4],
            ["title" => "خمیر دندان", "id" => 5]


        ]];
     }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($parentid, Request $request)
    {

        $newcat = Cat::create([
            'title' => $request['title'],
            'parent' => $parentid
        ]);

        return ["data" => $newcat];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function show(Cat $cat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function edit(Cat $cat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function update($parentid, Cat $Cat, Request $request)
    {



        $Cat->title = $request->title;


        return ["data" => $Cat->save()];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function destroy($parentid, Cat $Cat)
    {

        $rootid = $Cat->id;

        $this->eachChild($rootid, function ($item) {
            $item->delete();
        });

        return ["data" => $Cat->delete()];
    }




    function eachChild($root, $act)
    {

        $ret = array();
        $allsubs = Cat::whereParent($root)->get();


        foreach ($allsubs as $itemsub) {

            $act($itemsub);
            $ret[] = [
                'title' => $itemsub->title,
                'id' => $itemsub->id,
                "children" => $this->eachChild($itemsub->id, $act)
            ];
        }

        return $ret;
    }
}
