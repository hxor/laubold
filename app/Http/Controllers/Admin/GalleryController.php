<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Gallery;
use App\Models\Image;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;

class GalleryController extends Controller
{
    private $bread;

    /**
     * Data For Breadcrumbs
     */
    public function __construct()
    {
        $this->bread = [
            '0' => route('admin'),
            'page-title' => 'Gallery',
            'menu' => 'Admin',
            'submenu' => 'Media',
            'active' => 'Gallery'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        $bread = $this->bread;

        if ($request->ajax()) {
          $galleries = Gallery::select(['id', 'title', 'created_at']);
          return Datatables::of($galleries)
                  ->addColumn('action', function($gallery){
                      return view('layouts.backend.partials.datatable._action', [
                          'model' => $gallery,
                          'form_url' => route('admin.gallery.destroy', $gallery->id),
                          'edit_url' => route('admin.gallery.edit', $gallery->id),
                          'show_url' => route('admin.gallery.show', $gallery->id)
                      ]);
                  })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'ID'])
            ->addColumn(['data' => 'title', 'name' => 'title', 'title' => 'Title'])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'])
            ->addColumn(['data'=>'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>'false']);

        return view('main.backend.gallery.index', compact('bread', 'html'));
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
        // return $request->all();
        $this->validate($request,[
            'title' => 'required'
        ]);

        $data = [
          'title' => $request->title,
          'slug' => str_slug($request->title, '-'),
        ];

        Gallery::create($data);

        notify()->flash('Done!', 'success', [
            'timer' => 1500,
            'text' => 'Gallery successfully added',
        ]);

        return redirect()->route('admin.gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bread = $this->bread;
        $bread[0] = route('admin.gallery.index');

        $gallery = Gallery::findOrFail($id);
        $images = $gallery->images()->paginate(5);
        return view('main.backend.gallery.show', compact('bread', 'gallery', 'images'));
    }

    /**
     * get View Image Upload
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getFormImage($id){
        $bread = $this->bread;
        $bread[0] = route('admin.gallery.show', $id);

        $gallery = Gallery::findOrFail($id);
        return view('main.backend.gallery.image_upload', compact('gallery', 'bread'));
    }

    /**
     * Fungsi Upload Image
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function doUploadImage(Request $request, $id){
        $title = $request->file->getClientOriginalName();
        $path = '/gallery/'.date('mY').'/'.str_slug($request->file->getClientOriginalName(),'-').'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('gallery/'.date('mY')), $path);

        Image::create(['gallery_id' => $id, 'title' => $title, 'image' => $path]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bread = $this->bread;
        $bread[0] = route('admin.gallery.index');
        $gallery = Gallery::findOrFail($id);
        return view('main.backend.gallery.edit', compact('gallery', 'bread'));
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
        $gallery = Gallery::findOrFail($id);

        // return $request->all();
        $this->validate($request,[
            'author' => 'required',
            'title' => 'required'
        ]);

        $gallery->update($request->all());
        notify()->flash('Done!', 'success', [
            'timer' => 1500,
            'text' => 'Gallery successfully edited',
        ]);

        return redirect()->route('admin.gallery.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gallery::destroy($id)) return redirect()->back();

          notify()->flash('Done!', 'success', [
              'timer' => 1500,
              'text' => 'Gallery successfully deleted',
          ]);

          return redirect()->route('admin.gallery.index');
    }

    /**
     * Fungsi Delete Image dan menghapus dari directory
     * @param  [type] $imageId [description]
     * @return [type]          [description]
     */
    public function doImageDestroy($imageId){
        $image = Image::findOrFail($imageId);
        unlink(public_path().$image->image);
        $image->delete();

        notify()->flash('Done!', 'success', [
            'timer' => 1500,
            'text' => 'Image successfully deleted',
        ]);

        return redirect()->route('admin.gallery.show', $image->gallery_id);
    }
}
