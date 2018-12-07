<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Img;
use App\Post;
use App\News_to_category;
use App\News_to_site;



class AdminNewsController extends Controller
{

    public function news_select($site_id){
        $result=Post::where('site_id', $site_id)->orderBy('id', 'desc')->select('id', 'title as label')->get();
        return response()->json(
            ['success'=>$result]
        );
    }

    public function index1($site_id, $cat_id=null)
    {
        extract(request()->only(['query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn']));
        $result=Post::with(['Category', 'Site'])->where('site_id', $site_id);
        if(!is_null($cat_id)){
            $result->join('news_to_category', 'news_to_category.post_id', '=', 'posts.id')->select('posts.*')->where('news_to_category.cat_id', $cat_id);
        }
        if (isset($query) && $query) {
            $result = $byColumn == 1 ?
                $this->filterByColumn($result, $query) :
                $this->filter($result, $query, ['title',  'type', 'status', 'is_primary','main_site_publish']);
        }

        if (isset($orderBy)) {
            $direction = $ascending == 1 ? 'ASC' : 'DESC';
            $result = $result->orderBy($orderBy, $direction);
        } else {
            $result = $result->orderBy('id', 'desc');
        }

        $result = $result->paginate($limit);
        return response()->json(
            ['success'=>$result]
        );
    }

    public function sub_news_publish(){
        extract(request()->only(['query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn']));
        $result=Post::where('site_id', '!=','0')->where('main_site_publish', '!=', '0');

        if (isset($query) && $query) {
            $result = $byColumn == 1 ?
                $this->filterByColumn($result, $query) :
                $this->filter($result, $query, ['title',  'site_id', 'main_site_publish']);
        }

        if (isset($orderBy)) {
            $direction = $ascending == 1 ? 'ASC' : 'DESC';
            $result = $result->orderBy($orderBy, $direction);
        } else {
            $result = $result->orderBy('id', 'desc');
        }

        $result = $result->paginate($limit);
        return response()->json(
            ['success'=>$result]
        );
    }

    protected function filterByColumn($data, $queries)
    {
        $queries = json_decode($queries);
        return $data->where(function ($q) use ($queries) {
            foreach ($queries as $field => $query) {
                if (is_string($query)) {
                    $in=['site_id', 'type','status', 'is_primary', 'main_site_publish'];
                    if(in_array($field, $in)){
                        $q->where($field,  "{$query}");
                    } else {
                        $q->where($field, 'LIKE', "%{$query}%");
                    }
                }
            }
        });
    }

    protected function filter($data, $query, $fields)
    {
        return $data->where(function ($q) use ($query, $fields) {
            foreach ($fields as $index => $field) {
                $method = $index > 0 ? 'orWhere' : 'where';
                $in=['site_id', 'type','status', 'is_primary', 'main_site_publish'];
                if(in_array($field, $in)){
                    $q->{$method}($field,  "{$query}");
                } else {
                    $q->{$method}($field, 'LIKE', "%{$query}%");
                }
            }
        });
    }

    public function show($id){
        $post=Post::find($id);

        $category=[];
        $cats=News_to_category::where('post_id', $post->id)->get();
        foreach ($cats as $cat){$category[]=$cat->cat_id;}
        $post->category=$category;

        $psites=[];
        $sites=News_to_site::where('post_id', $post->id)->get();
        foreach ($sites as $site){$psites[]=$site->site_id;}
        $post->site=$psites;

        return response()->json(
            ['success'=>$post]
        );
    }





    public function store(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);

        if($request->hasFile('image')){
            $data['image'] =Img::upload($request);
        }else{
            if($data['type']=='2') {
                $data['image'] = $data['youtube'];
            } else {
                $data['image'] = null;
            }

        }


        $post= new Post();

        $post->image=$data['image'];
        $post->site_id=$data['site_id'];
        $post->admin_id=$data['admin_id'];
        $post->title=$data['title'];
        $post->content=$data['content'];
        $post->short_content=$data['short_content'];
        $post->type=$data['type'];
        $post->status=$data['status'];
        $post->is_primary=$data['is_primary'];
        $post->main_site_publish=$data['main_site_publish'];
        $post->save();

        $this->save_to_category($data['cat_id'],$post->id);
        $this->save_to_sites($data['sites'],$post->id);

        return response()->json([ 'success' => 1 ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        $post= Post::find($id);

        if($request->hasFile('image')){
            $post->image = Img::upload($request);
        } else {
            if($data['type']=='2') {
                $post->image = $data['youtube'];
            }
        }

        $post->site_id=$data['site_id'];
        $post->admin_id=$data['admin_id'];
        $post->title=$data['title'];
        $post->content=$data['content'];
        $post->short_content=$data['short_content'];
        $post->type=$data['type'];
        $post->status=$data['status'];
        $post->is_primary=$data['is_primary'];
        $post->main_site_publish=$data['main_site_publish'];
        $post->save();

        News_to_category::where('post_id', $id)->delete();
        $this->save_to_category($data['cat_id'],$id);
        News_to_site::where('post_id', $id)->delete();
        $this->save_to_sites($data['sites'],$id);

        return response()->json([ 'success' => 1 ]);
    }

    public function save_to_sites($sites, $post_id){
        foreach ($sites as $site){
            $toSite=new News_to_site();
            $toSite->post_id=$post_id;
            $toSite->site_id=$site;
            $toSite->save();
        }
    }

    public function save_to_category($cats, $post_id){
        foreach ($cats as $cat){
            $toCat=new News_to_category();
            $toCat->post_id=$post_id;
            $toCat->cat_id=$cat;
            $toCat->save();
        }
    }


    public function change_primary(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);
        $post = Post::find($data['id']);
        $post->is_primary=$data['flg'];
        $post->save();
    }

    public function change_status(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);
        $post = Post::find($data['id']);
        $post->status=$data['flg'];
        $post->save();
    }

    public function main_site_publish(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);
        $post = Post::find($data['id']);
        $post->main_site_publish=$data['flg'];
        $post->save();
    }

    public function destroy($id)
    {
        $post=Post::find($id);
        if(!is_null($post->image)){
            Img::deleteImg($post->image);
        }
        $post->delete();
        News_to_category::where('post_id', $id)->delete();
    }

}
