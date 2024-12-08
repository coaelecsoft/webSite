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
<main role="main" class="flex-shrink-0">
    <!-- Page Header -->  
    <header class="main-header" style="">
        <div class="container"> 
            <h1 style="" ><?= $main->$main_title_name; ?></h1>  
            <div><?= $main->$text_name; ?></div>
        </div>        
    </header>
    <!-- Page Header -->  

    <!-- New Slider 
    Slide is post from page stylized with page_option, option post. 
    When we select option 3, select post to slider and don't show in body page.
    -->  
    <?php $slidecounter = count($slider); ?>
    <?php if($slidecounter > 0){ ?>
    <div class="my-slider" style="height:calc(80vh);background: lightgrey;overflow: hidden">
        <div id="move"  style="display: flex; width: calc(<?= $slidecounter ?> * 100vw);transition: 1s;bacground:yellow">
            <?php
            
            foreach ($slider as $slide) {
                //   echo $slide->$title_name.'<br><hr>';
                ?>
                <div class="post-style-1" style="">
                    <?php
                    if ($slide->image) {

                        $mypath = Yii::$app->params['webSite'] . '/frontend/web/uploads/master/';
                        ?>
                        <figure class="image">
                            <?= Html::img($mypath . $slide->image, ['alt' => 'myalt', 'title' => '', 'class' => '', 'width' => '100%', 'style' => '    
                            transition: all 2s;
                            width: 100%;
                            height: 100%;
                            object-fit: cover;']) ?>   
                        </figure>
                        <?php
                    }
                    ?>

                    <div class="container text" >
                        <h2><?= $slide->$main_title_name; ?></h2>  
                        <?= $slide->$text_name; ?>
                        <?php if ($slide->tel_1) {
                            ?>
                            <a title="<?= $slide->$main_title_name; ?>" href="tel:<?= $slide->tel_1 ?>" target="_blank" class="post-style-btn" > 
                                <img   width="32" height="32" src="<?= Yii::$app->params['webSite'] . '/frontend/web/phone.svg' /* . $home->icon */ ?>" 
                                       alt="<?= $slide->$title_name ?>"
                                       title="<?= $slide->$main_title_name ?>"
                                       style=""
                                       >                     
                                <span>  <?= $slide->tel_2 ? '  ' . $slide->tel_2 : $slide->$menu_title_name; ?></span>
                            </a>
                        <?php } ?>
                    </div>                    
                </div>

            <?php }
            ?>
        </div>
    </div>
    <?php } ?>
    <!-- New Slider -->  

    <!-- JS code for move slider
    this slider very elegant and very simple with few rows code.
    -->

    <script>
        const slide = document.getElementById('move');
        slide.style.marginLeft = '0';
        function moveSlideLeft() {
            // Get the current left margin
            const marginLeft = parseInt(slide.style.marginLeft);
            // Set the new left margin
            slide.style.marginLeft = `${marginLeft - 100}vw`;
        }

// Start moving the slide in a loop

        let count = 0;
        let countSlide = <?= $slidecounter ?> - 1;
        console.log(countSlide);

        setInterval(() => {
            if (count === countSlide) {
                slide.style.marginLeft = '0';

                count = 0;
            } else {
                moveSlideLeft();
                count++;
            }
        }, 5000);
    </script>
    <!-- JS code for move slider
        this slider very elegant and very simple with few rows code.
    -->



    <!-- post on page - Main content on page
    This foreach loop render all posts on main page.
    With page_option, field from post table, change extension of css class. 
    So we have very simple layout with power change button.
    -->
    <?php
    foreach ($others as $slave) {
        if ($slave->page_option != '3') {
            ?>

            <section id="<?=$slave->$link_name?>" class="container <?= 'post-style-' . $slave->page_option ?>">
                <div class="text container">
                    <h2><?= $slave->$menu_title_name ?></h2>
                    <?= $slave->$text_name ?>

                    <?php if (1) { ?>
                        <?php if ($slave->slaves/* 1  $slave->slaves */) { ?>
                            <nav> 

                                <?=
                                Html::a(' <b>' . $slave->$menu_title_name . '</b>', ['/site/master',
                                    'page' => $slave->$link_name,
                                        // 'subpage' => $slave->$link_name,
                                        // 'home' => Yii::$app->mycoms->wordtourl($body->home->link_sr_latn),
                                        //'subhome' => Yii::$app->mycoms->wordtourl($body->link_sr_latn),
                                        ], ['style' => '', 'class' => 'btn btn-primary', 'title' => $menu_title_name]);
                                ?>
                            </nav>
                        <?php } ?>

                        <?php if ($slave->tel_1) {
                            ?>
                            <a title="<?= $slave->$main_title_name; ?>" href="tel:<?= $slave->tel_1 ?>" target="_blank" class="post-style-btn" > 
                                <img   width="32" height="32" src="<?= Yii::$app->params['webSite'] . '/frontend/web/phone.svg' /* . $home->icon */ ?>" 
                                       alt="<?= $slave->$title_name ?>"
                                       title="<?= $slave->$main_title_name ?>"
                                       style=""
                                       >                     
                                <span>  <?= $slave->tel_2 ? '  ' . $slave->tel_2 : $slave->$menu_title_name; ?></span>

                            </a>
            <?php } ?>

                        <?php
                    }
                    ?>
                </div>
                    <?php
                    if ($slave->image) {
                        ?>
                    <figure class="image">

                    <?php
                    $mypath = Yii::$app->params['webSite'] . '/frontend/web/uploads/master/';
                    ?>
                        <?= Html::img($mypath . $slave->image, [
                            'alt' => $slave->$main_title_name, 
                            'title' => $slave->$title_name, 
                            'class' => '', 
                            'width' => '100%', 'style' => '    
                            transition: all 2s;
                            width: 100%;
                            height: 100%;
                            object-fit: cover;']) ?>       

                    </figure>
                        <?php
                    }
                    ?>

            </section>
                <?php
            }
        }
        ?>
    <!-- post on page - Main content on page
      This foreach loop render all posts on main page.
      With page_option, field from post table, change extension of css class. 
      So we have very simple layout with power change button.
    -->

</main>