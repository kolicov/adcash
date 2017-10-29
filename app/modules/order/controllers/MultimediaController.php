<?php

namespace Modules\Order\Controllers;

use Models\Items;
use Modules\Order\Forms\Form\ProductForm;

class MultimediaController extends ControllerBase {

    public function uploadAction() {
        $tmp = __DIR__ . '/../../../../public/tmp/';
        $this->view->disable();
        $result = array();

        try {
            foreach ($this->request->getUploadedFiles() as $file) {
                $name = $file->getName();
                move_uploaded_file($file->getTempName(), $tmp . $name);
                chmod($tmp . $name, 0777);
                $result['files'][] = '/tmp/' . $name;
                $result['status'] = true;
            }
        } catch (\Exception $e) {
            $result['message'] = 'Възникна грешка, моля опитайте пак';
            $result['status'] = false;
        }

        echo(json_encode($result));
    }

}
