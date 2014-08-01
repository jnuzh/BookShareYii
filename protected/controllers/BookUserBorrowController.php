<?php
require_once 'response.php';
class BookUserBorrowController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('list','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		if(!isset($_GET['id']))
                    _sendResponse(500, 'Record ID is missing');
                $record = BookUserBorrow::model()->findByPk($_GET['id']);
                if(is_null($record))
                    _sendResponse(404, 'No Record found');
                else
                    _sendResponse(200, CJSON::encode($record));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$record = new Record;
                if(isset($_POST['borrower']))
		{
                    $record->attributes = array('borrower'=>$_POST['borrower'], 'borrow_time'=>new CDbExpression('NOW()'), 'due_time'=>$_POST['due_time']);
                    if($record->save()){ 
                        _sendResponse(200, CJSON::encode($record));
                    }else{
                        _sendResponse(403, 'Could not borrow book');
                    }
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BookUserBorrow']))
		{
			$model->attributes=$_POST['BookUserBorrow'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	/**
	 * Lists all models.
	 */
	public function actionList()
	{
		$records = BookUserBorrow::model()->findAll();
                if(empty($records)) 
                    $this->_sendResponse(200, 'No Records');
                else
                {
                    $rows = array();
                    foreach($records as $record)
                    $rows[] = $record->attributes;
                    $this->_sendResponse(200, CJSON::encode($rows));
                }
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BookUserBorrow('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BookUserBorrow']))
			$model->attributes=$_GET['BookUserBorrow'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BookUserBorrow the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BookUserBorrow::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BookUserBorrow $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='book-user-borrow-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
