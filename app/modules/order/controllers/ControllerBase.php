<?php

namespace Modules\Order\Controllers;

use Phalcon\Mvc\Controller;
use Models\Images;

class ControllerBase extends Controller {

    protected function saveImage($url, $item_id, $order, $description = NULL) {
        try {
            $image = new \Models\Images();
            $tmp_image = explode('/', $url);

            $public_dir = __DIR__ . '/../../../../public';

            if (!file_exists($public_dir . '/img/' . $item_id . '/')) {
                mkdir($public_dir . '/img/' . $item_id . '/');
                chmod($public_dir . '/img/' . $item_id . '/', 0777);
            }

            rename($public_dir . $url, $public_dir . '/img/' . $item_id . '/' . $tmp_image[count($tmp_image) - 1]);
            $image->setImage('/img/' . $item_id . '/' . $tmp_image[count($tmp_image) - 1]);

            $image->setIndex($order);
            $image->setDescription($description);

            $image->save();

            return $image;
        } catch (\Exception $ex) {
            die($ex);
        }
    }

    protected function updateImage($id, $order, $description = null) {
        $image = \Models\Images::findFirstById($id);
        if ($image) {
            $image->setIndex($order);
            $image->setDescription($description);
            $image->update();
        }
    }

    public function removeImages($ids, $item, $remation) {
        $public_dir = __DIR__ . '/../../../../public';
        foreach ($item->getImages() as $image) {
            if (!in_array($image->getId(), $ids)) {
                $relation = $remation::findFirst("item_id = {$item->getId()} and image_id = {$image->getId()}");
                if ($relation) {
                    $relation->delete();
                }
                unlink($public_dir . $image->getImage());
                $image->delete();
            }
        }
    }

    protected function setFlashErrorMessages(array $messages = null) {
        if (count($messages) > 0) {
            foreach ($messages as $message) {
                $this->flash->error($message);
            }
        }
        return true;
    }

}
