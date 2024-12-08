<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
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