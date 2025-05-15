<?php

namespace app\controllers;
use yii\web\Controller;
use app\enums\CategoriaEnum;

class CategoriasController extends Controller
{
    public function actionIndex()
    {
        $categorias = [];
        foreach (CategoriaEnum::getLabels() as $valor => $descricao) {
            $categorias[] = [
                'codigo' => $valor,
                'descricao' => $descricao
            ];
        }

        return $categorias;
    }

}
