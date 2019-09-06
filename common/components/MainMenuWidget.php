<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 07.05.2016
 * Time: 10:35
 */

namespace common\components;
use yii\base\Widget;
use app\models\Category;
use Yii;

class MainMenuWidget extends Widget{

    public $tpl;
    public $model;
    public $data;
    public $tree;
    public $menuHtml;
    public $id;

    public function init(){
        parent::init();
        if( $this->tpl === null ){
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }

    public function run(){
        // get cache
        if($this->tpl == 'menu.php'){
            $menu = Yii::$app->cache->get('menu');
            if($menu) return $menu;
        }

        $this->data = \common\models\MenuItem::find()->where(['menu_id' => $this->id])->asArray()->all();

        $this->tree = $this->getTree();

        $this->menuHtml = $this->getMenuHtml($this->tree);

        // set cache
        if($this->tpl == 'menu.php'){
            //Yii::$app->cache->set('menu', $this->menuHtml, 1);
        }
        return $this->menuHtml;
    }

    protected function getTree(){
        $tree = [];
        foreach ($this->data as $id=>&$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = ''){
        $str = '';

        foreach ($tree as $item) {
            $str .= $this->catToTemplate($item, $tab);
        }
        return $str;
    }

    protected function catToTemplate($item, $tab){
        ob_start();
        include __DIR__ . '/main_menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }

} 