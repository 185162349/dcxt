<?php

namespace backend\controllers;

use common\models\Image;
use Yii;
use common\models\CaiPin;
use common\models\search\CaiPinSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CaiController implements the CRUD actions for CaiPin model.
 */
class CaiController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CaiPin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CaiPinSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CaiPin model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CaiPin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CaiPin();
        if ($model->load(Yii::$app->request->post())) {
            //$db = mysql_connect('localhost','root','Ctrip07185419') or die('can not connect to database');
//mysql_select_db('moviesite',$db) or die(mysql_error($db));
//上传文件的路径
            $dir = 'E:\dcxt\yii2\frontend\web\image';
            /*
            $_FILES:用在当需要上传二进制文件的地方,获得该文件的相关信息
            $_FILES['userfile']['name'] 客户端机器文件的原名称。
            $_FILES['userfile']['type'] 文件的 MIME 类型，需要浏览器提供该信息的支持，例如“image/gif”
            $_FILES['userfile']['size'] 已上传文件的大小，单位为字节
            $_FILES['userfile']['tmp_name'] 文件被上传后在服务端储存的临时文件名,注意不要写成了$_FILES['userfile']['temp_name']很容易写错的，虽然tmp就是代表临时的意思，但是这里用的缩写
            $_FILES['userfile']['error'] 和该文件上传相关的错误代码。['error']
            */
            if($_FILES['uploadfile']['error'] != UPLOAD_ERR_OK)
            {
                switch($_FILES['uploadfile']['error'])
                {
                    case UPLOAD_ERR_INI_SIZE: //其值为 1，上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值
                        die('The upload file exceeds the upload_max_filesize directive in php.ini');
                        break;
                    case UPLOAD_ERR_FORM_SIZE: //其值为 2，上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值
                        die('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.');
                        break;
                    case UPLOAD_ERR_PARTIAL: //其值为 3，文件只有部分被上传
                        die('The uploaded file was only partially uploaded.');
                        break;
                    case UPLOAD_ERR_NO_FILE: //其值为 4，没有文件被上传
                        die('No file was uploaded.');
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR: //其值为 6，找不到临时文件夹
                        die('The server is missing a temporary folder.');
                        break;
                    case UPLOAD_ERR_CANT_WRITE: //其值为 7，文件写入失败
                        die('The server failed to write the uploaded file to disk.');
                        break;
                    case UPLOAD_ERR_EXTENSION: //其他异常
                        die('File upload stopped by extension.');
                        break;
                }
            }

            //$image_caption = $_POST['caption'];
            $image_username = $_POST['CaiPin']['name'];
            $image_date = date('Y-m-D');
            /*getimagesize方法返回一个数组，
            $width : 索引 0 包含图像宽度的像素值，
            $height : 索引 1 包含图像高度的像素值，
            $type : 索引 2 是图像类型的标记：
            1 = GIF，2 = JPG， 3 = PNG， 4 = SWF， 5 = PSD， 6 = BMP，
            7 = TIFF(intel byte order)，8 = TIFF(motorola byte order)，
            9 = JPC，10 = JP2，11 = JPX，12 = JB2，13 = SWC，14 = IFF，15 = WBMP，16 = XBM，
            $attr : 索引 3 是文本字符串，内容为“height="yyy" width="xxx"”，可直接用于 IMG 标记
            */

            list($width,$height,$type,$attr) = getimagesize($_FILES['uploadfile']['tmp_name']);

//imagecreatefromgXXX方法从一个url路径中创建一个新的图片
            switch($type)
            {
                case IMAGETYPE_GIF:
                    $image = imagecreatefromgif($_FILES['uploadfile']['tmp_name']) or die('The file you upload was not supported filetype');
                    $ext = '.gif';
                    break;
                case IMAGETYPE_JPEG:
                    $image = imagecreatefromjpeg($_FILES['uploadfile']['tmp_name']) or die('The file you upload was not supported filetype');
                    $ext = '.jpg';
                    break;
                case IMAGETYPE_PNG:
                    $image = imagecreatefrompng($_FILES['uploadfile']['tmp_name']) or die('The file you upload was not supported filetype');
                    $ext = '.png';
                    break;
                default    :
                    die('The file you uploaded was not a supported filetype.');
            }
            $lsmodel = new Image();
            //$model->image_caption = $image_caption;
            $lsmodel->image_username = $image_username;
            $lsmodel->image_date = time();
            $lsmodel->save(false);
            $last_id = $lsmodel->id;
//用写入的id作为图片的名字，避免同名的文件存放在同一目录中
            $imagename = $last_id.$ext;
            $imageModel = Image::findOne(['id' => $last_id]);
            $imageModel->image_filename = $imagename;
            $imageModel->save(false);
            $model->img = $imagename;
            $model->save(false);
//有url指定的图片创建图片并保存到指定目录
            switch($type)
            {
                case IMAGETYPE_GIF:
                    imagegif($image,$dir.'/'.$imagename);
                    break;
                case IMAGETYPE_JPEG:
                    imagejpeg($image,$dir.'/'.$imagename);
                    break;
                case IMAGETYPE_PNG:
                    imagepng($image,$dir.'/'.$imagename);
                    break;
            }
//销毁由url生成的图片
            imagedestroy($image);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CaiPin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CaiPin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CaiPin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CaiPin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CaiPin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
