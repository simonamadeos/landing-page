<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\Hero;
use app\models\Product;
use app\models\Show;
use app\models\Testimonial;

class LandingController extends Controller
{
    public function actionIndex()
    {
        $hero = Hero::find()->one();
        $products = Product::find()->all(); 

        if (empty($products)) {
            $products = [
                (object)['image' => 'img/prod1.jpg', 'name' => 'Tigers Jaw', 'price' => 250000, 'description' => ''],
                (object)['image' => 'img/prod2.jpg', 'name' => 'I Wont Care How You Remember', 'price' => 99000, 'description' => ''],
                (object)['image' => 'img/prod3.jpg', 'name' => 'Charmer', 'price' => 199000, 'description' => ''],
            ];
        }

        // pastikan $shows selalu ada, tidak tergantung if
        $shows = Show::find()->orderBy(['show_date' => SORT_ASC])->all();
        $testimonials = Testimonial::find()->all();

        return $this->render('index', [
            'hero' => $hero,
            'products' => $products,
            'shows' => $shows,
            'testimonials' => $testimonials

        ]);
    }
}
