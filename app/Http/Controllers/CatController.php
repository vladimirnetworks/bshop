<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Relish;
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function catload(Request $request)
    {

        $ret = array();

        if ($request->type == 'index') {
            $cats = Cat::whereParent(0)->orderBy('id', 'DESC')->paginate(10, ['*'], 'page', 0);


            foreach ($cats as $cat) {
                $ret[] = ["title" => $cat->title, "id" => $cat->id];
            }
        }


        if ($request->type == 'relateto') {

            $rels = Relish::whereProductId($request->id)->orderBy('cat_id','ASC')->first();

           // dd($rels);

          // $catt = Cat::whereId($rels->cat_id)->first();


          $cats = array();
          if (isset($rels->cat_id)) {
            $cats = Cat::whereParent($rels->cat_id)->orderBy('id', 'DESC')->get();
          }

          if (!count($cats)) {
            $cats = Cat::whereId($rels->cat_id)->orderBy('id', 'DESC')->get();
          }
         
         

          /*  $catsid = array();
            foreach ($rels as $rel) {
                $catsid[] = $rel->cat_id;
            }
            */
        

            //$cats = Cat::whereIn('id', $catsid)->get();

            foreach ($cats as $cat) {
                $ret[] = ["title" => $cat->title, "id" => $cat->id];
            }

        }


        $ret = [];

        return ["data" => $ret];
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


     
        Relish::whereCatId($Cat->id)->delete();

        $this->eachChild($rootid, function ($item) {

            Relish::whereCatId($item->id)->delete();
            $item->delete();
        });

        return ["data" => $Cat->delete()];
    }


    public function oneLevelChild($rootid , Request $request)
    {

        $allsubs = Cat::whereParent($rootid)->orderBy('id', 'DESC')->paginate(10, ['*'], 'page', $request->page);
        return  $allsubs;
      
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
