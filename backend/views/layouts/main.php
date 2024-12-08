<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use backend\models\Master;
AppAsset::register($this);

//$menu = Master::find()->orderBy(['no' => SORT_ASC])->all(); //->onCondition(['main_status' => '1']) //$menu = Master::find()->onCondition(['menu_option' => '1'])->orderBy(['no' => SORT_ASC])->all(); //->onCondition(['main_status' => '1'])
$menu = Master::find()->onCondition(['menu_option' => '1'])->orOnCondition(['menu_option' => '2'])->orderBy(['no' => SORT_ASC])->all(); //->onCondition(['main_status' => '1'])
    $lang_link = str_replace('-', '_', Yii::$app->mycoms->wordtourl(Yii::$app->language));
    $title_name = 'title_' . $lang_link;
    $description_name = 'description_' . $lang_link;
    $main_title_name = 'main_title_' . $lang_link;
    $base_title_name = 'base_' . $lang_link;
    $text_name = 'text_' . $lang_link;
    $link_name = 'link_' . $lang_link;
    $menu_title_name = 'menu_title_' . $lang_link;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [
      //  ['label' => 'Home', 'url' => ['/site/index']],
        
    ];
        foreach ($menu as $main_menu) {
           
    //echo $main_menu->title_sr_latn.'<br>';
                    if ($main_menu->id == 1) {
                       // echo $main_menu->menu_title_sr_latn.'<br>';
                        //$menu_from_home = Yii::$app->mycoms->wordtourl($main_menu->title_sr_latn);
                          // $menu_title_from_home = $main_menu->$menu_title_name;
//$menuItems[] ='<li class="nav-item">'.Html::a($menu_title_from_home, [$main_menu->link_sr_latn], ['class' => 'nav-link', 'title' => $main_menu->title_sr_latn]).'</li>';
                        
                     $menuItems[] = ['label' => $main_menu->$menu_title_name, 'url' => ['site/index']];
                    }else{
                        
                        $menuItems[] = ['label' => $main_menu->$menu_title_name, 'url' => ['site/master', 'page'=>$main_menu->$link_name]];
                        
                    }
            
                }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    }     
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
