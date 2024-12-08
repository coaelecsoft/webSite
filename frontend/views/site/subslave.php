<?php
use yii\helpers\Html;

$lang_link = str_replace('-', '_', Yii::$app->mycoms->wordtourl(Yii::$app->language));
$title_name = 'title_' . $lang_link;
$description_name = 'description_' . $lang_link;
$main_title_name = 'heading_' . $lang_link;
$base_name = 'basic_' . $lang_link;
$text_name = 'text_' . $lang_link;
$link_name = 'link_'.$lang_link;
$menu_title_name = 'menu_title_'.$lang_link;

$this->title = $main->$title_name;
$description = strip_tags($main->$description_name);
$this->registerMetaTag(['name' => 'description', 'content' => $description]);
$this->registerLinkTag(['rel'=> 'icon','type'=>'image/png','href'=> Yii::$app->request->baseUrl . '/frontend/web/uploads/master/'.$main->icon]);
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

$img_path = Yii::$app->params['website'] . '/frontend/web/uploads/master/' ;
$this->registerMetaTag(['property' => 'og:image', 'content' => $img_path. $main->image]);
$this->registerMetaTag(['property' => 'twitter:image', 'content' => $img_path. $main->image]);
?>
<main>  
       <!-- Header of home page in <main> tag --> 
    <header class="<?= 'text-image-' . $main->page_option_1 ?> my-container  page-main-header">
        <div class="text-panel">
                <nav>   
                     <?php if($main->slave->master->menu_option == '0'){ ?>
                    <?=
                    Html::a(' <b> Početna </b>', ['/site/index',
                       // 'page' => $slave->$link_name,
                            // 'subpage' => $slave->$link_name,
                            // 'home' => Yii::$app->mycoms->wordtourl($body->home->link_sr_latn),
                            //'subhome' => Yii::$app->mycoms->wordtourl($body->link_sr_latn),
                            ], ['style' => '', 'class' => 'btn btn-primary', 'title' => $main->slave->master->$title_name]);
                    ?>
                       <?php }?>
                    
                    <?=
                    Html::a($main->slave->master->$title_name, ['/site/master',
                       'page' => $main->slave->master->$link_name,
                            // 'subpage' => $slave->$link_name,
                            // 'home' => Yii::$app->mycoms->wordtourl($body->home->link_sr_latn),
                            //'subhome' => Yii::$app->mycoms->wordtourl($body->link_sr_latn),
                            ], ['style' => '', 'class' => 'btn btn-primary', 'title' => $main->slave->master->$title_name]);
                       
                      
                    ?>
                 <?=
                    Html::a($main->slave->$title_name, ['/site/slave',
                       'page' => $main->slave->master->$link_name,
                           'subpage' => $main->slave->$link_name,
                            // 'home' => Yii::$app->mycoms->wordtourl($body->home->link_sr_latn),
                            //'subhome' => Yii::$app->mycoms->wordtourl($body->link_sr_latn),
                            ], ['style' => '', 'class' => 'btn btn-primary', 'title' => $main->slave->$title_name]);
                       
                      
                    ?>
                </nav>
            <h1><?= $main->$main_title_name; ?></h1>  
            <div><?= $main->$text_name; ?></div>
        </div>
        <?php if ($main->image) { ?>

            <figure class="image-panel">
                <?=
                Html::img($img_path . $main->image, [
                    'alt' => $main->$main_title_name,
                    'title' => $main->$title_name,
                    'class' => '',
                    'width' => '100%',
                    'style' => ''])
                ?>  
            </figure>  
        <?php }elseif($main->image){ ?>
            <figure class="image-panel">
                <?=
                Html::img($img_path . $main->image, [
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
    
  


    <div class="container">
    <?php
    if($main->ssslaves){
     foreach ($main->ssslaves as $slave) {
         
         ?>
       <div class="row post" id="<?= $slave->$link_name ?>">
                <div class="col-lg-6">
                    <h2> <?= $slave->$menu_title_name ?></h2>
                    <div>
                        <?= $slave->$text_name ?>
                    </div>
                      <?php if ($slave->sssslaves/* 1  $slave->slaves*/) { ?>
                    <nav>    
                 <?=
                    Html::a(' <b>' . $slave->$menu_title_name . '</b>', ['/site/ssslave',
                        'page' => $main->slave->master->$link_name,
                        'subpage'=>$main->slave->$link_name,
                        'subsubpage'=>$main->$link_name,
                            'subsubsubpage' => $slave->$link_name,
                            // 'home' => Yii::$app->mycoms->wordtourl($body->home->link_sr_latn),
                            //'subhome' => Yii::$app->mycoms->wordtourl($body->link_sr_latn),
                            ], ['style' => '', 'class' => 'btn btn-primary', 'title' => $slave->$menu_title_name]);
                    ?>
                </nav>
                      <?php } ?>
                </div>
             <?php
                    if ($slave->image) {

                        $mypath = Yii::$app->params['webSite'] . '/frontend/web/uploads/master/';
                        ?>
                <figure class="col-lg-6">
                  
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
    }else{
        echo 'nema postova u ovoj stranici';
    }
     ?>
</div>
</main>