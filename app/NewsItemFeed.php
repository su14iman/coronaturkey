<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
//use App\News;

class NewsItemFeed extends Model implements Feedable
{
    public function toFeedItem()
    {
        return FeedItem::create([
            'id' => "/v/".str_replace(" ",'_',$this->Description),
            'title' => $this->Title,
            'summary' => strip_tags($this->Text),
            'category' => $this->Name,
            'updated' => $this->created_at,
            'link' => "/v/".str_replace(" ",'_',$this->Description),
            'author' => $this->author,
        ]);
    }

    public static function getFeedItems()
    {

        $query = News::where('PublishStatus',1)
            ->join('news_images', 'news.id', '=', 'news_images.newsID')
            ->join('news_types', 'news.NewstypeID', '=', 'news_types.id')
            ->join('news_keywords', 'news.id', '=', 'news_keywords.newsID')
            ->join('news_sources_links', 'news.id', '=', 'news_sources_links.newsID')
            ->select(
                'news.id',
                'news_types.Name',
                'news.Title',
                'news.Description',
                'news.Text',
                'news_images.imageURL',
                'news_sources_links.Link',
                'news_keywords.keyword',
                'news.created_at'
            )
            ->get()->toArray();

        $items = collect(); // create new collection

        foreach ($query as $key => $value) {
//            $query[$key]->created_at = Carbon::parse($value->updated_at)->format('dS F Y H:i a');
////            $query[$key]->link = 'http://ichangemycity.com/' . $value->link;
//
            $instance = new static; // create new NewsItem model class
//
            foreach($value as $attribute => $_value) {
                $instance->{$attribute} = $_value; // copy available attribute/column and its value
//                $instance->title = $_value;
//                $instance->created_at = Carbon::parse($value["created_at"])->format('j F Y');
                $instance->author = 'CoronaTürkiye';
//                $instance->updated = $_value;
            }
//
            $instance->exists = true; // tell this model is already exists, forcely
            $items[$key] = $instance; // assign this model to the collection
        }

        return $items; // return the items containing this model class (which implements FeedItem interface)
    }
}
