<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\jui\DatePicker;

use backend\models;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var app\models\Master $model */
/** @var yii\widgets\ActiveForm $form */
?>





<div class="row">

    <?php
    $form = ActiveForm::begin([
                'options' => [
                    'class' => 'row',
                ],
    ]);
    ?>





<div class="col-lg-8">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="sr-tab" data-bs-toggle="tab" data-bs-target="#sr" type="button" role="tab" aria-controls="sr" aria-selected="true">Srpski</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en" type="button" role="tab" aria-controls="en" aria-selected="false">Engleski</button>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="sr" role="tabpanel" aria-labelledby="home-tab">
                <div style="border: 1px solid lightblue">
                    <?= $form->field($model, 'menu_title_sr_latn')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'title_sr_latn')->textInput(['maxlength' => true, 'onchange' => 'addToLink()']) ?>
                    <?= $form->field($model, 'heading_sr_latn')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'link_sr_latn')->textInput(['maxlength' => true]) ?>
                </div>
                <?= $form->field($model, 'description_sr_latn')->textarea(['rows' => 3]) ?>

                <?= $form->field($model, 'text_sr_latn')->textarea(['rows' => 12]) ?>

                <?= $form->field($model, 'basic_sr_latn')->textarea(['rows' => 6]) ?>


            </div>
            <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                <?= $form->field($model, 'menu_title_en')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'heading_en')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'link_en')->textInput(['maxlength' => true, 'onchange' => 'testfunction()']) ?>
                <?= $form->field($model, 'description_en')->textarea(['rows' => 3]) ?>

                <?= $form->field($model, 'text_en')->textarea(['rows' => 12]) ?>

                <?= $form->field($model, 'basic_en')->textarea(['rows' => 6]) ?>


            </div>
            <script>
                var name = "ĆićA; mIRa? ;  i i  Žiža.";
                // the characters i'm looking for in a string:
                var charList = ["č", "Č", "Ć", "ć", "Š", "s", "Ž", "ž", "Đ", "đ", " ", "!", "?", ".", ",", ";"];
                // the characters i'd like to replace them with:
                var replaceList = ["c", "c", "c", "c", "s", "s", "z", "z", "d", "d", "-", "-", "-", "-", "-", "-"];


                function makeLink(titleForLink){
                    var name = titleForLink
                const newName = name.split("").map((char, index) => {
                    if (charList.includes(char)) {
                        return replaceList[charList.indexOf(char)];
                    } else {
                        return char;
                    }
                });

                return newName.join(""); // "Desi Sto Zao"
            }
           // console.log(makeLink(name));
            
function toLower(titleForLink) {
  var name = titleForLink;
  const newName = name.split("").map((char, index) => {
    if (char.toUpperCase() === char) {
      return char.toLowerCase();
    } else {
      return char;
    }
  });

  return newName.join(""); // "desi sto zao"
}

console.log(toLower(name));
console.log(makeLink(name));
console.log(makeLink(toLower(name)));

                function formatSr() {



                    var limit = name.length;
                    for (i = 0; i < limit; i++) {
                        for (var j in charList) {
                            if (name.charAt(i) === charList[j])
                                name = name.replace(name.charAt(i), replaceList[j]);
                        }
                    }
                    return name
                }
              //  console.log(formatSr())
                //const newString = originalString.replace(name.charAt(i), replaceList[j]);

//console.log(newString); // "desi sto zao"

                const titleSr = document.getElementById("master-title_sr_latn");
                const headSr = document.getElementById("master-heading_sr_latn");
                const linSr = document.getElementById("master-link_sr_latn");

                function addToLink() {
                    if (linSr.value == '') {
                        linSr.value = makeLink(titleSr.value);
                    }


                    if (headSr.value == '') {
                        headSr.value = titleSr.value;
                    }
                }
            </script>
        </div>

    </div>
    
    
    
    <div class="col-lg-4">
        <div>
            <h2> <?= Yii::t('app','Page Options') ?></h2>
            <div class="row">
                <div class="col-lg-12">
          
                    
                    
                    
                    
                    
                    
                    <?php
            if (!isset($_GET['master_id'])) {
                if($model->slave_id){ ?>
<?= $form->field($model, 'slave_id')->textInput(['maxlength' => true, 'readOnly' => true]) ?>            

                    <?php
                }else{
                $allpages = models\Slave::find()->all();
                $pages = [];
                foreach ($allpages as $page) {
                    array_push($pages, ['id' => $page->id, 'name' => $page->menu_title_sr_latn]);
                } ?>
   <?= $form->field($model, 'slave_id')->dropDownList(ArrayHelper::map($pages, 'id', 'name'), ['prompt' => 'Stranica']); ?> 

                       
                    <?php
                }
                ?>

                      <?php } else { ?>
                <?= $form->field($model, 'slave_id')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $_GET['master_id']]) ?>            

            <?php } ?>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
                <div class="col-lg-12">
                     <?= $form->field($model, 'no')->textInput() ?>
                </div>
                 <div class="col-lg-6">
                    <?=
                    $form->field($model, 'menu_option')->radioList([
                        '0' => Yii::t('app','Home'),
                        '1' => Yii::t('app','Menu') ,
                        '2' => Yii::t('app','Menu + Home') ,
                    ]);
                    ?>
                </div>
                <div id="page-active" class="col-lg-6">
                    <?=
                    $form->field($model, 'page_active')->radioList([
                        '0' => Yii::t('app','Disabled'),
                        '1' => Yii::t('app','Enabled') ,
                            ], [
                        'class' => 'my-class',
                        'onchange' => 'MyFunction()'
                            ]
                    );
                    ?>
                </div>
            </div>
            
            <div class="col-lg-12">
                   <?=
                $form->field($model, 'page_option')->radioList([
                    '0' => 'Show in one column',
                    '1' => 'Show in two column > text image',
                    '2' => 'Show in two column > image text',
                    '3' => 'Show In slider',
                    
                    '4' => 'Show with subArticle',
                  //  ['onchange' => 'testfunction()']
                ]);
               /*   * 
                 */
                ?>
            </div>
            <hr>
            <div class="col-lg-12">
                <?=
                $form->field($model, 'page_option_1')->radioList([
                   '0' => 'Show in one column',
                    '1' => 'Show in two column > text image',
                    '2' => 'Show in two column > image text',
                    '3' => 'Show In slider',
                    
                    '4' => 'Show with subArticle',
                  //  ['onchange' => 'testfunction()']
                ]);
               /*   * 
                 */
                ?>
            </div>
            <div class="col-lg-12">
<?=
                    $form->field($model, 'subarticle')->radioList([
                        '0' => Yii::t('app','Disabled'),
                        '1' => Yii::t('app','Enabled') ,
                            ], [
                        'class' => 'my-class',
                        'onchange' => 'MyFunction()'
                            ]
                    );
                    ?>
            </div>
            <script>
                const radioGroup = document.getElementById("master-page_active");
                const pageActive = document.getElementById("page-active");
                const selectedValue = radioGroup.querySelector("input[type='radio']:checked").value;
                if (selectedValue === "0") {
                    pageActive.style = 'background:red;';
                } else if (selectedValue === "1") {
                    pageActive.style = 'background:blue;';
                }

                function  MyFunction() {
                    const selectedValue = radioGroup.querySelector("input[type='radio']:checked").value;

                    if (selectedValue === "0") {
                        pageActive.style = 'background:red;';
                    } else if (selectedValue === "1") {
                        pageActive.style = 'background:blue;';
                    }
                }


            </script>
            <?php if (0) { ?>

                <?= $form->field($model, 'page_option')->dropDownList(['0', '1', '2', '3',], ['prompt' => '']) ?>

                <?= $form->field($model, 'page_option_1')->dropDownList(['0', '1', '2', '3',], ['prompt' => '']) ?>

                <?= $form->field($model, 'post_option_1')->dropDownList(['0', '1', '2', '3', '4',], ['prompt' => '']) ?>
            <?php } ?>
        </div>
        <div>
            <h2>Slike</h2>
            <?= $form->field($model, 'menu_icon')->textInput(['maxlength' => true]) ?>
             <?php
            if ($model->icon) {
                $mypath = \Yii::$app->urlManagerFrontend->baseUrl . '/uploads/master/';
                ?>
                <div style="border: 1px gray solid; border-radius: 12px">

                    <?= Html::img($mypath . $model->icon, ['alt' => 'myalt', 'title' => 'mytitle', 'class' => 'img_main fadeRotate', 'width' => '90%']) ?>       
                    <?php
                    ?>
                </div> 


                <?php
            }
            ?>
<?= $form->field($model, 'logo')->fileInput() ?> 
            <hr>
            <?php // $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>
 <?php
            if ($model->image) {
                $mypath = \Yii::$app->urlManagerFrontend->baseUrl . '/uploads/master/';
                ?>
                <div style="border: 1px gray solid; border-radius: 12px">

                    <?= Html::img($mypath . $model->image, ['alt' => 'myalt', 'title' => 'mytitle', 'class' => 'img_main fadeRotate', 'width' => '90%']) ?>       
                    <?php
                    ?>
                </div> 


                <?php
            }
            ?>
            <?= $form->field($model, 'back')->fileInput() ?> 
            <?php // $form->field($model, 'image')->textInput(['maxlength' => true]) ?>  
        </div>
        <div style="display:none">
            <h2>Kontakt podaci</h2>
            <?= $form->field($model, 'e_mail')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tel_1')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tel_2')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'post_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'post_code')->textInput() ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'long')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'zoom')->textInput() ?>
        </div>
        <div style="display:none">
            <h2>Dodatni podaci</h2>
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'data_1')->textInput() ?>

            <?= $form->field($model, 'data_2')->textInput() ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
