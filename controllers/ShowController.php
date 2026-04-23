<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Show;

class ShowController extends Controller
{
    public function actionIndex()
    {
        $shows = Show::find()->orderBy(['show_date' => SORT_ASC])->all();
        return $this->render('index', ['shows' => $shows]);
    }

    public function actionCreate()
    {
        $model = new Show();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Show berhasil ditambahkan');
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Show::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException("Show tidak ditemukan");
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Show berhasil diperbarui');
            return $this->redirect(['index']);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = Show::findOne($id);
        if ($model) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Show berhasil dihapus');
        }
        return $this->redirect(['index']);
    }
}
