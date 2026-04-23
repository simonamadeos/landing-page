<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Order;

class OrderController extends Controller
{
    public function actionCheckout()
    {
        $model = new Order();

        // Ambil total harga dari session cart
        $cart = Yii::$app->session->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->total = $total;
            if ($model->save()) {
                // Bersihkan cart setelah order tersimpan
                Yii::$app->session->remove('cart');
                Yii::$app->session->setFlash('success', 'Order berhasil disimpan!');
                
                // ✅ Redirect bawa ID order
                return $this->redirect(['order/success', 'id' => $model->id]);
            }
        }

        return $this->render('checkout', [
            'model' => $model,
            'total' => $total
        ]);
    }

    public function actionSuccess($id)
    {
        $order = Order::findOne($id);

        if (!$order) {
            throw new \yii\web\NotFoundHttpException("Order tidak ditemukan.");
        }

        return $this->render('success', [
            'order' => $order
        ]);
    }
}
