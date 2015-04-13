<?php


class TreeWidget extends CWidget {

    /**
     * CArrayDataProvider 数据对象或数组数据
     * 组件数据接收参数
     * @var Object || array
     */
    public $dataProvider;

    /**
     * 赋值接收数据
     * @var type 
     */
    public $arrAll = array();

    /**
     * 按_ID作键名的多维关系
     * @var type 
     */
    public $arrIdRelation = array();

    /**
     * 按_ID作键名的多维关系的简化,用来输出树状图
     * @var type 
     */
    public $arrIdRelationSimple = array();

    /**
     * 将原始数据转化成的_ID作键名的数组
     * @var type 
     */
    public $arrIdAll = array();

    /**
     * 所有的父子关系
     * @var type 
     */
    public $arrIdSon = array();

    /**
     * 叶子节点的_ID
     * @var type 
     */
    public $arrIdLeaf = array();

    /**
     * 根节点的_ID
     * @var type 
     */
    public $arrIdRoot = array();

    /**
     * 每个节点下的子孙后代_ID
     * @var type 
     */
    public $arrIdChildren = array();

    /**
     * 每个节点回逆到根
     * @var type 
     */
    public $arrIdBackPath = array();

    /**
     * 输出树的结构
     * @var type 
     */
    public $strItem = '<br />{$strSep}{$name}';

    /**
     * 设置表格样式
     * @var type 
     */
    public $tableClass = 'table table-striped table-bordered table-hover table-projects';

    /**
     * 数据字段参数数组
     * @var type 
     */
    public $dataKey = array();

    /**
     * 指定需要格式化的字段
     * @var type 
     */
    public $formatParam = 'name';

    /**
     * 表格列名称
     * @var type 
     */
    public $tableHead = array();

    /**
     * 父ID
     * @var type 
     */
    public $pid = 'pid';

    /**
     * 指定树的类型
     * true 表格类型树
     * false 下拉框类型树
     * @var type 
     */
    public $treeType = true;

    /**
     * 绑定下拉框value值
     * @var type 
     */
    public $optionValue = 'id';

    /**
     * 格式化时间
     * @var type 
     */
    public $formatTime = array();

    /**
     * 下拉框样式
     * @var type 
     */
    public $selectClass = 'class="form-control"';

    /**
     * 设置下拉框的默认值和选项
     * @var type 
     */
    public $defaultSelectValue = array(
        0, '≡ 作为一级栏目 ≡',
    );

    /**
     * 设置下拉框是否多选
     * true 多选
     * false 单选
     * @var type 
     */
    public $isMultiple = false;

    /**
     * 绑定到下拉框的默认值
     * @var type 
     */
    public $bindSelectValue = 0;

    /**
     * 运行
     */
    public function run() {
        if (is_array($this->dataProvider) && count($this->dataProvider) > 0)
            $data = $this->_run($this->dataProvider);
        else if (is_object($this->dataProvider) && count($this->dataProvider->rawData) > 0)
            $data = $this->_run($this->dataProvider->rawData);


        $this->render('tree', array('data' => $data));
    }

    /**
     * 
     * @return type
     */
    private function _run($datas) {
        foreach ($datas as $data)
            $this->arrAll[] = $data;
        $this->dataKey = array_keys($data);

        $this->processData();
        if ($this->treeType === true)
            $data = $this->getTable();
        else
            $data = $this->getSelect($this->pid, $this->bindSelectValue, $this->isMultiple, $this->selectClass, $this->defaultSelectValue);

        return $data;
    }

    /**
     * 获得html
     * @return type
     */
    public function getHtml() {
        return $this->genHtml();
    }

    /**
     * 设置分层字段
     * 表格类型
     * @return string
     */
    public function getItemName() {
        $html = '<tr>';
        foreach ($this->dataKey as $v) {
            if ($this->formatParam == $v)
                $str = '{$strSep}';
            else
                $str = '';

            $html .= '<td>' . $str . '{$' . $v . '}</td>';
        }
        $html .= '</tr>';
        return $html;
    }

    /**
     * 获取表格列名称
     * @return string
     */
    public function getTableHead() {
        $html = '<tr>';
        foreach ($this->tableHead as $v)
            $html .= '<th>' . $v . '</th>';

        $html .= '</tr>';
        return $html;
    }

    /**
     * 获得表格形式的树
     * @return string
     */
    public function getTable() {
        $this->strItem = $this->getItemName();
        $strRe = '<table class="' . $this->tableClass . '">';
        $strRe .= '<thead>' . $this->getTableHead() . '</thead><tbody>';
        $strRe .= $this->genHtml();
        $strRe .= '</tbody></table>';
        return $strRe;
    }

    /**
     * 获取下拉框形式的树
     * @param type $strName
     * @param array $arrValue
     * @param type $blmMulti
     * @param type $strExt
     * @param type $arrFirst
     * @return string
     */
    public function getSelect($strName = 'tree', $arrValue = array(), $blmMulti = false, $strExt = '', $arrFirst = null) {
        !is_array($arrValue) && $arrValue = array($arrValue);
        foreach ($this->arrIdAll as $strTemp => $arrTemp) {
            $this->arrIdAll[$strTemp]['selected'] = '';

            if (in_array($arrTemp['id'], $arrValue)) {
                $this->arrIdAll[$strTemp]['selected'] = ' selected="selected"';
            }
        }
        $this->strItem = '<option value=\"{$' . $this->optionValue . '}\"{$selected} title=\"{$' . $this->formatParam . '}\">{$strSep}{$' . $this->formatParam . '}</option>';
        $strRe = '<select id="id_' . $strName . '" name="' . $strName . ($blmMulti ? '[]' : '') . '"';
        $strRe .= ($blmMulti ? ' multiple="multiple"' : '') . (empty($strExt) ? '' : ' ' . $strExt) . '>';

        if (is_array($arrFirst) && count($arrFirst) == 2) {
            $strRe .= '<option value="' . $arrFirst[0] . '">' . $arrFirst[1] . '</option>';
        }

        $strRe .= $this->getHtml() . '</select>';
        return $strRe;
    }

    /**
     * 数据处理
     * @param type $arrData
     * @return type
     */
    private function helpForGetRelation($arrData) {
        $arrRe = array();
        foreach ($arrData as $strTemp => $arrTemp) {
            $arrRe[$strTemp] = $arrTemp;
            if (isset($this->arrIdRelation[$strTemp])) {
                $arrRe[$strTemp] = $this->arrIdRelation[$strTemp];
            }
            if (count($arrRe[$strTemp]) > 0) {
                $arrRe[$strTemp] = $this->helpForGetRelation($arrRe[$strTemp]);
            } else {
                array_push($this->arrIdLeaf, $strTemp);
            }
        }
        return $arrRe;
    }

    /**
     * 数据处理
     * @param type $arrData
     * @return type
     */
    private function helpForGetChildren($arrData) {
        $arrRe = array_keys($arrData);
        foreach ($arrData as $arrTemp) {
            $arrRe = array_merge($arrRe, $this->helpForGetChildren($arrTemp));
        }
        return $arrRe;
    }

    /**
     * 数据处理
     * @param type $str
     * @return type
     */
    private function helpForGetBackPath($str) {
        $arrRe = array();
        $intTemp = $this->arrIdAll[$str][$this->pid];
        if ($intTemp > 0) {
            $intTemp = '_' . $intTemp;
            array_push($arrRe, $intTemp);
            $arrRe = array_merge($arrRe, $this->helpForGetBackPath($intTemp));
        }
        return $arrRe;
    }

    /**
     * 数据处理
     */
    private function processData() {
        $count = count($this->arrAll);
        foreach ($this->arrAll as $arrTemp) {
            $strTemp = '_' . $arrTemp['id'];
            $this->arrIdAll[$strTemp] = $arrTemp;
            if ($arrTemp[$this->pid] > 0 && $count > 1) {
                $strTemp_ = '_' . $arrTemp[$this->pid];
                !isset($this->arrIdRelation[$strTemp_]) && $this->arrIdRelation[$strTemp_] = array();
                $this->arrIdRelation[$strTemp_][$strTemp] = array();
                !isset($this->arrIdSon[$strTemp_]) && $this->arrIdSon[$strTemp_] = array();
                array_push($this->arrIdSon[$strTemp_], $strTemp);
            } else {
                !isset($this->arrIdRelation[$strTemp]) && $this->arrIdRelation[$strTemp] = array();
                array_push($this->arrIdRoot, $strTemp);
            }
        }

        $this->arrIdRelation = $this->helpForGetRelation($this->arrIdRelation);
        $this->arrIdLeaf = array_unique($this->arrIdLeaf);
        foreach ($this->arrIdRelation as $strTemp => $arrTemp) {
            $this->arrIdChildren[$strTemp] = $this->helpForGetChildren($arrTemp);
            in_array($strTemp, $this->arrIdRoot) && $this->arrIdRelationSimple[$strTemp] = $arrTemp;
        }
        $arrTemp = array_keys($this->arrIdAll);
        foreach ($arrTemp as $strTemp) {
            $this->arrIdBackPath[$strTemp] = $this->helpForGetBackPath($strTemp);
        }
    }

    /**
     * 数据处理
     * @param type $intLen
     * @return string
     */
    private function genSeparator($intLen) {
        $strRe = '';
        $i = 0;
        while ($i < $intLen) {
            $strRe .= '　' . (($i + 1 == $intLen) ? '├' : '│');
            $i++;
        }
        !empty($strRe) && $strRe .= '─';
        return $strRe;
    }

    /**
     * 数据处理
     * @param type $arrRelation
     * @param type $intSep
     * @return type
     */
    private function genHtml($arrRelation = null, $intSep = 0) {
        $strRe = '';
        null === $arrRelation && $arrRelation = $this->arrIdRelationSimple;
        foreach ($arrRelation as $strKey => $arrTemp) {
            if (count($this->arrIdAll[$strKey]) > 0) {
                if (!empty($this->formatTime) && count($this->formatTime) > 0) {
                    foreach ($this->formatTime as $formatTime) {
                        if ($this->arrIdAll[$strKey][$formatTime] > 0) {
                            $this->arrIdAll[$strKey][$formatTime] = date('Y-m-d H:i:s', $this->arrIdAll[$strKey][$formatTime]);
                        }
                    }
                }

                $strSep = $this->genSeparator($intSep);
                extract($this->arrIdAll[$strKey]);
                eval('$strRe .= "' . $this->strItem . '";');
                count($arrTemp) > 0 && $strRe .= $this->genHtml($arrTemp, ($intSep + 1));
            }
        }
        return $strRe;
    }

}
