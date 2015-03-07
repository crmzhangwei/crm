<?php

/**
 *  GMenu.php 导航菜单类
 */
class GMenu extends CWidget {

    public $menuType = 'top';
    public $items = array();
    public $activateItems=true;
    public $encodeLabel=true;
    public $activeCssClass='active';
    public $activateParents=true;
    public $hideEmptyItems=false;
    public $htmlOptions = array();
    public $submenuHtmlOptions = array();
    public $linkLabelWrapper;
    public $linkLabelWrapperHtmlOptions = array();
    public $dropdownClass = 'dropdown';
    
    public function init() { 
        if (isset($this->htmlOptions['id']))
            $this->id = $this->htmlOptions['id'];
        else
            $this->htmlOptions['id'] = $this->id;
        $route = $this->getController()->getRoute();
        $this->items = $this->normalizeItems($this->items, $route, $hasActiveChild);
    }
    
    public function run() {
        if($this->menuType == 'top') {
            $this->renderTopMenu($this->items);
        } else {
            // var_dump($this->items);
            $this->renderSideMenu($this->items);
        }
    }
    
    public function renderTopMenu($items){
        if (count($items)) {
            echo CHtml::openTag('ul', $this->htmlOptions) . "\n";
            foreach ($items as $item) {
                $options = isset($item['itemOptions']) ? $item['itemOptions'] : array();
                $class = array();
                if ($item['active'] && $this->activeCssClass != '')
                    $class[] = $this->activeCssClass;
                if(!empty($item['dropdown']))
                    $class[] = $this->dropdownClass;
                if ($class !== array()) {
                    if (empty($options['class']))
                        $options['class'] = implode(' ', $class);
                    else
                        $options['class'].=' ' . implode(' ', $class);
                }                
                echo CHtml::openTag('li', $options);
                $menu = $this->renderMenuItem($item);
                echo $menu;
                if(!empty($item['dropdown'])){
                    echo CHtml::openTag('ul', array('class'=>"dropdown-menu"));                    
                    foreach ($item['dropdown'] as $dropdown) {
                        $dropdownOptions = array();
                        if(isset($dropdown['divider'])){
                            $dropdownOptions = array('class'=>'divider');
                        }
                        echo CHtml::openTag('li', $dropdownOptions);
                        if(!isset($dropdown['divider'])){
                            echo $this->renderMenuItem($dropdown);
                        }                        
                        echo CHtml::closeTag('li') . "\n";
                    }                    
                    echo CHtml::closeTag('ul');                    
                }
                echo CHtml::closeTag('li') . "\n";                
            }            
            echo CHtml::closeTag('ul');
        }
    }
    
    public function renderSideMenu($items){
        if (count($items)) {
            echo CHtml::openTag('ul', $this->htmlOptions) . "\n";
            foreach ($items as $item) {
                $options = isset($item['itemOptions']) ? $item['itemOptions'] : array();
                $class = array();
                if ($item['active'] && $this->activeCssClass != ''){
                    $class[] = $this->activeCssClass;
//                    $class[] = 'open';
                }
                if ($class !== array()) {
                    if (empty($options['class']))
                        $options['class'] = implode(' ', $class);
                    else
                        $options['class'].=' ' . implode(' ', $class);
                }                
                echo CHtml::openTag('li', $options);
                $menu = $this->renderMenuItem($item);
                echo $menu;
                if(!empty($item['items'])){
                    $suboptions = array('class'=>"submenu");  
                    if ($item['active'])
                        $suboptions['style'] = 'display: block';
                    echo CHtml::openTag('ul', $suboptions);                    
                    foreach ($item['items'] as $subitem) {
                        if ($subitem['active'] && $this->activeCssClass != ''){
                            echo CHtml::openTag('li', array('class'=>'active'));
                        } else {
                            echo CHtml::openTag('li');
                        }
                        echo $this->renderMenuItem($subitem);
                        echo CHtml::closeTag('li') . "\n";
                    }                    
                    echo CHtml::closeTag('ul'); 
                }
            }
            echo CHtml::closeTag('ul');
        }
    }
    
    protected function renderMenuItem($item) {
        if (isset($item['url'])) {
            $label = $this->linkLabelWrapper === null ? $item['label'] : CHtml::tag($this->linkLabelWrapper, $this->linkLabelWrapperHtmlOptions, $item['label']);
            if(!empty($item['dropdown']) && $this->menuType == 'top'){
                $label = $label . '<i class="icon-caret-down"></i>';
            } else {
                if (isset($item['items']) && count($item['items']) && isset($item['icon'])) {
                    $label = '<i class="'.$item['icon'].'"></i><span class="menu-text">' . $label . '</span>';
                    if($this->menuType != 'top'){
                        $label .= '<b class="arrow icon-angle-down"></b>';
                    }                    
                    $item['linkOptions'] = array('class'=>'dropdown-toggle');
                } else {
                    if($this->menuType != 'top'){
                        $label = '<i class="icon-double-angle-right"></i>' . $label;
                    }
                }
                
            }
            return CHtml::link($label, $item['url'], isset($item['linkOptions']) ? $item['linkOptions'] : array());
        } else
            return CHtml::tag('span', isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
    }

    protected function normalizeItems($items, $route, &$active) {
        if(!empty($items)){
            foreach ($items as $i => $item) {
                if (isset($item['visible']) && !$item['visible']) {
                    unset($items[$i]);
                    continue;
                }
                if (!isset($item['label']))
                    $item['label'] = '';
                if ($this->encodeLabel)
                    $items[$i]['label'] = CHtml::encode($item['label']);
                $hasActiveChild = false;
                if (isset($item['items'])) {
                    $items[$i]['items'] = $this->normalizeItems($item['items'], $route, $hasActiveChild);
                    if (empty($items[$i]['items']) && $this->hideEmptyItems) {
                        unset($items[$i]['items']);
                        if (!isset($item['url'])) {
                            unset($items[$i]);
                            continue;
                        }
                    }
                }
                if (!isset($item['active'])) {
                    if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item, $route))
                        $active = $items[$i]['active'] = true;
                    else
                        $items[$i]['active'] = false;
                }
                elseif ($item['active'])
                    $active = true;
            }
            return array_values($items);
        }
        
    }

    protected function isItemActive($item, $route) {
        if (isset($item['url']) && is_array($item['url']) && !strcasecmp(trim($item['url'][0], '/'), $route)) {
            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                foreach (array_splice($item['url'], 1) as $name => $value) {
                    if (!isset($_GET[$name]) || $_GET[$name] != $value)
                        return false;
                }
            }
            return true;
        }
        return false;
    }

}
