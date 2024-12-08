<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "master".
 *
 * @property int $id
 * @property int|null $no
 * @property string $menu_option
 * @property string $page_active
 * @property string $page_option
 * @property string $page_option_1
 * @property string $subarticle
 * @property string|null $title_sr_latn
 * @property string|null $menu_title_sr_latn
 * @property string|null $heading_sr_latn
 * @property string|null $description_sr_latn
 * @property string|null $text_sr_latn
 * @property string|null $basic_sr_latn
 * @property string|null $link_sr_latn
 * @property string|null $title_en
 * @property string|null $menu_title_en
 * @property string|null $heading_en
 * @property string|null $description_en
 * @property string|null $text_en
 * @property string|null $basic_en
 * @property string|null $link_en
 * @property string|null $e_mail
 * @property string|null $tel_1
 * @property string|null $tel_2
 * @property string|null $post_name
 * @property int|null $post_code
 * @property string|null $address
 * @property string|null $lat
 * @property string|null $long
 * @property int|null $zoom
 * @property string|null $price
 * @property int|null $data_1
 * @property int|null $data_2
 * @property string|null $menu_icon
 * @property string|null $icon
 * @property string|null $image
 * @property string $post_option_1
 *
 * @property Slave[] $slaves
 */
class Master extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $logo;
    public $back;
    public $back1;
    public static function tableName()
    {
        return 'master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no', 'post_code', 'zoom', 'data_1', 'data_2'], 'integer'],
            [['logo','back', 'back1'], 'file'],
            [['menu_option', 'page_active', 'page_option', 'page_option_1', 'description_sr_latn', 'text_sr_latn', 'basic_sr_latn', 'description_en', 'text_en', 'basic_en', 'post_option_1', 'subarticle'], 'string'],
            [['title_sr_latn', 'menu_title_sr_latn', 'heading_sr_latn', 'link_sr_latn', 'title_en', 'menu_title_en', 'heading_en', 'link_en', 'menu_icon', 'icon', 'image'], 'string', 'max' => 255],
            [['e_mail', 'tel_1', 'tel_2', 'post_name', 'address', 'price'], 'string', 'max' => 55],
            [['lat', 'long'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no' => Yii::t('app','No') ,
            'menu_option' => Yii::t('app','Menu Option'),
            'page_active' => Yii::t('app','Page Active'),
            'page_option' => 'Post Option',
            'page_option_1' => 'Headr Option',
            'subarticle' => 'Sub articles',
            'title_sr_latn' => Yii::t('app','Title Sr Latn'),
            'menu_title_sr_latn' => Yii::t('app','Menu Title Sr Latn'),
            'heading_sr_latn' => 'Heading Sr Latn',
            'description_sr_latn' => 'Description Sr Latn',
            'text_sr_latn' => 'Text Sr Latn',
            'basic_sr_latn' => 'Basic Sr Latn',
            'link_sr_latn' => 'Link Sr Latn',
            'title_en' => 'Title En',
            'menu_title_en' => Yii::t('app','Menu Title En'),
            'heading_en' => 'Heading En',
            'description_en' => 'Description En',
            'text_en' => 'Text En',
            'basic_en' => 'Basic En',
            'link_en' => 'Link En',
            'e_mail' => 'E Mail',
            'tel_1' => 'Tel 1',
            'tel_2' => 'Tel 2',
            'post_name' => 'Post Name',
            'post_code' => 'Post Code',
            'address' => 'Address',
            'lat' => 'Lat',
            'long' => 'Long',
            'zoom' => 'Zoom',
            'price' => 'Price',
            'data_1' => 'Data 1',
            'data_2' => 'Data 2',
            'menu_icon' => 'Menu Icon',
            'icon' => 'Icon',
            'image' => 'Image',
            'post_option_1' => 'Post Option 1',
        ];
    }

    /**
     * Gets query for [[Slaves]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSlaves()
    {
        return $this->hasMany(Slave::class, ['master_id' => 'id'])->orderBy(['no' => SORT_ASC]);
    }
}
