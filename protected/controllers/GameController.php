<?php

class GameController extends Controller
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
				'actions'=>array('index','view', 'list', 'quickie', 'getnewquickieround'),
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
		$model=new Game;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Game']))
		{
			$model->attributes=$_POST['Game'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		else
		{
			// setting the default score to 11
			$model->score_home 		= 11;
			$model->score_visitor 	= 11;
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Game']))
		{
			$model->attributes=$_POST['Game'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Game');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Game('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Game']))
			$model->attributes=$_GET['Game'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Game::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='game-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionList()
    {
        // $games = Game::model()->findAll( array( 'order' => 'id DESC' ) );
        // $this->render( 'list', array( 'games' => $games ) );

        $dataProvider=new CActiveDataProvider(
												'Game', 
												array( 
													'criteria' => array( 'order' => 'created DESC' ),
													'pagination' => array( 'pageSize' => 12 ) 
												));
       
		$this->render('list',array(
			'dataProvider'=>$dataProvider,
		));
    }

    /**
     *
     */
    public function actionQuickie()
    {
        $this->render( 'quickie' );
    }

    public function actionGetNewQuickieRound()
    {
		$round = Yii::app()->request->getParam( 'ugss_round' );

		if( $round )
		{
			unset( $_POST[ 'ugss_round' ] );
		
			// alright at this point $_POST should be an array with more than 0 
			// players in it ...
			if( sizeof( $_POST ) )
			{
				$pair1 		= $pair2 = NULL;
				$score1 	= $score2 = 0;
				$winners 	= array();

				// we grab the names in pairs with the scores and figure out who won  
				// and simply return the winners
				foreach( $_POST as $name => $score)
				{
					if( ! $pair1 )
					{
						$pair1 	= $name;
						$score1 = $score;
					}
					else
					{
						$pair2 	= $name;
						$score2 = $score;
					}

					// let's see who won
					if( $pair1 && $pair2 )
					{
						// if the game is a tie, the first player wins ,,,
						$winner = new stdClass();
						if( $score2 > $score1 )
						{
							$winner->name = $pair2;
							$winners[] = $winner;
						}
						else
						{
							$winner->name = $pair1;
							$winners[] = $winner;
						}

						// we zero everything out and start from scratch ...
						$pair1 		= $pair2 = NULL;
						$score1 	= $score2 = 0;
					}
				}

				// if there is a player left, it's an automatic winner
				if( $pair1 )
				{
					$winner = new stdClass();
					$winner->name = $pair1;
					$winners[] = $winner;
				}
	
				// apprarently you have to wrap the result in (); to pass it
				// as a JavaScript JSON ---
				header( 'Content-type: application/json' );
				die( '(' . json_encode( $winners ) . ');' );
			}
		}
		die( 'err' );        
    }
}
