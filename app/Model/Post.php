<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $fillable = [
        'title_en',
        'title_ru',
        'title_uz',
        'content_en',
        'content_ru',
        'content_uz',
        'description_en',
        'description_ru',
        'description_uz',
        'image',
    ];
    const IS_PUBLIC = 0;
    const IS_DRAFT = 1;
    const IS_FEATURED = 1;
    const IS_STANDART = 0;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getCategoryTitle()
    {
        return ($this->category != null)
            ?   $this->category->title
            :   'Нет категории';
    }

    public function getTagsTitlesArray()
    {
        if (!$this->tags->isEmpty()) {
            $tags['en'] = $this->tags;
            $tags['ru'] = $this->tags;
            $tags['uz'] = $this->tags;
            return $tags;
        }
    }
    public function getTagsTitlesString()
    {
        if (!$this->tags->isEmpty()) {
            $tags['en'] = implode(', ' , $this->tags->pluck('title_en')->all());
            $tags['ru'] = implode(', ' , $this->tags->pluck('title_ru')->all());
            $tags['uz'] = implode(', ' , $this->tags->pluck('title_uz')->all());
            return $tags;
        }
        return 'Нет тегов';
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'post_tags',
            'post_id',
            'tag_id'
        );
    }

    public static function add($fields)
    {
        $post = new static;
        $post->fill($fields);
        $post->user_id = Auth::user()->id;
        $post->save();
        return $post;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function uploadImage($image)
    {
        if($image == null) return;
        $this->removeImage();
        $filename = str_random(10) .'.'. $image->extension();
        $image->storeAs('public', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function remove($id)
    {
        DB::table('post_tags')->where('post_id', $id)->delete();
        $this->removeImage();
        $this->delete();
    }

    public function removeImage()
    {
        if($this->image != null) {
            Storage::delete('/public/' . $this->image);
        }
    }

    public function setCategory($id)
    {
        if($id == null) return;
        $this->category_id = $id;
        $this->save();
    }

    public function setTags($ids)
    {
        if($ids == null) return;
        $this->tags()->sync($ids);
    }

    public function setDraft()
    {
        $this->status = self::IS_DRAFT;
        $this->save();
    }

    public function setPublic()
    {
        $this->status = self::IS_PUBLIC;
        $this->save();
    }

    public function toggleStatus($value)
    {
        return ($value != 'false') ?  $this->setDraft() : $this->setPublic();
    }

    public function setFeatured()
    {
        $this->is_featured = self::IS_FEATURED;
        $this->save();
    }

    public function setStandart()
    {
        $this->is_featured = self::IS_STANDART;
        $this->save();
    }

    public function toggleFeatured($value)
    {
        return ($value == 'false') ? $this->setStandart() : $this->setFeatured();
    }

    public function setDateAttribute($value)
    {
        $date = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d');
        $this->attributes['date'] = $date;
    }

    public function getDateAttribute($value)
    {
        $date = Carbon::createFromFormat('Y-m-d', $value)->format('d/m/y');
        return $date;
    }

    public function getCategoryID()
    {
        return $this->category != null ? $this->category->id : null;
    }

    public function getDate()
    {
        return Carbon::createFromFormat('d/m/y', $this->date)->format('F d, Y');
    }

    public function hasPrevios()
    {
        return self::where('id', '<', $this->id)->max('id');
    }

    public function getPrevios()
    {
        $postID = $this->hasPrevios();
        return self::find($postID);
    }

    public function hasNext()
    {
        return self::where('id', '>', $this->id)->min('id');
    }

    public function getNext()
    {
        $postID = $this->hasNext();
        return self::find($postID);
    }

    public function related()
    {
        return self::all()->except($this->id);
    }

    public function hasCategory()
    {
        return $this->category != null ? true : false;
    }

    public static function popularPosts($limit)
    {
        return self::orderBy('views', 'desc')->take($limit)->get();
    }

    public static function featuredPosts($limit)
    {
        return self::where('is_featured', 1)->take($limit)->get();
    }

    public static function recentPosts($limit)
    {
        return self::orderBy('created_at', 'desc')->take($limit)->get();
    }
}
