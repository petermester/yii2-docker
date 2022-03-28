<?php

namespace app\controllers;

use app\models\Weather;
use yii\base\BaseObject;
use yii\data\Pagination;
use yii\db\Exception;
use yii\web\NotFoundHttpException;
use yii\httpclient\Client;

class WeatherController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Weather::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $weathers = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'countries' => $weathers,
            'pagination' => $pagination,
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
        ]);
        // return $this->render('index');
    }

    /**
     * Displays a single Weather model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Weather model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Weather();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Weather model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Weather model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Weather model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Weather the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Weather::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Get entities by api.
     * Save entities into the database.
     */
    public function actionFetch()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('https://api.publicapis.org/entries')
            ->send();
        if ($response->isOk) {
            foreach ($response->data['entries'] as $element) {
                if (Weather::find()
                    ->where(['title' => $element['API']])
                    ->count() == 0)
                {
                    $weather = new Weather();
                    $weather->setAttribute('title', $element['API']);
                    $weather->setAttribute('description', $element['Description']);
                    $weather->setAttribute('link', $element['Link']);
                    try {
                        $weather->save();
                    } catch (Exception $e) {
                        // @TODO handle exception!
                    }

                }

            }

        }

        return $this->render('index');
    }

}
