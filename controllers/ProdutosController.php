<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\web\Controller;
use app\models\Produto;
use yii\filters\Cors;
use app\enums\CategoriaEnum;

use Yii;

class ProdutosController extends Controller
{
    public $modelClass = 'app\models\Produto';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        // Configurar o ContentNegotiator para JSON
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => false,
                'Access-Control-Allow-Headers' => ['*'],
                'Access-Control-Expose-Headers' => ['Authorization'],
                'Access-Control-Max-Age' => 3600,
            ],
        ];

        return $behaviors;
    }
    
    public function actions()
    {
        $actions = parent::actions();
        $actions['options'] = [
            'class' => 'yii\rest\OptionsAction',
        ];

        return $actions;
    }
    
    public function actionIndex()
    {
        $produtos = Produto::find()->asArray()->all();;
        foreach($produtos as &$produto) {
            $produto["categoria_descricao"] = CategoriaEnum::getLabel($produto["categoria"]);
        }
        return $produtos;
    }

    public function actionCreate()
    {
        $produto = new Produto();
        $produto->load(Yii::$app->request->post(), '');

        if ($produto->validate() && $produto->save()) {
            return [
                'success' => true,
                'message' => 'Produto criado com sucesso',
                'data' => $produto
            ];
        }

        return [
            'success' => false,
            'message' => 'Erro ao criar produto',
            'errors' => $produto->errors
        ];
    }

    public function actionUpdate($id)
    {
        $form = Yii::$app->request->post();
        if ($form['id'] != $id) {
            return [
                'success' => false,
                'message' => 'ID do produto não corresponde.',
            ];
        }

        $produto = Produto::findOne($id);

        if (!$produto) {
            return [
                'success' => false,
                'message' => 'Produto não encontrado.',
            ];
        }

        // Carregar os dados enviados via PUT
        $produto->load(Yii::$app->request->bodyParams, '');

        if ($produto->validate() && $produto->save()) {
            return [
                'success' => true,
                'message' => 'Produto atualizado com sucesso',
                'data' => $produto
            ];
        }

        return [
            'success' => false,
            'message' => 'Erro ao atualizar produto',
            'errors' => $produto->errors
        ];
    }

    public function actionView($id)
    {
        $produto = Produto::findOne($id);
        if (!$produto) {
            return [
                'success' => false, 
                'message' => 'Produto não encontrado.',
            ];
        }

        return [
            'success' => true,
            'data' => $produto  
        ];
    }

    public function actionDelete($id)
    {
        $produto = Produto::findOne($id);   
        if (!$produto) {
            return [
                'success' => false,
                'message' => 'Produto não encontrado.',
            ];
        }

        if ($produto->delete()) {
            return [
                'success' => true,
                'message' => 'Produto deletado com sucesso.',
            ];
        }

        return [
            'success' => false,
            'message' => 'Erro ao deletar produto',
        ];
    }
}
