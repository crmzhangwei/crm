<?php

/* 
 * 用来显示表格的组件。统一显示的样式。
 */

class GGridView extends CGridView
{
    public $template = '{items}';
    public $itemsCssClass= 'table table-striped table-bordered table-hover no-margin-bottom no-border-top';
    public $filte='';

}