<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\Input;
use Session;
class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('image');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        $image=new Image;
        $image->title=Input::get('nume');
        if(Input::hasFile('image')){
            $file=Input::file('image');
            $target=md5(uniqid(time())).$file->getClientOriginalName();
            $file->move(public_path().'/images/',$target);
            $image->name=$target;
            $image->size=$file->getClientsize();
            $image->type=$file->getClientMimeType();
        }
        $image->save();
       // return 'data saved in database';
     return redirect('/');
            
    }

    public function showall()
    {
        $image=Image::all();
        return view('showall', compact('image'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image=Image::findorfail($id);
        return view('show',compact('image'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image=Image::where('id','=',$id)->first();
        return view('edit',['image'=>$image]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $image=Image::findOrFail($id);  
    if ($request->hasFile('image'))
        {
$file=Input::file('image');
$target=md5(uniqid(time())).$file->getClientOriginalName();
$file->move(public_path().'/images/',$target);
$image->name=$target;                            
        }   
             $image->id = $request['id'];
             $image->title = $request['title'];

          $image->save();             
      return redirect('/'); 
        }

public function delete($id){
    $image=Image::where('id','=',$id)->first();
    if($image->delete()){
    Session::flash('message','Record was deleted');
    return redirect('/');
    }else{
        Session::flash('message','Error!Please try again!');
        return redirect('/');
    }
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

/*
 * $sql2="SELECT * FROM images WHERE ID='{$_POST['id']}'"; 
           $result2=mysqli_query($con, $sql2);
            $rec=  mysqli_fetch_array($result2);
           
            $title=$_POST['title'];
           if(isset($_POST['image'])){
           $target="./images/".basename($_FILES['image']['name']);
           }else{
           $target=$rec['image'];
           echo $target;
           } 
$sql1="UPDATE images SET title='{$title}', image='{$target}' WHERE id='{$_POST['id']}'";
           mysqli_query($con, $sql1) or die(mysqli_error($con));
           move_uploaded_file($_FILES['image']['tmp_name'],$target);
          header('Location:index.php');
 */