<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\enums\CategoriaEnum;
use Ramsey\Uuid\Uuid;

/**
 * This is the model class for table "produto".
 *
 * @property string $id
 * @property string $nome
 * @property int $quantidade
 * @property int $categoria
 */
class Produto extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%produto}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // Validação para o campo 'nome'
            ['nome', 'required', 'message' => 'O campo Nome é obrigatório.'],
            ['nome', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'O Nome deve ter no mínimo 2 caracteres.', 'tooLong' => 'O Nome deve ter no máximo 255 caracteres.'],

            // Validação para o campo 'quantidade'
            ['quantidade', 'required', 'message' => 'O campo Quantidade é obrigatório.'],
            ['quantidade', 'integer', 'message' => 'A Quantidade deve ser um número inteiro.'],
            ['quantidade', 'compare', 'compareValue' => 1, 'operator' => '>=', 'message' => 'A Quantidade deve ser maior ou igual a 1.'],

            // Validação para o campo 'categoria' com enum
            ['categoria', 'in', 'range' => CategoriaEnum::getValues(), 'message' => 'Categoria inválida.']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'quantidade' => 'Quantidade',
            'categoria' => 'Categoria',
        ];
    }

    /**
     * Retorna o nome da categoria
     * @return string|null
     */
    public function getCategoriaNome()
    {
        return CategoriaEnum::getLabel($this->categoria);
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->id = Uuid::uuid4()->toString();
        }
        return parent::beforeSave($insert);
    }
} 