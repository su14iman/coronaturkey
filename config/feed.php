<?php

return [

    'feeds' => [
        'news' => [
            'items' => 'App\NewsItemFeed@getFeedItems',

            'url' => '/feed',

            'title' => 'All newsitems on corona-turkiye.com',

            /*
             * Custom view for the items.
             *
             * Defaults to feed::feed if not present.
             */
            'view' => 'feed::feed',
        ],
    ],

];