<?php

namespace frontend\controllers;

use backend\models\Master;
use yii\rest\ActiveController;

/**
 * Description of ApiController
 *
 * @author Alex
 */
class ApiController extends ActiveController {
     public $modelClass = Master::class;
}
