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
?>
<main role="main" class="flex-shrink-0">
    <header style="margin-top: 108px;background: whitesmoke; padding: 13px 0px;">
        <div class="container">
            <h1 ><?= $main->$main_title_name; ?></h1>  
            <h2><?= $main->$text_name . ' Pozovite ' . $main->tel_2; ?></h2>

        </div>

    </header>
    <!<!-- New Slider -->  
    <?php $slidecounter = count($slider); ?>
    <div class="my-slider" style="height:calc(80vh);background: lightgrey;overflow: hidden">
        <div id="move"  style="display: flex; width: calc(<?= $slidecounter ?> * 100vw);transition: 1s;bacground:yellow">
            <?php
            foreach ($slider as $slide) {

                //   echo $slide->$title_name.'<br><hr>';
                ?>

                <div style="overflow: hidden;
                     display: grid;
                     grid-template-columns: repeat(6, 1fr);
                     grid-template-rows: repeat(6, 1fr);
                     width: 100%;
                     height: 100%;
                     background: grey;">


                    <?php
                    if ($slide->image) {

                        $mypath = Yii::$app->params['webSite'] . '/frontend/web/uploads/master/';
                        ?>
                        <figure style="    grid-column: 1/7;
                                grid-row: 1 / 7;
                                height: 80vh;">
                                <?= Html::img($mypath . $slide->image, ['alt' => 'myalt', 'title' => '', 'class' => '', 'width' => '100%', 'style' => '    
                            transition: all 2s;
                            width: 100%;
                            height: 100%;
                            object-fit: cover;']) ?>   
                        </figure>
                        <?php
                    }
                    ?>

                    <div class="container" style="
                         grid-column: 1/7;
                         grid-row: 1 / 7;
                         height: 80vh;
                         display: flex;
                         flex-direction: column;
                         justify-content: center;
                         padding: 20px;
                         z-index: 1;">
                        <div>
                            <h2 style="background:rgba(222,222,222,.9);padding: 20px;text-align: center"><?= $slide->$main_title_name; ?></h2>  
                        </div>
                        <div style="background:rgba(222,222,222,.9);padding: 20px;text-align: center">
                            <?= $slide->$text_name; ?>
                            <div>
                            <a title="<?= $slide->$main_title_name; ?>" class="" href="tel:<?= $slide->tel_1 ?>" target="_blank" style="border-radius: var(--bs-border-radius-pill);
                               padding: 13px 24px;
                               background: var(--bs-blue);
                               color: yellow;
                               text-decoration: none;
                               
                               justify-content: center;
                               align-items: center;
                              "> 
                                <img   width="32" height="32" src="<?= Yii::$app->params['webSite'] . '/frontend/web/phone.svg' /* . $home->icon */ ?>" 
                                       alt="<?= $slide->$title_name ?>"
                                       title="<?= $slide->$main_title_name ?>"
                                       style="border-radius:var(--bs-border-radius-pill);background: yellow;margin-right: 5px;"
                                       >                     
                                       <?= '  '.$slide->tel_2; ?> 
                            </a>
                            </div>
                        </div>
                    </div>                    
                </div>

            <?php }
            ?>
        </div>
    </div>
    <!-- New Slider -->  

    <!--

    
  
    -->

    <script>



        const slide = document.getElementById('move');

// Set the initial left margin
        slide.style.marginLeft = '0';

// Create a function to move the left margin by 100vw
        function moveSlideLeft() {
            // Get the current left margin
            const marginLeft = parseInt(slide.style.marginLeft);

            // Set the new left margin
            slide.style.marginLeft = `${marginLeft - 100}vw`;
        }

// Start moving the slide in a loop
        let count = 0;
        setInterval(() => {
            if (count === 2) {
                slide.style.marginLeft = '0';
                count = 0;
            } else {
                moveSlideLeft();
                count++;
            }
        }, 5000);

//console.log(slide)
        // Deklaracija funkcije
        function myFunction() {
            // slide.style.marginLeft = -100vw;
            //console.log(slide.style.margin);
            //slide.style.height = '-100vw';//  console.log(new Date().toLocaleTimeString());
        }

// Poziva funkciju svaku sekundu
        setInterval(myFunction, 1000);


    </script>

















    <div class="container">


        <?php
        foreach ($others as $slave) {
            if ($slave->page_option != '3') {
                ?>

                <div class="row post" id="<?= $slave->$link_name ?>">
                    <div class="text col-lg-6">
                        <div>
                            <h2><?= $slave->$menu_title_name ?></h2>
                        </div>
                        <div>
                            <?= $slave->$text_name ?>
                        </div>
                        <?php if ($slave->slaves/* 1 */) { ?>
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
                    <?php
                    if ($slave->image) {
                        ?>
                        <figure class=" col-lg-6" style="overflow:none;">

                            <?php
                            $mypath = Yii::$app->params['webSite'] . '/frontend/web/uploads/master/';
                            ?>
                            <?= Html::img($mypath . $slave->image, ['alt' => 'myalt', 'title' => '', 'class' => '', 'width' => '100%', 'style' => '    
                            transition: all 2s;
                            width: 100%;
                            height: 100%;
                            object-fit: cover;']) ?>       

                        </figure>
                        <?php
                    }
                    ?>
                </div>

                <?php
            }
        }
        ?>
    </div>

</main>