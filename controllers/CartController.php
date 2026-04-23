<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class CartController extends Controller
{
    public function actionIndex()
    {
        $cart = Yii::$app->session->get('cart', []);
        return $this->render('index', [
            'cart' => $cart
        ]);
    }

    public function actionAdd($id)
    {
        $session = Yii::$app->session;
        $cart = $session->get('cart', []);

        // ambil data produk dari database
        $product = \app\models\Product::findOne($id);
        if (!$product) {
            throw new \yii\web\NotFoundHttpException("Produk tidak ditemukan");
        }

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
            ];
        }

        $session->set('cart', $cart);
        Yii::$app->session->setFlash('success', $product->name . " berhasil ditambahkan ke keranjang!");
        return $this->redirect(['cart/index']);
    }

    public function actionUpdate($id)
    {
        $session = Yii::$app->session;
        $cart = $session->get('cart', []);

        if (Yii::$app->request->isPost && isset($cart[$id])) {
            $qty = (int)Yii::$app->request->post('qty');
            $cart[$id]['qty'] = $qty > 0 ? $qty : 1;
            $session->set('cart', $cart);
        }

        return $this->redirect(['index']);
    }

    public function actionRemove($id)
    {
        $session = Yii::$app->session;
        $cart = $session->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $session->set('cart', $cart);
        }

        Yii::$app->session->setFlash('success', 'Item berhasil dihapus dari keranjang.');
        return $this->redirect(['index']);
    }

    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->remove('cart');
        Yii::$app->session->setFlash('success', 'Keranjang berhasil dikosongkan.');
        return $this->redirect(['index']);
    }
}
