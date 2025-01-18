<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_settings".
 *
 * @property int $id
 * @property string|null $address
 * @property string|null $bd
 * @property string|null $avatar_path
 * @property string|null $about
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $messenger
 * @property int|null $notify_new_msg
 * @property int|null $notify_new_action
 * @property int|null $notify_new_reply
 * @property int|null $opt_hide_contacts
 * @property int|null $opt_hide_me
 * @property int|null $is_performer
 * @property int $user_id
 *
 * @property Users $user
 */
class UserSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bd'], 'safe'],
            [['about'], 'string'],
            [['notify_new_msg', 'notify_new_action', 'notify_new_reply', 'opt_hide_contacts', 'opt_hide_me', 'is_performer', 'user_id'], 'integer'],
            [['user_id'], 'required'],
            [['address', 'avatar_path'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 11],
            [['skype', 'messenger'], 'string', 'max' => 32],
            [['user_id'], 'unique'],
            [['phone', 'skype', 'messenger'], 'unique', 'targetAttribute' => ['phone', 'skype', 'messenger']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Адрес',
            'bd' => 'Дата рождения',
            'avatar_path' => 'Аватар',
            'about' => 'Описание',
            'phone' => 'Телефон',
            'skype' => 'Skype',
            'messenger' => 'Уведомление',
            'notify_new_msg' => 'Новое уведомление',
            'notify_new_action' => 'Новое действие',
            'notify_new_reply' => 'Новый отклик',
            'opt_hide_contacts' => 'Скрыть контакты',
            'opt_hide_me' => 'Скрыть меня',
            'is_performer' => 'Исполнитель',
            'user_id' => 'ID пользователя',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserSettingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserSettingsQuery(get_called_class());
    }
}
