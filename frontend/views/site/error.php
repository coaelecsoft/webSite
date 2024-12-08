<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$img_path = Yii::$app->params['website'] . '/frontend/web/240-240.png';
$this->registerLinkTag(['rel' => 'stylesheet', 'href' => '/css/hacker.css']);
?>
<main >
    <article class="blur-container"  id="layout-100vh"> 
        <header class="left" >

            <h1><?= Html::encode($this->title) ?></h1>
            
            <p>  
        <?= nl2br(Html::encode($message)) ?>
                <br><!-- comment -->
          
            </p>    
<nav>    <?=
                    Html::a(' <b>Idi na početnu</b>', ['/',
                       // 'page' => $slave->$link_name,
                            // 'subpage' => $slave->$link_name,
                            // 'home' => Yii::$app->mycoms->wordtourl($body->home->link_sr_latn),
                            //'subhome' => Yii::$app->mycoms->wordtourl($body->link_sr_latn),
                            ], ['style' => '', 'class' => 'btn btn-primary', 'title' => 'Izmenite zaglavlje ove stranice']);
                    ?>
                </nav>
        </header>
        
    </article>

</main>

