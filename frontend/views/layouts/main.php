<?php
/** @var \yii\web\View $this */

/** @var string $content */
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use backend\models\Master;

AppAsset::register($this);
$home = Master::find()->onCondition(['id' => '1'])->one();

//$menu = Master::find()->orderBy(['no' => SORT_ASC])->all(); //->onCondition(['main_status' => '1']) //$menu = Master::find()->onCondition(['menu_option' => '1'])->orderBy(['no' => SORT_ASC])->all(); //->onCondition(['main_status' => '1'])
$menu = Master::find()->onCondition(['menu_option' => '1'])->orOnCondition(['menu_option' => '2'])->andOnCondition(['page_active' => '1'])->orderBy(['no' => SORT_ASC])->all(); //->onCondition(['main_status' => '1'])

$lang_link = str_replace('-', '_', Yii::$app->mycoms->wordtourl(Yii::$app->language));
$title_name = 'title_' . $lang_link;
$description_name = 'description_' . $lang_link;
$main_title_name = 'heading_' . $lang_link;
$base_title_name = 'basic_' . $lang_link;
$text_name = 'text_' . $lang_link;
$link_name = 'link_' . $lang_link;
$menu_title_name = 'menu_title_' . $lang_link;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= (Yii::$app->language == 'sr-Latn') ? "sr" : Yii::$app->language; ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <style>

            .zaglavlje-stranice *{

            }


            .pod-meni-lista{


            }
            .meni-stavke, .meni-stavke *{
                list-style: none;
            }
            .moj-flex{
                display: flex;
                flex-direction: column;
                gap: 5px;
            }
            .meni-stavke{

                width: 100%;
                padding: 10px;
            }

            .meni-stavke a{


                padding: 13px 23px;
                border-radius: var(--bs-border-radius);
                background: yellow;
                width: 100%;
                flex: 100%;
                display: flex;

            }
            .meni-stavka{
                display: flex;
                flex-direction: column;
            }

            .meni-link{

            }
        </style>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100" itemscope itemtype="https://schema.org/WebSite">
        <link itemprop="url" href="<?= Yii::$app->params['webSite'] ?>"/>
        <?php $this->beginBody() ?>
        <header class="header-page" style="    box-shadow: var(--bs-box-shadow-sm);">
            <div class="container">                
                <ul class="top-header">
                    <li>
                        <a href="mailto:<?= $home->e_mail ?>"> 
                            <?= $home->e_mail ?> 
                        </a>
                    </li>
                    <li>
                        <a title="Pozovite Otkup automobila" class="" href="tel:<?= $home->tel_1 ?>" target="_blank"> 
                            <img   width="32" height="32" src="<?= Yii::$app->params['webSite'] . '/frontend/web/phone.svg' /* . $home->icon */ ?>" 
                                   alt="<?= $home->$title_name ?>"
                                   title="<?= $home->$main_title_name ?>"
                                   style="border-radius:var(--bs-border-radius-pill);"
                                   >                     
                                   <?= $home->tel_2; ?> 
                        </a>
                    </li>
                </ul>
            </div>

            <div class="container" >
                <nav class="main-top-menu">
                    <ul class="top-header menu-control">
                        <li>
                            <a title="<?= Yii::$app->name ?>" href="/">
                                <img    width="44" height="44" src="<?= Yii::$app->params['webSite'] . '/frontend/web/uploads/master/' . $home->icon /* . $home->icon */ ?>" 
                                        alt="<?= $home->$title_name ?>"
                                        title="<?= $home->$main_title_name ?>">     
                            </a>
                        </li>
                        <li class="my-menu-button">
                            <a  title="Open menu" href="javascript:void(openMenu())">
                                <svg style="width:44px;height:44px;" xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                <path fill="black" fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
                                </svg>
                            </a>
                        </li>
                    </ul>

                    <ul id="menu-list" class="menu-list">

                        <?php
                        foreach ($menu as $mainmenu) {
                            ?>




                            <li>
                                <?php
                                $submenu = array();
                                if ($mainmenu->slaves) {

                                    foreach ($mainmenu->slaves as $slave) {
                                        if ($slave->menu_option == '1') {
                                            $submenu[] = $slave;
                                        }
                                    }
                                }
                                ?>



                                <div class="my-main-link">
                                   
                                    <a  class="my-text-link"
                                        title= "<?= $mainmenu->$title_name ?>"
                                        href="<?= Yii::$app->params['webSite'] . '/' . $mainmenu->$link_name; ?>">
                                        <img class="my-link-img"
                                                 id='btn-<?= $mainmenu->$link_name ?>'  width="32" height="32" src="<?= Yii::$app->params['webSite'] . '/frontend/web/uploads/master/' . $mainmenu->icon /* . $home->icon */ ?>" 
                                                 alt="<?= $home->$title_name ?>"
                                                 title="<?= $home->$title_name ?>"

                                                 >
                                            <?= $mainmenu->$menu_title_name ?>

                                    </a>

                                    <?php if ($submenu) { ?> 
                                        <a 
                                            class="my-icon-link" 
                                            href="javascript:void(openSubMenu('sub-menu-<?= $mainmenu->$link_name ?>'))"
                                            
                                            >
                                            <img class="my-link-img"
                                                 id='btn-sub-menu-<?= $mainmenu->$link_name ?>'  width="32" height="32" src="<?= Yii::$app->params['webSite'] . '/frontend/web/arrow-right.svg' /* . $home->icon */ ?>" 
                                                 alt="<?= $home->$title_name ?>"
                                                 title="<?= 'Otvori ' . $mainmenu->$menu_title_name ?>"

                                                 > 
                                        </a>

                                    <?php } else { ?> 
                                        

                                    <?php } ?>

                                </div>
                                 <?php if ($submenu) { ?> 
                                <ul class="sub-menu" id="sub-menu-<?= $mainmenu->$link_name ?>">
                                    <?php
                                    if ($submenu) {
                                        foreach ($submenu as $smenu) {
                                            //  echo  $smenu->$title_name;
                                            ?>
                                            <li>
                                                <?php if ($smenu->subslaves) { ?>
                                                    <a href="<?= Yii::$app->params['webSite'] . '/' . $mainmenu->$link_name . '/' . $smenu->$link_name; ?>"
                                                       title= "novi title<?= $smenu->$main_title_name ?>"
                                                       onClick="openSubMenu('sub-menu-<?= $mainmenu->$link_name ?>')"
                                                       >

                                                        <?= $smenu->$menu_title_name; ?>
                                                    </a>

                                                <?php } else {
                                                    ?>  
                                                    <a href="<?= Yii::$app->params['webSite'] . '/' . $mainmenu->$link_name . '#' . $smenu->$link_name; ?>"
                                                       title= "<?= $smenu->$main_title_name ?>"
                                                       
                                                       >

                                                        <?= $smenu->$menu_title_name; ?>
                                                    </a>
                                                <?php } ?>

                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>

                                </ul>
                                <?php } ?>

                            </li>                      
                            <?php
                        }
                        ?>

                    </ul>



                </nav>
            </div>

        </header>

        <?= Alert::widget() ?>
        <?= $content ?>



        <footer class="footer mt-auto py-3 text-muted">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4" itemscope itemtype="https://schema.org/LocalBusiness">
                        <figure>
                            <img itemprop="logo"   width="64" height="64" src="<?= Yii::$app->params['webSite'] . '/frontend/web/uploads/master/' . $home->icon /* . $home->icon */ ?>" 
                                 alt="<?= $home->$title_name ?>"
                                 title="<?= $home->$main_title_name ?>"
                                 >                     
                        </figure>
                        <p  itemprop="name"
                            style="font-size: 1.3rem;font-weight: bolder">

                            <?= Html::encode(Yii::$app->name) ?>

                        </p>

                        <p itemprop="description">
                            <?= $home->$base_title_name; ?>
                        </p>

                        <meta itemprop="url" content="<?= Yii::$app->params['webSite'] ?>">
                        <address itemprop="address">
                            <p ><?= $home->address ?></p>
                            <p ><span ><?= $home->post_code . ', ' ?></span><!-- comment --> 
                                <span ><?= $home->post_name ?></span>
                            </p>                    
                        </address>

                        <p itemprop="email"><?= $home->e_mail ?></p>
                        <p itemprop="telephone"> 


                            <a title="<?= Html::encode(Yii::$app->name) ?>" class="" href="tel:<?= $home->tel_1 ?>" target="_blank" style="
                               padding: 13px 24px;
                               background: var(--bs-blue);
                               color: yellow;
                               text-decoration: none;

                               justify-content: center;
                               align-items: center;
                               "> 
                                <img width="32" height="32" src="<?= Yii::$app->params['webSite'] . '/frontend/web/phone.svg' ?>" alt="Pouzdan otkup automobila<br>Bez obzira na stanje i vrstu vozila " title="Pouzdan otkup automobila <br>Bez obzira na stanje i vrstu vozila " style="border-radius:var(--bs-border-radius-pill);background: yellow;margin-right: 5px;">                     
                                <?= $home->tel_2; ?> 
                            </a>

                        </p>  
                    </div>
                    <div  class="col-lg-8">
                        <ul style="list-style:none;"  class="menu-list">

                            <?php
                            foreach ($menu as $mainmenu) {
                                ?>




                                <li style="flex: auto;">
                                    <?php
                                    $submenu = array();
                                    if ($mainmenu->slaves) {

                                        foreach ($mainmenu->slaves as $slave) {
                                            if ($slave->menu_option == '1') {
                                                $submenu[] = $slave;
                                            }
                                        }
                                    }
                                    ?>




                                    <a  class="my-text-link"
                                        style="
                                        padding: 13px;

                                        "
                                        title= "<?= $mainmenu->$main_title_name ?>"
                                        href="<?= Yii::$app->params['webSite'] . '/' . $mainmenu->$link_name; ?>">
                                            <?= $mainmenu->$menu_title_name ?>

                                    </a>





                                    <ul style="
                                        margin-left: 0px;
                                        height: auto;
                                        overflow: hidden;
                                        transition: 0.5s;
                                        
                                        
                                        display: flex;
                                        flex-direction: column;
                                        gap: 5px;
                                        padding-top: 5px;
                                        padding-bottom: 5px;
                                        padding-left: 0;
                                        ">
                                            <?php
                                            if ($submenu) {
                                                foreach ($submenu as $smenu) {
                                                    //  echo  $smenu->$title_name;
                                                    ?>
                                        <li style="list-style: none;">
                                                    <?php if ($smenu->subslaves) { ?>
                                                        <a href="<?= Yii::$app->params['webSite'] . '/' . $mainmenu->$link_name . '/' . $smenu->$link_name; ?>"
                                                           title= "<?= $smenu->$main_title_name ?>"
                                                           style="
                                                           padding: 13px;

                                                           "
                                                           >

                                                            <?= $smenu->$menu_title_name; ?>
                                                        </a>

                                                    <?php } else {
                                                        ?>  
                                                        <a href="<?= Yii::$app->params['webSite'] . '/' . $mainmenu->$link_name . '#' . $smenu->$link_name; ?>"
                                                           title= "<?= $smenu->$main_title_name ?>"
                                                           style="
                                                           padding: 13px;

                                                           "
                                                           >

                                                            <?= $smenu->$menu_title_name; ?>
                                                        </a>
                                                    <?php } ?>

                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </ul>


                                </li>                      
                                <?php
                            }
                            ?>

                        </ul>
                    </div>


                    <div class="col-log-12">
                        <p>

                        </p>
                        <p>  &copy; <?= Html::encode(Yii::$app->name) ?><a target="_blank" href="https://izrada-sajta.rs">
                                by PiSi
                            </a></p>
                    </div>
                </div>


            </div>
        </footer>


        <script>

            window.onload = function () {
                console.log("%c- PiSi Dizajn Alex - Web Razvoj, Web Progresive App With HTML5, CSS3, Javascript, PHP&MySQL, Yii2-framework ", "color:#286da8; font-size:30px");
            }


            const currentLocation = location.href;

            const menuItem = document.querySelectorAll('a');
            const menuLength = menuItem.length;
            for (let i = 0; i < menuLength; i++) {
                if (menuItem[i].href === currentLocation) {
                    menuItem[i].classList.add('active');
                }
            }
            /*
             **/


            function openMenu() {
                const myMenu = document.getElementById('menu-list');
                if (myMenu.classList.contains('show-menu-list')) {
                    myMenu.classList.remove('show-menu-list');
                } else {
                    myMenu.classList.add('show-menu-list');
                }
            }


            function openSubMenu(id) {
                const subMenu = document.getElementById(id);
                const btnSubMenu = document.getElementById('btn-' + id); ///document.getElementById(id); btn-sub-menu-1
                if (subMenu.classList.contains('open-sub-menu')) {
                    subMenu.classList.remove('open-sub-menu');
                    btnSubMenu.classList.remove('rotate-btn');
                    // btnSubMenu.style.transform = 'rotateZ(0deg);';
                } else {
                    subMenu.classList.add('open-sub-menu');
                    // btnSubMenu.style.transform = 'rotateZ(90deg);';
                    btnSubMenu.classList.add('rotate-btn');
                }
            }

            function openMainMenu() {
                const mainMenu = document.getElementById('main-menu-list');
                const ul = document.querySelector('#main-menu-list');
// get all children
                const children = ul.children;
                if (mainMenu.classList.contains('open-main-menu')) {
                    mainMenu.classList.remove('open-main-menu');
                    Array.from(children).forEach((li, index) => {
                        setTimeout(() => {
                            li.style.marginLeft = "100%";
                        }, 200 * index);
                    });
                } else {
                    mainMenu.classList.add('open-main-menu');
                    // iterate over all child nodes
                    Array.from(children).forEach((li, index) => {
                        setTimeout(() => {
                            li.style.marginLeft = "0px";
                        }, 300 * index);
                    });
                }
            }


            window.onscroll = function () {
                const doc = document.documentElement;
                const top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);
                const mainMenu = document.getElementById('body-header');
                if (top <= 229) {
                    // goToTopPanel.style.display = "none";
                    // mainMenu.classList.remove('scroled-menu');
                } else {
                    //mainMenu.classList.add('scroled-menu');
                    // goToTopPanel.style.display = "initial";
                }
            }

        </script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php
$this->endPage();
