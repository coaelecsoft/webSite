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
$description = strip_tags($main->$description_name);
$this->registerMetaTag(['name' => 'description', 'content' => $description]);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Yii::$app->request->baseUrl . '/frontend/web/uploads/master/' . $main->icon]);
$main_title = $main->$main_title_name;
$base = $main->$base_name;

$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Yii::$app->request->absoluteUrl]);
//$this->registerMetaTag(['property' => 'fb:app_id', 'content' => Yii::$app->params['fb:app_id']]);
$this->registerMetaTag(['property' => 'og:type', 'content' => 'website']);
$this->registerMetaTag(['property' => 'og:site_name', 'content' => Yii::$app->name]);
$this->registerMetaTag(['property' => 'twitter:card', 'content' => $description]);
$this->registerMetaTag(['property' => 'twitter:title', 'content' => $this->title]);
$this->registerMetaTag(['property' => 'twitter:description', 'content' => $description]);

$img_path = Yii::$app->params['website'] . '/frontend/web/uploads/master/' . $main->image;
$this->registerMetaTag(['property' => 'og:image', 'content' => $img_path]);
$this->registerMetaTag(['property' => 'twitter:image', 'content' => $img_path]);
?>
<main>
    <!-- Header of home page in <main> tag --> 
    <header class="<?= 'text-image-' . $main->page_option_1 ?> my-container  page-main-header">
        <div class="text-panel">

            <?php if ($main->menu_option == '0') { ?>
                <nav> 
                    <?=
                    Html::a($home->$menu_title_name, ['/site/index',
                            // 'page' => $slave->$link_name,
                            // 'subpage' => $slave->$link_name,
                            // 'home' => Yii::$app->mycoms->wordtourl($body->home->link_sr_latn),
                            //'subhome' => Yii::$app->mycoms->wordtourl($body->link_sr_latn),
                            ], ['style' => '', 'class' => 'btn btn-primary',
                        'title' => $home->$title_name]);
                    ?>
                </nav>
            <?php } ?> 


            <h1><?= $main->$main_title_name; ?></h1>  
            <div><?= $main->$text_name; ?></div>
        </div>
        <?php if ($main->image1) { ?>

            <figure class="image-panel">
                <?=
                Html::img($img_path . $main->image1, [
                    'alt' => $main->$main_title_name,
                    'title' => $main->$title_name,
                    'class' => '',
                    'width' => '100%',
                    'style' => ''])
                ?>  
            </figure>  
        <?php } ?>
    </header>
    <!-- Header of home page in <main> tag -->   



    <?php
    if ($main->slaves) {
        ?>
            
    <?php
    foreach ($main->slaves as $slave) {
        if ($slave->page_option != '3') {
            ?>

           <!-- article of master page -->           
            <article  id="<?= $slave->$link_name ?>" class="my-container">
                <header class="<?= 'text-image-' . $slave->page_option ?>">
                    <div class="text-panel">
                        <?php if ($slave->$title_name) { ?>
                            <h2><?= $slave->$title_name ?></h2>
                        <?php } ?>

                        <?= $slave->$base_name ?>




                        <?php if ($slave->subarticle == '0' and $slave->subslaves) {///If not be activated showing subarticles panel and if have recorde in $slave->slaves, show button with link to main page of subarticles ?>
                            <nav> 
                                <?=
                                Html::a(' <b>' . $slave->$title_name . '</b>', ['/site/slave',
                                    'page' => $main->$link_name,
                                      'subpage' => $slave->$link_name,
                                        // 'home' => Yii::$app->mycoms->wordtourl($body->home->link_sr_latn),
                                        //'subhome' => Yii::$app->mycoms->wordtourl($body->link_sr_latn),
                                        ], ['style' => '', 'class' => 'btn btn-primary', 'title' => $menu_title_name]);
                                ?>
                            </nav>
                        <?php } ///If not be activated showing subarticles panel ?>


                        <?php if ($slave->tel_1) { // If find phone number in field $slave->tel_1 show button to call
                            ?>
                            <a title="<?= $slave->$main_title_name; ?>" href="tel:<?= $slave->tel_1 ?>" target="_blank" class="post-style-btn" > 
                                <img   width="32" height="32" src="<?= Yii::$app->params['webSite'] . '/frontend/web/phone.svg' /* . $home->icon */ ?>" 
                                       alt="<?= $slave->$title_name ?>"
                                       title="<?= $slave->$title_name ?>"
                                       style=""
                                       >                     
                                <span>  <?= $slave->tel_2 ? '  ' . $slave->tel_2 : $slave->$menu_title_name; ?></span>

                            </a>
                        <?php } ?>



                    </div>
                    
                    <?php
                            if ($slave->subarticle == '0' and ($slave->image or $slave->image1) ) {
                                ?>
                                <figure class="image-panel">

                                    <?php
                                    $mypath = Yii::$app->params['webSite'] . '/frontend/web/uploads/master/';
                                    ?>
                                    <?php
                                    $slika = $slave->image ? $slave->image : $slave->image1;
                                    echo Html::img($mypath .$slika , [
                                        'alt' => $slave->$main_title_name,
                                        'title' => $slave->$title_name,
                                        'class' => '',
                                        'width' => '100%',
                                        'style' => '    
                                transition: all 2s;
                                width: 100%;
                                height: 100%;
                                object-fit: cover;'])
                                    ?>       

                                </figure>
                                <?php
                            }
                            ?>

                    <?php if ($slave->subarticle == '0') { ?>
                        <?php if ($slave->menu_option == '0') { ?>
                            


                        <?php } elseif ($slave->menu_option == '2') { ?>

                            <?php
                            if ($slave->image1) {
                                ?>
                                <figure class="image-panel">

                                    <?php
                                    $mypath = Yii::$app->params['webSite'] . '/frontend/web/uploads/master/';
                                    ?>
                                    <?=
                                    Html::img($mypath . $slave->image1, [
                                        'alt' => $slave->$main_title_name,
                                        'title' => $slave->$title_name,
                                        'class' => '',
                                        'width' => '100%',
                                        'style' => '    
                                transition: all 2s;
                                width: 100%;
                                height: 100%;
                                object-fit: cover;'])
                                    ?>       

                                </figure>
                                <?php
                            }
                            ?>

                        <?php } ?>
                        <?php
                    }
                    ?>


                </header>






                <?php
                if ($slave->subslaves and $slave->subarticle == '1') {
                    ?>

                    <div class="sub-article-container">
                        <?php
                        foreach ($slave->subslaves as $key => $subslave) {
                            if ($subslave->page_active == "1" and $subslave->menu_option == "1") {
                                ?>

                                <article class="sub-article" title="<?= $subslave->$title_name ?>">
                                    <h3 style="text-align: center;"><?= $subslave->$menu_title_name ?></h3>
                                    <?php if ($subslave->icon) { ?>
                                        <figure style="text-align: center;">
                                            <img title="<?= $subslave->$title_name ?>" width="55" height="55" src="<?= $img_path . $subslave->icon ?>" alt="<?= 'icon ' . $subslave->title_sr_latn ?>" >                     
                                        </figure>
                                    <?php } else {
                                        ?>
                                        <figure style="text-align: center;">
                                            <img title="<?= $subslave->$title_name ?>" width="55" height="55" src="<?= $img_path . $main->icon ?>" alt="<?= 'icon ' . $subslave->title_sr_latn ?>" >                     
                                        </figure> 
                                        <?php
                                    }
                                    ?>

                                    <?php if ($subslave->$description_name) { ?>
                                        <div style="margin: auto;">
                                            <?= $subslave->$description_name ?>  
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php if ($subslave->ssslaves/* 1  $slave->slaves */) { ?>
                                        <nav class="link-to-page"> 

                                            <?=
                                            Html::a(' <b>' . $subslave->$title_name . '</b>', ['/site/subslave',
                                                'page'=> $slave->master->$link_name,
                                                'subpage' => $slave->$link_name,
                                                'subsubpage' => $subslave->$link_name,
                                                    // 'home' => Yii::$app->mycoms->wordtourl($body->home->link_sr_latn),
                                                    //'subhome' => Yii::$app->mycoms->wordtourl($body->link_sr_latn),
                                                    ], ['style' => 'width:100%', 'class' => 'btn btn-primary', 'title' => $menu_title_name]);
                                            ?>
                                        </nav>
                                    <?php } ?> 

                                </article>


                                <?php
                            }
                        }
                        ?>
                    </div>
                <?php }
                ?>




            </article>
            <!-- article of master page -->     





            <?php
        }
    }
    ?>
        <?php
}
?>




</main>