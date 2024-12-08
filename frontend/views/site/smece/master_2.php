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
$description = $main->$description_name;
$this->registerMetaTag(['name' => 'description', 'content' => $description]);
$this->registerLinkTag(['rel'=> 'icon','type'=>'image/png','href'=> Yii::$app->request->baseUrl . '/frontend/web/uploads/master/'.$main->icon]);
$main_title = $main->$main_title_name;
$base = $main->$base_name;
?>
<main role="main" class="flex-shrink-0">
  <header style="margin-top: 108px;background: whitesmoke; padding: 13px 0px;">
        <div class="container">
            <h1 ><?= $main->$main_title_name; ?></h1>  
            <div><?= $main->$text_name; ?></div>

        </div>

    </header>


    <div class="container">
    <?php
    if($main->slaves){
     foreach ($main->slaves as $slave) {
         
         ?>
        
        
        
        
        
       <div class="row post" id="<?= $slave->$link_name ?>">
                <div class="col-lg-6 text">
                    <h2> <?= $slave->$menu_title_name ?></h2>
                    <div>
                        <?= $slave->$text_name ?>
                    </div>
                      <?php if($slave->subslaves/*1*/){ ?>
                    <nav>    <?=
                    Html::a(' <b>' . $slave->$menu_title_name . '</b>', ['/site/slave',
                        'page' => $main->$link_name,
                            'subpage' => $slave->$link_name,
                            // 'home' => Yii::$app->mycoms->wordtourl($body->home->link_sr_latn),
                            //'subhome' => Yii::$app->mycoms->wordtourl($body->link_sr_latn),
                            ], ['style' => '', 'class' => 'btn btn-primary', 'title' => 'Izmenite zaglavlje ove stranice']);
                    ?>
                </nav>
                      <?php } ?>
                </div>
                <?php if ($slave->image) {?>
                <figure class="col-lg-6">
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
    }else{
        echo 'nema postova u ovoj stranici';
    }
     ?>
</div>
</main>