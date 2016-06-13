<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\components\MarkWenZi;
use app\components\EvaluationWidget;
use yii\helpers\Url;
use yii\bootstrap\Modal;

class IndexAsset extends \app\assets\BaseAsset {

    public $css = ['css/student1.css'];
    public $js = ['js/student1.js'];

}

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentbasicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '学生板块';
$this->params['breadcrumbs'][] = $this->title;
IndexAsset::register($this);
$imgUrl = $this->assetBundles[IndexAsset::className()]->baseUrl . '/image/';
?>
<div class="studentbasic-table-index" >
    <!--用户信息-->
    <span class="btn btn-default span3">您的信息：</span>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'student_id',
            'name',
            'sex',
            'dept',
            'class',
        ],
    ]);
    ?>
    <!--评价填写-->
    <form action="<?= Url::toRoute(['student-basic/create']) ?>" name="star" method="post">
        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <h1 class="titleOne">2015-2016学年  上学期总评</h1>
        <div class="colorPieceOne"></div>
        
        <!-- 学期总评-->
        <div class="row">
            <div class="col-lg-10   col-xs-8 generalComment">
                <div class=row>
                    <div class="col-lg-4  col-xs-6 titleTwo">
                        <span class="span1">学期总评</span>
                    </div>
                    <div class="col-lg-8 col-xs-6 colorPieceTwo"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-xs-8 colorPieceThree"></div>
        </div>
        <!--校园四大项打分+文字评价-->
        <?php
        $star_items = [
            ['name' => 'zt', 'label' => '总体评价', 'title' => '学校整体怎么样'],
            ['name' => 'jxhj', 'label' => '教学环境', 'title' => '教学设施，教学内容，师资力量等'],
            ['name' => 'zshj', 'label' => '住宿环境', 'title' => '寝室安保，家具质量，水电网络系统，舒适度'],
            ['name' => 'yshj', 'label' => '饮食环境', 'title' => '寝室安保，家具质量，水电网络系统，舒适度']
        ];

        foreach ($star_items as $data):
            ?>
            <div class="row starRow">
                <div class="col-lg-4 col-xs-5 col-lg-offset-2 col-md-offset-1 ">
                    <span class="span2"><?= $data['label'] ?>：</span>
                    <?php
                    $star_opt = ['type' => 'star', 'name' => $data['name']];
                    if (isset($studentmark1->$data['name'])) {
                        $star_opt['disabled'] = true;
                        $star_opt['value'] = $studentmark1->$data['name'];
                    }
                    echo EvaluationWidget::widget($star_opt);
                    ?>
                </div>
                <div class="starRowRight col-lg-5 col-xs-6">
                    <span ><?= $data['title'] ?></span>
                    <?php if ($data['name'] != 'zt' && !isset($studentmark1->$data['name'])): ?>
                        <span class="more">文字评价</span>
                    <?php endif; ?>
<?php if (isset($studentmark1->$data['name'])): ?><span class="yitian">已填</span><?php endif; ?>
                </div>   
            </div>
            <?php
            if ($data['name'] != 'zt')
                echo MarkWenZi::widget(['dafen' => $data['name'], 'buju' => 'boxt']);
        endforeach;
        ?>

        <div class="row spacingThree">
            <div class="col-lg-11 " style="background-color:#e1e1e1;height: 2px;"></div>
        </div>
        <div class="row spacingFour">
            <div class="col-lg-9 " style="height: 80px;">

            </div>
        </div>
        <!--课程评价+教师信息-->
        <div class="row">
            <div class="col-lg-10   col-xs-9 curriculumEvaluation">
                <div class=row>
                    <div class="col-lg-4  col-xs-7 titleTwo">
                        <span class="span1">课程评价</span>
                    </div>
                    <div class="col-lg-8 col-xs-5 colorPieceTwo"></div>
                </div>
            </div>
        </div>
        <!--任课教师信息 -->
        <ul class="teacher-list list-unstyled row">
             <?php foreach ($courses as $course) { ?>
             <li class="col-lg-3 col-md-4 col-sm-6">
                <div class="teacher-item <?php $finished = false;
                    foreach ($studentmarkt as $data)
                        if ($data['teacher_id'] == $course['teacher_id']) {
                            $finished = true;
                            break;
                        }
                    if($finished) 
                        echo 'finished';
                    ?> " Cname="<?= '课程：' . $course['course_name']; ?>" Tname="<?= '教师：' . $course['teacher_name']; ?>" teacher_id="<?= $course['teacher_id'] ?>" >
                    <img src="<?= $imgUrl . 'js.png'; ?>">
                    <span class="course"> <?= $course['course_name'] ?></span>
                    <span class="teacher"> <?= $course['teacher_name'] ?></span>
                <?php } ?>
                </div>
            </li>
        </ul>

        <div class="row colorPieceFive">
            <div class="col-lg-11 " style="background-color:#e1e1e1;height: 2px;"></div>
        </div>
       <!-- 补充评价-->
        <div class="row" >
            <div class="col-lg-10   col-xs-10 supplementaryEvaluation">
                <div class=row>
                    <div class="col-lg-4  col-xs-7 titleTwo">
                        <span class="span1">补充评价</span>
                    </div>
                    <div class="col-lg-8 col-xs-5 colorPieceTwo"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10   col-xs-10 colorPieceThree"></div>
        </div>
        <div class="row">
            <div class="col-md-10 "style="margin-left: 74px; margin-top: 40px;">

            <?php 
            echo EvaluationWidget::widget(['type' => 'longtext', 'name' => 'bcpj', 'textarea' => [ 'rows' => 15, 'placeholder' => '请填写意见']]);

            // 读取机构列表
            $data = [];
            foreach (app\models\Organization::find()->each(10) as $org) {
                $data[] = ['name' => 'org_' . $org->org_id, 'label' => $org->name];
            }

            echo EvaluationWidget::widget([
                'type'=>'checkgroup',
                'params' => [
                    'title'=>'以下勾选的职能部门将收到我的补充评价：',
                    'items' => $data,
                ]
            ])
            /* 部门评价结束 */
            ?>
            </div>
        </div>
        <div class="separator"></div>
        <div class="text-center">
            <input type="submit" id="submit" value="评价完成，提交" />
        </div>
    
    </form>

<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>    

</div>

<!-- 教师评价模态框 -->
<?php
Modal::begin([
    'header' => '<h2 id="a"></h2> <h2 id="b"> </h2>',
    'id' => 'ajaxDialog',
    'size' => Modal::SIZE_LARGE,
    'footer' => '
		<button class="btn btn-default" data-dismiss="modal">关闭</button>
		<button class="btn btn-primary" id="ajaxSubmit">提交</button>']);

echo Html::beginForm(['student-basic/teacher'], 'post', ['id' => 'ajaxForm'])
?>
<!--模态框内容-->
<input name="teacher_id" type="hidden" />
<div class="container">
    <div class="col-md-4 colorPieceEight" >
        <div class="row colorPieceSix">
            <div class="col-md-12">
                <span class="span2">课堂风采：</span><?= EvaluationWidget::widget(['type' => 'star', 'name' => 'ktfc']) ?>
            </div>
        </div>
        <div class="row colorPieceSix ">
            <div class="col-md-12">
                <span class="span2">课后辅导：</span><?= EvaluationWidget::widget(['type' => 'star', 'name' => 'khfd']) ?>
            </div>
        </div>
        <div class="row colorPieceSix">
            <div class="col-md-12">
                <span class="span2">人物魅力：</span><?= EvaluationWidget::widget(['type' => 'star', 'name' => 'rwml']) ?>
            </div>
        </div>
    </div>
    <div class="col-md-4 colorPieceSeven" >
        <textarea type="text" name="totw"   placeholder="意见反馈" rows="8" cols="60" autofocus ></textarea>
        <input type="text" name="totr" placeholder="热词"/>      
    </div>
</div>
<div class="result-container">
    <div class="separator"></div>
    <div class="result"></div>
</div>
<?php
echo Html::endForm();
Modal::end();
?>