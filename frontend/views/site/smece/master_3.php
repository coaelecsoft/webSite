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
      //  echo 'dd---'.$main->page_option;
     foreach ($main->slaves as $slave) {
         if($slave->page_active == '1'){
         if ($slave->page_option != '3') {
       //echo 'treba da je drugacije od 3';
           //  echo $slave->title_sr_latn;
         if($slave->page_option == '0'){
         
         ?>
        
        
        
        
        
       <div style="padding-top:108px;" class="row post" id="<?= $slave->$link_name ?>">
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
        
        
         <?php }elseif($slave->page_option == '1'){ ?> 

        
                 <div style="overflow: hidden;
                 display: grid;
                 grid-template-columns: repeat(6, 1fr);
                 grid-template-rows: repeat(6, 1fr);
                 width: 100%;
                 height: 100%;
                 background: grey;">


                <?php
                if ($slave->image) {

                $mypath = Yii::$app->params['webSite'] . '/frontend/web/uploads/master/';
                ?>
                <figure style="    grid-column: 1/7;
                        grid-row: 1 / 7;
                        height: 80vh;">
                        <?= Html::img($mypath . $slave->image, ['alt' => 'myalt', 'title' => '', 'class' => '', 'width' => '100%', 'style' => '    
                            transition: all 2s;
                            width: 100%;
                            height: 100%;
                            object-fit: cover;']) ?>   
                </figure>
                <?php
                }
                ?>

                <div class="container" style="
                      background:rgba(42,42,42,.4);
                     grid-column: 1/7;
                     grid-row: 1 / 7;
                     height: 80vh;
                     display: flex;
                     flex-direction: column;
                     justify-content: center;
                     padding: 20px;
                     z-index: 1;">
                    <div>
                        <h2 style="text-shadow: 1px 1px black, white 1px 2px;
                            
                             color: white;
                            border-radius: var(--bs-border-radius-2xl);padding: 20px;text-align: center"><?= $slave->$main_title_name; ?></h2>  
                    </div>
                    <hr>
                    <div style="
                         
                          color: white;
                            border-radius: var(--bs-border-radius-2xl);padding: 20px;text-align: center">
                        <?= $slave->$text_name; ?>
                        <div>
                            <a title="<?= $slave->$main_title_name; ?>" class="" href="tel:<?= $slave->tel_1 ?>" target="_blank" style="border-radius: var(--bs-border-radius-pill);
                               padding: 13px 24px;
                               background: var(--bs-blue);
                               color: yellow;
                               text-decoration: none;

                               justify-content: center;
                               align-items: center;
                               "> 
                                <img   width="32" height="32" src="<?= Yii::$app->params['webSite'] . '/frontend/web/phone.svg' /* . $home->icon */ ?>" 
                                       alt="<?= $slave->$title_name ?>"
                                       title="<?= $slave->$main_title_name ?>"
                                       style="border-radius:var(--bs-border-radius-pill);background: yellow;margin-right: 5px;"
                                       >                     
                                       <?= '  '.$slave->tel_2; ?> 
                            </a>
                        </div>
                    </div>
                </div>                    
            </div>    
        
        
        
         <?php } ?>
    <?php
     }
    }}
    }else{
        echo 'nema postova u ovoj stranici';
    }
     ?>
</div>
</main>