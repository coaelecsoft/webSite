<?php

use yii\helpers\Html;

$lang_link = str_replace('-', '_', Yii::$app->mycoms->wordtourl(Yii::$app->language));
$title_name = 'title_' . $lang_link;
$description_name = 'description_' . $lang_link;
$main_title_name = 'heading_' . $lang_link;
$base_name = 'basic_' . $lang_link;
$text_name = 'text_' . $lang_link;
$link_name = 'link_' . $lang_link;
$menu_title_name = 'menu_title_' . $lang_link;

$this->title = $main->$title_name;
$description = $main->$description_name;
$this->registerMetaTag(['name' => 'description', 'content' => $description]);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Yii::$app->request->baseUrl . '/frontend/web/uploads/master/' . $main->icon]);
$main_title = $main->$main_title_name;
$base = $main->$base_name;

$mypath = \Yii::$app->urlManagerFrontend->baseUrl . '/uploads/master/';
?>

<header class="page-header" style=" ">
    <div class="text-page-header">
        <div class="container" style="display:flex; flex-direction: column;">
            <nav>
                <?=
                Html::a('Izmenite zaglavlje stranice:<b>' . $main->$menu_title_name . '</b>', ['/master/update',
                    'id' => $main->id,
                    'mytype' => '1',
                        // 'subpage' => $slave->$link_name,
                        // 'home' => Yii::$app->mycoms->wordtourl($body->home->link_sr_latn),
                        //'subhome' => Yii::$app->mycoms->wordtourl($body->link_sr_latn),
                        ], ['style' => '', 'class' => 'btn btn-warning', 'title' => 'Izmenite zaglavlje ove stranice']);
                ?>
            </nav>
            <div>
                <h1><?= $main->$main_title_name; ?></h1>  
            </div>
            <div>
                <?= $main->$text_name; ?>
            </div>
            <nav>
                <?=
                Html::a('Dodaj post u ovu stranicu', ['/master/create'],
                        ['style' => '', 'class' => 'btn btn-primary', 'title' => '']);
                ?>
            </nav>
        </div>
    </div>
    <figure class="image-page-header" style="height: 100vh;">
        <?php
        if ($main->image) {
            ?>
            <?= Html::img($mypath . $main->image, ['alt' => 'myalt', 'title' => '', 'class' => '', 'width' => '100%', 'style' => '    
                            transition: all 2s;
                            width: 100%;
                            height: 100%;
                            object-fit: cover;']) ?>       
            <?php
        }
        ?>
    </figure>       
</header>

<div>
    <?php
    foreach ($others as $slave) {
        if ($slave->page_option != '3') {
            echo $slave->no;
            ?>

            <div class="post" id="<?= $slave->$link_name ?>">
                <div class="text">
                    <nav>
                        <?=
                        Html::a('Izmenite post: <b>' . $slave->$menu_title_name . '</b>', ['/master/update',
                            'id' => $slave->id,
                            'mytype' => '1',
                                // 'subpage' => $slave->$link_name,
                                // 'home' => Yii::$app->mycoms->wordtourl($body->home->link_sr_latn),
                                //'subhome' => Yii::$app->mycoms->wordtourl($body->link_sr_latn),
                                ], ['style' => '', 'class' => 'btn btn-warning', 'title' => 'Izmenite zaglavlje ove stranice']);
                        ?>
                    </nav>
                    <div>
                        <h2><?= $slave->$menu_title_name ?></h2>
                    </div>
                    <div>
                        <?= $slave->$text_name ?>
                    </div>
                    <?php if (1/* $slave->slaves */) { ?>
                        <nav> 

                            <?=
                            Html::a(' <b>' . $slave->$menu_title_name . '</b>', ['/site/master',
                                'page' => $slave->$link_name,
                                    // 'subpage' => $slave->$link_name,
                                    // 'home' => Yii::$app->mycoms->wordtourl($body->home->link_sr_latn),
                                    //'subhome' => Yii::$app->mycoms->wordtourl($body->link_sr_latn),
                                    ], ['style' => '', 'class' => 'btn btn-primary', 'title' => 'Izmenite zaglavlje ove stranice']);
                            ?>
                        </nav>
                    <?php } ?>
                </div>
                <figure class="figure">
                    <?php
                    if ($slave->image) {

                        //$mypath = Yii::$app->params['webSite'] . '/frontend/web/uploads/master/';
                        ?>
                        <?= Html::img($mypath . $slave->image, ['alt' => 'myalt', 'title' => '', 'class' => '', 'width' => '100%', 'style' => '    
                            transition: all 2s;
                            width: 100%;
                            height: 100%;
                            object-fit: cover;']) ?>       
                        <?php
                    }
                    ?>
                </figure>
            </div>

            <?php
        }
    }
    ?>
</div>

<div style="border: red solid 13px;">
    <?php
    foreach ($others as $slave) {
        if ($slave->page_option == '3') {
            ?>
            <div class="row">
                <div class="col-lg-6">
                    <nav>
                        <?=
                        Html::a('Izmenite post: <b>' . $slave->$menu_title_name . '</b>', ['/master/update',
                            'id' => $slave->id,
                            'mytype' => '1',
                                // 'subpage' => $slave->$link_name,
                                // 'home' => Yii::$app->mycoms->wordtourl($body->home->link_sr_latn),
                                //'subhome' => Yii::$app->mycoms->wordtourl($body->link_sr_latn),
                                ], ['style' => '', 'class' => 'btn btn-warning', 'title' => 'Izmenite zaglavlje ove stranice']);
                        ?>
                    </nav>

                    <div>
                        <h2><?= $slave->$menu_title_name ?></h2>
                    </div>
                    <div>
                        <?= $slave->$text_name ?>
                    </div>
                   
                </div>
                <div class="col-lg-6">
<?php
                    if ($slave->image) {

                        //$mypath = Yii::$app->params['webSite'] . '/frontend/web/uploads/master/';
                        ?>
                        <?= Html::img($mypath . $slave->image, ['alt' => 'myalt', 'title' => '', 'class' => '', 'width' => '100%', 'style' => '    
                            transition: all 2s;
                            width: 100%;
                            height: 100%;
                            object-fit: cover;']) ?>       
                        <?php
                    }
                    ?>
                </div>
            </div>

            <?php
        }
    }
    ?>
</div>