<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\models\Product;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $products = Product::find()->all();
        return $this->render('index', ['products' => $products]);
    }

    public function actionCreate()
    {
        $model = new Product();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile) {
                $filename = 'uploads/' . time() . '_' . preg_replace('/[^a-z0-9\-_\.]/i', '', $model->imageFile->baseName) . '.' . $model->imageFile->extension;

                // simpan dulu file nya
                if ($model->imageFile->saveAs(Yii::getAlias('@webroot') . '/' . $filename)) {
                    $model->image = $filename; // simpan path ke database
                }
            }

            if ($model->save(false)) { // pakai save(false) biar tidak ulang validasi file
                Yii::$app->session->setFlash('success', 'Produk berhasil ditambahkan');
                return $this->redirect(['admin/index']);
            }
        }

        return $this->render('create', ['model' => $model]);
    }


    public function actionEdit($id)
{
    $model = Product::findOne($id);
    if (!$model) {
        throw new NotFoundHttpException('Produk tidak ditemukan');
    }

    $oldImage = $model->image; // simpan path lama

    if ($model->load(Yii::$app->request->post())) {
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        if ($model->imageFile) {
            $filename = 'uploads/' . time() . '_' . preg_replace(
                '/[^a-z0-9\-_\.]/i',
                '',
                $model->imageFile->baseName
            ) . '.' . $model->imageFile->extension;

            if ($model->imageFile->saveAs(Yii::getAlias('@webroot') . '/' . $filename)) {
                // ✅ kalau ada file lama → hapus
                if ($oldImage && file_exists(Yii::getAlias('@webroot') . '/' . $oldImage)) {
                    @unlink(Yii::getAlias('@webroot') . '/' . $oldImage);
                }
                $model->image = $filename;
            }
        } else {
            // tidak ada upload baru → tetap pakai gambar lama
            $model->image = $oldImage;
        }

        if ($model->save(false)) {
            Yii::$app->session->setFlash('success', 'Produk berhasil diperbarui');
            return $this->redirect(['admin/index']);
        }
    }

    return $this->render('edit', ['model' => $model]);
}



    public function actionDelete($id)
    {
        $model = Product::findOne($id);
        if ($model) {
            // (opsional) hapus gambar fisik
            if ($model->image && file_exists(Yii::getAlias('@webroot') . '/' . $model->image)) {
                @unlink(Yii::getAlias('@webroot') . '/' . $model->image);
            }
            $model->delete();
            Yii::$app->session->setFlash('success', 'Produk berhasil dihapus');
        }
        return $this->redirect(['admin/index']);
    }

    public function actionView($id)
    {
        $model = Product::findOne($id);
        if (!$model) throw new NotFoundHttpException('Produk tidak ditemukan');
        return $this->render('view', ['model' => $model]);
    }
}
