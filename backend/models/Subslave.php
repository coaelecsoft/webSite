<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "subslave".
 *
 * @property int $id
 * @property int|null $slave_id
 * @property int|null $no
 * @property string $menu_option
 * @property string $page_active
 * @property string $page_option
 * @property string $page_option_1
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
 * @property Slave $slave
 * @property Ssslave[] $ssslaves
 */
class Subslave extends \yii\db\ActiveRecord
{
    public $logo;
    public $back;
     public $back1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subslave';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slave_id', 'no', 'post_code', 'zoom', 'data_1', 'data_2'], 'integer'],
            [['logo','back','back1'], 'file'],
            [['menu_option', 'page_active', 'page_option', 'page_option_1', 'description_sr_latn', 'text_sr_latn', 'basic_sr_latn', 'description_en', 'text_en', 'basic_en', 'post_option_1','subarticle'], 'string'],
            [['title_sr_latn', 'menu_title_sr_latn', 'heading_sr_latn', 'link_sr_latn', 'title_en', 'menu_title_en', 'heading_en', 'link_en', 'menu_icon', 'icon', 'image'], 'string', 'max' => 255],
            [['e_mail', 'tel_1', 'tel_2', 'post_name', 'address', 'price'], 'string', 'max' => 55],
            [['lat', 'long'], 'string', 'max' => 15],
            [['slave_id'], 'exist', 'skipOnError' => true, 'targetClass' => Slave::class, 'targetAttribute' => ['slave_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slave_id' => 'Slave ID',
            'no' => 'No',
            'menu_option' => 'Menu Option',
            'page_active' => 'Page Active',
            'page_option' => 'Page Option',
            'page_option_1' => 'Page Option 1',
            'title_sr_latn' => 'Title Sr Latn',
            'menu_title_sr_latn' => 'Menu Title Sr Latn',
            'heading_sr_latn' => 'Heading Sr Latn',
            'description_sr_latn' => 'Description Sr Latn',
            'text_sr_latn' => 'Text Sr Latn',
            'basic_sr_latn' => 'Basic Sr Latn',
            'link_sr_latn' => 'Link Sr Latn',
            'title_en' => 'Title En',
            'menu_title_en' => 'Menu Title En',
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
     * Gets query for [[Slave]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSlave()
    {
        return $this->hasOne(Slave::class, ['id' => 'slave_id']);
    }

    /**
     * Gets query for [[Ssslaves]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSsslaves()
    {
        return $this->hasMany(Ssslave::class, ['sub_slave_id' => 'id']);
    }
}
