<?php

class NotesListController extends Controller
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
				'actions'=>array('index','view','admin','delete','create','update', 'export'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new NotesList;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$model = $this->toSave($model, "save");
		$this->render('create',array(
			'model'=>$model,
		));
	}

	private function toSave($model, $action = ""){
		if(isset($_POST['NotesList']))
		{
			$tmp = $_POST['NotesList'];
			
			if($action == "save"){
				$tmp['date'] = date("d-m-Y");
			}
			
			$model->attributes=$tmp;
			
			$model->image=CUploadedFile::getInstance($model,'image');

			$tmp['image'] = $model->image->name;
		
			if($model->save()){
				
				$path = Yii::app()->basePath.'/../uploads/'.$model->id;

				if($action == "update" && !empty($model->image->name) && file_exists($path."/".$model->image->name)){
					unlink($path."/".$model->image->name);
				}

				if(!is_dir($path)){
					mkdir($path, 0777, true);
				}
				if(!empty($tmp['image'])){
					$model->image->saveAs($path."/".$tmp['image']);
				}
				$this->redirect(array('admin'));
			}
		}
		return $model;
	
	
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

		$model = $this->toSave($model, "update");

		$this->render('update',array(
			'model'=>$model,
		));
	}
	/****Export to csv file and by email****/
	public function actionExport(){
		Yii::import('ext.ECSVExport');
		$cmd = Yii::app()->db->createCommand("SELECT * FROM tbl_notes_list ");
		$csv = new ECSVExport($cmd);
		$outputFile = "uploads/export.csv";        
		
		 if(empty($_GET['email'])){
		 	 $content= $csv->toCSV();
		 	Yii::app()->getRequest()->sendFile($outputFile, $content, "text/csv", false);
		 }else{
		 	 $csv->setOutputFile($outputFile);
			 $csv->toCSV();
			 $message = new YiiMailMessage;
			 
			 $message->setBody('Export CSV', 'text/html');
			 $message->subject = 'Export CSV';
			 $message->addTo(Yii::app()->params['adminEmail']);
			 $message->from = Yii::app()->params['adminEmail'];
			 $message->attach(Swift_Attachment::fromPath($outputFile)); 
			 Yii::app()->mail->send($message);
			 $this->redirect(array('admin','export'=>'yes'));
		 	
		 }
 		
		Yii::app()->end();
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
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('NotesList');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new NotesList('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NotesList']))
			$model->attributes=$_GET['NotesList'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return NotesList the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=NotesList::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param NotesList $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='notes-list-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
