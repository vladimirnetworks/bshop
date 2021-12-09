<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Product;
use App\Models\Relish;
use Illuminate\Http\Request;
use \Gumlet\ImageResize;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexxv(Request $request)
    {


        $prods = Product::orderBy('id', 'DESC')->paginate(20, ['*'], 'page', $request->page);


      /*  $prods->each(function ($item) {

            $phot = json_decode($item->photos, true);


            if (isset($phot[0])) {
                $item->photo = $phot[0]['medium'];
            }


            $item->jsondata = str_replace('','',json_encode([

                "id"=>$item->id,
                "title"=>$item->title,
                "tinytitle"=>$item->tinytitle,
                "price"=>$item->price,
                "caption"=>lize($item->caption),
                "photos"=>$phot,
                

            ]));

        });
*/

   


        return  $prods;
        /*
        return [
            "data" => [
                ["title" => "1"],
                ["title" => "2"]
            ]
        ];
        */
    }


    public function indecat($catid, Request $request)
    {

     $rel = Relish::whereCatId($catid)->orderBy('product_id', 'DESC')->paginate(10, ['*'], 'page', $request->page);
   
     $prdid = [];
     foreach ($rel as $rl) {
          $prdid[] = $rl['product_id'];
     }

     return ["data"=>Product::findMany($prdid)];

    }


    public function relateto($prodid)
    {
        $rels = Relish::whereProductId($prodid)->orderBy('cat_id','ASC')->get(['cat_id']);


        $cats = array();
        foreach ($rels as $rel) {
           $cats[] = $rel->cat_id;
        }

       

      /* $cats = array();
       if (isset($rels->cat_id)) {
         $xcats = Cat::whereParent($rels->cat_id)->orderBy('id', 'DESC')->get();

          foreach ($xcats as $catt) {
            $cats[] = $catt->id;
          }

       }

      
         $cats[] = $rels->cat_id;
       
      */

       $rels = Relish::whereIn('cat_id',$cats)->get(['product_id']);

    
       
       foreach ($rels as $hprodid) {
          // if ($hprodid->product_id != $prdid) {

            if ($hprodid->product_id != $prodid) {
                $prd[] = $hprodid->product_id;
            }
            
          // }
        
       }
      
       return ["data"=>Product::findMany($prd)];


    }

    public function index(Request $request)
    {
        //
        //header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Methods: *');
        //header('Access-Control-Allow-Headers: *');

        $targets = Product::orderBy('id', 'DESC')->paginate(20, ['*'], 'page', $request->page);


        return response($targets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # header('Access-Control-Allow-Methods: *');
        # header('Access-Control-Allow-Headers: *');





        $sgal = [];
        foreach ($request->gal as $gal) {

          
            if (strtolower(substr($gal['small'], 0, 10)) == 'data:image') {

                do {

                    $basefname = rand(0, 99999999) . '.jpg';
                    $fname = "photos/" . $basefname;


                } while (file_exists($fname));


                $data = explode(',', $gal['small']);


                $image = ImageResize::createFromString(base64_decode($data[1]));
                $image->save("photos/" . $basefname);

                $image = ImageResize::createFromString(base64_decode($data[1]));
                $image->scale(50);
                $image->save("photos/medium_".$basefname);
                
                $image = ImageResize::createFromString(base64_decode($data[1]));
                $image->scale(25);
                $image->save("photos/small_".$basefname);
                

                /*$ifp = fopen($fname, 'wb');

                $data = explode(',', $gal['small']);
                fwrite($ifp, base64_decode($data[1]));
                fclose($ifp);
                */


                $sgal[] = [
                    "big" => $fname,
                    "medium" => "photos/medium_".$basefname,
                    "small" => "photos/small_".$basefname
                ];




            } else {

                $sgal[] = $gal;
            }
        }

        $photos = json_encode($sgal);



        $newprod = Product::create([
            'title' => $request['title'], 'tinytitle' => $request['tinytitle'],
            'price' => $request['price'],
            'photos' =>  $photos,
            "caption" => $request['caption'],"searchkey" => $request['searchkey']
        ]);

        return ["data" => $newprod];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $photo  = json_decode($product->photos, true);

        if (isset($photo[0])) {
            $photo = $photo[0]['medium'];
        } else {
            $photo = "";
        }

        return view("singleProduct", ["pageTitle" => $product->title, "product" => $product, "photo" => $photo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $Product)
    {
        //header('Access-Control-Allow-Origin: *');
        //header('Access-Control-Allow-Methods: *');
        //header('Access-Control-Allow-Headers: *');

        $Product->title = $request->title;
        $Product->price = $request->price;
        $Product->caption = $request->caption;
        $Product->tinytitle = $request->tinytitle;
        $Product->searchkey = $request->searchkey;

        $sgal = [];
        foreach ($request->gal as $gal) {

            if (strtolower(substr($gal['small'], 0, 10)) == 'data:image') {

                do {

                    $basefname = rand(0, 99999999) . '.jpg';
                    $fname = "photos/" . $basefname;


                } while (file_exists($fname));


                $data = explode(',', $gal['small']);


                /*$ifp = fopen($fname, 'wb');

                $data = explode(',', $gal['small']);
                fwrite($ifp, base64_decode($data[1]));
                fclose($ifp);
*/

                $image = ImageResize::createFromString(base64_decode($data[1]));
                $image->save("photos/" . $basefname);

                $image = ImageResize::createFromString(base64_decode($data[1]));
                $image->scale(50);
                $image->save("photos/medium_".$basefname);
                
                $image = ImageResize::createFromString(base64_decode($data[1]));
                $image->scale(25);
                $image->save("photos/small_".$basefname);

           
             



                $sgal[] = [
                    "big" => $fname,
                    "medium" => "photos/medium_".$basefname,
                    "small" => "photos/small_".$basefname
                ];
            } else {



                if ($gal['big'] == $gal['medium']) {

                    $image = new ImageResize($gal['big']);
                    $image->scale(50);
                    $image->save(str_replace("photos/","photos/medium_",$gal['big']));
                    

                    $image = new ImageResize($gal['big']);
                    $image->scale(25);
                    $image->save(str_replace("photos/","photos/small_",$gal['big']));

                    $gal['medium'] = str_replace("photos/","photos/medium_",$gal['medium']);
                    $gal['small'] = str_replace("photos/","photos/small_",$gal['small']);

                    $sgal[] = $gal;

                } else {
                $sgal[] = $gal;
                }






            }
        }

        $Product->photos = json_encode($sgal);


        Relish::whereProductId($Product->id)->delete();

       

        $cats = [];

        foreach ($request->cat as $cat) {
            $cats[] = $cat;        
            $cats = array_merge($cats,Cat::AllParent($cat));
        }

        $cats = array_unique($cats);

        foreach ($cats as $cat) {
            Relish::create([
                "product_id"=>$Product->id,
                "cat_id"=>$cat
            ]);
        }

        return ["data" => $Product->save(),"test"=>$cats];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $Product)
    {
        return ["data" => $Product->delete()];
    }
}
