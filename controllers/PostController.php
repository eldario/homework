<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use app\models\Language;
use app\models\Author;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class PostController extends Controller
{
	const DATE_START = '01.01.2017';
	const DATE_END = '08.08.2017';
	const LIKES_LIMIT = 5000;
	
    public function behaviors(){
        return [
            'verbs' => [
                'class' => VerbFilter::className()
            ],
        ];
    }
 
    public function actionIndex(){
        return $this->render('index', [
			'posts'=>$this->findAll(),
        ]);
    }
    
    public function actionUpdate($positions = 5){
		if(!$langs = $this->findSomething(new Language)){
			throw new NotFoundHttpException('No langs');
		}
		if(!$authors = $this->findSomething(new Author)){
			throw new NotFoundHttpException('No authors');
		}
		$mega = [];
		foreach(range(0,$positions) as $itter){
			shuffle($langs);
			shuffle($authors);
			$l = $langs[0]['id'];
			$likes = rand(1,9999);
			$mega[] = [$l, $authors[0]['id'], $this->getSomeDate(), $this->getTitle($l), $this->getContent($l),$likes];
		}
		Yii::$app->db->createCommand()->batchInsert('Posts', ['language','author','date','title','content', 'likes'], $mega)->execute();
		return $this->render('index', [
			'posts'=>$this->findAll()
        ]);
    }
	
	protected function getSomeDate(){
		$date = range(strtotime(self::DATE_START),strtotime(self::DATE_END),86400);
		shuffle($date);
		return date('d.m.Y',$date[0]);
	}
	
	protected function findSomething($class){
		return $class->find()->select(['id'])->asArray()->all();
	}
	
	protected function getTitle($langId){
		$titles = [
			1=>["жесть", "удивительно", "снова", "совсем", "шок", "случай", "сразу", "событие", "начало", "вирус"],
			2=>["currency", "amazing", "again", "absolutely", "shocking", "case", "immediately", "event", "beginning", "virus"]
		];
		$langId = isset($titles[$langId]) ? $langId : 1;
		shuffle($titles[$langId]);
		$title = array_splice($titles[$langId],0,rand(4,6));
		return $this->mb_ucfirst(join(' ',$title));
	}
		
	protected function getContent($langId){
		$words = [
			1=>["один", "еще", "бы", "такой", "только", "себя", "свое", "какой", "когда", "уже", "для", "вот", "кто", "да", "говорить", "год", "знать", "мой", "до", "или", "если", "время", "рука", "нет", "самый", "ни", "стать", "большой", "даже", "другой", "наш", "свой", "ну", "под", "где", "дело", "есть", "сам", "раз", "чтобы", "два", "там", "чем", "глаз", "жизнь", "первый", "день", "тута", "во", "ничто", "потом", "очень", "со", "хотеть", "ли", "при", "голова", "надо", "без", "видеть", "идти", "теперь", "тоже", "стоять", "друг", "дом", "сейчас", "можно", "после", "слово", "здесь", "думать", "место", "спросить", "через", "лицо", "что", "тогда", "ведь", "хороший", "каждый", "новый", "жить", "должный", "смотреть", "почему", "потому", "сторона", "просто", "нога", "сидеть", "понять", "иметь", "конечный", "делать", "вдруг", "над", "взять", "никто", "сделать"],
			2=>["one", "yet", "would", "such", "only", "yourself", "his", "what", "when", "already", "for", "behold", "Who", "yes", "speak", "year", "know", "my", "before", "or", "if", "time", "arm", "no", "most", "nor", "become", "big", "even", "other", "our", "his", "well", "under", "where", "a business", "there is", "himself", "time", "that", "two", "there", "than", "eye", "a life", "first", "day", "mulberry", "in", "nothing", "later", "highly", "with", "to want", "whether", "at", "head", "need", "without", "see", "go", "now", "also", "stand", "friend", "house", "now", "can", "after", "word", "here", "think", "a place", "ask", "across", "face", "what", "then", "after all", "good", "each", "new", "live", "due", "look", "why", "because", "side", "just", "leg", "sit", "understand", "have", "finite", "do", "all of a sudden", "above", "to take", "no one", "make"]
		];
		$langId = isset($words[$langId]) ? $langId : 1;
		$content = [];
		$t = rand(2,3);
		foreach(range(0,$t) as $a){
			shuffle($words[$langId]);
			$title = join(' ',array_splice($words[$langId],0,rand(5,8)));
			$content[] = $this->mb_ucfirst($title);
		}
		return join(' ',$content);
	}
	
	protected function mb_ucfirst($string){
		return mb_strtoupper(mb_substr($string, 0, 1)).mb_strtolower(mb_substr($string, 1)).'.';
	}

    protected function findAll(){
        if (($model = Post::find()->orderBy(['RANDOM()' => SORT_DESC])->limit(10)->offset(0)->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
