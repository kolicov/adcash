<?php

namespace Models;

class ProductImage extends BaseImages {

    public function initialize() {
        $this->belongsTo('item_id', 'Modules\HomepageSection', 'id');
        $this->belongsTo('image_id', 'Modules\Products', 'id');
    }

}
