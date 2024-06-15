<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Model\Media;
use Config;
use File;
use Illuminate\Http\Request;
use Image;
use Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $image_allowed_mimes = ['image/bmp', 'image/gif', 'image/jpeg', 'image/tiff', 'image/png'];

    private $default_storage_path;

    private $file_base_url;

    private $record_per_page = 8;

    public function __construct()
    {

        $this->default_storage_path = storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'media');

        $this->file_base_url = Storage::url('media');

        if (! file_exists($this->default_storage_path)) {
            mkdir($this->default_storage_path, '0777', true);
        }
    }

    public function index()
    {
        return view('admin.media.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->upl;
        $type = $request->attachment_type;

        $mime = $file->getClientMimeType();

        switch ($request->attachment_type) {
            case 'image':  if (! in_array($mime, $this->image_allowed_mimes)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Mime-Type not allowed',
                ]);
            }

                // resize image
                $image_sizes = Config::get('custom.media.image_sizes');

                $media = null;
                try {
                    $media = $this->saveImage($file, $type);
                    $primary_media_id = $media->id;
                } catch (Exception $e) {
                    return response()->json([
                        'success' => false,
                        'error' => $e->getMessage(),
                    ]);
                }

                foreach ($image_sizes as $key => $value) {

                    $child = [];
                    $child['image_size'] = $key;
                    $child['height'] = $value['height'];
                    $child['width'] = $value['width'];
                    $child['crop'] = $value['crop'];

                    $this->saveImage($file, $type, $child, $primary_media_id);
                }

                return response()->json([
                    'success' => true,
                    'data' => [
                        'media_id' => $primary_media_id,
                        'thumbnail' => $this->getItem($primary_media_id, 'thumbnail'),
                    ],
                ]);

                break;
        }
    }

    public function saveImage($file, $type, $resize = [], $parent = null)
    {

        // $category_image=$request[$filename];
        // $category_image_name=rand(1000000000,9999999999).'.'.$category_image->getClientOriginalExtension();

        $image = Image::make($file->getRealPath());

        $file_name_without_extension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        if (empty($resize)) {

            $filename = $this->getUniqueName($file_name_without_extension, $file->getClientOriginalExtension());

            $media_url = $this->file_base_url.'/'.$filename;

            $file_size = $file->getSize();
            $path = $this->default_storage_path.DIRECTORY_SEPARATOR.$filename;

            $output = $image->save($path);

            $media = Media::create([
                'type' => $type,
                'added_by' => 1,
                'name' => $filename,
                'path' => $path,
                'description' => $filename,
                'height' => $image->height(),
                'width' => $image->width(),
                'url' => $media_url,
                'kilobyte' => $file_size,
            ]);

            return $media;

        } else {

            $filename = $this->getUniqueName($file_name_without_extension.'_'.$resize['width'].'x'.$resize['height'], $file->getClientOriginalExtension());

            $media_url = $this->file_base_url.'/'.$filename;

            $file_size = $file->getSize();
            $path = $this->default_storage_path.DIRECTORY_SEPARATOR.$filename;

            //Crop and resize the image
            if ($resize['crop']) {

                $image->fit($resize['width'], $resize['height'], function ($constraint) {
                    $constraint->upsize();
                });

            } else {

                $image->resize($resize['width'], $resize['height'], function ($constraint) {
                    $constraint->aspectRatio();
                });

            }

            $output = $image->save($path);

            //Save media to database
            $media = Media::create([
                'type' => $type,
                'added_by' => 1,
                'name' => $filename,
                'path' => $path,
                'description' => $filename,
                'parent' => $parent,
                'height' => $resize['height'],
                'image_size' => $resize['image_size'],
                'width' => $resize['width'],
                'url' => $media_url,
                'kilobyte' => $file_size,
            ]);

            return $media;

        }

        // if($childData != null){
        //     $width = $childData['width'];
        //     $height = $childData['height'];
        //     $category_image_resize->resize($width,$height);
        //     $id = $childData['id'];
        //     $image_size = $childData['image_size'];
        // }else{
        //     $width = $category_image_resize->width();
        //     $height = $category_image_resize->height();
        //     $image_size = 'original';
        //     $id = '';
        // }

        // $image_path = $path.$image_size.'/'.$category_image_name;
        // if (!File::exists($path . $image_size)) {
        //     File::makeDirectory($path . $image_size, 0775, true, true);
        // }

        // $category_image_resize->save(public_path($image_path));
        // $byte = $category_image_resize->filesize();
        // $kilobyte = $this->formatBytes($byte, $precision = 2);

        // $media = Media::create(['type'=> $type,
        // 'name'=>$request['name'],
        // 'path'=> $image_path,
        // 'description'=>$request['description'],
        // 'parent'=>$id,
        // 'image_size'=>$image_size,
        // 'height'=>$width,
        // 'width'=>$height,
        // 'kilobyte'=>$kilobyte]);

        // return $media;
    }

    // public function saveImage($type,$path,$filename,$request,$childData){

    //     $category_image=$request[$filename];
    //     $category_image_name=rand(1000000000,9999999999).'.'.$category_image->getClientOriginalExtension();

    //     $category_image_resize = Image::make($category_image->getRealPath());

    //     if($childData != null){
    //         $width = $childData['width'];
    //         $height = $childData['height'];
    //         $category_image_resize->resize($width,$height);
    //         $id = $childData['id'];
    //         $image_size = $childData['image_size'];
    //     }else{
    //         $width = $category_image_resize->width();
    //         $height = $category_image_resize->height();
    //         $image_size = 'original';
    //         $id = '';
    //     }

    //     $image_path = $path.$image_size.'/'.$category_image_name;
    //     if (!File::exists($path . $image_size)) {
    //         File::makeDirectory($path . $image_size, 0775, true, true);
    //     }

    //     $category_image_resize->save(public_path($image_path));
    //     $byte = $category_image_resize->filesize();
    //     $kilobyte = $this->formatBytes($byte, $precision = 2);

    //     $media = Media::create(['type'=> $type,
    //     'name'=>$request['name'],
    //     'path'=> $image_path,
    //     'description'=>$request['description'],
    //     'parent'=>$id,
    //     'image_size'=>$image_size,
    //     'height'=>$width,
    //     'width'=>$height,
    //     'kilobyte'=>$kilobyte]);

    //     return $media;
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Media::where(['id' => $id])->first();
        $dataChilds = Media::where(['parent' => $id])->get();

        if (File::exists($data->path)) {
            File::delete($data->path);
        }
        foreach ($dataChilds as $child) {
            if (File::exists($child->path)) {
                File::delete($child->path);
            }
        }

        $media = Media::where(['id' => $id])->orWhere(['parent' => $id])->delete();

        return response()->json(['success' => true, 'msg' => 'Deleted successfully!'], 200);
    }

    public function formatBytes($size, $precision)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = [' bytes', ' KB', ' MB', ' GB', ' TB'];

            return round(pow(1024, $base - floor($base)), $precision).$suffixes[floor($base)];
        } else {
            return $size;
        }
    }

    public function getUniqueName($name, $extension)
    {

        $path = $this->default_storage_path;

        $new_name = $name;

        $counter = 1;
        while (1) {
            if (! file_exists($path.DIRECTORY_SEPARATOR.$new_name.'.'.$extension)) {
                return $new_name.'.'."$extension";
            }

            $new_name = $name.'_'.$counter++;
        }

    }

    public function getItem($id, $size = null)
    {
        // dd($id);
        // $response = array();

        if (is_null($size)) {
            $response = Media::with('children')->where('id', $id)->first()->toArray();
        } else {
            $response = Media::with('children')->where('id', $id)->first()->children()->where('image_size', $size)->first()->toArray();
        }

        if ($response) {
            return $response;
        } else {
            return false;
        }
    }

    public function getAll(Request $request, $size = null)
    {
        if (is_null($size)) {
            $media = Media::where('parent', null)->latest()->paginate($this->record_per_page);
        } else {

            $media = Media::where('parent', null)
                ->with(['children' => function ($q) use ($size) {
                    $q->where('image_size', $size);
                }])
                ->paginate($this->record_per_page);
        }

        return response()->json($media);

    }

    public function createUrl($name, $extension)
    {

        $path = $this->default_storage_path;

        $new_name = $name;

        $counter = 1;
        while (1) {
            if (! file_exists($path.DIRECTORY_SEPARATOR.$new_name.'.'.$extension)) {
                return $new_name.'.'."$extension";
            }

            $new_name = $name.'_'.$counter++;
        }

    }
}
