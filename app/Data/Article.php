<?php
//Статьи
//Сохраняем / кэшируем только то, что в последствии используем 
namespace App\Data;

use App\Data\Subsidiary\InterfaceData;
use App\Model\Articles;
use Illuminate\Support\Facades\Cache;

class Article implements InterfaceData
{
    protected $store = 'article';

    public function clear()
    {
        Cache::store($this->store)->flush();
    }
    
    public function clearById($id){
        Cache::store($this->store)->forget($id);
    }
    
    public function getArticle($id){
        return Cache::store($this->store)->rememberForever(
            $id,
            function() use ($id){
                $article_model = new Articles();
                $article = $article_model
                    -> published()
                    -> getById($id)
                    -> with('tags','category')
                    -> first();                
                $data = [
                    'id'            =>  $article->id,
                    'title'         =>  $article->title,
                    'curl'          =>  $article->curl,
                    'keywords'      =>  $article->meta_keywords,
                    'description'   =>  $article->meta_description,
                    'content'       =>  $article->content,
                    'created_at'    =>  $article->created_at,
                    'updated_at'    =>  $article->updated_at,
                    'is_comments'   =>  $article->comments_enable,
                    'category'      =>  [
                        'id'    => $article->category->id,
                        'name'  => $article->category->name,
                        'curl'  => $article->category->curl,
                    ]
                ];
                foreach($article->tags as $tag){
                    $data['tags'][] = [
                        'id'    =>  $tag->id,
                        'name'  =>  $tag->name,
                        'curl'  =>  $tag->curl,
                    ];
                }
                return $data;
            }
        );
    }
}